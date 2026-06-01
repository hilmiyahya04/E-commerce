<!-- START REKOMENDASI PRODUCT -->
<div id="Recommendations"
    class="animate-fade-in-smooth pt-12 sm:pt-24 lg:pt-32 py-12 md:py-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">

    <!-- HEADER -->
    <div class="text-center">
        <h1 class="animate-fade-in-smooth text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">
            Rekomendasi Produk
        </h1>

        <p class="animate-fade-in-smooth text-gray-500 text-xs sm:text-sm md:text-base max-w-md mx-auto mt-2">
            Tentukan pilihanmu dengan rekomendasi produk terbaik dari kami
        </p>
    </div>

    @auth

        @if($recommendations->isNotEmpty())

            <!-- GRID PRODUCT -->
            <div class="animate-fade-in-smooth grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">

                @foreach($recommendations as $product)

                    <!-- PRODUCT -->
                    <a href="{{ route('product.detail', $product->id) }}"
                        class="animate-fade-in-smooth group block">

                        <!-- IMAGE -->
                        <div class="animate-fade-in-smooth overflow-hidden rounded-2xl">
                            <img
                                class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300"

                                src="{{ $product->productImage1
                                    ? asset('storage/' . $product->productImage1)
                                    : 'https://placehold.co/600x600/F3F4F6/F3F4F6' }}"
                                alt="{{ $product->productName }}"
                            >
                        </div>

                        <!-- CONTENT -->
                        <div class="animate-fade-in-smooth pt-4">

                            <!-- PRODUCT NAME -->
                            <h3 class="animate-fade-in-smooth font-bold text-lg text-gray-900 line-clamp-2">
                                {{ $product->productName }}
                            </h3>

                            <!-- PRICE -->
                            <p class="animate-fade-in-smooth mt-2 text-base font-bold text-black">
                                Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                            </p>

                            <!-- DESCRIPTION -->
                            <p class="animate-fade-in-smooth text-sm text-gray-500 mt-2 line-clamp-3">
                                {{ $product->category->categoryDescription ?? 'Tidak ada deskripsi kategori.' }}
                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="animate-fade-in-smooth py-16 text-center text-gray-400">
                <p class="animate-fade-in-smooth">Belum ada rekomendasi untukmu saat ini.</p>

                <p class="animate-fade-in-smooth text-sm mt-2">
                    Coba beli atau rating beberapa produk terlebih dahulu.
                </p>
            </div>

        @endif

    @else

        <div class="animate-fade-in-smooth py-16 text-center text-gray-400">
            <p class="animate-fade-in-smooth">Login untuk melihat rekomendasi produk untukmu.</p>
        </div>

    @endauth

</div>
<!-- END REKOMENDASI PRODUCT -->