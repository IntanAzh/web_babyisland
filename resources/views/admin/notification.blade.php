<x-admin.layout :title="$title">
    <body class="bg-gray-100 font-sans min-h-screen">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md flex flex-col items-center py-6">
                <div class="flex items-center space-x-2 mb-10"></div>

                <!-- Menu -->
                <nav class="w-full px-6 space-y-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        Dashboard</a>
                    <a href="{{ route('admin.allproduk') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        All Products</a>
                    <a href="{{ route('admin.orderlist') }}"
                        class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
                        Order List</a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Notification</h1>

                <!-- Notification Panel -->
                <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-xl">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">Recent Notifications</h2>
                        <button class="text-gray-400 hover:text-gray-600 text-xl leading-none">&times;</button>
                    </div>

                    @php
                        $notifications = [
                            [
                                'name' => 'Mainan Bayi',
                                'price' => 115000,
                                'image' => 'menaradonat.png',
                                'date' => 'Nov 15, 2023',
                                'status' => 'Sold',
                            ],
                            [
                                'name' => 'Alat Tidur Bayi',
                                'price' => 145000,
                                'image' => 'boxbayi.png',
                                'date' => 'Nov 15, 2023',
                                'status' => 'Sold',
                            ],
                            [
                                'name' => 'Baby Monitor - Beaba',
                                'price' => 188000,
                                'image' => 'ayunan.png',
                                'date' => 'Nov 15, 2023',
                                'status' => 'Sold',
                            ],
                        ];
                    @endphp

                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        @foreach ($notifications as $notif)
                            <div class="flex items-center space-x-4 border-b pb-3">
                                <img src="{{ url('/img/admin/' . $notif['image']) }}" alt="Produk"
                                    class="w-14 h-14 object-cover rounded-md">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-800">{{ $notif['name'] }}</p>
                                    <p class="text-sm text-gray-600">
                                        Rp {{ number_format($notif['price'], 0, ',', '.') }}
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $notif['date'] }}</p>
                                </div>
                                <span class="text-xs bg-yellow-400 text-white px-2 py-1 rounded-full">
                                    {{ $notif['status'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </main>
        </div>
    </body>
</x-admin.layout>
