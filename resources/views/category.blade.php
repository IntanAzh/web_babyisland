<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
   
    <body class="bg-gray-100">

        <main class="max-w-7xl mx-auto p-4">
            <h2 class="text-xl font-semibold mb-4">Semua Kategori</h2>
            <ul class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                <li class="bg-white p-4 rounded shadow">
                    <h3 class="font-semibold">Perlengkapan Perjalanan</h3>
                    <ul>
                        <li>Car Seat</li>
                        <li>Stroller</li>
                        <li>Baby Walker</li>
                    </ul>
                </li>
                <li class="bg-white p-4 rounded shadow">
                    <h3 class="font-semibold">Mainan & Edukasi</h3>
                    <ul>
                        <li>Baby Monitor</li>
                        <li>Puzzle</li>
                        <li>Board Book</li>
                    </ul>
                </li>
            </ul>
    
            <h2 class="text-xl font-semibold mb-4">Semua Produk</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded shadow p-4">
                    <img src="carseat.pgn" alt="Produk" class="w-full h-32 object-cover rounded">
                    <h3 class="font-semibold mt-2">Car Seat - Maxi Cosi</h3>
                </div>
                <div class="bg-white rounded shadow p-4">
                    <img src="path_to_image" alt="Produk" class="w-full h-32 object-cover rounded">
                    <h3 class="font-semibold mt-2">Baby Monitor - Beaba</h3>
                </div>
                <!-- Tambahkan produk lainnya di sini -->
            </div>
    
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
    
        <footer class="bg-white mt-8 p-4">
            <div class="max-w-7xl mx-auto flex justify-around">
                <div class="text-center">
                    <h4 class="font-semibold">Bersih & Steril</h4>
                </div>
                <div class="text-center">
                    <h4 class="font-semibold">Harga Terjangkau</h4>
                </div>
                <div class="text-center">
                    <h4 class="font-semibold">Customer Service Responsif</h4>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>2024 Baby Island. All Rights Reserved | Terms of Use | Privacy Policy</p>
            </div>
        </footer>
        
    </body>
  </x-layout>