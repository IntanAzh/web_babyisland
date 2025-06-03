<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <main class="mt-15">
        <!-- Progress Bar - Improved for mobile -->
        <nav class="text-sm text-gray-600 mb-6">
                <div class="text-sm mb-10 text-center bg-[#FDE5C1] h-[80px] flex items-center justify-center w-[100%]">
                    <span class="text-gray-500 ">1 Sewa Produk</span> >
                    <span class=" font-semibold">2 Detail Checkout</span> >
                    <span class="text-gray-500">3 Pesanan Selesai</span>
                </div>
        </nav>
          <section class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 mb-10 pt-2 sm:pt-4">
            <div class="flex flex-col lg:flex-row lg:gap-8 items-start">
                <!-- Product Detail - Improved mobile responsiveness -->                
                <div class="w-full mb-6 lg:mb-0">
                    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-300 text-gray-700">
                                    <th class="py-5 px-4 text-left text-lg font-semibold">Produk</th>
                                    <th class="py-5 px-4 text-left text-lg font-semibold">Harga/Hari</th>
                                    <th class="py-5 px-4 text-center text-lg font-semibold">Jumlah</th>
                                    <th class="py-5 px-4 text-left text-lg font-semibold">Durasi</th>
                                    <th class="py-5 px-4 text-left text-lg font-semibold">Subtotal</th>
                                    <th class="py-5 px-4"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-300">
                                    <td class="py-7 px-4">
                                        <div class="flex flex-col text-center items-center gap-4">
                                            <img src="{{ asset('storage/' . ($product->image ?? 'carseat.png')) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover">
                                            <div class="flex flex-col">
                                                <span class="font-medium text-base">{{ $product->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-7 px-4">
                                        <span class="text-base">{{ $product->formatPrice($product->price) }}</span>
                                    </td>
                                    <td class="py-7 px-4 text-center">
                                        <span class="text-base">{{ $quantity }}</span>
                                    </td>
                                    <td class="py-7 px-4">
                                        <span class="text-base">{{ $duration }} hari</span>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($rental_start)->format('d M Y') }} - {{ \Carbon\Carbon::parse($rental_end)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="py-7 px-4">
                                        <span class="font-medium text-base">{{ $product->formatPrice($subtotal) }}</span>
                                    </td>
                                    <td class="py-7 px-4">
                                        <a href="{{ route('product.detail', $product->id) }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('category.index') }}" class="inline-flex mt-4 sm:mt-6 items-center text-gray-700 hover:text-gray-900 transition text-sm sm:text-base bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali Berbelanja</span>
                    </a>
                </div>
                  <!-- Summary - Enhanced for better responsiveness -->
                <div class="bg-[#FEF8EF] p-4 sm:p-6 rounded-lg shadow-md w-[50vh] mx-auto lg:mx-0 mt-6 lg:mt-0 sticky top-4 max-w-full lg:max-w-sm">
                    <h2 class="font-bold text-lg sm:text-xl mb-4 sm:mb-6 text-center">Total Sewa</h2>
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex justify-between items-center pb-3 sm:pb-4 border-b border-gray-200">
                            <span class="text-gray-700 text-sm sm:text-base">Subtotal</span>
                            <span class="font-medium text-sm sm:text-base">{{ $product->formatPrice($subtotal) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-1 sm:pt-2 font-semibold text-base sm:text-lg">
                            <span>Total</span>
                            <span>{{ $product->formatPrice($subtotal) }}</span>
                        </div>
                    </div>
                    <form action="{{ route('order.processCheckout') }}" method="POST" class="mt-6 sm:mt-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="{{ $quantity }}">
                        <input type="hidden" name="rental_start" value="{{ $rental_start }}">
                        <input type="hidden" name="rental_end" value="{{ $rental_end }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                        <button type="submit" class="w-full py-3 sm:py-4 px-4 rounded-md border border-gray-400 bg-transparent hover:bg-[#FBD7A2] transition-all duration-300 font-medium text-sm sm:text-base shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-[#FBD7A2] focus:ring-opacity-50">
                            Lanjutkan ke Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</x-layout>
