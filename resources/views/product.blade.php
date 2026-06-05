<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfarizki Shop</title>
    <!-- Tambahkan link Tailwind CDN jika belum ada di header -->
    <script src="https://tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

<!-- KONTEN UTAMA -->
<section class="animate-fade-in-smooth flex-grow bg-white">

    <!-- START SEARCH -->
    <!-- Perbaikan: Mengubah bg-#FFFFFF menjadi bg-white (Utility Tailwind yang valid) -->
    <div class="animate-fade-in-smooth bg-white p-8 md:p-12 lg:px-16 lg:py-20 mt-10">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="animate-fade-in-smooth text-2xl font-bold text-black sm:text-3xl">
                All About
            </h1>

            <p class="animate-fade-in-smooth hidden text-black sm:mt-4 sm:block">
                Beli sepatu impianmu di Alfarizki! Temukan koleksi sepatu terbaru
                dengan harga terbaik. Daftar sekarang untuk penawaran eksklusif dan
                diskon menarik!
            </p>
        </div>

        <div class="mx-auto mt-8 max-w-4xl">
            <form action="{{ route('product.search') }}" method="GET">
                <div class="flex items-center rounded-full bg-[#e9e9ee] p-2 shadow-sm">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        autocomplete="off"
                        class="w-full bg-transparent px-6 py-3 text-lg text-gray-700 border-none outline-none ring-0 focus:ring-0 focus:outline-none"
                    />

                    <button
                        type="submit"
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#11131a] text-white transition hover:scale-105"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- END SEARCH -->

    @if($products->isEmpty())
        <div class="text-center py-12">
            <p class="text-xl text-gray-500 font-medium">Produk tidak ditemukan 🌟</p>
        </div>
    @else
        <!-- 🛍 Grid Produk -->
        <div class="animate-fade-in-smooth grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-5xl mx-auto mt-6 mb-12 px-4">
            @foreach($products as $product)
            <div class="animate-fade-in-smooth bg-white rounded-xl overflow-hidden flex flex-col justify-between">

                <img 
                    class="w-full h-[300px] object-cover rounded-[32px]"
                    src="{{ $product->productImage1 
                        ? asset('storage/' . $product->productImage1) 
                        : 'https://placehold.co/600x600/F3F4F6/F3F4F6' }}"
                    alt="{{ $product->productName }}"
                >

                <div class="p-4 flex flex-col flex-grow justify-between">
                    <div>
                        <h3 class="text-base font-semibold mb-1 text-gray-800 line-clamp-2">
                            {{ $product->productName }}
                        </h3>

                        <p class="text-gray-950 font-bold mb-4">
                            Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2 line-clamp-3">
                            {{ $product->category->categoryDescription ?? 'Tidak ada deskripsi kategori.' }}
                        </p>
                    </div>

                    <!-- <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        @auth
                        <button class="w-full bg-[#0D2031] text-white py-2 rounded-lg hover:bg-gray-600 transition">
                            <a href="{{ route('product.detail', $product->id) }}">Pesan</a>
                        </button>
                        @endauth

                        @guest
                        <button type="button" class="w-full bg-[#0D2031] text-white py-2 rounded-lg hover:bg-gray-600 transition" onclick="alert('Silakan login terlebih dahulu untuk memesan produk.')">
                            Pesan
                        </button>
                        @endguest
                    </form> -->
                </div>
            </div>
            @endforeach
        </div>
        <!-- END GRID -->
    @endif

</section>


@include('components.header')

@include('components.navbar')

@include('components.footer')

<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>