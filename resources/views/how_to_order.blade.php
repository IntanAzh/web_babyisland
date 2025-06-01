<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-15 w-[100%]">
        <section class="text-center w-[100%] bg-[#FEF8EF] p-4">
            <h2 class="text-2xl font-bold mb-8">Cara Sewa</h2>

            <div class="flex flex-wrap items-center  gap-6 justify-items-center w-[100%]">
                <!-- Step 1 -->
                <div class="upper flex flex-wrap items-center justify-evenly w-[100%] gap-5">

                    <div class="relative bg-white rounded-xl shadow p-6 w-64">
                        <span
                            class="absolute -top-3 left-4 bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">Step
                            1</span>
                        <div class="flex items-center gap-4 mt-2">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                            </svg>
                            <p class="text-gray-800 font-medium">Cari Produk</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative bg-white rounded-xl shadow p-6 w-64">
                        <span
                            class="absolute -top-3 left-4 bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">Step
                            2</span>
                        <div class="flex items-center gap-4 mt-2">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-800 font-medium">Pilih Tanggal Sewa</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative bg-white rounded-xl shadow p-6 w-64">
                        <span
                            class="absolute -top-3 left-4 bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">Step
                            3</span>
                        <div class="flex items-center gap-4 mt-2">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m-4-1l5-5m0 0l-5-5m5 5H9" />
                            </svg>
                            <p class="text-gray-800 font-medium">Pembayaran</p>
                        </div>
                    </div>
                </div>

                <div class="below flex flex-wrap items-center justify-evenly w-[100%] gap-5">

                    <!-- Step 4 -->
                    <div class="relative bg-white rounded-xl shadow p-6 w-64">
                        <span
                            class="absolute -top-3 left-4 bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">Step
                            4</span>
                        <div class="flex items-center gap-4 mt-2">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <p class="text-gray-800 font-medium">Konfirmasi</p>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative bg-white rounded-xl shadow p-6 w-64">
                        <span
                            class="absolute -top-3 left-4 bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">Step
                            5</span>
                        <div class="flex items-center gap-4 mt-2">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 17l-4-4h8l-4 4z" />
                            </svg>
                            <p class="text-gray-800 font-medium">Ulasan</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-8 bg-[#FDE5C1] p-5">
            <h2 class="text-xl font-semibold">Syarat & Ketentuan</h2>
            <ul class="list-decimal mt-4 p-5">
                <li>
                    <p class="font-bold">Umum</h3>
                    <ul class="list-disc list-inside">
                        <li>Dengan menggunakan layanan Baby Island, pelanggan dianggap telah membaca dan menyetujui
                            syarat & ketentuan ini.</li>
                        <li>Baby Island berhak mengubah ketentuan tanpa pemberitahuan sebelumnya.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Penyewaan & Penggunaan</h3>
                    <ul class="list-disc list-inside">
                        <li>Pelanggan harus memiliki tanggal sewa dengan benar.</li>
                        <li>Produk yang disewa hanya untuk penggunaan pribadi, bukan untuk diperjualbelikan atau
                            disewakan kembali.</li>
                        <li>Barang harus dikembalikan dalam kondisi yang sama seperti saat diterima.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Pembayaran</h3>
                    <ul class="list-disc list-inside">
                        <li>Pembayaran dilakukan sebelum barang dikirim atau diambil.</li>
                        <li>Bukti pembayaran harus disimpan untuk verifikasi pesanan.</li>
                        <li>Tidak ada pengembalian dana setelah transaksi selesai, kecuali dalam kondisi tertentu
                            yang disetujui Baby Island.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Pengiriman & Pengembalian</h3>
                    <ul class="list-disc list-inside">
                        <li>Pelanggan bertanggung jawab atas biaya pengiriman dan pengembalian (jika berlaku).</li>
                        <li>Keterlambatan pengembalian akan dikenakan biaya tambahan sesuai kebijakan.</li>
                        <li>Jika produk mengalami kerusakan atau hilang, pelanggan wajib mengganti sesuai nilai yang
                            ditetapkan.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Pembatalan & Perubahan Pesanan</h3>
                    <ul class="list-disc list-inside">
                        <li>Pembatalan dapat dilakukan sebelum pesanan dikonfirmasi, dan dana akan dikembalikan
                            dengan potongan biaya administrasi.</li>
                        <li>Perubahan tanggal sewa dapat dilakukan dengan menghubungi layanan pelanggan terlebih
                            dahulu.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Tanggung Jawab Pelanggan</h3>
                    <ul class="list-disc list-inside">
                        <li>Pelanggan bertanggung jawab penuh terhadap produk selama masa sewa.</li>
                        <li>Baby Island tidak bertanggung jawab atas kecelakaan atau cedera yang terjadi akibat
                            penggunaan produk yang disewa.</li>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</x-layout>
