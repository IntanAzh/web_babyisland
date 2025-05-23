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
                <p class="text-sm text-gray-600 mb-6">Home › All Products › Product Details</p>

                <div class="bg-white p-6 rounded-xl shadow">
                    <form>
                        <div class="grid md:grid-cols-3 gap-6 mb-6">
                            <div class="md:col-span-2 space-y-4">
                                <div>
                                    <label class="block font-semibold mb-1">Product Name</label>
                                    <input type="text" class="w-full border rounded px-3 py-2" value="Box Bayi">
                                </div>
                                <div>
                                    <label class="block font-semibold mb-1">Description</label>
                                    <textarea rows="4" class="w-full border rounded px-3 py-2">Box bayi nyaman dan aman, cocok untuk bayi usia 0–24 bulan. Dilengkapi dengan pagar pengaman dan bahan lembut, ideal untuk tidur maupun bermain.</textarea>
                                </div>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-semibold mb-1">Category</label>
                                        <input type="text" class="w-full border rounded px-3 py-2"
                                            value="Tidur & Kenyamanan">
                                    </div>
                                    <div>
                                        <label class="block font-semibold mb-1">SKU</label>
                                        <input type="text" class="w-full border rounded px-3 py-2" value="Box-123">
                                    </div>
                                    <div>
                                        <label class="block font-semibold mb-1">Brand</label>
                                        <input type="text" class="w-full border rounded px-3 py-2" value="Sleepy">
                                    </div>
                                    <div>
                                        <label class="block font-semibold mb-1">Stock</label>
                                        <input type="number" class="w-full border rounded px-3 py-2" value="23">
                                    </div>
                                    <div>
                                        <label class="block font-semibold mb-1">Rental Price (for one week)</label>
                                        <input type="text" class="w-full border rounded px-3 py-2"
                                            value="Rp. 145.000">
                                    </div>
                                </div>
                            </div>

                            {{-- Image Preview --}}
                            <div class="space-y-6">
                                <div class="border rounded-lg overflow-hidden">
                                    <img src="{{ url('/img/admin/boxbayi.png') }}" alt="Box Bayi" class="w-full h-auto">
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

                        {{-- Action Buttons --}}
                        <div class="flex justify-center gap-4 w-full">
                            <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md">UPDATE</button>
                            <button type="button" class="bg-yellow-500 text-white px-6 py-2 rounded-md">DELETE</button>
                            <button type="button" class="border px-6 py-2 rounded-md">CANCEL</button>
                        </div>

                    </form>
                </div>
        </div>
        </div>
        </div>
    </body>
</x-admin.layout>
