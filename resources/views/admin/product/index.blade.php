<x-admin.layout :title="$title">


    <!-- Main Content -->
    <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
        <!-- Baris judul & tombol sejajar -->
        <div class="flex items-center justify-between bg-orange-50 px-2 py-4 mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">All Products</h1>
                <p class="text-sm font-semibold text-gray-600">Home &gt; All Products</p>
            </div>

            <a href="{{ route('product.create') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded shadow text-sm">
                + Add new product </a>
        </div>
        @if ($products->isEmpty())
            <p class="text-gray-600">No products available.</p>
        @else
            <div class="product">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="w-full max-w-xs mx-auto">
                            <a href="{{ route('product.edit', $product->id) }}"
                                class="bg-white rounded-xl shadow p-4 flex flex-col items-center justify-center h-64">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Produk"
                                    class="object-cover rounded mb-3" width="120px">
                                <h3 class="font-semibold text-center text-sm">{{ $product['name'] }}</h3>
                                @if ($product->stock > 0)
                                    <p class="mt-1 text-sm font-medium text-green-600 text-center">
                                        Stock avaiable: {{ $product->stock }} pcs
                                    </p>
                                @else
                                    <p class="mt-1 text-sm font-medium text-red-600 text-center">
                                        Stock not Avaiable
                                    </p>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->links('vendor.pagination.custom') }}
            </div>
        @endif
    </main>
</x-admin.layout>
