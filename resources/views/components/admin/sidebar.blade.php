<aside class="w-64 bg-white shadow-md flex flex-col items-center py-6">
    <!-- Logo -->
    <div class="flex items-center space-x-2 mb-10">

    </div>

    <!-- Menu -->
    <nav class="w-full px-6 space-y-4 pt-4">
        <x-admin.navlink href="{{ route('admin.dashboard') }}" :active="request()->is('admin/dashboard')">Dashboard</x-admin.navlink>
        <x-admin.navlink href="{{ route('product.index') }}" :active="request()->is('admin/product*')">All Products</x-admin.navlink>
        <x-admin.navlink href="{{ route('order.index') }}" :active="request()->is('admin/order*')">Order List</x-admin.navlink>
        {{-- <a href="#" class="block text-center py-3 rounded-full bg-yellow-400 text-gray-800 font-bold shadow">
            Dashboard </a>
        <a href="" class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
            All Products</a>
        <a href="{{ route('admin.orderlist') }}"
            class="block text-center py-2 text-gray-800 font-semibold hover:text-orange-500">
            Order List</a> --}}
    </nav>
    {{-- @if (request()->is('admin/product'))
        <!-- Category -->
        <div class="w-full px-6 mt-10">
            <h3 class="text-sm font-semibold text-gray-600 mb-4">Categories :</h3>
            <ul class="space-y-3">
                <li class="flex justify-between items-center">
                    <span class="text-gray-700">Perlengkapan Perjalanan</span>
                    <span class="bg-yellow-300 text-sm font-bold text-white px-2 py-1 rounded-md">26</span>
                </li>
                <li class="flex justify-between items-center">
                    <span class="text-gray-700">Mainan & Edukasi</span>
                    <span class="bg-yellow-300 text-sm font-bold text-white px-2 py-1 rounded-md">32</span>
                </li>
                <li class="flex justify-between items-center">
                    <span class="text-gray-700">Tidur & Kenyamanan</span>
                    <span class="bg-yellow-300 text-sm font-bold text-white px-2 py-1 rounded-md">22</span>
                </li>
            </ul>
        </div>
    @endif --}}
</aside>
