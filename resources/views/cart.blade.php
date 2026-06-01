<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">

    @include('components.header')
    @include('components.navbar')

    <section class="animate-fade-in-smooth bg-white py-8 antialiased md:py-16 mt-5">
        <div class="max-w-screen-xl mx-auto px-4 2xl:px-0">

            <h2 class="animate-fade-in-smooth text-2xl font-bold text-gray-900">
                Keranjang
            </h2>

            <div class="animate-fade-in-smooth mt-6 sm:mt-8 lg:flex lg:items-start lg:justify-center gap-8 pb-16">

                <!-- LEFT -->
                <div class="animate-fade-in-smooth w-full lg:max-w-2xl xl:max-w-4xl space-y-6">

                    @if($cart && count($cart) > 0)

                        @foreach($cart as $id => $item)

                            <div class="animate-fade-in-smooth rounded-2xl border border-gray-200 bg-white p-4 sm:p-6 shadow-sm hover:shadow-md transition">

                                <div class="flex flex-col md:flex-row md:items-center gap-6">

                                    <!-- IMAGE -->
                                     <div class="animate-fade-in-smooth shrink-0">

                                        <img
                                            src="{{ $item['image']
                                                ? asset('storage/' . $item['image'])
                                                : 'https://placehold.co/200x200/F3F4F6/F3F4F6' }}"
                                            alt="{{ $item['name'] }}"
                                            class="w-24 h-24 object-cover rounded-xl"
                                        >
                                    </div>

                                    <!-- INFO -->
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg text-gray-900">
                                            {{ $item['name'] }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Harga:
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <!-- RIGHT -->
                                    <div class="flex flex-col items-end gap-4">

                                        <!-- SUBTOTAL -->
                                        <p class="font-bold text-lg text-gray-900">
                                            Rp {{ number_format($item['price'] * ($item['quantity'] ?? 1), 0, ',', '.') }}
                                        </p>

                                        <div class="flex items-center gap-4">

                                            <!-- QTY -->
                                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">

                                                <!-- MINUS -->
                                                <button
                                                    type="button"
                                                    class="btn-qty-decrease px-3 py-2 text-gray-600 hover:bg-gray-100 transition"
                                                    data-id="{{ $id }}"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="2"
                                                        stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M5 12h14" />
                                                    </svg>
                                                </button>

                                                <!-- QTY NUMBER -->
                                                <span
                                                    id="qty-{{ $id }}"
                                                    class="px-4 py-2 text-sm font-medium min-w-[40px] text-center"
                                                >
                                                    {{ $item['quantity'] ?? 1 }}
                                                </span>

                                                <!-- PLUS -->
                                                <button
                                                    type="button"
                                                    class="btn-qty-increase px-3 py-2 text-gray-600 hover:bg-gray-100 transition"
                                                    data-id="{{ $id }}"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="2"
                                                        stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- DELETE -->
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-red-600 hover:text-red-800 transition"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    @else

                        <div class="animate-fade-in-smooth bg-white border-2 border-gray-200 rounded-2xl p-10 text-center text-gray-500 hover:shadow-lg transition space-y-5">
                            Keranjang kosong
                        </div>

                    @endif

                </div>

                <!-- RIGHT -->
                <div class="animate-fade-in-smooth w-full max-w-md mt-6 lg:mt-0">

                    @php
                        $total = 0;

                        if($cart){
                            foreach($cart as $item){
                                $qty = $item['quantity'] ?? 1;
                                $price = $item['price'] ?? 0;

                                $total += $price * $qty;
                            }
                        }
                    @endphp

                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 shadow-sm hover:shadow-lg transition space-y-5">

                        <h3 class="text-xl font-semibold text-gray-900">
                            Ringkasan Belanja
                        </h3>

                        <div class="flex items-center justify-between text-lg font-bold">
                            <span>Total</span>
                            <span>
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            
                            @auth
                                <button
                                    type="submit"
                                    class="w-full bg-[#0D2031] text-white py-3 rounded-xl hover:bg-gray-700 transition"
                                >
                                    Checkout
                                </button>
                            @endauth

                            @guest
                                <button
                                    type="button"
                                    onclick="alert('Silakan login terlebih dahulu untuk checkout')"
                                    class="w-full bg-[#0D2031] text-white py-3 rounded-xl hover:bg-gray-700 transition"
                                >
                                    Checkout
                                </button>
                            @endguest
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('components.footer')

    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    @vite(['resources/js/cart.js'])

</body>
</html>
