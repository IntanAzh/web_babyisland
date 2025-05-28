<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">
        <main class="mt-15">
            <div class="text-sm mb-10 text-center bg-[#FDE5C1] h-[80px] flex items-center justify-center w-[100%]">
                <span class="font-semibold">1 Sewa Produk</span> >
                <span class="text-gray-500">2 Detail Checkout</span> >
                <span class="text-gray-500">3 Pesanan Selesai</span>
            </div>
            <section class="category-container flex gap-7 items-center justify-center">



                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Product Detail -->
                    <div class="md:col-span-2">
                        <table class="w-full border-t border-gray-300">
                            <thead>
                                <tr class="text-left border-b border-gray-300">
                                    <th class="py-2">Produk</th>
                                    <th class="py-2">Harga</th>
                                    <th class="py-2">Jumlah</th>
                                    <th class="py-2">Subtotal</th>
                                    <th class="py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-200">
                                    <td class="py-4 flex items-center space-x-2">
                                        <img src="/images/car-seat.png" alt="Car Seat" class="w-16 h-16">
                                        <span>Car Seat - Maxi Cosi</span>
                                    </td>
                                    <td class="py-4">Rp.160,000</td>
                                    <td class="py-4">1</td>
                                    <td class="py-4">Rp.160,000</td>
                                    <td class="py-4 text-center">
                                        🗑️
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a
                            href="{{ route('produk') }}"class="inline-flex mt-4 items-center bg-orange-100 text-orange-600 px-4 py-2 rounded shadow hover:bg-orange-200 ">
                            ← Kembali Berbelanja </a>
                    </div>

                    <!-- Summary -->
                    <div class="bg-orange-100 p-6 rounded shadow">
                        <h2 class="font-bold text-lg mb-4">Total Sewa</h2>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp.160,000</span>
                        </div>
                        <div class="flex justify-between font-semibold text-lg">
                            <span>Total</span>
                            <span>Rp.160,000</span>
                        </div>
                        <a href="{{ route('detail_co') }}"class="text-orange-400 font-semibold hover:underline">
                            <button class="mt-6 w-full py-2 border rounded hover:bg-orange-200 transition">
                                Checkout
                            </button>
                        </a>

                    </div>
                </div>
                </div>
            </section>
        </main>
    </body>

</x-layout>
