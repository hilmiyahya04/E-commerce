<!DOCTYPE html>
<html lang="en">
<body>

<section class="animate-fade-in-smooth pt-24 py-8 bg-white mt-5">
    <div class="px-4 mx-auto 2xl:px-0">
        <div class="animate-fade-in-smooth lg:grid lg:grid-cols-3 lg:gap-8 xl:gap-12">

            <!-- KOLOM 1: IMAGE -->
            <div class="animate-fade-in-smooth shrink-0 max-w-[350px] ml-auto w-full">

                <img 
                    class="w-full h-[350px] object-cover rounded-xl"
                    
                    src="{{ $product->productImage1 
                        ? asset('storage/' . $product->productImage1) 
                        : 'https://placehold.co/600x600/F3F4F6/F3F4F6' }}"
                        
                    alt="{{ $product->productName }}"
                >
                
            </div>

            <!-- KOLOM 2: DETAIL PRODUK -->
            <div class="animate-fade-in-smooth mt-6 sm:mt-8 lg:mt-0 max-w-[350px] ml-auto lg:max-w-none">
                <!-- TITLE -->
                <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">
                    {{ $product->productName }}
                </h1>

                <!-- KODE -->
                <p class="text-sm text-gray-500 mt-2">
                    Kode: {{ $product->productCode }}
                </p>

                <!-- PRICE -->
                <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                    <p class="text-2xl font-extrabold text-gray-900 sm:text-2xl">
                        Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                    </p>
                </div>

                <hr class="w-3/4 my-6 border-gray-200" />

                <!-- DESCRIPTION -->
                <p class="text-sm text-gray-500 mt-2">
                    {{ $product->category->categoryDescription ?? 'Tidak ada deskripsi kategori.' }}
                </p>
            </div>

            <!-- KOLOM 3: KARTU DI PALING KANAN -->
            <div class="animate-fade-in-smooth mt-8 lg:mt-0 mb-16">

                <div class="animate-fade-in-smooth bg-white max-w-[300px] p-6 rounded-3xl border border-gray-200 shadow-md hover:shadow-xl transition duration-300 flex flex-col justify-between gap-6">

                    <!-- CONTENT -->
                    <div class="space-y-5">

                        <!-- TITLE -->
                        <h5 class="animate-fade-in-smooth text-lg font-bold text-black">
                            Atur jumlah dan catatan
                        </h5>

                        <!-- IMAGE -->
                        <div class="flex items-center gap-4">
                            <img
                                class="w-16 h-16 object-cover rounded-xl border border-gray-200"
                                src="{{ $product->productImage1
                                    ? asset('storage/' . $product->productImage1)
                                    : 'https://placehold.co/200x200/F3F4F6/F3F4F6' }}"
                                alt="{{ $product->productName }}"
                            >
                            <h1 class="text-md text-gray-900 sm:text-lg">
                                {{ $product->productName }}
                            </h1>
                        </div>

                       <!-- QTY -->
                    <div>

                        <div class="inline-flex border border-gray-300 rounded-xl overflow-hidden">

                            <!-- MINUS -->
                            <button
                                type="button"
                                class="btn-qty-decrease px-4 py-2 text-gray-600 hover:bg-gray-100 transition"
                                data-id="{{ $product->id }}"
                                data-price="{{ $product->productPrice }}"
                            >
                                -
                            </button>

                            <!-- QTY -->
                            <span
                                id="qty-{{ $product->id }}"
                                class="px-5 py-2 text-sm font-semibold min-w-[50px] text-center border-x border-gray-300"
                            >
                                {{ $item['quantity'] ?? 1 }}
                            </span>

                            <!-- PLUS -->
                            <button
                                type="button"
                                class="btn-qty-increase px-4 py-2 text-gray-600 hover:bg-gray-100 transition"
                                data-id="{{ $product->id }}"
                                data-price="{{ $product->productPrice }}"
                            >
                                +
                            </button>

                        </div>

                    </div>
                                            
                        <!-- STOCK -->
                        <div>
                            <span class="text-sm text-gray-600">
                                Stock :
                                <span class="font-semibold text-black">
                                    {{ $product->productAvailability }}
                                </span>
                                Pcs
                            </span>
                        </div>

                        <!-- TOTAL -->
                        <div class="animate-fade-in-smooth flex items-center justify-between pt-2 border-t border-gray-100">

                            <span class="text-lg font-semibold text-gray-900">
                                Subtotal
                            </span>

                            <p class="font-bold text-gray-900 text-lg">
                                <span class="text-base font-semibold text-gray-900">
                                    Rp.
                                </span>
                                <span id="price-{{ $product->id }}">
                                    {{ number_format($product->productPrice * ($item['quantity'] ?? 1), 0, ',', '.') }}
                                </span>
                            </p>
                        </div>

                    </div>

                    <!-- BUTTON GROUP -->
                    <div class="pt-2 flex flex-col gap-3">

                        @auth
                            <form action="{{ route('orders.store', $product->id) }}" method="POST" class="w-full">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <button
                                    type="submit"
                                    class="w-full bg-[#0D2031] text-white text-sm py-3 rounded-xl hover:bg-gray-700 transition duration-300"
                                >
                                    Pesan
                                </button>
                            </form>
                        @else
                            <button
                                type="button"
                                onclick="alert('Silakan login terlebih dahulu untuk memesan produk.')"
                                class="w-full bg-[#0D2031] text-white text-sm py-3 rounded-xl hover:bg-gray-700 transition duration-300"
                            >
                                Pesan
                            </button>
                        @endauth

                        <!-- CART -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                            @csrf

                            <button
                                type="submit"
                                class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition duration-300 flex justify-center items-center"
                            >
                                <img
                                    src="{{ asset('assets/cart-shopping.png') }}"
                                    alt="Cart"
                                    class="w-5 h-5"
                                >
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div> <!-- Tutup Grid Utama -->
    </div> <!-- Tutup Container -->
</section>



    @include('components.header')

    @include('components.navbar')

    @include('components.footer')

    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>

