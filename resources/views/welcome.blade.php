<!DOCTYPE html>
<html lang="en">
<body class="bg-background etext-on-background font-body-md selection:bg-primary-container selection:text-on-primary-container">

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
@include('components.navbar')

@include('components.hero')

@include('components.header')

@include('components.allabout')

@include('components.recommendation')

<!-- START PRODUCT GRID -->
@include('components.product')
<!-- END PRODUCT GRID -->

@include('components.join')

<!-- START FOOTER -->
@include('components.footer')
<!-- END FOOTER -->

@stack('scripts')

<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>
