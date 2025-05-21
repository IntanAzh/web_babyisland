<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class="mx-auto p-4 mt-15 relative bg-white">
            <div class="min-h-screen flex flex-col items-center justify-center bg-white px-4 py-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Terima Kasih! Pesanan Anda Akan Kami Konfirmasi</h2>
                <div class="box bg-orange-50 p-8 rounded-xl w-full max-w-xl">
                    <h5 class="font-semibold mb-4">Pesanan Anda telah dibuat. Kami akan segera menyiapkannya dan
                        mengirimkannya sesuai jadwal sewa
                        yang Anda tentukan setelah kami konfirmasi.</h5>

                    <div class="text-center">
                        <a href="{{ route('ulasan') }}"><button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                                Beri Ulasan
                            </button>

                        </a>
                    </div>
                </div>
            </div>

            <div class="back">
                <div class="">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                        <a href="{{ route('home') }}">Kembali Ke Home</a> </button>
                </div>
            </div>
        </main>

    </body>
</x-layout>
