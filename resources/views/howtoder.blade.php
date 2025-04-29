<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  
<body class="bg-yellow-50">
    <main class="container mx-auto px-4 py-8">
        <section>
            <h2 class="text-xl font-semibold">Cara Sewa</h2>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="p-4 border rounded-lg bg-white shadow">
                    <h3 class="text-center">Step 1<br>Cari Produk</h3>
                </div>
                <div class="p-4 border rounded-lg bg-white shadow">
                    <h3 class="text-center">Step 2<br>Pilih Tanggal Sewa</h3>
                </div>
                <div class="p-4 border rounded-lg bg-white shadow">
                    <h3 class="text-center">Step 3<br>Pembayaran</h3>
                </div>
                <div class="p-4 border rounded-lg bg-white shadow">
                    <h3 class="text-center">Step 4<br>Konfirmasi</h3>
                </div>
                <div class="p-4 border rounded-lg bg-white shadow">
                    <h3 class="text-center">Step 5<br>Ulasan</h3>
                </div>
            </div>
        </section>

        <section class="mt-8">
            <h2 class="text-xl font-semibold">Syarat & Ketentuan</h2>
            <ol class="list-decimal list-inside mt-4">
                <li>
                    <h3 class="font-bold">Umum</h3>
                    <ul class="list-disc list-inside">
                        <li>Dengan menggunakan layanan Baby Island, pelanggan dianggap telah membaca dan menyetujui syarat & ketentuan ini.</li>
                        <li>Baby Island berhak mengubah ketentuan tanpa pemberitahuan sebelumnya.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Penyewaan & Penggunaan</h3>
                    <ul class="list-disc list-inside">
                        <li>Pelanggan harus memiliki tanggal sewa dengan benar.</li>
                        <li>Produk yang disewa hanya untuk penggunaan pribadi, bukan untuk diperjualbelikan atau disewakan kembali.</li>
                        <li>Barang harus dikembalikan dalam kondisi yang sama seperti saat diterima.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Pembayaran</h3>
                    <ul class="list-disc list-inside">
                        <li>Pembayaran dilakukan sebelum barang dikirim atau diambil.</li>
                        <li>Bukti pembayaran harus disimpan untuk verifikasi pesanan.</li>
                        <li>Tidak ada pengembalian dana setelah transaksi selesai, kecuali dalam kondisi tertentu yang disetujui Baby Island.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Pengiriman & Pengembalian</h3>
                    <ul class="list-disc list-inside">
                        <li>Pelanggan bertanggung jawab atas biaya pengiriman dan pengembalian (jika berlaku).</li>
                        <li>Keterlambatan pengembalian akan dikenakan biaya tambahan sesuai kebijakan.</li>
                        <li>Jika produk mengalami kerusakan atau hilang, pelanggan wajib mengganti sesuai nilai yang ditetapkan.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Pembatalan & Perubahan Pesanan</h3>
                    <ul class="list-disc list-inside">
                        <li>Pembatalan dapat dilakukan sebelum pesanan dikonfirmasi, dan dana akan dikembalikan dengan potongan biaya administrasi.</li>
                        <li>Perubahan tanggal sewa dapat dilakukan dengan menghubungi layanan pelanggan terlebih dahulu.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="font-bold">Tanggung Jawab Pelanggan</h3>
                    <ul class="list-disc list-inside">
                        <li>Pelanggan bertanggung jawab penuh terhadap produk selama masa sewa.</li>
                        <li>Baby Island tidak bertanggung jawab atas kecelakaan atau cedera yang terjadi akibat penggunaan produk yang disewa.</li>
                    </ul>
                </li>
            </ol>
        </section>
    </main>

    <footer class="bg-white mt-8">
        <div class="container mx-auto px-4 py-4">
            <p class="text-center">2024 Baby Island. All Rights Reserved | Terms of Use | Privacy Policy</p>
        </div>
    </footer>
</body>

</x-layout>