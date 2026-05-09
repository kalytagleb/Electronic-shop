<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Best Deals - Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
      <link rel="stylesheet" href="{{ asset('style.css') }}" />
  </head>
  <body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
    @include('components.navbar')


    <div class="px-8 2xl:px-16 pt-6 pb-2 text-xs text-gray-400 font-semibold flex gap-2">
      <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">Home</a>
      <span>/</span>
      <span class="text-gray-900">Best Deals</span>
    </div>

    <main class="w-full px-8 2xl:px-16 py-6 flex-1">
      <div
        class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4 border-b border-gray-200 pb-6"
      >
        <div>
          <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Lightning Deals</h1>
          <p class="text-gray-500 text-sm">
            Hurry up! These offers are available for a limited time only.
          </p>
        </div>
        <div class="flex items-center gap-2">
          <span class="text-sm font-bold">Sort by:</span>
          <select
            class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-gray-900 transition-colors"
          >
            <option>Biggest Discount</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        <a
          href="{{ route('product', 1) }}"
          class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
        >
          <div class="relative">
            <div class="w-full h-52 bg-gray-100 overflow-hidden flex items-center justify-center">
              <img
                src="{{ asset('images/iPhone14_pro.jpg') }}"
                alt="iPhone 14 Pro"
                class="w-full h-full object-cover"
              />
            </div>
            <span
              class="absolute top-2 left-2 bg-black text-white text-xs font-bold px-3 py-1 rounded-md"
              >-17%</span
            >
            <button
              class="absolute top-2 right-2 bg-black text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors"
            >
              <img src="{{ asset('static/cart_catalog.svg') }}" class="w-4 h-4" alt="Cart" />
            </button>
          </div>
          <div class="p-4">
            <h3 class="text-sm font-semibold text-gray-900 truncate mb-1.5">iPhone 14 Pro 256GB</h3>
            <div class="flex items-baseline gap-2">
              <span class="text-lg font-extrabold text-gray-900 mono">$995.00</span>
              <span class="text-xs text-gray-400 line-through mono">$1199.00</span>
            </div>
          </div>
        </a>

        <a
          href="{{ route('product', 2) }}"
          class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
        >
          <div class="relative">
            <div class="w-full h-52 bg-gray-100 overflow-hidden flex items-center justify-center">
              <img
                src="{{ asset('images/iPhone13.jpg') }}"
                alt="iPhone 13"
                class="w-full h-full object-cover"
              />
            </div>
            <span
              class="absolute top-2 left-2 bg-black text-white text-xs font-bold px-3 py-1 rounded-md"
              >-25%</span
            >
            <button
              class="absolute top-2 right-2 bg-black text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors"
            >
              <img src="{{ asset('static/cart_catalog.svg') }}" class="w-4 h-4" alt="Cart" />
            </button>
          </div>
          <div class="p-4">
            <h3 class="text-sm font-semibold text-gray-900 truncate mb-1.5">
              iPhone 13 128GB Gold
            </h3>
            <div class="flex items-baseline gap-2">
              <span class="text-lg font-extrabold text-gray-900 mono">$380.00</span>
              <span class="text-xs text-gray-400 line-through mono">$499.00</span>
            </div>
          </div>
        </a>

        <a
          href="{{ route('product', 3) }}"
          class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
        >
          <div class="relative">
            <div class="w-full h-52 bg-gray-100 overflow-hidden flex items-center justify-center">
              <img
                src="{{ asset('images/iPhone12_pro.jpg') }}"
                alt="iPhone 12 Pro"
                class="w-full h-full object-cover"
              />
            </div>
            <span
              class="absolute top-2 left-2 bg-black text-white text-xs font-bold px-3 py-1 rounded-md"
              >-15%</span
            >
            <button
              class="absolute top-2 right-2 bg-black text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors"
            >
              <img src="{{ asset('static/cart_catalog.svg') }}" class="w-4 h-4" alt="Cart" />
            </button>
          </div>
          <div class="p-4">
            <h3 class="text-sm font-semibold text-gray-900 truncate mb-1.5">iPhone 12 Pro 128GB</h3>
            <div class="flex items-baseline gap-2">
              <span class="text-lg font-extrabold text-gray-900 mono">$348.00</span>
              <span class="text-xs text-gray-400 line-through mono">$410.00</span>
            </div>
          </div>
        </a>

        <a
          href="{{ route('product', 4) }}"
          class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
        >
          <div class="relative">
            <div class="w-full h-52 bg-gray-100 overflow-hidden flex items-center justify-center">
              <img
                src="{{ asset('images/iPhone11_pro.jpg') }}"
                alt="iPhone 11 Pro"
                class="w-full h-full object-cover"
              />
            </div>
            <span
              class="absolute top-2 left-2 bg-black text-white text-xs font-bold px-3 py-1 rounded-md"
              >-30%</span
            >
            <button
              class="absolute top-2 right-2 bg-black text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors"
            >
              <img src="{{ asset('static/cart_catalog.svg') }}" class="w-4 h-4" alt="Cart" />
            </button>
          </div>
          <div class="p-4">
            <h3 class="text-sm font-semibold text-gray-900 truncate mb-1.5">iPhone 11 Pro 64GB</h3>
            <div class="flex items-baseline gap-2">
              <span class="text-lg font-extrabold text-gray-900 mono">$152.50</span>
              <span class="text-xs text-gray-400 line-through mono">$218.00</span>
            </div>
          </div>
        </a>
      </div>
    </main>
    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
