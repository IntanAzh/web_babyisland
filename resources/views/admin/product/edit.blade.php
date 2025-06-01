<x-admin.layout :title="$title">
    <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
        <h1 class="text-xl font-semibold mb-1">Product Details</h1>
        <p class="text-sm text-gray-600 mb-6">Home &gt; All Products &gt; Product Details</p>

        <div class="bg-white p-6 rounded-xl shadow">
            {{-- Form Update --}}
            <form method="POST" action="{{ route('product.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-3 gap-6 mb-6">
                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <label class="block font-semibold mb-1">Product Name</label>
                            <input name="name" type="text" class="w-full border rounded px-3 py-2"
                                value="{{ $product->name }}">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Description</label>
                            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ $product->description }}</textarea>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-semibold mb-1">Category</label>
                                <select name="category_id"
                                    class="w-full border rounded px-3 py-2 @error('category_id') border-red-500 @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $product->category_id) selected @endif>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">SKU</label>
                                <input name="sku" type="text" class="w-full border rounded px-3 py-2"
                                    value="{{ $product->sku }}">
                            </div>
                            <div>
                                <label class="block font-semibold mb-1">Brand</label>
                                <input name="brand" type="text" class="w-full border rounded px-3 py-2"
                                    value="{{ $product->brand }}">
                            </div>
                            <div>
                                <label class="block font-semibold mb-1">Stock</label>
                                <input name="stock" type="number" class="w-full border rounded px-3 py-2"
                                    value="{{ $product->stock }}">
                            </div>
                            <div>
                                <label class="block font-semibold mb-1">Rental Price (for one week)</label>
                                <input name="price" type="number" class="w-full border rounded px-3 py-2"
                                    value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>

                    {{-- Image Preview --}}
                    <div class="space-y-6">
                        <div class="border rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto">
                        </div>
                        <div class="bg-gray-100 rounded-lg px-4 py-3 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-300 rounded"></div>
                                <span class="text-sm text-gray-700">Product thumbnail.png</span>
                            </div>
                            <span class="text-green-500 text-lg">✔</span>
                        </div>
                    </div>
                </div>

                {{-- Update Button --}}
                <div class="flex justify-center gap-4 w-full">
                    <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md">UPDATE</button>
                    <a href="{{ route('product.index') }}"
                        class="border border-gray-300 px-8 py-2 rounded-md text-gray-700 hover:bg-gray-100">CANCEL</a>
                </div>
            </form>

            {{-- Delete Button (form terpisah) --}}
            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                onsubmit="return confirm('Are you sure?')" class="mt-4 flex justify-center">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-md">DELETE</button>
            </form>
        </div>
    </main>
</x-admin.layout>
