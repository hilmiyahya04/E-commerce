<!-- START NAVBAR -->
<nav class="bg-white fixed w-full z-50 top-0 shadow transition-all duration-300 ">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <span class="self-center text-xl md:text-2xl text-heading font-bold whitespace-nowrap inline-block transition-transform duration-150 active:scale-90 cursor-pointer select-none">Alfarizki</span>
    
    <div class="flex md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse flex gap-4 items-center">
      
      <!-- PERBAIKAN PADA LINK KERANJANG -->
      <a href="{{ route('cart.index') }}" class="relative inline-block">
        <!-- Kontainer Ikon: Mengunci ruang 24px (w-6 h-6) dan memberi background abu-abu tipis saat loading -->
        <div class="w-6 h-6 bg-slate-100 rounded animate-pulse" id="cart-icon-container">
          <img 
            src="{{ asset('assets/cart-large.png') }}" 
            class="w-6 h-6 opacity-0 transition-opacity duration-300"
            loading="eager"
            fetchpriority="high"
            onload="this.classList.remove('opacity-0'); document.getElementById('cart-icon-container').classList.remove('animate-pulse', 'bg-slate-100')"
          >
        </div>

        @if($cartCount > 0)
            <span class="absolute -top-2 -right-2 bg-[#0D2031] text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                {{ $cartCount }}
            </span>
        @endif  
      </a>

      <a href="/admin/login" target="_blank"
        class="px-4 py-1.5 bg-[#0D2031] text-white rounded shadow hover:bg-[#0D2031]/80 transition">
        Login
      </a>
      
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/></svg>
      </button>
    </div>

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-default rounded-base bg-neutral-secondary-soft md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-neutral-primary">
        <li>
          <a href="#" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-[#0D2031] after:transition-transform after:duration-300 hover:after:scale-x-100" aria-current="page">Home</a>
        </li>
        <li>
          <a href="#Recommendations" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-[#0D2031] after:transition-transform after:duration-300 hover:after:scale-x-100">Recommendations</a>
        </li>
        <li>
          <a href="#Product" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-[#0D2031] after:transition-transform after:duration-300 hover:after:scale-x-100">Product</a>
        </li>
        <li>
          <a href="#Contact" class="block py-2 px-1 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-[#0D2031] after:transition-transform after:duration-300 hover:after:scale-x-100">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- END OF NAVBAR -->
