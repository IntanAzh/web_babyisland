<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class="mx-auto p-4 mt-24">
            <section class="category-container flex flex-col md:flex-row gap-7">
                <!-- Category Sidebar -->
                <div class="list p-4 bg-[#FEF8EF] md:w-1/4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4">Semua Kategori</h2>
                    <div class="category">
                        <ul class="flex flex-col gap-3">
                            <li>
                                <a href="{{ route('category.index') }}" 
                                   class="{{ !$activeCategory ? 'font-bold text-orange-500' : 'text-gray-700 hover:text-orange-400' }}">
                                    <h3>Semua Produk</h3>
                                </a>
                            </li>
                            
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('category.show', $category->slug) }}" 
                                       class="{{ $activeCategory && $activeCategory->id === $category->id ? 'font-bold text-orange-500' : 'text-gray-700 hover:text-orange-400' }}">
                                        <h3>{{ $category->name }}</h3>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="produk md:w-3/4">
                    <h2 class="text-xl font-bold mb-6">{{ $activeCategory ? $activeCategory->name : 'Semua Produk' }}</h2>
                    
                    @if($products->isEmpty())
                        <div class="flex justify-center items-center h-64">
                            <p class="text-gray-500">Tidak ada produk tersedia untuk kategori ini.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            @foreach($products as $product)
                                <a href="{{ route('product.detail', $product->id) }}" class="product-card">
                                    <div class="bg-[#FDE5C1] rounded-lg shadow p-4 flex items-center justify-center flex-col h-64 hover:shadow-md transition-all">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                             class="object-cover rounded h-32 w-32 mb-4">
                                        <h3 class="font-semibold text-center">{{ $product->name }}</h3>
                                        <p class="text-orange-600 font-medium mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </section>

            <!-- Why Choose Us Section -->
            <section class="bg-[#FBD7A2] py-10 mt-16 rounded-lg">
                <div class="container mx-auto px-4">
                    <h2 class="text-2xl font-bold text-center mb-8">Mengapa Memilih Baby Island?</h2>
                    <div class="flex flex-wrap justify-center gap-10 md:gap-16">
                        <!-- Item -->
                        <div class="flex flex-col items-center text-center max-w-[160px]">
                            <div class="bg-white rounded-full w-[100px] h-[100px] flex items-center justify-center shadow-md hover:scale-105 transition duration-300 ease-in-out">
                                <img src="{{ url('/img/choose/bling.png') }}" alt="Bersih & Steril" class="w-15">
                            </div>
                            <p class="font-semibold mt-4 text-sm md:text-base text-black">Bersih & Steril</p>
                        </div>

                        <!-- Item -->
                        <div class="flex flex-col items-center text-center max-w-[160px]">
                            <div class="bg-white rounded-full w-[100px] h-[100px] flex items-center justify-center shadow-md hover:scale-105 transition duration-300 ease-in-out">
                                <img src="{{ url('/img/choose/dolar.png') }}" alt="Harga Terjangkau" class="w-15">
                            </div>
                            <p class="font-semibold mt-4 text-sm md:text-base text-black leading-tight">Harga Terjangkau</p>
                        </div>

                        <!-- Item -->
                        <div class="flex flex-col items-center text-center max-w-[160px]">
                            <div class="bg-white rounded-full w-[100px] h-[100px] flex items-center justify-center shadow-md hover:scale-105 transition duration-300 ease-in-out">
                                <img src="{{ url('/img/choose/cs.png') }}" alt="CS Responsif" class="w-15">
                            </div>
                            <p class="font-semibold mt-4 text-sm md:text-base text-black">CS Responsif</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</x-layout>
