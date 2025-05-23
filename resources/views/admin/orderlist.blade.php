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
                    <a href="{{ route('admin.allproduk') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        All Products</a>
                    <a href="#"
                        class="block text-center py-3 rounded-full bg-yellow-400 text-gray-800 font-bold shadow">
                        Order List</a>
                </nav>
            </aside>

            <!-- Main Dashboard -->
            <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
                <h1 class="text-2xl font-semibold text-gray-800 mb-1">Order List</h1>
                <p class="text-sm text-gray-600 mb-6">Home &gt; Order List</p>

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="bg-white p-4 rounded shadow">
                            <h2 class="font-semibold mb-2">Recent Purchase</h2>
                            <table class="w-full text-sm text-left mt-2">
                                <thead class="bg-orange-100">
                                    <tr>
                                        <th class="px-4 py-2">Order ID</th>
                                        <th class="px-4 py-2">Customer Name</th>
                                        <th class="px-4 py-2">Product</th>
                                        <th class="px-4 py-2">Date</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b cursor-pointer hover:bg-gray-100"
                                        onclick="window.location='{{ route('admin.detailorder') }}'">
                                        <td class="px-4 py-3">#000574</td>
                                        <td class="px-4 py-3">Hana</td>
                                        <td class="px-4 py-3">Tidur – Kasur Bayi</td>
                                        <td class="px-4 py-3">14 Apr 25</td>
                                        <td class="px-4 py-3 text-green-600">Finished</td>
                                        <td class="px-4 py-3">Rp. 265.000</td>
                                    </tr>

                                    <tr class="border-b">
                                        <td class="px-4 py-3">#000575</td>
                                        <td class="px-4 py-3">Intan</td>
                                        <td class="px-4 py-3">Mainan – Ayunan</td>
                                        <td class="px-4 py-3">14 Apr 25</td>
                                        <td class="px-4 py-3 text-green-600">Finished</td>
                                        <td class="px-4 py-3">Rp. 190.000</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-4 py-3">#000576</td>
                                        <td class="px-4 py-3">Evril</td>
                                        <td class="px-4 py-3">Tidur – Kasur Bayi</td>
                                        <td class="px-4 py-3">15 Apr 25</td>
                                        <td class="px-4 py-3 text-yellow-600">Process</td>
                                        <td class="px-4 py-3">Rp. 265.000</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-4 py-3">#000577</td>
                                        <td class="px-4 py-3">Adinda</td>
                                        <td class="px-4 py-3">Tidur – Baby Bouncer</td>
                                        <td class="px-4 py-3">15 Apr 25</td>
                                        <td class="px-4 py-3 text-yellow-600">Process</td>
                                        <td class="px-4 py-3">Rp. 205.000</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-4 py-3">#000578</td>
                                        <td class="px-4 py-3">Azizah</td>
                                        <td class="px-4 py-3">Mainan – Ayunan</td>
                                        <td class="px-4 py-3">15 Apr 25</td>
                                        <td class="px-4 py-3 text-yellow-600">Process</td>
                                        <td class="px-4 py-3">Rp. 190.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</x-admin.layout>
