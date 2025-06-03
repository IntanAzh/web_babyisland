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
                <div class="container">
                    <div class="max-w-7xl mx-auto gap-6 bg-white p-6 rounded-lg">
                        <!-- Billing Form -->
                        <h2 class="text-xl font-bold mb-6 text-center">Detail Tagihan</h2>
                        <form action="{{ route('order.process') }}" method="POST" class="flex flex-col lg:flex-row justify-center items-start gap-8">
                            @csrf
                            <div class="w-full lg:w-3/5 p-6 rounded-xl space-y-4 form-detail bg-[#FEF8EF]">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="nama_depan" placeholder="Nama Depan Sesuai KTP"
                                        class="input-style p-3 border rounded-md w-full" required />
                                    <input type="text" name="nama_belakang" placeholder="Nama Belakang Sesuai KTP"
                                        class="input-style p-3 border rounded-md w-full" required />

                                    <input type="text" name="alamat" placeholder="Alamat (Jalan, Blok, RT, RW)"
                                        class="input-style p-3 border rounded-md w-full md:col-span-2" required />

                                    <input type="text" name="kecamatan" placeholder="Kecamatan"
                                        class="input-style p-3 border rounded-md w-full" required />
                                    <input type="text" name="kabupaten" placeholder="Kabupaten"
                                        class="input-style p-3 border rounded-md w-full" required />

                                    <select name="provinsi" class="input-style p-3 border rounded-md w-full md:col-span-2" required>
                                        <option value="">Pilih Provinsi</option>
                                        <option value="jabar">Jawa Barat</option>
                                        <option value="jateng">Jawa Tengah</option>
                                        <option value="jatim">Jawa Timur</option>
                                        <!-- Tambah sesuai kebutuhan -->
                                    </select>

                                    <input type="text" name="kode_pos" placeholder="Kode Pos" class="input-style p-3 border rounded-md w-full" required />
                                    <input type="text" name="no_hp" placeholder="No Hp" class="input-style p-3 border rounded-md w-full" required />

                                    <input type="email" name="email" placeholder="Email"
                                        class="input-style p-3 border rounded-md w-full md:col-span-2" required />

                                    <!-- Add Courier Selection -->
                                    <div class="md:col-span-2">
                                        <label class="block text-gray-700 mb-2">Pilih Kurir</label>
                                        <div class="grid grid-cols-3 gap-4">
                                            <div class="border p-3 rounded-md flex items-center">
                                                <input type="radio" name="courier" value="JNE" id="courier-jne" class="mr-2" required>
                                                <label for="courier-jne" class="flex items-center">
                                                    <img src="{{ asset('images/jne.png') }}" alt="JNE" class="h-8 mr-2">
                                                    <span>JNE</span>
                                                </label>
                                            </div>
                                            <div class="border p-3 rounded-md flex items-center">
                                                <input type="radio" name="courier" value="J&T" id="courier-jnt" class="mr-2">
                                                <label for="courier-jnt" class="flex items-center">
                                                    <img src="{{ asset('images/jnt.png') }}" alt="J&T" class="h-8 mr-2">
                                                    <span>J&T</span>
                                                </label>
                                            </div>
                                            <div class="border p-3 rounded-md flex items-center">
                                                <input type="radio" name="courier" value="SiCepat" id="courier-sicepat" class="mr-2">
                                                <label for="courier-sicepat" class="flex items-center">
                                                    <img src="{{ asset('images/sicepat.png') }}" alt="SiCepat" class="h-8 mr-2">
                                                    <span>SiCepat</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <textarea name="catatan" rows="3" placeholder="Catatan" class="input-style p-3 border rounded-md w-full md:col-span-2"></textarea>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="w-full lg:w-1/3 bg-[#FEF8EF] p-6 rounded-lg">
                                <h2 class="text-xl font-bold mb-6 text-center">Pesanan Anda</h2>
                                <div class="mb-6 pb-4 border-b border-gray-200">
                                    <div class="flex justify-between mb-2">
                                        <span>{{ session('checkout_data.product_name') ?? $product->name }} x {{ session('checkout_data.quantity') ?? '1' }}</span>
                                        <span>{{ $product->formatPrice(session('checkout_data.subtotal') ?? $product->price) }}</span>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <p>Awal sewa: {{ \Carbon\Carbon::parse(session('checkout_data.rental_start'))->format('d/m/Y') }}</p>
                                        <p>Akhir sewa: {{ \Carbon\Carbon::parse(session('checkout_data.rental_end'))->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-between mb-3">
                                    <span>Biaya Pengantaran</span>
                                    <span>Rp.20,000</span>
                                </div>
                                <div class="flex justify-between font-semibold text-lg mb-6 pt-2 border-t border-gray-200">
                                    <span>Total</span>
                                    <span>{{ $product->formatPrice((session('checkout_data.subtotal') ?? $product->price) + 20000) }}</span>
                                </div>

                                <div class="mb-6">
                                    <p class="font-medium mb-3">Pilih Metode Pembayaran</p>
                                    @foreach (['BNI', 'Mandiri', 'BCA'] as $bank)
                                        <div class="flex items-center mb-2">
                                            <input type="radio" name="payment_method"
                                                value="Bank Transfer - {{ $bank }}" class="mr-2 h-4 w-4" id="bank-{{ $bank }}">
                                            <label for="bank-{{ $bank }}">Bank Transfer - {{ $bank }}</label>
                                        </div>
                                    @endforeach
                                    <div class="flex items-center mb-2">
                                        <input type="radio" name="payment_method" value="QRIS" class="mr-2 h-4 w-4" id="qris">
                                        <label for="qris">QRIS</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input type="radio" name="payment_method" value="COD" class="mr-2 h-4 w-4" id="cod" checked>
                                        <label for="cod">Cash On Delivery (COD)</label>
                                    </div>

                                    <!-- Add Account Number Field - Only shows when bank transfer is selected -->
                                    <div id="account-number-container" class="mb-4 hidden">
                                        <label class="block text-gray-700 mb-2">Nomor Rekening Pembayar</label>
                                        <input type="text" name="account_number" placeholder="Masukkan nomor rekening Anda" 
                                            class="input-style p-3 border rounded-md w-full">
                                    </div>
                                </div>

                                <div class="flex items-start mb-6">
                                    <input type="checkbox" name="terms" id="terms" class="mr-2 mt-1 h-4 w-4" required>
                                    <label for="terms" class="text-sm">Saya sudah membaca dan setuju dengan syarat dan
                                        ketentuan*</label>
                                </div>
                                <button type="submit"   
                                    class="w-full bg-orange-400 hover:bg-orange-500 text-white font-semibold py-3 px-4 rounded">
                                    Buat Pesanan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

            <!-- Add JavaScript to toggle account number field visibility -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
                    const accountNumberContainer = document.getElementById('account-number-container');
                    
                    paymentMethods.forEach(method => {
                        method.addEventListener('change', function() {
                            if (this.value.includes('Bank Transfer')) {
                                accountNumberContainer.classList.remove('hidden');
                            } else {
                                accountNumberContainer.classList.add('hidden');
                            }
                        });
                    });
                });
            </script>
    </body>
</x-layout>
