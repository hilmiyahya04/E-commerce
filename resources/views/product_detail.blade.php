<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

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


    <section class="pt-24 py-8 bg-[#F7F9FF] mt-5">
  <div class="px-4 mx-auto 2xl:px-0">

    <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">

      <!-- IMAGE -->
      <div class="shrink-0 max-w-md lg:max-w-lg mx-auto bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
        <img
          class="w-full rounded-lg"
          src="{{ asset('storage/' . $product->productImage1) }}"
          alt="{{ $product->productName }}"
        >
      </div>

      <!-- DETAIL -->
      <div class="mt-6 sm:mt-8 lg:mt-0">

        <!-- TITLE -->
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
          {{ $product->productName }}
        </h1>

        <!-- KODE -->
        <p class="text-sm text-gray-500 mt-2">
          Kode: {{ $product->productCode }}
        </p>

        <!-- PRICE -->
        <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
          <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
            Rp {{ number_format($product->productPrice, 0, ',', '.') }}
          </p>
        </div>

        <!-- BUTTON -->
        <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">

          <!-- FAVORITE -->
<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    @auth
    <button type="submit"
        class="flex bg-[#0D2031] items-center justify-center gap-2 py-2.5 px-5 text-sm font-medium text-white border border-gray-200 rounded-lg hover:bg-gray-600">
        <span>Pesan</span>
    </button>
    @endauth

    @guest
    <button type="button"
        class="flex bg-[#0D2031] items-center justify-center gap-2 py-2.5 px-5 text-sm font-medium text-white border border-gray-200 rounded-lg hover:bg-gray-600"
        onclick="alert('Silakan login terlebih dahulu untuk memesan produk.')">
        <span>Pesan</span>
    </button>

    @endguest

</form>

          <!-- ADD TO CART -->
<a href="{{ route('cart.index') }}"
   class="bg-green-600 relative inline-flex items-center gap-3
          bg-primary-700 hover:bg-primary-800
          text-white font-medium rounded-lg text-sm
          px-5 py-2.5 transition duration-200
          focus:ring-4 focus:ring-primary-300  hover:bg-green-700" >

    <img src="{{ asset('assets/cart-shopping.png') }}" class="w-5 h-5">
</a>

        </div>

        <hr class="w-3/4 my-6 md:my-8 border-gray-200 dark:border-gray-800" />

        <!-- DESCRIPTION -->
        <p class="text-gray-500 dark:text-gray-400">
          {{ $product->description ?? 'Tidak ada deskripsi produk.' }}
        </p>

      </div>
    </div>
  </div>
</section>

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

