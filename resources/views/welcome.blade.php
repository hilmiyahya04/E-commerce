<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alfarizki</title>

</head>
<body class="bg-gray-100">

<!-- START NAVBAR -->
<nav class="bg-white fixed w-full z-50 top-0 shadow transition-all duration-300 ">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
        {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Flowbite Logo--"> --}}
        <span class="self-center text-xl text-heading font-bold whitespace-nowrap">Alfarizki</span>
    </a>
    <div class="flex md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse flex gap-3 items-center">
<a href="{{ route('cart.index') }}" class="relative">
    <img src="{{ asset('assets/cart_large.png') }}" alt="Cart" class="w-6 h-6">
</a>
          <a href="/admin/login" target="_blank"
        class="px-4 py-1.5 bg-blue-600 text-white rounded">
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
          <a href="#" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Recommendations</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- END OF NAVBAR -->


<!-- START CAROUSEL WRAPPER -->
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
<!-- END OF CAROUSEL -->

<!-- START REKOMENDASI PRODUCT -->
<section class="bg-gray-100 py-10 sm:py-12">
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">
            REKOMENDASI PRODUK
        </h2>
    </div>

    <!-- Grid Produk -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-8">
        <!-- Card Produk -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
            <img src="https://via.placeholder.com/150" alt="Jordan" class="mx-auto mt-4 w-24 h-24 object-contain">
            <div class="bg-black text-white py-2 font-semibold">Jordan</div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
            <img src="https://via.placeholder.com/150" alt="Filla" class="mx-auto mt-4 w-24 h-24 object-contain">
            <div class="bg-black text-white py-2 font-semibold">Filla</div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
            <img src="https://via.placeholder.com/150" alt="Adidas" class="mx-auto mt-4 w-24 h-24 object-contain">
            <div class="bg-black text-white py-2 font-semibold">Adidas</div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
            <img src="https://via.placeholder.com/150" alt="Supreme" class="mx-auto mt-4 w-24 h-24 object-contain">
            <div class="bg-black text-white py-2 font-semibold">Supreme</div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
            <img src="https://via.placeholder.com/150" alt="Converse" class="mx-auto mt-4 w-24 h-24 object-contain">
            <div class="bg-black text-white py-2 font-semibold">Converse</div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
            <img src="https://via.placeholder.com/150" alt="Nike" class="mx-auto mt-4 w-24 h-24 object-contain">
            <div class="bg-black text-white py-2 font-semibold">Nike</div>
        </div>
    </div>
</div>
</section>

  <div class=" bg-[#0D2031] p-8 md:p-12 lg:px-16 lg:py-24">
    <div class="mx-auto max-w-lg text-center">
      <h2 class="text-2xl font-bold text-white md:text-3xl">
        All About
      </h2>

      <p class="hidden text-white sm:mt-4 sm:block">
        Beli sepatu impianmu di Alfarizki! Temukan koleksi sepatu terbaru
        dengan harga terbaik.Daftar sekarang untuk penawaran eksklusif dan
        diskon menarik!
      </p>
    </div>

    <div class="mx-auto mt-8 max-w-xl">
      <form action="#" class="sm:flex sm:gap-4">
        <div class="sm:flex-1">
          <label for="email" class="sr-only">Product</label>

          <input type="Product" placeholder="Product" class="w-full rounded-md border-gray-200 bg-white p-3 text-gray-700 shadow-xs transition focus:border-white focus:ring-2 focus:ring-yellow-400 focus:outline-hidden">
        </div>

        <button type="submit" class="group mt-4 flex w-full items-center justify-center gap-2 rounded-md bg-blue-600 px-5 py-3 text-white transition focus:ring-2 focus:ring-yellow-400 focus:outline-hidden sm:mt-0 sm:w-auto">
          <span class="text-sm font-medium"> Search</span>

          <svg class="size-5 shadow-sm rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
          </svg>
        </button>
      </form>
    </div>
  </div>
</section>
<!-- END REKOMDASI PRODUCT -->

<!-- START PRODUCT GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto py-8 px-6">

    @foreach($products as $product)
    <a href="{{ route('product.detail', $product->id) }}" class="group block h-full">

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 hover:-translate-y-1 flex flex-col h-full">

            <!-- Gambar -->
            <img
                src="{{ asset('storage/'.$product->productImage1) }}"
                alt="{{ $product->productName }}"
                class="aspect-square w-full object-contain transition duration-300 group-hover:scale-105"
            >

            <!-- Konten -->
            <div class="p-4 flex flex-col flex-1">

                <!-- Judul (dibatasi biar rapi) -->
                <h3 class="font-bold text-black transition line-clamp-2">
                    {{ $product->productName }}
                </h3>

                <p class="text-sm text-gray-500">
                    {{ $product->productCode }}
                </p>

                <p class="mt-2 text-sm font-bold text-gray-900">
                    Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                </p>

                <!-- Tombol selalu di bawah -->
                <div class="mt-auto pt-4 flex gap-2" onclick="event.stopPropagation();">
                    <button href="https://wa.me/6281234567890?text=Saya%20ingin%20memesan%20produk%20"
                   target="_blank"class="flex-1 flex items-center justify-center bg-green-500 text-white text-sm font-medium py-2 rounded-lg hover:bg-green-600 transition duration-300">
                    Pesan
                    </button>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button
                            type="submit"
                            class="w-full bg-blue-600 text-white text-sm font-medium py-2 rounded-lg hover:bg-blue-700 transition duration-300"
                        >
                            + Keranjang
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </a>
    @endforeach
</div>
<!-- END PRODUCT GRID -->

<footer class="bg-neutral-primary-soft">
    <div class="bg-[#0D2031] mx-auto w-full p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://flowbite .com/" class="flex items-center">
                  {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-7 me-3" alt="FlowBite Logo" /> --}}
                  <span class="text-heading text-white self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3 text-white font-bold">
              <div>
                  <h2 class="mb-6 text-sm text-white font-bold text-heading uppercase">Resources</h2>
                  <ul class="text-body font-medium">
                      <li class="mb-4 text-white font-bold">
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
                      <li class="mb-4 text-white font-bold">
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
                      <li class="mb-4 text-white font-bold">
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
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/></svg>
                <span class="sr-only">Facebook page</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M18.942 5.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.586 11.586 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3 17.392 17.392 0 0 0-2.868 11.662 15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.638 10.638 0 0 1-1.706-.83c.143-.106.283-.217.418-.331a11.664 11.664 0 0 0 10.118 0c.137.114.277.225.418.331-.544.328-1.116.606-1.71.832a12.58 12.58 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM8.678 14.813a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.929 1.929 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/></svg>
                <span class="sr-only">Discord community</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/></svg>
            <span class="sr-only">Twitter page</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/></svg>
                <span class="sr-only">GitHub account</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2a10 10 0 1 0 10 10A10.009 10.009 0 0 0 12 2Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.093 20.093 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM10 3.707a8.82 8.82 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.755 45.755 0 0 0 10 3.707Zm-6.358 6.555a8.57 8.57 0 0 1 4.73-5.981 53.99 53.99 0 0 1 3.168 4.941 32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.641 31.641 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM12 20.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 15.113 13a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd"/></svg>
                <span class="sr-only">Dribbble account</span>
            </a>
          </div>
      </div>
    </div>
</footer>
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>


