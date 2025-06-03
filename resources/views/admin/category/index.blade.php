<x-admin.layout :title="$title">

    <!-- Main Content -->
    <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
        <!-- Baris judul & tombol sejajar -->
        <div class="flex items-center justify-between bg-orange-50 px-2 py-4 mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">All Categories</h1>
                <p class="text-sm font-semibold text-gray-600">Home &gt; All Categories</p>
            </div>

            <a href="{{ route('kategori.create') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded shadow text-sm">
                + Add new category </a>
        </div>
        @if ($categories->isEmpty())
            <p class="text-gray-600">No categories available.</p>
        @else
            <div class="category">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($categories as $category)
                        <div class="w-full max-w-xs mx-auto">
                            <a href="{{ route('kategori.edit', $category->id) }}"
                                class="bg-white rounded-xl shadow p-4 flex flex-col items-center justify-center h-64">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="Category"
                                    class="object-cover rounded mb-3" width="120px">
                                <h3 class="font-semibold text-center text-sm">{{ $category['name'] }}</h3>
                                <p class="mt-1 text-sm font-medium text-blue-600 text-center">
                                    {{ $category->product->count() }} products
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Pagination -->
            <div class="mt-10">
                {{ $categories->links('vendor.pagination.custom') }}
            </div>
        @endif
    </main>
</x-admin.layout>
