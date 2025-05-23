<x-admin.layout :title="$title">

    <body class="bg-gray-100 font-sans">
        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md flex flex-col items-center py-6">
                <div class="flex items-center space-x-2 mb-10"> </div>

                <!-- Menu -->
                <nav class="w-full px-6 space-y-4 ">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        Dashboard </a>
                    <a href="#"
                        class="block text-center py-3 rounded-full bg-yellow-400 text-gray-800 font-bold shadow">
                        All Products</a>
                    <a href="{{ route('admin.orderlist') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        Order List</a>
                </nav>

                <!-- Category -->
                <div class="w-full px-6 mt-10">
                    <h3 class="text-sm font-semibold text-gray-600 mb-4">Categories :</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Perlengkapan Perjalanan</span>
                            <span class="bg-yellow-300 text-sm font-bold text-white px-2 py-1 rounded-md">26</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Mainan & Edukasi</span>
                            <span class="bg-yellow-300 text-sm font-bold text-white px-2 py-1 rounded-md">32</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Tidur & Kenyamanan</span>
                            <span class="bg-yellow-300 text-sm font-bold text-white px-2 py-1 rounded-md">22</span>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
                <!-- Baris judul & tombol sejajar -->
                <div class="flex items-center justify-between bg-orange-50 px-2 py-4 mb-6">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">All Products</h1>
                        <p class="text-sm font-semibold text-gray-600">Home &gt; All Products</p>
                    </div>

                    <a href="{{ route('admin.tambahproduk') }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded shadow text-sm">
                        + Add new product </a>
                </div>
                <div class="produk">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ([['img' => 'ayunan.png', 'nama' => 'Tidur - Ayunan', 'stok' => 12], 
                        ['img' => 'boxbayi.png', 'nama' => 'Tidur - Box Bayi', 'stok' => 12], 
                        ['img' => 'menaradonat.png', 'nama' => 'Mainan - Menara', 'stok' => 5],
                         ['img' => 'ayunan.png', 'nama' => 'Tidur - Ayunan', 'stok' => 12],
                          ['img' => 'boxbayi.png', 'nama' => 'Tidur - Box Bayi', 'stok' => 12],
                           ['img' => 'menaradonat.png', 'nama' => 'Mainan - Menara', 'stok' => 5], 
                           ['img' => 'ayunan.png', 'nama' => 'Tidur - Ayunan', 'stok' => 12], 
                           ['img' => 'boxbayi.png', 'nama' => 'Tidur - Box Bayi', 'stok' => 12], 
                           ['img' => 'menaradonat.png', 'nama' => 'Mainan - Menara', 'stok' => 5]
                           ] as $produk)
                            <div class="w-full max-w-xs mx-auto">
                                <a href="{{ route('admin.produkedit') }}"
                                    class="bg-white rounded-xl shadow p-4 flex flex-col items-center justify-center h-64">
                                    <img src="{{ url('/img/admin/' . $produk['img']) }}" alt="Produk"
                                        class="object-cover rounded mb-3" width="120px">
                                    <h3 class="font-semibold text-center text-sm">{{ $produk['nama'] }}</h3>
                                    <p class="mt-1 text-sm font-medium text-green-600 text-center">Stok tersedia:
                                        {{ $produk['stok'] }} pcs</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>


                <!-- Pagination -->
                <div class="mt-10">
                    <nav class="flex justify-center space-x-4 px-6 py-3 ">
                        <ul class="flex space-x-4">
                            <li><a href="#" class="text-gray-600">1</a></li>
                            <li><a href="#" class="text-gray-600">2</a></li>
                            <li><a href="#" class="text-gray-600">3</a></li>
                            <li><a href="#" class="text-gray-600">.</a></li>
                            <li><a href="#" class="text-gray-600">.</a></li>
                            <li><a href="#" class="text-gray-600">.</a></li>
                            <li><a href="#" class="text-gray-600">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </main>
        </div>
    </body>
</x-admin.layout>
