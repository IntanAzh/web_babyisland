<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">

        <main class="mx-auto p-4 mt-15">
            <section class="category-container gap-7">
                <div class="bg-[#FEF8EF] min-h-screen ">
                    <div class=" px-6 py-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left: Gambar dan ketersediaan -->
                        <div class="flex flex-col items-center border-r">
                            <img src={{ url('/img/carseat.png') }} alt="Car Seat Maxi Cosi" class="w-72 mb-4">
                            <p class="font-medium">Produk tersedia : <span class="font-bold">15</span></p>
                            <a href="{{ route('checkout') }}"class="text-orange-400 font-semibold hover:underline">
                                <button
                                    class="bg-orange-200 text-gray-800 font-semibold py-2 px-4 mt-6 rounded hover:bg-orange-300 transition">
                                    Sewa Sekarang
                                </button>
                            </a>
                        </div>

                        <!-- Right: Detail Produk -->
                        <div class="flex flex-col gap-4">
                            <h1 class="text-2xl font-semibold">Car Seat - Maxi Cosi</h1>
                            <p class="text-lg font-bold text-gray-700">Rp.25,000 <span class="text-base font-normal">/
                                    hari</span></p>

                            <!-- Kalender Dinamis -->
                            <div class="w-full max-w-xs">
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1"> Tanggal
                                    Sewa</label>
                                <input datepicker type="text" id="tanggal" name="tanggal"
                                    class="datepicker-input w-full border border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2"
                                    placeholder="Pilih tanggal sewa">
                            </div>

                            <!-- Kalender Dinamis -->
                            <div class="w-full max-w-xs">
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1"> Tanggal
                                    Pengembalian</label>
                                <input datepicker type="text" id="tanggal" name="tanggal"
                                    class="datepicker-input w-full border border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2"
                                    placeholder="Pilih tanggal pengembalian">
                            </div>

                            <!-- Harga sewa -->
                            <div class="mt-6">
                                {{-- <h2 class="font-semibold text-lg mb-2">Lama Sewa</h2> --}}
                                <table class="w-[400px] border-gray-400 text-center table-sewa">
                                    <thead class="">
                                        <tr class="border-b">
                                            <td>Lama Sewa</td>
                                            <td>Harga</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b">
                                            <td>1 Minggu</td>
                                            <td>Rp.160,000 (22,857/hari)</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td>2 Minggu</td>
                                            <td>Rp.310,000 (22,143/hari)</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td>3 Minggu</td>
                                            <td>Rp.445,000 (21,190/hari)</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td>4 Minggu</td>
                                            <td>Rp.500,000 (17,857/hari)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-[#FFE2B8] py-10 px-6 md:px-24">
                        <h2 class="text-2xl font-bold mb-4 text-center">Deskripsi</h2>
                        <div class="text-gray-800 space-y-3">
                            <p><strong>Car Seat - Maxi Cosi</strong></p>
                            <p><strong>Mengapa Harus Menyewa Car Seat?</strong><br>
                                Keselamatan anak saat bepergian adalah prioritas utama...</p>

                            <p><strong>Fitur & Keunggulan:</strong></p>
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Sistem Keamanan Standar Internasional</li>
                                <li>Desain Ergonomis & Nyaman</li>
                                <li>Posisi Sandaran Dapat Disesuaikan</li>
                                <li>Mudah Dipasang di Berbagai Kendaraan</li>
                                <li>Cover Bisa Dicuci</li>
                                <li>Cocok untuk Usia 0-4 Tahun</li>
                            </ol>

                            <p><strong>Catatan:</strong></p>
                            <ul class="list-disc list-inside">
                                <li>Bisa diantar ke alamat dengan biaya tambahan</li>
                                <li>Barang harus kembali dalam kondisi bersih</li>
                                <li>Keterlambatan kena biaya Rp. 20.000/hari</li>
                                <li>Kerusakan/kehilangan dikenakan biaya tambahan</li>
                            </ul>
                            <p class="mt-4 font-semibold">Pastikan si kecil tetap aman dan nyaman selama perjalanan!
                                Sewa sekarang hanya di Baby Island!</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Flowbite Datepicker Script -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>
        </main>
    </body>
</x-layout>
