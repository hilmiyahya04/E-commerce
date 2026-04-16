<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seach</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
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


<div class="max-w-6xl mx-auto px-6 py-10 mt-12">

        <!-- 🧾 Judul -->
    <h1 class="text-2xl font-bold mb-6 text-center">Daftar Produk</h1>

    <!-- 🔍 Search Bar -->
    <form action="{{ route('product.search') }}" method="GET" class="mb-10">
        <div class="flex max-w-xl mx-auto shadow rounded-lg overflow-hidden">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari produk..."
                class="w-full px-4 py-3 focus:outline-none"
            >
            <button
                type="submit"
                class="bg-green-600 text-white px-6 hover:bg-green-700"
            >
                Cari
            </button>
        </div>
    </form>

    <!-- ❌ Jika kosong -->
    @if($products->isEmpty())
        <p class="text-center text-gray-500">Produk tidak ditemukan</p>
    @endif

    <!-- 🛍 Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        @foreach($products as $product)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

            <!-- 📷 Gambar -->
            @if($product->productImage1)
                <img
                    src="{{ asset('storage/'.$product->productImage1) }}"
                    class="w-full h-48 object-cover"
                >
            @endif

            <!-- 📄 Konten -->
            <div class="p-4">

                <h3 class="text-lg font-semibold mb-2">
                    {{ $product->productName }}
                </h3>

                <p class="text-green-600 font-bold mb-4">
                    Rp {{ number_format($product->productPrice, 0, ',', '.') }}
                </p>

                <!-- 🛒 Button -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button
                        class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition"
                    >
                        + Keranjang
                    </button>
                </form>

            </div>
        </div>
        @endforeach

    </div>
</div>


<footer class="bg-neutral-primary-soft">
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
                <svg class="bg-white w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/></svg>
                <span class="sr-only">Facebook page</span>
            </a>
          </div>
      </div>
    </div>
</footer>

<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>
