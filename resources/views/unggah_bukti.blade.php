<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class="mx-auto p-4 mt-15">
            <!-- Progress Bar - Consistent with checkout pages -->
            <nav class="text-sm text-gray-600 mb-6">
                <div class="text-sm mb-10 text-center bg-[#FDE5C1] h-[80px] flex items-center justify-center w-[100%]">
                    <span class="text-gray-500">1 Sewa Produk</span> >
                    <span class="text-gray-500">2 Detail Checkout</span> >
                    <span class="font-semibold">3 Unggah Bukti Pembayaran</span>
                </div>
            </nav>

            <div class="min-h-screen flex flex-col items-center justify-center bg-white px-4 py-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Upload Bukti Pembayaran Anda!</h2>

                <!-- Order Summary -->
                <div class="bg-orange-50 p-4 rounded-xl w-full max-w-xl mb-6">
                    <h3 class="font-semibold mb-2">Ringkasan Pesanan</h3>
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
                    <div class="text-sm mt-2">
                        <p>Invoice: <strong>{{ $order->transaction->invoice }}</strong></p>
                        <p>Total: <strong>{{ $order->product->formatPrice($order->total_price) }}</strong></p>
                    </div>
                </div>

                <!-- Bank Account Info -->
                <div class="bg-orange-50 p-4 rounded-xl w-full max-w-xl mb-6">
                    <h3 class="font-semibold mb-2">Informasi Rekening</h3>
                    <p>Bank: <strong>BNI</strong></p>
                    <p>No. Rekening: <strong>123456789</strong></p>
                    <p>Atas Nama: <strong>Baby Island Indonesia</strong></p>
                </div>

                <div class="bg-orange-50 p-8 rounded-xl w-full max-w-xl shadow">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('transaksi.upload.payment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        
                        <div class="mb-4">
                            <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                Bukti Pembayaran
                            </label>
                            <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                                class="block text-sm text-gray-500 rounded-full hover:file:bg-yellow-600">
                            @error('bukti_pembayaran')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2">Note: Untuk pemesanan COD, wajib ambil foto saat
                                menyerahkan uang ke kurir.</p>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                                Unggah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</x-layout>
