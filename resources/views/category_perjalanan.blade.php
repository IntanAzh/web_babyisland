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
                                <a
                                    href="{{ route('category_mainan') }}"class="text-orange-400 font-semibold hover:underline">
                                    <h3>Mainan & Edukasi</h3>
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('category_tidur') }}"class="text-orange-400 font-semibold hover:underline">
                                    <h3>Tidur & Kenyamanan</h3>
                                </a>
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

        <section class="bg-[#FBD7A2] py-10">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap justify-center gap-10 md:gap-10">
                    <!-- Item -->
                    <div class="flex flex-col items-center text-center max-w-[160px]">
                        <div
                            class="bg-white rounded-full w-[100px] h-[100px] md:w-[100px] md:h-[100px] flex items-center justify-center shadow-md hover:scale-105 transition duration-300 ease-in-out">
                            <img src="{{ url('/img/choose/bling.png') }}" alt="Bersih & Steril"
                                class="w-15 md:w-15">
                        </div>
                        <p class="font-semibold mt-4 text-sm md:text-base text-black">Bersih & Steril</p>
                    </div>

                    <!-- Item -->
                    <div class="flex flex-col items-center text-center max-w-[160px]">
                        <div
                            class="bg-white rounded-full w-[80px] h-[80px] md:w-[100px] md:h-[100px] flex items-center justify-center shadow-md hover:scale-105 transition duration-300 ease-in-out">
                            <img src="{{ url('/img/choose/dolar.png') }}" alt="Harga Terjangkau"
                                class="w-15 md:w-15">
                        </div>
                        <p class="font-semibold mt-4 text-sm md:text-base text-black leading-tight">Harga Terjangkau
                        </p>
                    </div>

                    <!-- Item -->
                    <div class="flex flex-col items-center text-center max-w-[160px]">
                        <div
                            class="bg-white rounded-full w-[80px] h-[80px] md:w-[100px] md:h-[100px] flex items-center justify-center shadow-md hover:scale-105 transition duration-300 ease-in-out">
                            <img src="{{ url('/img/choose/cs.png') }}" alt="CS Responsif" class="w-15 md:w-15">
                        </div>
                        <p class="font-semibold mt-4 text-sm md:text-base text-black">CS Responsif</p>
                    </div>
                </div>
            </div>
        </section>
    </body>
</x-layout>
