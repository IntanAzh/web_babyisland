<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <header class="bg-white py-10 text-center bg-center bg-cover h-[400px] md:h-[680px] relative z-10 mt-10"
        style="background-image: url(/img/bgBaby.png)">

        <!-- Overlay agar teks lebih terbaca -->
        <div class="absolute bg-white/40 inset-0 z-0"></div>

        <!-- Kontainer teks -->
        <div class="hero-text md:w-[60%] w-[90%] absolute right-2 md:right-4 lg:right-24 top-12 z-10  flex flex-col items-end">
            <h1 class="text-[#F9BD64] text-center text-xl md:text-4xl lg:text-5xl font-extrabold leading-snug">
                Baby Island <br>
                <span class="text-[#F9BD64] font-extrabold text-lg">
                    Solusi Praktis untuk Kebutuhan Si Kecil!
                </span>
            </h1>

            <div class="mt-2 lg:ml-[100px]">
                <p class="text-[#F9BD64] text-xs md:text-lg lg:text-xl font-bold leading-tight md:leading-relaxed text-end md:text-justify ">Kenapa beli kalau bisa sewa?

                    <strong>Stroller, car seat, box bayi, hingga mainan edukatif</strong>, semua ada di sini!


                    Hemat, praktis, dan ramah lingkungan. Yuk, sewa sekarang dan buat momen bersama si kecil lebih
                    nyaman!
                </p>
            </div>
        </div>

    </header>

    <!-- Kategori Rental -->
    <section class="py-10">
        <h2 class="text-center text-2xl md:text-3xl font-black text-[#F9BD64]">Kategori Rental Baby Island</h2>
        <div class="flex justify-center md:space-x-10 mt-5 flex-wrap items-center gap-5">
            <div
                class="text-center perlengakpan flex flex-col items-center bg-[#FEF2E0] p-3 rounded-xl w-[220px] h-[220px]">
                <img src={{ url('/img/kategori/perlengkapan.png') }} alt="perlengkapan" class="w-[100px] h-[150px]">
                <h3 class="mt-2 font-bold">Perlengkapan Perjalanan</h3>
            </div>

            <div
                class="text-center mainan flex flex-col items-center bg-[#FEF2E0] p-3 rounded-xl w-[220px] h-[220px]" ">
                    <img src={{ url('/img/kategori/mainan.png') }} alt="mainan" class="w-[120px] h-[150px]">
                    <h3 class="mt-2 font-bold">Mainan & Edukasi</h3>
                </div>

                <div class="text-center alat-tidur flex flex-col items-center bg-[#FEF2E0] p-3 rounded-xl w-[220px] h-[220px]" ">
                <img src={{ url('/img/kategori/alatTidur.png') }} alt="alat tidur" class="w-[120px] h-[150px]">
                <h3 class="mt-2 font-bold">Tidur & Kenyamanan</h3>
            </div>

        </div>
    </section>

    <!-- Why Choose Baby Island -->
    <section class="bg-[#FEF2E0] py-8 px-2 h">
        <div class="text-center">

            <h2 class="text-center text-2xl font-bold">Why Choose Baby Island</h2>
            <p class="font-bold ">Mendukung Perjalanan Si Kecil dengan Penyewaan Premium, Keamanan <br>Terjamin, dan
                Solusi Keluarga yang
                Disesuaikan dari Baby Island.</p>
        </div>
        <div class="max-w-4xl  mx-auto grid grid-cols-1 md:grid-cols-3 gap-5 mt-5 p-5">
            <div class="p-5shadow-lg rounded flex flex-col items-center">
                <div class="gambar bg-[#FBD7A2] p-4 rounded-full w-[150px] h-[150px] flex justify-center items-center ">
                    <img src={{ url('/img/choose/bling.png') }} alt=" bling" class="w-[150px]">
                </div>
                <h4 class="font-bold mt-3">Bersih & Steril</h4>
                <p class="text-center">Semua perlengkapan bayi dicuci dan didesinfeksi sebelum dikirim.</p>
            </div>
            <div class="p-5shadow-lg rounded flex flex-col items-center md:mt-18">
                <div class="gambar bg-[#FBD7A2] p-4 rounded-full w-[150px] h-[150px] flex justify-center items-center ">
                    <img src={{ url('/img/choose/dolar.png') }} alt=" bling" class="w-[150px]">
                </div>
                <h4 class="font-bold mt-3">Harga Terjangkau</h4>
                <p class="text-center">Sewa perlengkapan bayi lebih ekonomis dibanding beli baru.</p>
            </div>
            <div class="p-5shadow-lg rounded flex flex-col items-center">
                <div class="gambar bg-[#FBD7A2] p-4 rounded-full w-[150px] h-[150px] flex justify-center items-center ">
                    <img src={{ url('/img/choose/cs.png') }} alt=" bling" class="w-[100px]">
                </div>
                <h4 class="font-bold mt-3">Customer Service Responsif</h4>
                <p class="text-center">Siap membantu kapanpun Anda membutuhkan.</p>
            </div>

        </div>
    </section>

    <!-- Testimonial -->
    <section class="py-10">
        <div class="text-choosen text-center">

            <h2 class="text-center text-2xl font-bold">What People Say About Baby Island</h2>
        </div>
        <div class="max-w-4xl  mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 mt-5 p-5">
            <div class="p-5 rounded flex flex-col items-center">
                <div class="gambar bg-[#FBD7A2] p-4 rounded-full w-[80px] h-[80px] flex justify-center items-center ">
                    <img src={{ url('/img/choose/bling.png') }} alt=" bling" class="w-[50px]">
                </div>
                <h4 class="font-bold mt-3 text-[14px]">Fitria Anjani</h4>
                <p class="text-center text-[12px]">“Konsep penyewaan ini sangat membantu! Saya bisa mencoba berbagai perlengkapan bayi tanpa harus membeli.”
                </p>
                <span>⭐⭐⭐⭐⭐</span>
            </div>
            <div class="p-5 rounded flex flex-col items-center">
                <div class="gambar bg-[#FBD7A2] p-4 rounded-full w-[80px] h-[80px] flex justify-center items-center ">
                    <img src={{ url('/img/profil.png') }} alt=" bling" class="w-[50px]">
                </div>
                <h4 class="font-bold mt-3 text-[14px]">Azizah</h4>
                <p class="text-center text-[12px]">“Car seat yang saya sewa bersih dan terawat dengan baik. Harga juga lebih hemat dibanding beli baru.”
                </p>
                <span>⭐⭐⭐⭐⭐</span>
            </div>
            <div class="p-5 rounded flex flex-col items-center">
                <div class="gambar bg-[#FBD7A2] p-4 rounded-full w-[80px] h-[80px] flex justify-center items-center ">
                    <img src={{ url('/img/profil.png') }} alt=" bling" class="w-[50px]">
                </div>
                <h4 class="font-bold mt-3 text-[14px]">Diah F</h4>
                <p class="text-center text-[12px]">“Proses pemesanan mudah, dan pengirimannya tepat waktu.”
                </p>
                <span>⭐⭐⭐⭐⭐</span>
            </div>
            <div class="p-5 rounded flex flex-col items-center">
                <div class="gambar bg-[#FBD7A2] p-4 rounded-full w-[80px] h-[80px] flex justify-center items-center ">
                    <img src={{ url('/img/profil.png') }} alt=" bling" class="w-[50px]">
                </div>
                <h4 class="font-bold mt-3 text-[14px]">Elsyabila</h4>
                <p class="text-center text-[12px]">“Baby Island sangat membantu! Saya menyewa stroller untuk liburan, dan kualitasnya sangat bagus, seperti baru.”
                </p>
                <span>⭐⭐⭐⭐</span>
            </div>
            

        </div>

    </section>

    <!-- Contact -->
    <section class="bg-[#FEF2E0] text-center py-10 px-2">
        <h2 class="text-xl font-semibold">Have a question?</h2>
        <p>Jika ada pertanyaan, jangan ragu untuk menghubungi kami. Kami siap membantu melalui telepon atau email.
        </p>
        <button class="mt-7 bg-white text-black hover:bg-slate-200 transition-all duration-200 ease-in-out py-2 px-6 rounded">Chat</button>
    </section>
</x-layout>
