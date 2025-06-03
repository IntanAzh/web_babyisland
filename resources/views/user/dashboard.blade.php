<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="py-10">
        <div class="max-w-7xl mx-auto mt-20">
            <!-- Display any flash messages -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-[#FEF8EF] p-6 mb-6">
                <!-- Order Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-sm text-gray-500">Total Orders</h3>
                        <p class="text-2xl font-bold">{{ $stats['total_orders'] }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-sm text-gray-500">Active Orders</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $stats['active_orders'] }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-sm text-gray-500">Completed Orders</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $stats['completed_orders'] }}</p>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="font-semibold text-lg mb-4">Recent Orders</h2>
                    
                    @if($recent_orders->isEmpty())
                        <p class="text-gray-500 text-center py-4">You haven't placed any orders yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-orange-100">
                                    <tr>
                                        <th class="px-4 py-2">Order ID</th>
                                        <th class="px-4 py-2">Product</th>
                                        <th class="px-4 py-2">Rental Period</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Total</th>
                                        <th class="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recent_orders as $order)
                                        <tr class="border-b hover:bg-gray-100">
                                            <td class="px-4 py-3 cursor-pointer">#{{ $order->id }}</td>
                                            <td class="px-4 py-3 cursor-pointer">{{ $order->product->name }}</td>
                                            <td class="px-4 py-3 cursor-pointer">{{ $order->start_date }} - {{ $order->end_date }}</td>
                                            <td class="px-4 py-3 cursor-pointer">
                                                @if($order->status == 'completed')
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                @elseif($order->status == 'processing')
                                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                @elseif($order->status == 'rented')
                                                    <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 cursor-pointer">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3">
                                                @if($order->status == 'completed')
                                                    <a href="{{ route('ulasan', ['order_id' => $order->id, 'product_id' => $order->product_id]) }}" 
                                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                                        Leave Review
                                                    </a>
                                                @endif
                                                
                                                @if($order->status == 'pending' || $order->status == 'processing')
                                                    <form method="POST" action="{{ route('user.cancel-order', $order->id) }}" 
                                                          onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded text-xs">
                                                            Cancel Order
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $recent_orders->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- User Actions -->
            <div class="bg-[#FEF8EF] p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('user.profile') }}" class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50">
                        <div class="p-3 mx-auto w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26 15 3.41 18.13 3.41 22" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold">My Profile</h3>
                    </a>
                    {{-- <a href="{{ route('order.history') }}" class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50">
                        <div class="p-3 mx-auto w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center mb-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.75 12L10.58 14.83L16.25 9.17" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold">Order History</h3>
                    </a> --}}
                    {{-- <a href="#" class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50">
                        <div class="p-3 mx-auto w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12H19M19 12L16 9M19 12L16 15" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 6V5C19 3.89543 18.1046 3 17 3H7C5.89543 3 5 3.89543 5 5V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V18" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold">Logout</h3>
                    </a> --}}

                    <form method="POST" action="{{ route('logout') }}" class="contents">
                        @csrf
                        <button type="submit" class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50 w-full">
                            <div class="p-3 mx-auto w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12H19M19 12L16 9M19 12L16 15" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19 6V5C19 3.89543 18.1046 3 17 3H7C5.89543 3 5 3.89543 5 5V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V18" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold">Log Out</h3>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
