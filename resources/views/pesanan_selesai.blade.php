<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class="  mt-15">
            <nav class="text-sm text-gray-600 mb-6">
                <div class="text-sm mb-10 text-center bg-[#FDE5C1] h-[80px] flex items-center justify-center w-[100%]">
                    <span class="text-gray-500 ">1 Sewa Produk</span> >
                    <span class="text-gray-500 ">2 Detail Checkout</span> >
                    <span class=" font-semibold">3 Pesanan Selesai</span>
                </div>
            </nav>
            <div class="bg-white min-h-screen px-4 py-8 md:px-16 lg:px-32 font-sans">


                <h2 class="text-xl font-semibold mb-6 text-center text-gray-800">Pesanan Anda Telah Dikonfirmasi!</h2>

                <div class="bg-orange-50 p-6 rounded-lg shadow-sm text-sm text-gray-800">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <p class="text-gray-500">Tanggal</p>
                            <p>10/01/2023</p>
                        </div>
                        <div>
                            <p class="text-gray-500">No Pesanan</p>
                            <p>012345678</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Metode Pembayaran</p>
                            <p>Bank Transfer - BNI</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Alamat</p>
                            <p>Rt 01/01, Banyumas.</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 flex items-center gap-4 mb-4">
                        <img src="https://via.placeholder.com/70x100.png?text=Car+Seat" alt="Car Seat"
                            class="w-20 h-auto rounded">
                        <div class="flex-1">
                            <p class="font-medium">Car Seat - Maxi Cosi</p>
                            <p class="text-gray-500 text-sm">Durasi sewa: 1 Minggu</p>
                        </div>
                        <div class="text-sm">
                            <p>Jumlah: 1</p>
                            <p class="font-semibold">Rp.160,000</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 text-sm">
                        <div class="flex justify-between mb-1">
                            <span>Subtotal</span>
                            <span>Rp.160,000</span>
                        </div>
                        <div class="flex justify-between mb-1">
                            <span>Pengiriman</span>
                            <span>Rp.20,000</span>
                        </div>
                        <div class="flex justify-between font-semibold text-base">
                            <span>Total</span>
                            <span>Rp.180,000</span>
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

                    <div class="text-center">
                        <a href="{{ route('unggah.bukti') }}"class="text-orange-400 font-semibold hover:underline">
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded transition">
                                Unggah Bukti Pembayaran
                            </button>
                        </a>

                    </div>
                </div>
            </div>

        </main>
    </body>
</x-layout>
