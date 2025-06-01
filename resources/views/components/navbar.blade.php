<!-- Pastikan Alpine.js sudah ada -->
<script src="//unpkg.com/alpinejs" defer></script>

<nav class="bg-white fixed top-0 left-0 right-0 z-[10000] shadow-md" x-data="{ isOpen: false, showNotif: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="shrink-0">
                    <img src="{{ url('/img/logo.png') }}" title="logo" width="150">
                </div>
            </div>

            <!-- Navigasi Desktop -->
            <div class="flex gap-6 items-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <x-navlink href="/" :active="request()->is('/')">Home</x-navlink>
                        <x-navlink href="/how-to-order" :active="request()->is('how-to-order')">How To Order</x-navlink>
                        <x-navlink href="/category" :active="request()->is('category')">Category</x-navlink>
                        <x-navlink href="/login" :active="request()->is('login')">Login</x-navlink>
                    </div>
                </div>

                <!-- Notifikasi -->
                <div class="relative" x-data>
                    <button @click="showNotif = !showNotif" class="relative focus:outline-none">
                        <svg class="w-6 h-6 text-orange-400 hover:text-orange-500" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C8.67 6.165 8 7.388 8 9v5.159c0 .538-.214 1.055-.595 1.436L6 17h9z" />
                        </svg>
                        <span
                            class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                    </button>

                    <!-- Dropdown Notifikasi -->
                    <div x-show="showNotif" @click.away="showNotif = false" x-transition
                        class="absolute right-0 z-50 mt-2 w-80 rounded-lg bg-white shadow-lg ring-1 ring-black/10 p-4 text-sm space-y-3">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-800">Notification</h3>
                            <button @click="showNotif = false"
                                class="text-gray-400 hover:text-gray-600 text-lg font-bold">&times;</button>
                        </div>

                        <!-- Notifikasi 1 -->
                        <div class="flex items-start gap-2 bg-orange-50 border border-orange-200 p-3 rounded-md">
                            <svg class="w-5 h-5 text-orange-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.6A1.75 1.75 0 0116.518 17H3.482a1.75 1.75 0 01-1.742-2.301l6.517-11.6zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-2a1 1 0 01-1-1V8a1 1 0 112 0v2a1 1 0 01-1 1z" />
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800">Pesanan Telah Dikonfirmasi</p>
                                <p class="text-xs text-gray-500">15 April 2025 – 14:32</p>
                            </div>
                        </div>

                        <!-- Notifikasi 2 -->
                        <div class="flex items-start gap-2 bg-orange-50 border border-orange-200 p-3 rounded-md">
                            <svg class="w-5 h-5 text-orange-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.6A1.75 1.75 0 0116.518 17H3.482a1.75 1.75 0 01-1.742-2.301l6.517-11.6zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-2a1 1 0 01-1-1V8a1 1 0 112 0v2a1 1 0 01-1 1z" />
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800">Pembayaran Telah Dikonfirmasi</p>
                                <p class="text-xs text-gray-500">15 April 2025 – 14:32</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profil Dropdown -->
                <div class="relative ml-3">
                    <div>
                        <button type="button" @click="isOpen = !isOpen"
                            class="relative flex max-w-xs items-center rounded-full bg-white-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img src="{{ url('/img/profil.png') }}" alt="profil" class="w-[35px]">
                        </button>
                    </div>

                    <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-0">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-1">Settings</a>
                        <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol menu mobile -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
