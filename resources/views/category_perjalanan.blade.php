<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">

        <main class="mx-auto p-4 mt-15">
            <section class="category-container flex gap-7">

              <div class="list p-4 bg-[#FEF8EF] flex-1 min-h-screen ">
                    <h2 class="text-xl font-semibold mb-4">Semua Kategori</h2>
                    <div class="categor">
                        <ul class="flex flex-col gap-3">
                            <li>
                                <h3 class="font-semibold cursor-pointer">Perlengkapan Perjalanan</h3>
                            </li>
                            <li>
                                <a href="{{ route('category_mainan') }}"class="text-orange-400 font-semibold hover:underline"><h3>Mainan & Edukasi</h3></a>
                            </li>
                            <li>
                                <a href="{{ route('category_tidur') }}"class="text-orange-400 font-semibold hover:underline"><h3>Tidur & Kenyamanan</h3></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="produk flex-4 ">
                    <h2 class="text-xl font-bold mb-12">Perlengkapan Perjalanan</h2>
                    <div class="flex gap-5 flex-wrap">
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>
                        <div
                            class="bg-[#FDE5C1] rounded shadow p-4 flex items-center justify-center flex-col w-[200px] h-[200px] cursor-pointer">
                            <img src={{ url('/img/kategori/perlengkapan.png') }} alt="Produk"
                                class=" object-cover rounded " width="100px">
                            <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                        </div>


                        <!-- Tambahkan produk lainnya di sini -->
                    </div>
                </div>
            </section>

            <div class="mt-8">
                <nav class="flex justify-center">
                    <ul class="flex space-x-4">
                        <li><a href="#" class="text-gray-600">1</a></li>
                        <li><a href="#" class="text-gray-600">2</a></li>
                        <li><a href="#" class="text-gray-600">3</a></li>
                        <li><a href="#" class="text-gray-600">Next</a></li>
                    </ul>
                </nav>
            </div>
        </main>

        <section class="bg-[#FBD7A2] mt-8 p-4">
            <div class="unggulan flex items-center justify-center lg:gap-[100px] md:gap-10 gap-5 ">

                <div class="box flex flex-col items-center justify-center">
                    <div
                        class="gambar bg-[#ffffff] p-4 rounded-full md:w-[150px] md:h-[150px] h-[100px] w-[100px] flex justify-center items-center ">
                        <img src={{ url('/img/choose/bling.png') }} alt=" bling" class="md:w-[150px] w-[100px]">
                    </div>

                    <h4 class="font-bold mt-3 text-[12px] text-md md:text-xl">Bersih & Steril</h4>
                </div>
                <div class="box flex flex-col items-center justify-center">
                    <div
                        class="gambar bg-[#ffffff] p-4 rounded-full md:w-[150px] md:h-[150px] h-[100px] w-[100px] flex justify-center items-center ">
                        <img src={{ url('/img/choose/dolar.png') }} alt=" bling" class="md:w-[150px] w-[100px]">
                    </div>

                    <h4 class="font-bold mt-3 text-[12px] text-md md:text-xl">Harga Terjangkau</h4>
                </div>
                <div class="box flex flex-col items-center justify-center">
                    <div
                        class="gambar bg-[#ffffff] p-4 rounded-full md:w-[150px] md:h-[150px] h-[100px] w-[100px] flex justify-center items-center ">
                        <img src={{ url('/img/choose/cs.png') }} alt=" bling" class="md:w-[150px] w-[100px]">
                    </div>

                    <h4 class="font-bold mt-3 text-[12px] md:text-xl">Customer Service Responsif</h4>
                </div>

            </div>
        </section>
    </body>
</x-layout>
