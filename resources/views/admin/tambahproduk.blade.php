<x-admin.layout :title="$title">

    <body class="bg-gray-100 font-sans min-h-screen">

        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md flex flex-col items-center py-6">
                <div class="flex items-center space-x-2 mb-10"> </div>

                <!-- Menu -->
                <nav class="w-full px-6 space-y-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        Dashboard</a>
                    <a href="#"
                        class="block text-center py-3 rounded-full bg-yellow-400 text-gray-800 font-bold shadow">
                        All Products</a>
                    <a href="{{ route('admin.orderlist') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        Order List</a>
                </nav>
            </aside>

                <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
                    <h1 class="text-xl font-semibold mb-1">Product Details</h1>
                    <p class="text-sm text-gray-600 mb-6">Home › All Products › Add New</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-4">
                                <!-- Product Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                    <input type="text" name="name" class="w-full border rounded-md p-2"
                                        placeholder="Type here..." />
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea name="description" rows="4" class="w-full border rounded-md p-2" placeholder="Type here..."></textarea>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="flex justify-center items-center border border-gray-300 rounded-md">
                                <label for="image"
                                    class="w-full h-full flex flex-col items-center justify-center p-4 cursor-pointer text-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 01.88-2.52l4.24-5.66a2 2 0 013.12 0l4.24 5.66A4 4 0 0121 15M12 11v5m0 0h-2m2 0h2" />
                                    </svg>
                                    <span>Drop your image here,<br>.jpeg and .png are allowed</span>
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
                                <input type="text" name="category" class="w-full border rounded-md p-2"
                                    placeholder="Type here..." />
                            </div>

                            <!-- SKU -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                                <input type="text" name="brand" class="w-full border rounded-md p-2"
                                    placeholder="Type here..." />
                            </div>

                            <!-- Brand -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                                <input type="text" name="sku" class="w-full border rounded-md p-2"
                                    placeholder="Type here..." />
                            </div>

                            <!-- Stock -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                                <input type="text" name="rental_price" class="w-full border rounded-md p-2"
                                    placeholder="Type here..." />
                            </div>

                            <!-- Rental Price -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rental Price (for one week)</label>
                                <input type="text" name="stock" class="w-full border rounded-md p-2"
                                    placeholder="Type here..." />
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-center gap-4 mt-8">
                            <button type="submit"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-8 py-2 rounded-md">SAVE</button>
                               <button type="cancel" class="border border-gray-300 px-8 py-2 rounded-md text-gray-700 hover:bg-gray-100">CANCEL</a>
                        </div>
                    </form>
            </div>
        </div>
        </div>
    </body>
</x-admin.layout>
