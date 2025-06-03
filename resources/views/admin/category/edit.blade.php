<x-admin.layout :title="'Edit Category'">

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
        <h1 class="text-xl font-semibold mb-1">Edit Category</h1>
        <p class="text-sm text-gray-600 mb-6">Home &gt; All Categories &gt; Edit</p>
        <form class="space-y-6" id="register" method="POST" action="{{ route('kategori.update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Hidden ID field -->
            <input type="hidden" name="id" value="{{ $category->id }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="flex flex-col gap-4">
                    <!-- Category Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                        @error('name')
                            <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                        @enderror
                        <input type="text" name="name" id="name"
                            class="w-full border rounded-md p-2 @error('name') border-red-500 @enderror"
                            placeholder="Type here..." value="{{ old('name', $category->name) }}" />
                    </div>

                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        @error('slug')
                            <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                        @enderror
                        <input type="text" name="slug" id="slug"
                            class="w-full border rounded-md p-2 @error('slug') border-red-500 @enderror"
                            placeholder="Type here..." value="{{ old('slug', $category->slug) }}" />
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        @error('description')
                            <p class="text-red-600 text-sm mb-1">{{ $message }}</p>
                        @enderror
                        <textarea name="description" rows="4"
                            class="w-full border rounded-md p-2 @error('description') border-red-500 @enderror" 
                            placeholder="Type here...">{{ old('description', $category->description) }}</textarea>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="flex justify-center items-center border border-gray-300 rounded-md relative">
                    @if ($category->image)
                        <div class="absolute top-0 left-0 right-0 flex justify-center p-2">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" 
                                 class="h-32 object-cover rounded mb-2" id="current-image">
                        </div>
                    @endif
                    <label for="image"
                        class="w-full h-64 flex flex-col items-center justify-center p-4 cursor-pointer text-center text-gray-400 hover:bg-gray-50 transition"
                        id="drop-area">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 01.88-2.52l4.24-5.66a2 2 0 013.12 0l4.24 5.66A4 4 0 0121 15M12 11v5m0 0h-2m2 0h2" />
                        </svg>
                        <span id="upload-text">
                            @if ($category->image)
                                Change image <br>(current: {{ basename($category->image) }})
                            @else
                                Drop your image here,<br>.jpeg and .png are allowed
                            @endif
                        </span>
                        <input id="image" name="image" type="file" class="hidden"
                            accept="image/jpeg,image/png" />
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-center gap-4 mt-8">
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-8 py-2 rounded-md">UPDATE</button>
                <a href="{{ route('admin.kategori.index') }}"
                    class="border border-gray-300 px-8 py-2 rounded-md text-gray-700 hover:bg-gray-100">CANCEL</a>
            </div>
        </form>

        {{-- Delete Button (separate form) --}}
        <form action="{{ route('kategori.destroy', $category->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.')" 
            class="mt-4 flex justify-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md">DELETE</button>
        </form>
    </main>

    <script>
        const dropArea = document.getElementById('drop-area');
        const input = document.getElementById('image');
        const text = document.getElementById('upload-text');
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        // Function to generate slug from name
        function generateSlug(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        // Update slug when name changes
        nameInput.addEventListener('input', function() {
            slugInput.value = generateSlug(this.value);
        });

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
