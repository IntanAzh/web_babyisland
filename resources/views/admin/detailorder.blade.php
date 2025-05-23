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
            @php
                $order = (object) [
                    'id' => 574,
                    'created_at' => \Carbon\Carbon::parse('2025-04-14'),
                    'delivery_date' => \Carbon\Carbon::parse('2025-04-21'),
                    'status' => 'process',
                    'user' => (object) [
                        'name' => 'Fitria Anjani',
                        'email' => 'fitriaanjani@gmail.com',
                        'phone' => '0812345678',
                    ],
                    'shipping_method' => 'Same day express',
                    'payment_method' => 'Transfer Bank',
                    'payment_status' => 'Sudah Dibayar',
                    'payment_proof_time' => '14 April 2025, 10:25 WIB',
                    'payment_bank' => 'BNI',
                    'payment_card_last_four' => '0987',
                    'delivery_address' => 'Jl. Mawar No. 11, Purwokerto Barat Daya, Banyumas',
                    'items' => [
                        (object) [
                            'name' => 'Tidur – Kasur Bayi',
                            'quantity' => 1,
                            'price' => 256000,
                        ],
                        (object) [
                            'name' => 'Mainan – Ayunan',
                            'quantity' => 1,
                            'price' => 190000,
                        ],
                    ],
                    'shipping_cost' => 25000,
                ];
                $order->subtotal = collect($order->items)->sum('price');
                $order->total = $order->subtotal + $order->shipping_cost;
            @endphp

            <main class="flex-1 p-20 overflow-y-auto bg-orange-50">
                <h1 class="text-2xl font-semibold text-gray-800 mb-1">Order List</h1>
                <p class="text-sm text-gray-600 mb-6">Home &gt; Order List &gt; Detail Order</p>

                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-lg font-semibold">Order ID :
                                #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>
                            <p class="text-sm text-gray-600">
                                {{ $order->created_at->format('d F Y') }} - {{ $order->delivery_date->format('d F Y') }}
                            </p>
                        </div>
                        <p class="font-medium text-gray-700">[Status: {{ ucfirst($order->status) }}]</p>
                    </div>

                    {{-- Grid baris pertama (2 kolom) --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-orange-100 p-4 rounded-lg">
                            <p class="font-semibold mb-1">👤 Customer</p>
                            <p>Nama : {{ $order->user->name }}</p>
                            <p>Email : {{ $order->user->email }}</p>
                            <p>No HP : {{ $order->user->phone }}</p>
                        </div>
                        <div class="bg-orange-100 p-4 rounded-lg">
                            <p class="font-semibold mb-1">🔒 Order Info</p>
                            <p>Shipping : {{ $order->shipping_method }}</p>
                            <p>Metode Pembayaran : {{ $order->payment_method }}</p>
                            <p>Status : Finished</p>
                        </div>
                    </div>

                    {{-- Grid baris kedua (2 kolom) --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-orange-100 p-4 rounded-lg">
                            <p class="font-semibold mb-1">🚚 Deliver to</p>
                            <p>Alamat : {{ $order->delivery_address }}</p>
                        </div>
                        <div class="bg-orange-100 p-4 rounded-lg">
                            <p class="font-semibold mb-1">✏️ Change Status:</p>
                            <ul class="space-y-1 text-sm">
                                <li><input type="radio" checked> ✅ Confirmed</li>
                                <li><input type="radio"> 🟢 Process</li>
                                <li><input type="radio"> ⚪ Delivered</li>
                                <li><input type="radio"> ⚫ Finished</li>
                                <li><input type="radio"> ❌ Canceled</li>
                            </ul>
                            <button class="mt-2 bg-yellow-400 text-white px-3 py-1 rounded shadow">Save</button>
                        </div>
                    </div>

                    {{-- Grid baris ketiga (1 kolom full) --}}
                    <div class="bg-orange-100 p-4 rounded-lg mb-6">
                        <p class="font-semibold mb-1">💳 Payment Info</p>
                        <p>Metode: {{ $order->payment_method }} {{ $order->payment_bank }} (••••
                            {{ $order->payment_card_last_four }})</p>
                        <p>Status: {{ $order->payment_status }}</p>
                        <p>Bukti Pembayaran: {{ $order->payment_proof_time }}</p>
                        <a href="#" class="text-blue-600 underline text-sm">[Lihat bukti pembayaran]</a>
                    </div>

                    <div class="bg-white border rounded-xl p-6">
                        <h3 class="font-semibold text-lg mb-4">Products</h3>
                        <table class="w-full text-sm text-left border-t border-gray-300">
                            <thead class="text-gray-600 border-b">
                                <tr>
                                    <th class="py-2">Products Name</th>
                                    <th>Order ID</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="py-2">{{ $item->name }}</td>
                                        <td>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-right mt-6 text-sm space-y-1">
                            <p>Subtotal: Rp. {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                            <p>Pengiriman: Rp. {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                            <p class="font-bold text-base">Total: Rp. {{ number_format($order->total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
        </div>
    </body>
</x-admin.layout>
