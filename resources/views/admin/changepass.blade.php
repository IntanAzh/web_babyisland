<x-admin.layout :title="$title">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-orange-50 p-10 rounded-2xl shadow-md w-full max-w-xl">
            <h2 class="text-2xl font-bold text-center mb-1">Change Password</h2>
            <p class="text-sm text-center text-gray-600 mb-8">Reset Your Account Password</p>

            <form>
                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 mb-4">
                    <label for="current_password" class="text-gray-700 md:text-right">Current Password</label>
                    <input type="password" id="current_password" placeholder="Masukkan password lama"
                        class="md:col-span-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 mb-4">
                    <label for="new_password" class="text-gray-700 md:text-right">New Password</label>
                    <input type="password" id="new_password" placeholder="Masukkan password baru"
                        class="md:col-span-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 mb-6">
                    <label for="verify_password" class="text-gray-700 md:text-right">Verify Password</label>
                    <input type="password" id="verify_password" placeholder="Masukkan password baru"
                        class="md:col-span-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-yellow-400 text-white font-semibold py-2 px-6 rounded-md hover:bg-yellow-500 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
