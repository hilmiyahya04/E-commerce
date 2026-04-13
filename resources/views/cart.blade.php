<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>

<!-- START NAVBAR -->
<nav class="bg-white fixed w-full z-50 top-0 shadow transition-all duration-300 ">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
        {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Flowbite Logo--"> --}}
        <span class="self-center text-xl text-heading font-semibold whitespace-nowrap">ALFARIZKI</span>
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
<section class="bg-gray-100 py-8 antialiased md:py-16 mt-5">
  <div class="max-w-screen-xl mx-auto px-4 2xl:px-0">

    <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">
      Shopping Cart
    </h2>

    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start lg:justify-center xl:gap-8 pb-16">

      <!-- LEFT (CART ITEMS) -->
      <div class="w-full lg:max-w-2xl xl:max-w-4xl space-y-6">

        @if(session('cart') && count(session('cart')) > 0)

          @foreach(session('cart') as $id => $item)
          <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">

            <div class="flex flex-col md:flex-row md:items-center gap-6">

              <!-- IMAGE -->
              <img
                src="{{ asset('storage/'.$item['image']) }}"
                class="w-20 h-20 object-cover rounded"
              >

              <!-- INFO -->
              <div class="flex-1 space-y-2">
                <h3 class="font-semibold text-gray-900">
                  {{ $item['name'] }}
                </h3>

                <p class="text-gray-500 text-sm">
                  Rp {{ number_format($item['price'], 0, ',', '.') }}
                </p>

                <p class="text-sm">
                  Qty: <span class="font-medium">{{ $item['quantity'] }}</span>
                </p>
              </div>

              <!-- SUBTOTAL -->
              <div class="text-end">
                <p class="font-bold text-gray-900">
                  Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                </p>
              </div>

            </div>

          </div>
          @endforeach

        @else
          <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
            Keranjang kosong
          </div>
        @endif

      </div>

      <!-- RIGHT (SUMMARY) -->
      <div class="w-full max-w-md mt-6 lg:mt-0">

        <div class="space-y-4 rounded-lg bg-white p-4 shadow-sm sm:p-6">

          <p class="text-xl font-semibold text-gray-900">Order summary</p>

          @php
            $total = 0;
            if(session('cart')){
              foreach(session('cart') as $item){
                $total += $item['price'] * $item['quantity'];
              }
            }
          @endphp

          <div class="flex justify-between font-bold text-lg">
            <span>Total</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div>

          <button class="w-full bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700">
            Checkout
          </button>

        </div>

      </div>

    </div>
  </div>
</section>

<footer class="bg-neutral-primary-soft">
    <div class="bg-[#0D2031] mx-auto w-full p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-start gap-12">
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




