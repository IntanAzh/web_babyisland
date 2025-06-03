<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['checkout']);
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with(['product', 'transaction'])
                ->latest()
                ->paginate(10);
        } else {
            $orders = Order::where('user_id', auth()->id())
                ->with(['product', 'transaction'])
                ->latest()
                ->paginate(10);
        }
        $title = 'Orders';

        return view('admin.order.index', compact('orders', 'title'));
    }

    public function show(Order $order)
    {
        // Load all necessary related data
        $order->load(['user', 'product', 'transaction']);
        
        $title = 'Detail Orders';
        return view('admin.order.show', compact('order','title'));
    }

    /**
     * Process the checkout request from product page
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rental_start' => 'required|date|after_or_equal:today',
            'rental_end' => 'required|date|after:rental_start',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);
        
        // Check product availability
        if ($product->stock < $validated['quantity']) {
            return back()->with('error', 'Stok produk tidak mencukupi');
        }
        
        // Calculate rental duration and price
        $rental_start = Carbon::parse($validated['rental_start']);
        $rental_end = Carbon::parse($validated['rental_end']);
        $duration = $rental_end->diffInDays($rental_start);
        $quantity = $validated['quantity'];
        
        // Calculate price based on duration (implements discount logic)
        $price_per_day = $product->price;
        if ($duration >= 28) { // 4 weeks
            $price_per_day = $product->price * 0.8; // 20% discount
        } elseif ($duration >= 21) { // 3 weeks
            $price_per_day = $product->price * 0.85; // 15% discount
        } elseif ($duration >= 14) { // 2 weeks
            $price_per_day = $product->price * 0.9; // 10% discount
        } elseif ($duration >= 7) { // 1 week
            $price_per_day = $product->price * 0.95; // 5% discount
        }
        
        $subtotal = $price_per_day * $duration * $quantity;
        
        $title = 'Checkout';
        return view('checkout', compact(
            'product',
            'rental_start',
            'rental_end',
            'duration',
            'quantity',
            'subtotal',
            'title'
        ));
    }

    /**
     * Process order after checkout and redirect to customer details page
     */
    public function processCheckout(Request $request)
    {
        // Validate the input from checkout form
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'rental_start' => 'required|date',
            'rental_end' => 'required|date|after:rental_start',
            'subtotal' => 'required|numeric'
        ]);

        // Get product details
        $product = Product::findOrFail($validated['product_id']);
        
        // Store data in session for the next step
        session([
            'checkout_data' => [
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'rental_start' => $validated['rental_start'],
                'rental_end' => $validated['rental_end'],
                'subtotal' => $validated['subtotal'],
                'product_name' => $product->name,
                'product_image' => $product->image
            ]
        ]);
        
        $title = 'Detail Checkout';
        return view('detail_co', compact('title', 'product'));
    }

    /**
     * Show the checkout detail page (GET method)
     */
    public function showCheckoutDetail()
    {
        // Check if checkout data exists in session
        $checkoutData = session('checkout_data');
        
        if (!$checkoutData) {
            return redirect()->route('home')->with('error', 'Checkout data tidak ditemukan. Silakan ulangi proses pemesanan.');
        }
        
        // Get product details
        $product = Product::findOrFail($checkoutData['product_id']);
        
        $title = 'Detail Checkout';
        return view('detail_co', compact('title', 'product'));
    }

    /**
     * Process the order from the detail checkout form
     */
    public function processOrder(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email',
            'catatan' => 'nullable|string',
            'payment_method' => 'required|string',
            'courier' => 'required|string',
            'account_number' => 'nullable|string|max:50'
        ]);

        // Get checkout data from session
        $checkoutData = session('checkout_data');
        
        if (!$checkoutData) {
            return redirect()->route('home')->with('error', 'Checkout data tidak ditemukan. Silakan ulangi proses pemesanan.');
        }
        
        // Get the product
        $product = Product::findOrFail($checkoutData['product_id']);
        
        // Prepare the address string
        $address = $validated['alamat'] . ', ' . $validated['kecamatan'] . ', ' . 
                   $validated['kabupaten'] . ', ' . $validated['provinsi'] . ' ' . $validated['kode_pos'];
                   
        // Check if the product is still available
        if ($product->stock < $checkoutData['quantity']) {
            return back()->with('error', 'Maaf, stok produk tidak mencukupi.');
        }
        
        // Generate invoice number
        $invoiceNumber = 'INV-' . strtoupper(substr(uniqid(), 0, 8));
        
        // Create the order
        $order = Order::create([
            'user_id' => auth()->id() ?? 1, // Use authenticated user or default to guest user (ID 1)
            'product_id' => $checkoutData['product_id'],
            'qty' => $checkoutData['quantity'],
            'start_date' => $checkoutData['rental_start'],
            'end_date' => $checkoutData['rental_end'],
            'total_price' => $checkoutData['subtotal'] + 20000, // Adding shipping cost of 20000
            'address' => $address,
            'notes' => $validated['catatan'],
            'status' => 'pending',
            'courier' => $validated['courier']
        ]);
        
        // Extract payment method details
        $paymentMethod = explode(' - ', $validated['payment_method']);
        $bankName = isset($paymentMethod[1]) ? $paymentMethod[1] : '';
        
        // Create transaction record
        $transaction = Transaction::create([
            'order_id' => $order->id,
            'bank_name' => $bankName,
            'owner_name' => $validated['nama_depan'] . ' ' . $validated['nama_belakang'],
            'account_number' => $validated['account_number'] ?? '',
            'invoice' => $invoiceNumber,
            'status' => 'pending'
        ]);
        
        // Decrease product stock
        $product->decrement('stock', $checkoutData['quantity']);
        
        // Store some data in session for display on the completion page
        session([
            'order_completed' => [
                'order_id' => $order->id,
                'invoice' => $invoiceNumber,
                'total' => $order->total_price,
                'payment_method' => $validated['payment_method'],
                'courier' => $validated['courier'],
                'address' => $address
            ]
        ]);
        
        // Clear checkout data
        session()->forget('checkout_data');
        
        return redirect()->route('pesanan.selesai');
    }
    
    /**
     * Show order completion page
     */
    public function orderCompleted()
    {
        $orderData = session('order_completed');
        
        if (!$orderData) {
            return redirect()->route('home');
        }
        
        $order = Order::with('product')->findOrFail($orderData['order_id']);
        $title = 'Pesanan Selesai';
        
        return view('pesanan_selesai', compact('order', 'orderData', 'title'));
    }
    
    /**
     * Display form for uploading payment proof
     */
    public function showUploadForm()
    {
        $orderData = session('order_completed');
        
        if (!$orderData) {
            return redirect()->route('home')->with('error', 'Data pesanan tidak ditemukan');
        }
        
        $order = Order::with(['product', 'transaction'])->findOrFail($orderData['order_id']);
        $title = 'Unggah Bukti Pembayaran';
        
        return view('upload_bukti', compact('order', 'title'));
    }
    
    /**
     * Process payment proof upload
     */
    public function uploadPaymentProof(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'account_number' => 'required|string|max:50',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $order = Order::with('transaction')->findOrFail($validated['order_id']);
        
        // Check if order belongs to the current user
        if (auth()->id() && $order->user_id != auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses ke pesanan ini');
        }
        
        // Upload and store the image
        $imagePath = $request->file('payment_proof')->store('payment_proofs', 'public');
        
        // Update transaction with account number and image path
        $order->transaction->update([
            'account_number' => $validated['account_number'],
            'image' => $imagePath
        ]);
        
        return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diunggah. Pesanan Anda sedang diproses.');
    }
}
