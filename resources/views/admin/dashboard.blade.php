<x-admin.layout>
    <x-slot:title>{{ $info['title'] }}</x-slot:title>


    <!-- Main Dashboard -->
    <main class="flex-1 p-14 overflow-y-auto bg-orange-50">
        <h1 class="text-2xl font-semibold text-gray-800 mb-1">Dashboard</h1>
        <p class="text-sm text-gray-600 mb-6">Home &gt; Dashboard</p>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg p-4 shadow text-center">
                <div class="text-sm text-gray-500 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20H4v-2a4 4 0 014-4h1">
                        </path>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2">
                        </circle>
                    </svg>
                    <span>Total Users</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $info['total_users'] }} Users</h2>
            </div>

            <div class="bg-white rounded-lg p-4 shadow text-center">
                <div class="text-sm text-gray-500 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 13V7a2 2 0 00-2-2h-4.586a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 2H6a2 2 0 00-2 2v4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8m-4-4v8" />
                    </svg>
                    <span>Total Orders</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $info['total_orders'] }} Orders</h2>
            </div>

            <div class="bg-white rounded-lg p-4 shadow text-center">
                <div class="text-sm text-gray-500 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 12V6a2 2 0 00-2-2h-4.586a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 1H6a2 2 0 00-2 2v6" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16h16M4 20h16" />
                    </svg>
                    <span>Total Products</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $info['total_products'] }} Products</h2>
            </div>

            <div class="bg-white rounded-lg p-4 shadow text-center">
                <div class="text-sm text-gray-500">Total Revenue</div>
                <h2 class="text-xl font-bold text-gray-800 mt-2">
                    {{ $info['total_transactions'] }}
                </h2>
            </div>
        </div>
        {{-- <div class="">
            <!-- Graph and Best Sellers -->
            <div class="flex flex-wrap gap-6 mb-8">
                <!-- Sale Graph -->
                <div class="bg-white p-4 rounded-xl shadow-md border-gray-200 w-[670px]">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Sale Graph
                        </h3>
                        <span class="text-sm text-gray-500">MONTHLY</span>
                    </div>
                    <div class="border-b border-gray-500 mb-4"></div>
                    <div class="flex text-sm text-gray-700 h-61">
                        <!-- Y-axis -->
                        <div class="flex flex-col justify-evenly text-left w-28">
                            <span>Rp. 20.000.000</span>
                            <span>Rp. 15.000.000</span>
                            <span>Rp. 10.000.000</span>
                        </div>
                        <!-- Bar Chart -->
                        <div class="flex-1">
                            <div class="flex items-end justify-between h-48 border-l border-gray-400 relative">
                                <div class="absolute inset-x-0 top-0 border-t border-gray-300"></div>
                                <div class="absolute inset-x-0 top-1/3 border-t border-gray-300"></div>
                                <div class="absolute inset-x-0 top-2/3 border-t border-gray-300"></div>
                                <div class="absolute inset-x-0 bottom-0 border-t border-gray-300"></div>

                                <div class="w-6 bg-orange-300 h-1/3"></div>
                                <!-- April -->
                                <div class="w-6 bg-orange-300 h-2/3"></div>
                                <!-- May -->
                                <div class="w-6 bg-orange-300 h-1/2"></div>
                                <!-- June -->
                                <div class="w-6 bg-orange-300 h-2/5"></div>
                                <!-- July -->
                                <div class="w-6 bg-orange-300 h-1/2"></div>
                                <!-- August -->
                                <div class="w-6 bg-orange-300 h-2/3"></div>
                                <!-- September -->
                                <div class="w-6 bg-orange-300 h-[85%]"></div>
                                <!-- October -->
                            </div>
                            <div class="flex justify-between mt-2 text-xs text-gray-600 px-1">
                                <span>APR</span><span>MAY</span><span>JUN</span><span>JUL</span><span>AUG</span><span>SEP</span><span>OCT</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Best Sellers -->
                <div class="bg-white p-6 rounded-xl shadow-md border-gray-200 col-span-2 w-[366px]">
                    <h3 class="font-semibold justify-between text-gray-800 mb-5 border-b border-gray-700 pb-2">
                        Best Sellers
                    </h3>

                    <div class="flex items-center rounded-xl mb-4 space-x-3">
                        <img src="{{ asset('images/kasur.png') }}" class="w-12 h-12 rounded-lg object-cover"
                            alt="Kasur" />
                        <div>
                            <p class="font-medium text-sm">Tidur - Kasur Bayi</p>
                            <p class="text-xs text-gray-500">Tersewa : 243</p>
                        </div>
                    </div>

                    <div class="flex items-center rounded-xl mb-4 space-x-3">
                        <img src="{{ asset('images/walker.png') }}" class="w-12 h-12 rounded-lg object-cover"
                            alt="Walker" />
                        <div>
                            <p class="font-medium text-sm">Baby Walker - Ubravoo</p>
                            <p class="text-xs text-gray-500">Tersewa : 227</p>
                        </div>
                    </div>

                    <div class="flex items-center rounded-xl mb-4 space-x-3">
                        <img src="{{ asset('images/Monitor.png') }}" class="w-12 h-12 rounded-lg object-cover"
                            alt="Monitor" />
                        <div>
                            <p class="font-medium text-sm">Baby Monitor - Baeba</p>
                            <p class="text-xs text-gray-500">Tersewa : 191</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Recent Orders -->
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
                    @foreach ($info['recent_orders'] as $order)
                        <tr class="border-b">
                            <td class="px-4 py-3">#000574</td>
                            <td class="px-4 py-3">{{ optional($order->user)->username ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ optional($order->product)->name ?? 'N/A' }}</td>

                            <td class="px-4 py-3">14 Apr 25</td>
                            <td class="px-4 py-3 text-green-600">Finished</td>
                            <td class="px-4 py-3">Rp. 265.000</td>
                        </tr>
                        {{-- <tr class="border-t">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                @foreach ($order->produk as $produk)
                                {{ $produk->nama }}<br>
                                @endforeach
                            </td>
                            <td class="px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                        </tr> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-admin.layout>