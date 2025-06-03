<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <main class="mt-15">
        <!-- Progress Bar - Consistent with checkout pages -->
        <nav class="text-sm text-gray-600 mb-6">
            <div class="text-sm mb-10 text-center bg-[#FDE5C1] h-[80px] flex items-center justify-center w-[100%]">
                <span class="text-gray-500">1 Sewa Produk</span> >
                <span class="text-gray-500">2 Detail Checkout</span> >
                <span class="font-semibold">3 Pesanan Selesai</span>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 py-4">
            <h2 class="text-2xl font-bold text-center mb-6">Pesanan Selesai</h2>
            
            <div class="flex flex-col lg:flex-row gap-8 justify-between">
                <!-- Left order details section -->
                <div class="w-full lg:w-3/5 bg-white p-6 rounded-lg">
                    <div class="flex flex-col items-center justify-center mb-6">
                        <div class="bg-[#FEF8EF] rounded-full p-6 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center">Pesanan Anda Telah Dikonfirmasi!</h3>
                    </div>

                    <!-- Order details grid -->
                    <div class="bg-[#FEF8EF] p-6 rounded-lg shadow-sm text-sm text-gray-800">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <p class="text-gray-500">Tanggal</p>
                            <p>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">No Pesanan</p>
                            <p>{{ $order->transaction->invoice }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Metode Pembayaran</p>
                            <p>{{ $orderData['payment_method'] }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Alamat</p>
                            <p>{{ $orderData['address'] }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 flex items-center gap-4 mb-4">
                        @if($order->product->image)
                            <img src="{{ asset('storage/'.$order->product->image) }}" alt="{{ $order->product->name }}" class="w-20 h-auto rounded">
                        @else
                            <img src="{{ asset('img/carseat.png') }}" alt="Product" class="w-20 h-auto rounded">
                        @endif
                        <div class="flex-1">
                            <p class="font-medium">{{ $order->product->name }}</p>
                            <p class="text-gray-500 text-sm">Durasi sewa: {{ \Carbon\Carbon::parse($order->start_date)->diffInDays($order->end_date) }} hari</p>
                        </div>
                        <div class="text-sm">
                            <p>Jumlah: {{ $order->qty }}</p>
                            <p class="font-semibold">{{ $order->product->formatPrice($order->total_price - 20000) }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 text-sm">
                        <div class="flex justify-between mb-1">
                            <span>Subtotal</span>
                            <span>{{ $order->product->formatPrice($order->total_price - 20000) }}</span>
                        </div>
                        <div class="flex justify-between mb-1">
                            <span>Pengiriman</span>
                            <span>Rp.20,000</span>
                        </div>
                        <div class="flex justify-between font-semibold text-base">
                            <span>Total</span>
                            <span>{{ $order->product->formatPrice($order->total_price) }}</span>
                        </div>
                    </div>

                    <hr class="my-6">

                    <div class="text-sm mb-4">
                        <p class="mb-1">Silakan transfer ke rekening berikut:</p>
                        <p><strong>Bank BNI</strong></p>
                        <p>No. Rekening: 123456789</p>
                        <p>Atas Nama: Baby Island Indonesia</p>
                    </div>

                    <p class="text-xs text-gray-600 mb-6 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        Setelah transfer, harap unggah bukti pembayaran di bawah ini.
                    </p>                    
                </div>
                
                <!-- Right order summary section -->
                <div class="w-full lg:w-2/5 bg-[#FEF8EF] p-6 rounded-lg h-fit">
                    <h3 class="text-xl font-bold mb-6 text-center">Ringkasan Pesanan</h3>
                    
                    <div class="mb-6 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span>{{ $order->product->name }} x {{ $order->qty }}</span>
                            <span>{{ $order->product->formatPrice($order->total_price - 20000) }}</span>
                        </div>
                        <div class="text-sm text-gray-600">
                            <p>Durasi sewa: {{ \Carbon\Carbon::parse($order->start_date)->diffInDays($order->end_date) }} hari</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mb-3">
                        <span>Pengiriman</span>
                        <span>Rp.20,000</span>
                    </div>
                    <div class="flex justify-between font-semibold text-lg mb-6 pt-2 border-t border-gray-200">
                        <span>Total</span>
                        <span>{{ $order->product->formatPrice($order->total_price) }}</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                <form action="{{ route('unggah.bukti') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="invoice" value="{{ $order->transaction->invoice }}">
                    <button type="submit" class="bg-[#FF9500] hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition-colors text-center w-full sm:w-auto">
                        Unggah Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-layout>
