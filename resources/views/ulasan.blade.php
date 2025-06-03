<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body>
        <div class="min-h-screen flex items-center justify-center bg-white py-10 px-4">
            <div class="bg-orange-50 p-6 rounded-xl w-full max-w-md shadow-md text-center space-y-4">
                <h2 class="text-lg font-semibold text-gray-700">Berikan Ulasan Anda!</h2>

                <form id="reviewForm" class="space-y-4">
                    @csrf

                    <div class="text-center flex flex-col justify-center items-center">
                        <p class="mb-2 font-medium text-gray-700">Seberapa puas Anda dengan Baby Island?</p>
                        <div id="stars" class="flex justify-center space-x-1 cursor-pointer text-3xl ">
                            @for ($i = 1; $i <= 5; $i++)
                                <span data-star="{{ $i }}" class="star text-gray-300">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" value="0">
                    </div>

                    <textarea name="ulasan" id="ulasan" rows="4" placeholder="Tulis ulasan anda disini..."
                        class="w-full p-3 rounded border border-gray-200 focus:ring-yellow-400 focus:outline-none"></textarea>

                    <!-- Add order_id field if available in the URL -->
                    @if(request()->has('order_id'))
                        <input type="hidden" name="order_id" id="order_id" value="{{ request('order_id') }}">
                    @endif

                    <!-- Add product_id field if available in the URL -->
                    @if(request()->has('product_id'))
                        <input type="hidden" name="product_id" id="product_id" value="{{ request('product_id') }}">
                    @endif

                    <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-6 rounded w-full">
                        Kirim
                    </button>
                </form>
            </div>
        </div>

        <!-- Pop-up -->
        <div id="popup" class="fixed inset-0 bg-opacity-40 flex  items-center justify-center hidden z-50">
            <div class="bg-yellow-400 text-center p-8 rounded-2xl shadow-xl w-full max-w-md space-y-4">
                <!-- Icon -->
                <div class="text-5xl text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24"
                        stroke="white" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <!-- Text -->
                <div>
                    <p class="text-lg font-semibold text-gray-800">Ulasan berhasil dikirim!</p>
                    <p class="text-gray-800">Terima kasih telah berbagi pengalaman Anda bersama Baby Island.</p>
                </div>

                <!-- Button -->
                <button onclick="closePopup()"
                    class="mt-2 px-6 py-2 bg-white text-gray-800 font-semibold rounded hover:bg-gray-100 transition">
                    Kembali
                </button>
            </div>
        </div>
        <script>
            const stars = document.querySelectorAll(".star");
            const ratingInput = document.getElementById("rating");

            stars.forEach((star, index) => {
                star.addEventListener("click", () => {
                    ratingInput.value = index + 1;
                    updateStars(index);
                });
            });

            function updateStars(activeIndex) {
                stars.forEach((star, index) => {
                    if (index <= activeIndex) {
                        star.classList.add("text-yellow-400");
                        star.classList.remove("text-gray-300");
                    } else {
                        star.classList.remove("text-yellow-400");
                        star.classList.add("text-gray-300");
                    }
                });
            }

            // Handle form submission
            document.getElementById('reviewForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData();
                formData.append('rating', document.getElementById('rating').value);
                formData.append('ulasan', document.getElementById('ulasan').value);
                
                // Add order_id if it exists
                const orderIdInput = document.getElementById('order_id');
                if (orderIdInput) {
                    formData.append('order_id', orderIdInput.value);
                }
                
                // Add product_id if it exists
                const productIdInput = document.getElementById('product_id');
                if (productIdInput) {
                    formData.append('product_id', productIdInput.value);
                }
                
                // Add CSRF token
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request to submit review
                fetch('{{ route("review.submit") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success popup
                        document.getElementById('popup').classList.remove('hidden');
                    } else {
                        alert('Terjadi kesalahan saat mengirim ulasan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim ulasan. Silakan coba lagi.');
                });
            });
            
            function closePopup() {
                document.getElementById('popup').classList.add('hidden');
                document.getElementById('reviewForm').reset();
                updateStars(-1);
                // Redirect to home page after a short delay
                setTimeout(() => {
                    window.location.href = "{{ route('home') }}";
                }, 500);
            }
        </script>
    </body>
</x-layout>
