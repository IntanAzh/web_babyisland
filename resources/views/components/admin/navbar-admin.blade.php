<nav class="bg-white fixed top-0 left-0 right-0 z-[10000] shadow-md" x-data="{ isOpen: false, notifOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ url('/img/logo.png') }}" title="logo" width="150">
            </div>

            <!-- Right side -->
            <div class="flex items-center gap-4">
                <!-- Search Icon -->
                <button type="button" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </button>

                <!-- Notification -->
                <div class="relative" x-data="{ notifOpen: false }">
                    <button @click="notifOpen = !notifOpen"
                        class="text-gray-600 hover:text-gray-800 focus:outline-none relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 01-3.46 0" />
                        </svg>
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
                    </button>

                    <!-- Dropdown Notification -->
                    <div x-show="notifOpen" @click.away="notifOpen = false" x-transition
                        class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-lg z-50">
                        <div class="p-4 border-b font-semibold">Notifications</div>

                        <ul class="divide-y">
                            <!-- Example Notification Item -->
                            <li class="flex items-start gap-4 p-4 hover:bg-gray-50">
                                <img src="{{ url('/img/admin/ayunan.png') }}"
                                    class="w-12 h-12 rounded-md object-cover" />
                                <div class="flex-1">
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-800">Tidur - Kasur Bayi</span>
                                        <span class="text-xs bg-orange-400 text-white px-2 py-0.5 rounded">Sold</span>
                                    </div>
                                    <p class="text-sm text-gray-600">Rp. 115.000</p>
                                    <p class="text-xs text-gray-400">Nov 15, 2023</p>
                                </div>
                            </li>
                            <!-- Tambahkan notifikasi lain jika ada -->
                        </ul>

                        <div class="flex justify-between items-center p-4 border-t text-sm text-gray-500">
                            <span class="cursor-pointer hover:text-black">✓ MARK ALL AS READ</span>
                            <a href="{{ route('admin.notifications') }}"
                                class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">
                                VIEW ALL NOTIFICATION
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin Dropdown -->
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen"
                        class="inline-flex items-center gap-1 rounded-md bg-white border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none">
                        ADMIN
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <div x-show="isOpen" @click.away="isOpen = false" x-transition
                        class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="px-4 py-3 text-sm text-gray-900 border-b font-semibold">Admin</div>
                        <a href="#"
                            class="flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Change Password
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#"
                            class="flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
