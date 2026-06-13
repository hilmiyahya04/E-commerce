<!DOCTYPE html>
<html lang="en">
<body>

<section class="animate-fade-in-smooth pt-24 py-8 bg-white mt-3">

<div class="px-4 mx-auto max-w-7xl 2xl:px-0">

        <div class="flex w-full">

            <h1 class="animate-fade-in-smooth text-2xl font-bold text-gray-900 ml-7">
                Produk Detail |
            </h1>

                <button 
                    onclick="history.back()" 
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium text-gray-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </button>

        </div>

    <!-- GRID UTAMA: Berubah dari 1 kolom (mobile) menjadi 3 kolom (lg/desktop) -->
    <div class="animate-fade-in-smooth grid grid-cols-1 lg:grid-cols-3 gap-8 xl:gap-12 mt-8">

        <!-- KOLOM 1: IMAGE (Otomatis ke tengah di mobile dengan mx-auto) -->
        <div class="animate-fade-in-smooth shrink-0 max-w-[350px] mx-auto lg:ml-auto w-full">
            <img 
                class="w-full h-[350px] object-cover rounded-xl shadow-sm"
                src="{{ $product->productImage1 
                    ? asset('storage/' . $product->productImage1) 
                    : 'https://placehold.co/600x600/F3F4F6/F3F4F6' }}"
                alt="{{ $product->productName }}"
            >
        </div>

        <!-- KOLOM 2: DETAIL PRODUK (Lebar penuh di mobile, mengambil sisa ruang di desktop) -->
        <div class="animate-fade-in-smooth max-w-none lg:max-w-none">
            <!-- TITLE -->
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                {{ $product->productName }}
            </h1>

            <!-- KODE -->
            <p class="text-sm text-gray-500 mt-2">
                Kode: {{ $product->productCode }}
            </p>

            <!-- PRICE -->
            <div class="mt-4 flex items-center gap-4">
                <p class="text-2xl font-extrabold text-gray-900">
                    Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                </p>
            </div>

            <hr class="w-full lg:w-3/4 my-6 border-gray-200" />

            <!-- DESCRIPTION -->
            <p class="text-sm text-gray-600 leading-relaxed">
                {{ $product->category->categoryDescription ?? 'Tidak ada deskripsi kategori.' }}
            </p>
        </div>

        <!-- KOLOM 3: KARTU DI PALING KANAN (Otomatis ke tengah di mobile) -->
        <div class="animate-fade-in-smooth mb-16 flex justify-center lg:justify-start">
            <div class="animate-fade-in-smooth bg-white w-full max-w-[350px] lg:max-w-[300px] p-6 rounded-3xl border border-gray-200 shadow-md hover:shadow-xl transition duration-300 flex flex-col justify-between gap-6">

                <!-- CONTENT -->
                <div class="space-y-5">
                    <!-- TITLE -->
                    <h5 class="animate-fade-in-smooth text-lg font-bold text-black">
                        Atur jumlah dan catatan
                    </h5>

                    <!-- IMAGE & TITLE MINI -->
                    <div class="flex items-center gap-4">
                        <img
                            class="w-16 h-16 object-cover rounded-xl border border-gray-200"
                            src="{{ $product->productImage1
                                ? asset('storage/' . $product->productImage1)
                                : 'https://placehold.co/200x200/F3F4F6/F3F4F6' }}"
                            alt="{{ $product->productName }}"
                        >
                        <h1 class="text-sm font-medium text-gray-900 line-clamp-2">
                            {{ $product->productName }}
                        </h1>
                    </div>

                    <!-- QTY CONTROLLER -->
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

                            <!-- QTY VALUE -->
                            <span
                                id="qty-{{ $product->id }}"
                                class="px-5 py-2 text-sm font-semibold min-w-[50px] text-center border-x border-gray-300 flex items-center justify-center"
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
                    <div class="text-sm text-gray-600">
                        Stock : <span class="font-semibold text-black">{{ $product->productAvailability }}</span> Pcs
                    </div>

                    <!-- TOTAL -->
                    <div class="animate-fade-in-smooth flex items-center justify-between pt-2 border-t border-gray-100">
                        <span class="text-md font-semibold text-gray-900">Subtotal</span>
                        <p class="font-bold text-gray-900 text-lg">
                            <span class="text-sm font-semibold text-gray-900">Rp </span>
                            <span id="price-{{ $product->id }}">
                                {{ number_format($product->productPrice * ($item['quantity'] ?? 1), 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- BUTTON GROUP -->
                <div class="pt-2 flex gap-3">
    @auth

        <!-- Tombol Keranjang -->
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf

            <button
                type="submit"
                class="px-4 py-3 border border-[#0D2031] text-[#0D2031] rounded-xl hover:bg-gray-100 transition"
            >
                🛒
            </button>
        </form>

        <!-- Tombol Pesan -->
        <form action="{{ route('orders.store') }}" method="POST" class="flex-1">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <button
                type="submit"
                class="w-full bg-[#0D2031] text-white py-3 rounded-xl hover:bg-opacity-90 transition duration-300 font-semibold"
            >
                Pesan
            </button>
        </form>

    @else

        <button
            type="button"
            onclick="alert('Silakan login terlebih dahulu untuk menambahkan ke keranjang.')"
            class="px-4 py-3 border border-[#0D2031] text-[#0D2031] rounded-xl"
        >
            🛒
        </button>

        <button
            type="button"
            onclick="alert('Silakan login terlebih dahulu untuk memesan produk.')"
            class="flex-1 bg-[#0D2031] text-white py-3 rounded-xl hover:bg-opacity-90 transition duration-300 font-semibold"
        >
            Pesan
        </button>

    @endauth
</div>

            </div>
        </div>

    </div>
</div>

</section>



    @include('components.header')

    @include('components.navbar')

    @include('components.footer')

    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>

