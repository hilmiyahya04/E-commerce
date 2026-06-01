<!-- START PRODUCT GRID -->
<div id="Product" class="animate-fade-in-smooth pt-20  min-h-[80vh] pb-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <!-- TEXT DI ATAS -->
    <h2 class="animate-fade-in-smooth text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 text-center">
        Produk Terbaru
        </h2>
    <p class="animate-fade-in-smooth text-gray-500 mb-6 text-center">
        Pilih produk terbaik sesuai kebutuhan kamu
    </p>

    <!-- GRID -->
    <div class="animate-fade-in-smooth grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-8 ">

    @foreach($products as $product) 
    <div class="animate-fade-in-smooth bg-white">

        <a href="{{ route('product.detail', $product->id) }}" class="group">
            
            <!-- 1. KONTENEDOR GAMBAR (Mengunci ruang kotak & memberi animasi loading) -->
            <div 
                id="prod-box-{{ $product->id }}" 
                class="relative overflow-hidden bg-slate-100 aspect-square animate-pulse flex items-center justify-center w-full rounded-3xl"
            >
                <!-- 2. ELEMEN GAMBAR (Logika aman dari error 404 & Fade-In halus) -->
            <img
                src="{{ $product->productImage1 
                    ? asset('storage/'.$product->productImage1) 
                    : 'https://placehold.co/600x600/F3F4F6/F3F4F6' }}"
                    
                alt="{{ $product->productName }}"

                class="w-full h-full object-cover opacity-0 transition-all duration-300 ease-in-out group-hover:scale-105 rounded-3xl"

                loading="lazy"

                onload="
                    this.classList.remove('opacity-0'); 
                    document.getElementById('prod-box-{{ $product->id }}')
                    .classList.remove('animate-pulse', 'bg-slate-100')
                "
            >
            </div>

            <!-- 3. DETAIL INFORMASI PRODUK -->
            <div class="p-4 flex flex-col flex-1">

                <h3 class="font-bold text-black line-clamp-2">
                    {{ $product->productName }}
                </h3>

                <!-- <p class="text-sm text-gray-500">
                        {{ $product->productCode }}
                </p> -->

                <p class="animate-fade-in-smooth mt-2 text-sm font-bold text-gray-900">
                    Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                </p>

                <!-- DESCRIPTION -->
                <p class="text-sm text-gray-500 mt-2">
                {{ $product->category->categoryDescription ?? 'Tidak ada deskripsi kategori.' }}
                </p>
            </div>
        </a>
    </div>
    @endforeach

    </div>
</div>
<!-- END PRODUCT GRID -->
