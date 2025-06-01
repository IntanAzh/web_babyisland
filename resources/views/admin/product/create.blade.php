<x-admin.layout :title="$title">

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
        <h1 class="text-xl font-semibold mb-1">Product Details</h1>
        <p class="text-sm text-gray-600 mb-6">Home &gt; All Products &gt; Add New</p>
        <form class="space-y-6" id="register" method="POST" action="/admin/product" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="flex flex-col gap-4">
                    <!-- Product Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                        @error('name')
                            <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                        @enderror
                        <input type="text" name="name"
                            class="w-full border rounded-md p-2 @error('name') border-red-500 @enderror"
                            placeholder="Type here..." />
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        @error('description')
                            <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                        @enderror
                        <textarea name="description" rows="4"
                            class="w-full border rounded-md p-2 @error('description') border-red-500 @enderror" placeholder="Type here..."></textarea>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="flex justify-center items-center border border-gray-300 rounded-md relative">
                    <label for="image"
                        class="w-full h-64 flex flex-col items-center justify-center p-4 cursor-pointer text-center text-gray-400 hover:bg-gray-50 transition"
                        id="drop-area">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 01.88-2.52l4.24-5.66a2 2 0 013.12 0l4.24 5.66A4 4 0 0121 15M12 11v5m0 0h-2m2 0h2" />
                        </svg>
                        <span id="upload-text">Drop your image here,<br>.jpeg and .png are allowed</span>
                        <input id="image" name="image" type="file" class="hidden"
                            accept="image/jpeg,image/png" />
                    </label>
                </div>
            </div>

            <!-- 2 Columns Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    @error('category_id')
                        <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                    @enderror
                    <select name="category_id"
                        class="w-full border rounded-md p-2 @error('category_id') border-red-500 @enderror">
                        <option value="" disabled selected>Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- SKU -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                    @error('sku')
                        <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                    @enderror
                    <input type="text" name="sku"
                        class="w-full border rounded-md p-2 @error('sku') border-red-500 @enderror"
                        placeholder="Type here..." />
                </div>

                <!-- Brand -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    @error('brand')
                        <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                    @enderror
                    <input type="text" name="brand"
                        class="w-full border rounded-md p-2 @error('brand') border-red-500 @enderror"
                        placeholder="Type here..." />
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    @error('stock')
                        <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                    @enderror
                    <input type="number" name="stock"
                        class="w-full border rounded-md p-2 @error('stock') border-red-500 @enderror"
                        placeholder="Type here..." />
                </div>

                <!-- Rental Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rental Price (for one week)</label>
                    @error('price')
                        <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                    @enderror
                    <input type="number" name="price"
                        class="w-full border rounded-md p-2 @error('price') border-red-500 @enderror"
                        placeholder="Type here..." />
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-center gap-4 mt-8">
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-8 py-2 rounded-md">SAVE</button>
                <a href="{{ route('product.index') }}"
                    class="border border-gray-300 px-8 py-2 rounded-md text-gray-700 hover:bg-gray-100">CANCEL</a>
            </div>
        </form>
    </main>

    <script>
        const dropArea = document.getElementById('drop-area');
        const input = document.getElementById('image');
        const text = document.getElementById('upload-text');

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropArea.classList.add('bg-gray-100');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropArea.classList.remove('bg-gray-100');
            });
        });

        dropArea.addEventListener('drop', (e) => {
            input.files = e.dataTransfer.files;
            text.innerText = input.files[0].name;
        });

        input.addEventListener('change', () => {
            if (input.files.length > 0) {
                text.innerText = input.files[0].name;
            }
        });
    </script>
</x-admin.layout>
