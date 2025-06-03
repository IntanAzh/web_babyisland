<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body class="bg-gray-100">

        <main class="mx-auto p-4 mt-15">
            <section class="category-container gap-7">
                <div class="bg-[#FEF8EF] min-h-screen ">
                    <div class=" px-6 py-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left: Gambar dan ketersediaan -->
                        <div class="flex flex-col items-center md:border-r">
                            <img src="{{ asset('storage/' . ($product->image ?? 'carseat.png')) }}"
                                alt="{{ $product->name }}" class="w-72 mb-4">
                            <p class="font-medium">Produk tersedia : <span class="font-bold">{{ $product->stock }}</span>
                            </p>
                            <form action="{{ route('order.checkout') }}" method="POST" id="rental-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="rental_start" id="hidden-start-date">
                                <input type="hidden" name="rental_end" id="hidden-end-date">
                                <input type="hidden" name="quantity" value="1">
                                <button type="button" onclick="validateAndSubmit()" 
                                    class="bg-orange-200 text-gray-800 font-semibold py-2 px-4 mt-6 rounded hover:bg-orange-300 transition">
                                    Sewa Sekarang
                                </button>
                            </form>
                        </div>

                        <!-- Right: Detail Produk -->
                        <div class="flex flex-col gap-4 items-center">
                            <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>
                            <p class="text-lg font-bold text-gray-700">{{ $product->formatPrice($product->price) }}
                                <span class="text-base font-normal">/ hari</span></p>

                            <!-- Kalender Dinamis -->
                            <div class="w-full max-w-xs">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1"> Tanggal
                                    Sewa</label>
                                <input datepicker datepicker-format="dd-mm-yyyy" type="text" id="start_date" name="start_date"
                                    class="datepicker-input w-full border border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2"
                                    placeholder="Pilih tanggal sewa" onchange="updateHiddenDate('start')">
                            </div>

                            <!-- Kalender Dinamis -->
                            <div class="w-full max-w-xs">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1"> Tanggal
                                    Pengembalian</label>
                                <input datepicker datepicker-format="dd-mm-yyyy" type="text" id="end_date" name="end_date"
                                    class="datepicker-input w-full border border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 p-2"
                                    placeholder="Pilih tanggal pengembalian" onchange="updateHiddenDate('end')">
                            </div>

                            <!-- Harga sewa -->
                            <div class="mt-6">
                                <table class="w-[400px] border-gray-400 text-center table-sewa">
                                    <thead class="">
                                        <tr class="border-b">
                                            <td>Lama Sewa</td>
                                            <td>Harga</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b">
                                            <td>1 Minggu</td>
                                            <td>{{ $product->formatPrice($rentalPrices['1_week']['total']) }}
                                                ({{ $product->formatPrice($rentalPrices['1_week']['per_day']) }}/hari)
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td>2 Minggu</td>
                                            <td>{{ $product->formatPrice($rentalPrices['2_weeks']['total']) }}
                                                ({{ $product->formatPrice($rentalPrices['2_weeks']['per_day']) }}/hari)
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td>3 Minggu</td>
                                            <td>{{ $product->formatPrice($rentalPrices['3_weeks']['total']) }}
                                                ({{ $product->formatPrice($rentalPrices['3_weeks']['per_day']) }}/hari)
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td>4 Minggu</td>
                                            <td>{{ $product->formatPrice($rentalPrices['4_weeks']['total']) }}
                                                ({{ $product->formatPrice($rentalPrices['4_weeks']['per_day']) }}/hari)
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-[#FFE2B8] py-10 px-6 md:px-24 max-w-7xl mx-auto">
                        <h2 class="text-2xl font-bold mb-4 text-center">Deskripsi</h2>
                        <div class="text-gray-800 space-y-3">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>
            </section>
            <!-- Flowbite Datepicker Script -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Initialize datepickers with proper configuration
                    const options = {
                        format: 'dd-mm-yyyy',
                        autohide: true,
                        todayHighlight: true,
                        clearBtn: true
                    };
                    
                    // Initialize datepickers
                    const startDatePicker = document.getElementById('start_date');
                    const endDatePicker = document.getElementById('end_date');
                    
                    // Add event listeners for when datepicker changes date
                    startDatePicker.addEventListener('changeDate', function() {
                        updateHiddenDate('start');
                    });
                    
                    endDatePicker.addEventListener('changeDate', function() {
                        updateHiddenDate('end');
                    });
                    
                    // Also listen for input events as a fallback
                    startDatePicker.addEventListener('input', function() {
                        updateHiddenDate('start');
                    });
                    
                    endDatePicker.addEventListener('input', function() {
                        updateHiddenDate('end');
                    });
                });

                function updateHiddenDate(type) {
                    if (type === 'start') {
                        const displayValue = document.getElementById('start_date').value;
                        document.getElementById('hidden-start-date').value = convertToISODate(displayValue);
                        console.log('Start date updated to:', document.getElementById('hidden-start-date').value);
                    } else {
                        const displayValue = document.getElementById('end_date').value;
                        document.getElementById('hidden-end-date').value = convertToISODate(displayValue);
                        console.log('End date updated to:', document.getElementById('hidden-end-date').value);
                    }
                }
                
                // Convert from "DD-MM-YYYY" to "YYYY-MM-DD" format
                function convertToISODate(displayDate) {
                    if (!displayDate) return '';
                    
                    try {
                        // Split the parts using dash separator
                        const parts = displayDate.split('-');
                        if (parts.length !== 3) return '';
                        
                        const day = parts[0].padStart(2, '0');
                        const month = parts[1].padStart(2, '0');
                        const year = parts[2];
                        
                        if (!day || !month || !year) return '';
                        
                        return `${year}-${month}-${day}`;
                    } catch (e) {
                        console.error('Error converting date format:', e);
                        return '';
                    }
                }
                
                function validateAndSubmit() {
                    const startDate = document.getElementById('hidden-start-date').value;
                    const endDate = document.getElementById('hidden-end-date').value;
                    
                    console.log('Validating dates:', startDate, endDate);
                    
                    if (!startDate || !endDate) {
                        alert('Silakan pilih tanggal sewa dan tanggal pengembalian');
                        return;
                    }
                    
                    // We expect dates in YYYY-MM-DD format for validation
                    try {
                        const start = new Date(startDate);
                        const end = new Date(endDate);
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        
                        console.log('Parsed dates - Start:', start, 'End:', end, 'Today:', today);
                        
                        if (isNaN(start.getTime()) || isNaN(end.getTime())) {
                            alert('Tanggal tidak valid');
                            return;
                        }
                        
                        if (start < today) {
                            alert('Tanggal sewa tidak boleh lebih awal dari hari ini');
                            return;
                        }
                        
                        if (end <= start) {
                            alert('Tanggal pengembalian harus setelah tanggal sewa');
                            return;
                        }
                        
                        document.getElementById('rental-form').submit();
                    } catch (e) {
                        console.error('Error validating dates:', e);
                        alert('Terjadi kesalahan saat memproses tanggal. Silakan coba lagi.');
                    }
                }
</script>
        </main>
    </body>
</x-layout>
