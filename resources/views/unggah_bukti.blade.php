<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class="mx-auto p-4 mt-15">
            <div class="min-h-screen flex flex-col items-center justify-center bg-white px-4 py-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Upload Bukti Pembayaran Anda!</h2>

                <div class="bg-orange-50 p-8 rounded-xl w-full max-w-xl shadow">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                window.location.href = "{{ route('selesai.unggah') }}";
                            }, 800);
                        </script>
                    @endif

                    <form action="{{ route('unggah.bukti') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <input type="file" name="bukti_pembayaran"
                                class="block text-sm text-gray-500 rounded-full hover:file:bg-yellow-600">
                            @error('bukti_pembayaran')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2">Note: Untuk pemesanan COD, wajib ambil foto saat
                                menyerahkan uang ke kurir.</p>
                        </div>

                        <div class="text-center">
                            <a
                                href="{{ route('selesai.unggah') }}"class="text-orange-400 font-semibold hover:underline">
                                <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                                    Unggah
                                </button>
                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</x-layout>
