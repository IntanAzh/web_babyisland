<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class="mx-auto p-4 mt-15 relative bg-white">
            <div class="min-h-screen flex flex-col items-center justify-center bg-white px-4 py-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Terima Kasih! Bukti Pembayaran Anda Telah Diterima
                </h2>

                <div class="box bg-orange-50 p-8 rounded-xl w-full max-w-xl mb-8">
                    @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="text-center mb-6">
                        <div class="bg-green-100 rounded-full p-4 inline-block mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg">Pembayaran Terkirim!</h3>
                    </div>

                    @if(session('completed_order'))
                    <div class="mb-6 border-b border-gray-200 pb-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Nomor Invoice:</span>
                            <span class="font-semibold">{{ session('completed_order.invoice') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Produk:</span>
                            <span class="font-semibold">{{ session('completed_order.product_name') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="font-semibold">Rp{{ number_format(session('completed_order.total'), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    @endif

                    <h5 class="font-semibold mb-4">Pesanan Anda telah dibuat dan bukti pembayaran Anda telah kami terima.
                        Kami akan segera menyiapkannya dan mengirimkannya sesuai jadwal sewa yang Anda tentukan setelah kami
                        konfirmasi.</h5>

                    <div class="text-center">
                        <a href="{{ route('ulasan') }}">
                            <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                                Beri Ulasan
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mb-10">
                <a href="{{ route('home') }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                    Kembali Ke Home
                </a>
            </div>
        </main>
    </body>
</x-layout>
