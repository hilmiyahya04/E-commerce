<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alfarizki</title>

</head>
<body class="bg-[#F7F9FF]">

<!-- START NAVBAR -->
<nav class="bg-white fixed w-full z-50 top-0 shadow transition-all duration-300 ">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
        {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Flowbite Logo--"> --}}
        <span class="self-center text-xl text-heading font-bold whitespace-nowrap">Alfarizki</span>
    </a>
    <div class="flex md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse flex gap-4 items-center">
<a href="{{ route('cart.index') }}" class="relative inline-block">
    <img src="{{ asset('assets/cart-large.png') }}" class="w-6 h-6">

    @if($cartCount > 0)
        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
            {{ $cartCount }}
        </span>
    @endif
</a>
          <a href="/admin/login" target="_blank"
        class="px-4 py-1.5 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
        Login
      </a>
        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary" aria-controls="navbar-sticky" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/></svg>
        </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-bold border border-default rounded-base bg-neutral-secondary-soft md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-neutral-primary">
        <li>
          <a href="#" class="block py-2 px-1 text-black bg-brand rounded-sm md:bg-transparent md:text-fg-brand md:p-0" aria-current="page">Home</a>
        </li>
        <li>
          <a href="#Recommendations" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Recommendations</a>
        </li>
        <li>
          <a href="#Product" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Product</a>
        </li>
        <li>
          <a href="#Contact" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- END OF NAVBAR -->

<!-- START HERO -->
<section class="bg-[#0D2031] py-16 min-h-[70vh] antialiased md:py-16 mt-16">
    <div class="mx-auto grid max-w-screen-xl px-4 pb-8 md:grid-cols-12 gap-8 items-center mt-12">

  <!-- IMAGE (mobile: atas) -->
  <div class="order-1 md:order-2 w-full md:col-span-5 flex justify-center">
    <img src="assets/Container.png"
         class="w-full max-w-md md:max-w-lg h-auto object-contain"
         alt="shopping illustration" />
  </div>

  <!-- TEXT (mobile: bawah) -->
  <div class="order-2 md:order-1 md:col-span-7 text-center md:text-left">
    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-white md:max-w-2xl md:text-5xl xl:text-6xl">
      New Sports Collection <br />Up to 50% OFF!
    </h1>

    <p class="mb-4 max-w-2xl text-gray-400 md:mb-6 md:text-lg lg:text-xl">
      Engineered for speed, designed for the street.
      Experience the fusion of high-performance
      technology and elite luxury aesthetics.
    </p>

    <a href="#" class="inline-block rounded-lg bg-gray-500 px-6 py-3.5 text-white">
      Shop Now
    </a>
  </div>
</div>

    <div class="mx-auto grid max-w-screen-xl grid-cols-2 gap-3 text-gray-500 dark:text-gray-400 sm:grid-cols-3 sm:gap-12 lg:grid-cols-6 px-4">
      <a href="#" class="flex items-center justify-center space-x-2">
    {{-- <img src="{{ asset('assets/Logo_Jordan.png') }}" class="h-20" alt="Logo"> --}}
    <span class="font-extrabold text-3xl text-gray-300 hover:text-gray-900 dark:hover:text-white">
        JORDAN
    </span>
</a>
<a href="#" class="flex items-center justify-center space-x-2">
    {{-- <img src="{{ asset('assets/Logo_Jordan.png') }}" class="h-20" alt="Logo"> --}}
    <span class="font-extrabold text-3xl text-gray-300 hover:text-gray-900 dark:hover:text-white">
        NIKE
    </span>
</a>
<a href="#" class="flex items-center justify-center space-x-2">
    {{-- <img src="{{ asset('assets/Logo_Jordan.png') }}" class="h-20" alt="Logo"> --}}
    <span class="font-extrabold text-3xl text-gray-300 hover:text-gray-900 dark:hover:text-white">
        SUPREME
    </span>
</a>
<a href="#" class="flex items-center justify-center space-x-2">
    {{-- <img src="{{ asset('assets/Logo_Jordan.png') }}" class="h-20" alt="Logo"> --}}
    <span class="font-extrabold text-3xl text-gray-300 hover:text-gray-900 dark:hover:text-white">
        FILA
    </span>
</a>
<a href="#" class="flex items-center justify-center space-x-2">
    {{-- <img src="{{ asset('assets/Logo_Jordan.png') }}" class="h-20" alt="Logo"> --}}
    <span class="font-extrabold text-3xl text-gray-300 hover:text-gray-900 dark:hover:text-white">
        ADIDAS
    </span>
</a>
<a href="#" class="flex items-center justify-centerspace-x-2">
    {{-- <img src="{{ asset('assets/Logo_Jordan.png') }}" class="h-20" alt="Logo"> --}}
    <span class="font-extrabold text-3xl text-gray-300 hover:text-gray-900 dark:hover:text-white">
        VANS
    </span>
</a>
    </div>
  </section>
<!---- END OF HERO -->

{{-- <!-- START CAROUSEL WRAPPER -->
<div class="max-w-7xl mx-auto px-4 pt-24 pb-12">

  <div id="default-carousel" class="relative w-full z-0" data-carousel="slide">

    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">

      <!-- Item 1 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="assets/carouselsepatu.png"
          class="absolute block w-full h-full object-cover" alt="Sepatu">
      </div>

      <!-- Item 2 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://source.unsplash.com/1600x600/?sneakers"
          class="absolute block w-full h-full object-cover" alt="Sneakers">
      </div>

      <!-- Item 3 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://source.unsplash.com/1600x600/?footwear"
          class="absolute block w-full h-full object-cover" alt="Footwear">
      </div>

    </div>

    <!-- Indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
      <button class="w-3 h-3 rounded-full bg-white/50" data-carousel-slide-to="0"></button>
      <button class="w-3 h-3 rounded-full bg-white/50" data-carousel-slide-to="1"></button>
      <button class="w-3 h-3 rounded-full bg-white/50" data-carousel-slide-to="2"></button>
    </div>

    <!-- Controls -->
    <button type="button"
      class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4"
      data-carousel-prev>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 text-white">
        ❮
      </span>
    </button>

    <button type="button"
      class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4"
      data-carousel-next>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 text-white">
        ❯
      </span>
    </button>

  </div>

</div>
<!-- END OF CAROUSEL --> --}}

<!-- START REKOMENDASI PRODUCT -->
<div id="Recommendations" class="pt-32 -mt-32 min-h-[60vh] py-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
    <!-- Header -->
    <h1 class="text-8xl sm:text-2xl md:text-3xl font-bold text-gray-900">
        Rekomendasi Produk
    </h1>
    <p class="text-gray-500 mb-6 py-2">
        Tentukan pilihanmu dengan rekomendasi produk terbaik dari kami
    </p>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 py-8">
    <a href="#" class="group block max-w-sm p-6 rounded-xl border border-gray-200 bg-white shadow-md hover:shadow-xl transition duration-300">

    <h5 class="mb-2 text-xl font-bold text-gray-800">
        Nike
    </h5>

    <!-- Deskripsi -->
    <p class="text-gray-600 mb-4">
        High-quality sneakers for everyday wear. Experience comfort and style with Nike's latest collection. Perfect for sports and casual outings.
    </p>

    <!-- Button -->
    <div class="mt-auto">
        <span class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
            Lihat Produk →
        </span>
    </div>
    </a>

        <a href="#" class="group block max-w-sm p-6 rounded-xl border border-gray-200 bg-white shadow-md hover:shadow-xl transition duration-300">

    <h5 class="mb-2 text-xl font-bold text-gray-800">
        Nike
    </h5>

    <!-- Deskripsi -->
    <p class="text-gray-600 mb-4">
        High-quality sneakers for everyday wear. Experience comfort and style with Nike's latest collection. Perfect for sports and casual outings.
    </p>

    <!-- Button -->
    <div class="mt-auto">
        <span class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
            Lihat Produk →
        </span>
    </div>
    </a>

        <a href="#" class="group block max-w-sm p-6 rounded-xl border border-gray-200 bg-white shadow-md hover:shadow-xl transition duration-300">

    <h5 class="mb-2 text-xl font-bold text-gray-800">
        Nike
    </h5>

    <!-- Deskripsi -->
    <p class="text-gray-600 mb-4">
        High-quality sneakers for everyday wear. Experience comfort and style with Nike's latest collection. Perfect for sports and casual outings.
    </p>

    <!-- Button -->
    <div class="mt-auto">
        <span class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
            Lihat Produk →
        </span>
    </div>
    </a>

        <a href="#" class="group block max-w-sm p-6 rounded-xl border border-gray-200 bg-white shadow-md hover:shadow-xl transition duration-300">

    <h5 class="mb-2 text-xl font-bold text-gray-800">
        Nike
    </h5>

    <!-- Deskripsi -->
    <p class="text-gray-600 mb-4">
        High-quality sneakers for everyday wear. Experience comfort and style with Nike's latest collection. Perfect for sports and casual outings.
    </p>

    <!-- Button -->
    <div class="mt-auto">
        <span class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
            Lihat Produk →
        </span>
    </div>
    </a>
</div>
</div>
<!-- END REKOMENDASI PRODUCT -->

  <div class="bg-[#0D2031] p-8 md:p-12 lg:px-16 lg:py-24 mt-24">
    <div class="mx-auto max-w-lg text-center">
        <h2 class="text-2xl font-bold text-white md:text-3xl">
            All About
        </h2>

        <p class="hidden text-white sm:mt-4 sm:block">
            Beli sepatu impianmu di Alfarizki! Temukan koleksi sepatu terbaru
            dengan harga terbaik. Daftar sekarang untuk penawaran eksklusif dan
            diskon menarik!
        </p>
    </div>

    <div class="mx-auto mt-8 max-w-xl">
        <form action="{{ route('product.search') }}" method="GET" class="sm:flex sm:gap-4">

            <div class="sm:flex-1">
                <label class="sr-only">Product</label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari produk..."
                    class="w-full rounded-md border-gray-200 bg-white p-3 text-gray-700 shadow-xs transition focus:border-white"
                >
            </div>

            <button
                type="submit"
                class="group mt-4 flex w-full items-center justify-center gap-2 rounded-md bg-blue-600 px-5 py-3 text-white transition hover:bg-blue-700 focus:ring-2 focus:to-blue-500 sm:mt-0 sm:w-auto"
            >
                <span class="text-sm font-medium">Cari</span>

            </button>
        </form>
    </div>
</div>
<!-- END REKOMENDASI PRODUCT -->

<!-- START PRODUCT GRID -->
<div id="Product" class="pt-20 -mt-20 min-h-[80vh] pb-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

    <!-- TEXT DI ATAS -->
    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">
        Produk Terbaru
        </h2>
    <p class="text-gray-500 mb-6">
        Pilih produk terbaik sesuai kebutuhan kamu
    </p>

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-8">

        @foreach($products as $product)
        <a href="{{ route('product.detail', $product->id) }}">

            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 hover:-translate-y-1 flex flex-col h-full">

                <img
                    src="{{ asset('storage/'.$product->productImage1) }}"
                    alt="{{ $product->productName }}"
                    class="aspect-square w-full object-contain transition duration-300 group-hover:scale-105"
                >

                <div class="p-4 flex flex-col flex-1">

                    <h3 class="font-bold text-black line-clamp-2">
                        {{ $product->productName }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        {{ $product->productCode }}
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                    </p>

                    <div class="mt-auto pt-4 flex gap-2" onclick="event.stopPropagation();">
                        <button class="flex-1 bg-[#0D2031] text-white text-sm py-2 rounded-lg hover:bg-gray-600">
                            Pesan
                        </button>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 text-white text-sm py-2 rounded-lg hover:bg-green-700 flex justify-center items-center">
                                <img src="{{ asset('assets/cart-shopping.png') }}" class=" w-5 h-5">
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </a>
        @endforeach

    </div>
</div>
<!-- END PRODUCT GRID -->

<footer id="Contact" class="bg-neutral-primary-soft">
    <div class="bg-[#0D2031] mx-auto w-full p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://flowbite .com/" class="flex items-center">
                  {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-7 me-3" alt="FlowBite Logo" /> --}}
                  <span class="text-heading text-white self-center text-2xl font-semibold whitespace-nowrap">Alfarizki</span>
              </a>
              <p class="mt-2 text-white font-medium">kami adalah toko sepatu online terpercaya</p>
          </div>
          <div class="grid grid-cols-2 gap-5 sm:gap-9 sm:grid-cols-3 text-white text-left">
              <div>
                    <h2 class="mb-6 text-sm text-white font-bold text-heading uppercase">Resources</h2>
                  <ul class="text-body font-medium">
                                  <li class="mb-4 text-white ">
                          <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                      </li>
                       <li>
                         <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                     </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm text-white font-bold text-heading uppercase">Follow us</h2>
                  <ul class="text-body font-medium">
                      <li class="mb-4 text-white">
                          <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                      </li>
                      <li>
                          <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-bold text-white text-heading uppercase">Legal</h2>
                  <ul class="text-body font-medium">
                      <li class="mb-4 text-white">
                          <a href="# " class="hover:underline">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-default sm:mx-auto lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-white font-bold sm:text-center">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0">
            <a href="#" class="text-body hover:text-heading">
                <i class="fa-brands fa-instagram text-white text-xl"></i>
            </a>
          </div>
      </div>
    </div>
</footer>

<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>


