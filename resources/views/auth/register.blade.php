<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body>
        <div class="container mx-auto flex items-center justify-center h-[100vh]">
            {{-- register --}}

            <div class="bg-[#FEF2E0] hadow-md rounded-2xl px-10 py-12 w-[400px]">
                <h2 class="text-2xl font-bold text-center text-gray-700 mb-8">Register</h2>

                <form class="space-y-6" id="register" method="POST" action="/register">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm text-gray-600 mb-1">Username</label>
                        <input type="text" id="username" name="username"
                            class="w-full border-b border-gray-400 focus:outline-none focus:border-orange-400 bg-transparent py-1" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm text-gray-600 mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full border-b border-gray-400 focus:outline-none focus:border-orange-400 bg-transparent py-1" />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm text-gray-600 mb-1">Phone Number</label>
                        <input type="number" id="phone" name="phonenumber"
                            class="w-full border-b border-gray-400 focus:outline-none focus:ring-0 focus:border-orange-400 bg-transparent py-1" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm text-gray-600 mb-1">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full border-b border-gray-400 focus:outline-none focus:border-orange-400 bg-transparent py-1" />
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-orange-300 text-white font-medium py-2 rounded hover:bg-orange-400 transition">Register</button>
                    </div>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Already have an acount?
                    <a href="{{ route('login') }}"class="text-orange-400 font-semibold hover:underline">Login</a>
                </p>
            </div>
        </div>
    </body>
</x-layout>
