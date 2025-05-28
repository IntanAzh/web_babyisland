<x-admin.layout :title="$title">
    <x-slot name="title">{{ $title }}</x-slot>

    <div class="container mx-auto flex items-center justify-center h-[100vh]">
        {{-- login --}}
        <div class="bg-[#FEF2E0] shadow-md rounded-2xl px-10 py-12 w-[400px]">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-8">Login</h2>

            <form class="space-y-6">
                <div>
                    <label for="username" class="block text-sm text-gray-600 mb-1">Username</label>
                    <input type="text" id="username"
                        class="w-full border-b border-gray-400 focus:outline-none focus:border-orange-400 bg-transparent py-1" />
                </div>

                <div>
                    <label for="password" class="block text-sm text-gray-600 mb-1">Password</label>
                    <input type="password" id="password"
                        class="w-full border-b border-gray-400 focus:outline-none focus:border-orange-400 bg-transparent py-1" />
                </div>
                <div>
                    {{-- <a href='{{ route('admin.dashboard') }}'>

                        <button
                            class="w-full bg-orange-300 text-white font-medium py-2 rounded hover:bg-orange-400 transition">
                            Loggalfksdin
                        </button>
                    </a> --}}
                    <a href='{{ route('admin.dashboard') }}'>
                        <div type="submit"
                            class = "w-full bg-orange-300 text-white font-medium py-2 rounded hover:bg-orange-400 transition text-center">
                            Login</div>
                    </a>

                </div>

            </form>
        </div>
    </div>
</x-admin.layout>
