<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class=" mt-15">
            <nav class="text-sm text-gray-600 mb-6">
                <div class="text-sm mb-10 text-center bg-[#FDE5C1] h-[80px] flex items-center justify-center w-[100%]">
                    <span class="text-gray-500 ">1 Sewa Produk</span> >
                    <span class=" font-semibold">2 Detail Checkout</span> >
                    <span class="text-gray-500">3 Pesanan Selesai</span>
                </div>
            </nav>
            <div class=" py-4 flex flex-col justify-center items-center">
                <div class="container  ">


                    <div class=" gap-6 bg-white p-3">
                        <!-- Billing Form -->
                        <h2 class="text-lg font-bold mb-4">Detail Tagihan</h2>
                        <div class="flex flex-wrap gap-10">
                            {{-- <form action="{{ route('checkout.store') }}" method="POST"
                                    class="space-y-4 bg-[#fff1dc] p-6 rounded">
                                    @csrf --}}
                            <form class="w-full max-w-[687px] p-6 rounded-xl space-y-4 form-detail" method="POST"
                                action="#">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="nama_depan" placeholder="Nama Depan Sesuai KTP"
                                        class="input-style  " />
                                    <input type="text" name="nama_belakang" placeholder="Nama Belakang Sesuai KTP"
                                        class="input-style" />

                                    <input type="text" name="alamat" placeholder="Alamat (Jalan, Blok, RT, RW)"
                                        class="input-style md:col-span-2" />

                                    <input type="text" name="kecamatan" placeholder="Kecamatan"
                                        class="input-style" />
                                    <input type="text" name="kabupaten" placeholder="Kabupaten"
                                        class="input-style" />

                                    <select name="provinsi" class="input-style">
                                        <option value="">Pilih Provinsi</option>
                                        <option value="jabar">Jawa Barat</option>
                                        <option value="jateng">Jawa Tengah</option>
                                        <option value="jatim">Jawa Timur</option>
                                        <!-- Tambah sesuai kebutuhan -->
                                    </select>

                                    <input type="text" name="kode_pos" placeholder="Kode Pos" class="input-style" />
                                    <input type="text" name="no_hp" placeholder="No Hp" class="input-style" />

                                    <input type="email" name="email" placeholder="Email"
                                        class="input-style md:col-span-2" />

                                    <textarea name="catatan" rows="3" placeholder="Catatan" class="input-style md:col-span-2"></textarea>
                                </div>


                            </form>

                            <!-- Order Summary -->
                            <div class="bg-[#fff1dc] p-6 rounded">
                                <h2 class="text-lg font-bold mb-4">Pesanan Anda</h2>
                                <div class="mb-4">
                                    <div class="flex justify-between">
                                        <span>Car Seat - Maxi Cosi x 1</span>
                                        <span>Rp.160,000</span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <p>Awal sewa: 12/01/2023</p>
                                        <p>Akhir sewa: 18/01/2023</p>
                                    </div>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span>Biaya Pengantaran</span>
                                    <span>Rp.20,000</span>
                                </div>
                                <div class="flex justify-between font-semibold text-lg mb-4">
                                    <span>Total</span>
                                    <span>Rp.180,000</span>
                                </div>

                                <div class="mb-4">
                                    <p class="font-medium mb-2">Pilih Metode Pembayaran</p>
                                    @foreach (['BNI', 'Mandiri', 'BCA'] as $bank)
                                        <div class="flex items-center mb-1">
                                            <input type="radio" name="payment_method"
                                                value="Bank Transfer - {{ $bank }}" class="mr-2">
                                            <label>Bank Transfer - {{ $bank }}</label>
                                        </div>
                                    @endforeach
                                    <div class="flex items-center mb-1">
                                        <input type="radio" name="payment_method" value="QRIS" class="mr-2">
                                        <label>QRIS</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input type="radio" name="payment_method" value="COD" class="mr-2">
                                        <label>Cash On Delivery (COD)</label>
                                    </div>
                                </div>

                                <div class="flex items-start mb-4">
                                    <input type="checkbox" name="terms" class="mr-2 mt-1">
                                    <label class="text-sm">Saya sudah membaca dan setuju dengan syarat dan
                                        ketentuan*</label>
                                </div>
                                <a
                                    href="{{ route('pesanan.selesai') }}"class="text-orange-400 font-semibold hover:underline">
                                    <button type="submit"
                                        class="w-full bg-orange-400 hover:bg-orange-500 text-white font-semibold py-2 rounded">
                                        Buat Pesanan
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </body>
</x-layout>
