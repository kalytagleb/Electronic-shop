<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
    </style>
  </head>
  <body class="bg-gray-100 text-gray-900">
    @include('components.navbar')


    <div class="px-8 2xl:px-16 pt-6 pb-2 text-xs text-gray-400 font-semibold flex gap-2">
      <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">Home</a>
      <span>/</span>
      <a href="{{ route('catalog') }}" class="hover:text-gray-900 transition-colors">{{ $product->category->name ?? 'Category' }}</a>
      <span>/</span>
      <span class="text-gray-900">{{ $product->name }}</span>
    </div>

    <main class="w-full px-8 2xl:px-16 py-6 lg:py-10 max-w-[1440px] mx-auto">
      <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-start">
        
        <div class="w-full lg:w-1/2 flex flex-col gap-4">
          <div class="relative w-full aspect-square bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <img
              id="mainImg"
              src="{{ asset($product->primary_image ?? 'images/placeholder.jpg') }}"
              alt="{{ $product->name }}"
              class="w-full h-full object-cover"
            />
            <span class="absolute top-3 left-3 bg-black text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
                {{ $product->category->name ?? 'PRODUCT' }}
            </span>
          </div>
          
          <div class="grid grid-cols-4 gap-3">
            @foreach($product->images as $index => $image)
              <button 
                onclick="setImg(this, '{{ asset($image->image_url) }}')" 
                class="aspect-square bg-white border-2 {{ $index === 0 ? 'border-black' : 'border-gray-200' }} rounded-xl overflow-hidden hover:border-gray-900 transition-colors"
              >
                <img src="{{ asset($image->image_url) }}" alt="" class="w-full h-full object-cover" />
              </button>
            @endforeach
          </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col gap-6 lg:sticky lg:top-24">
          <div>
            <h1 class="text-3xl font-extrabold mb-2">{{ $product->name }}</h1>
            <div class="flex items-center gap-2">
              <span class="text-yellow-400 text-sm">*****</span>
              <span class="text-sm text-gray-500 mono">4.9</span>
              <span class="text-sm text-gray-300">.</span>
              <span class="text-sm text-gray-400">5 reviews</span>
            </div>
          </div>

          <div class="flex items-baseline gap-3">
            <span class="text-3xl font-extrabold mono">${{ number_format($product->price, 2) }}</span>
            <span class="text-base text-gray-400 line-through mono">${{ number_format($product->price * 1.2, 2) }}</span>
            <span class="bg-black text-white text-xs font-bold px-2 py-0.5 rounded-md">-17%</span>
          </div>

          <p class="text-sm text-gray-500">
            {{ $product->description ?? 'No description available for this product yet. It features premium build quality and excellent performance.' }}
          </p>

          <div class="flex flex-col gap-4 mt-2">
            <h3 class="text-sm font-extrabold uppercase tracking-wide">Specifications</h3>
            <hr class="border-black" />

            <div class="flex flex-col gap-3">
              <div class="flex text-sm">
                <span class="w-32 text-gray-400 font-semibold">Brand</span>
                <span class="font-bold text-gray-900">{{ $product->brand ?? 'N/A' }}</span>
              </div>
              <div class="flex text-sm">
                <span class="w-32 text-gray-400 font-semibold">Color</span>
                <span class="font-bold text-gray-900">{{ $product->color ?? 'N/A' }}</span>
              </div>
              <div class="flex text-sm">
                <span class="w-32 text-gray-400 font-semibold">Availability</span>
                <span class="font-bold {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->stock_quantity > 0 ? 'In Stock (' . $product->stock_quantity . ' pcs)' : 'Out of Stock' }}
                </span>
              </div>
            </div>
            
            <hr class="border-gray-200 mt-2 mb-4" />

            <div class="flex items-center gap-4 mt-6">
                <div class="flex items-center border border-gray-300 rounded-lg px-3 py-1">
                    <button type="button" onclick="changeQuantity(this, -1)" class="px-2 text-xl font-bold hover:text-gray-500">-</button>
                    <input type="number" id="productQuantity" data-qty value="1" min="1" class="w-16 text-center font-mono border border-gray-200 rounded outline-none appearance-none" onchange="if(this.value < 1) this.value = 1;">                    <button type="button" onclick="changeQuantity(this, 1)" class="px-2 text-xl font-bold hover:text-gray-500">+</button>
                </div>

                <button type="button" onclick="addToCart(this, {{ $product->id }})" class="bg-black text-white px-8 py-3 rounded-xl font-semibold hover:bg-gray-800 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Add to cart
                </button>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>