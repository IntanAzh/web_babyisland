<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <main class="mt-15">
        <!-- Progress Bar - Consistent with checkout pages -->
        <nav class="text-sm text-gray-600 mb-6">
            <div class="text-sm mb-10 text-center bg-[#FDE5C1] h-[80px] flex items-center justify-center w-[100%]">
                <span class="text-gray-500">1 Sewa Produk</span> >
                <span class="text-gray-500">2 Detail Checkout</span> >
                <span class="font-semibold">3 Unggah Bukti Pembayaran</span>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto px-4 py-6">
            <h2 class="text-2xl font-bold text-center mb-6">Unggah Bukti Pembayaran</h2>

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="bg-[#FEF8EF] p-6 rounded-lg shadow-md mb-6">
                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="font-medium text-lg">No. Invoice: {{ $order->transaction->invoice }}</p>
                        <p class="text-gray-600">Tanggal: {{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="bg-orange-100 px-3 py-1 rounded-full">
                        <p class="text-orange-600 font-medium">{{ ucfirst($order->status) }}</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Detail Produk:</h3>
                    <div class="flex items-center gap-3 mb-2">
                        @if($order->product->image)
                            <img src="{{ asset('storage/'.$order->product->image) }}" alt="{{ $order->product->name }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium">{{ $order->product->name }}</p>
                            <p class="text-sm text-gray-600">Jumlah: {{ $order->qty }} × {{ $order->product->formatPrice($order->product->price) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-600">Total Harga:</p>
                        <p class="font-bold">{{ $order->product->formatPrice($order->total_price) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Metode Pembayaran:</p>
                        <p>{{ $order->transaction->bank_name }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-[#FEF8EF] p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Upload Bukti Pembayaran</h3>
                
                <div class="mb-4 p-4 bg-orange-50 rounded-lg border border-orange-100">
                    <h4 class="font-medium mb-2">Informasi Rekening:</h4>
                    <p>Bank: <strong>BNI</strong></p>
                    <p>No. Rekening: <strong>123456789</strong></p>
                    <p>Atas Nama: <strong>Baby Island Indonesia</strong></p>
                </div>

                <form action="{{ route('upload.payment') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    
                    <div>
                        <label for="account_number" class="block text-gray-700 mb-1">Nomor Rekening Pengirim</label>
                        <input type="text" id="account_number" name="account_number" required
                            class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-orange-300"
                            placeholder="Masukkan nomor rekening pengirim">
                        @error('account_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="payment_proof" class="block text-gray-700 mb-1">Bukti Transfer (JPG, PNG, maks 2MB)</label>
                        <input type="file" id="payment_proof" name="payment_proof" required
                            class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-orange-300"
                            accept="image/jpeg,image/png,image/jpg">
                        @error('payment_proof')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-[#FF9500] hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition-colors">
                            Upload Bukti Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>