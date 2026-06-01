<!-- START HERO -->
<section class="animate-fade-in-smooth bg-[#0D2031] py-16 min-h-[70vh] antialiased md:py-16 mt-16">
  <div class="mx-auto grid max-w-screen-xl px-4 pb-8 md:grid-cols-12 gap-8 items-center mt-12">

    <!-- PERBAIKAN PADA DIV GAMBAR HERO (mobile: atas) -->
    <div class="order-1 md:order-2 w-full md:col-span-5 flex justify-center">
      <!-- Kontainer Gambar: Mengunci rasio ruang & memberi efek pulse gelap -->
      <div 
        id="hero-img-container" 
        class="w-full max-w-md md:max-w-lg aspect-square bg-slate-800 rounded-2xl animate-pulse flex items-center justify-center overflow-hidden"
      >
        <img 
          src="assets/Container.png"
          class="w-full h-full object-contain opacity-0 transition-opacity duration-500 ease-in-out"
          alt="shopping illustration"
          fetchpriority="high"
          loading="eager"
          onload="this.classList.remove('opacity-0'); document.getElementById('hero-img-container').classList.remove('animate-pulse', 'bg-slate-800')" 
        />
      </div>
    </div>

    <!-- TEXT (mobile: bawah) -->
    <div class="order-2 md:order-1 md:col-span-7 text-center md:text-left">
      <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-white md:max-w-2xl md:text-5xl xl:text-6xl">
        New Sports Collection <br />Up to 50% OFF!
      </h1>

      <p class="mb-4 max-w-2xl text-white md:mb-6 md:text-lg lg:text-xl">
        Shoes are our thing. So we made an online store for you to shop 
        Your favorite shoes from the best brands in the world.
      </p>

      <a href="#" class="inline-block rounded-lg bg-gray-500 px-6 py-3.5 text-white">
        Shop Now
      </a>
    </div>
  </div>

  <!-- Grid Brand/Merek (Tetap sama, tidak ada gambar lambat) -->
  <div class="mx-auto grid max-w-screen-xl grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-8 lg:gap-12 px-4 w-full">
      <a href="#" class="flex items-center justify-center p-2">
          <span class="font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white transition-colors duration-200">JORDAN</span>
      </a>
      <a href="#" class="flex items-center justify-center p-2">
          <span class="font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white transition-colors duration-200">NIKE</span>
      </a>
      <a href="#" class="flex items-center justify-center p-2">
          <span class="font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white transition-colors duration-200">SUPREME</span>
      </a>
      <a href="#" class="flex items-center justify-center p-2">
          <span class="font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white transition-colors duration-200">FILA</span>
      </a>
      <a href="#" class="flex items-center justify-center p-2">
          <span class="font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white transition-colors duration-200">ADIDAS</span>
      </a>
      <a href="#" class="flex items-center justify-center p-2">
          <span class="font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white transition-colors duration-200">VANS</span>
      </a>
  </div>
</section>
<!---- END OF HERO -->
