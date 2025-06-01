<x-admin.layout :title="$title">

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
                            @foreach ($orders as $order)
                                <tr class="border-b cursor-pointer hover:bg-gray-100"
                                    onclick="window.location='{{ route('order.show', $order->id) }}'">
                                    <td class="px-4 py-3">#{{ $order->id }}</td>
                                    <td class="px-4 py-3">{{ $order->user->username }}</td>
                                    <td class="px-4 py-3">{{ $order->product->name }}</td>
                                    <td class="px-4 py-3">{{ $order->start_date }} - {{ $order->end_date }}</td>
                                    <td class="px-4 py-3 text-green-600">{{ $order->status }}</td>
                                    <td class="px-4 py-3">{{ $order->total_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-10">
            {{ $orders->links('vendor.pagination.custom') }}
        </div>
    </main>
</x-admin.layout>
