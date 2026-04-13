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
  </head>
  <body class="bg-gray-100 text-gray-900">
    <nav
      class="bg-white border-b border-gray-200 px-8 flex items-center justify-between h-16 sticky top-0 z-20"
    >
      <div class="hidden md:flex items-center gap-9">
        <a href="{{ route('home') }}" class="font-semibold text-sm hover:opacity-60 transition-opacity"
          >Home</a
        >
        <a
          href="{{ route('best-deals') ?? '#' }}"
          class="font-semibold text-sm hover:opacity-60 transition-opacity"
          >Best Deals</a
        >
        <a href="{{ route('contacts') ?? '#' }}" class="font-semibold text-sm hover:opacity-60 transition-opacity"
          >Contacts</a
        >

        <div class="relative">
          <button
            onclick="toggleSort('catMenu')"
            class="font-semibold text-sm flex items-center hover:opacity-60 transition-opacity"
          >
            Categories
            <img src="{{ asset('static/chevron-down.svg') }}" class="w-4 h-4" alt="Search" />
          </button>
          <div
            id="catMenu"
            class="sort-dropdown bg-white border border-gray-200 rounded-xl shadow-lg min-w-40 py-1 z-30"
          >
            <a href="{{ route('catalog') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50"
              >Phones</a
            >
            <a href="#" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50">Laptops</a>
            <a href="#" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50">Monitors</a>
            <a href="#" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50">Audio</a>
            <a href="#" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50"
              >Accessories</a
            >
          </div>
        </div>
      </div>
      <div class="hidden md:flex items-center gap-6">
        <div class="relative flex items-center">
          <div
            id="searchWrapper"
            class="absolute right-[100%] mr-3 opacity-0 pointer-events-none translate-x-4 transition-all duration-300 ease-in-out"
          >
            <input
              type="text"
              id="searchInput"
              placeholder="Search products..."
              class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors w-48 xl:w-64 shadow-sm"
            />
          </div>

          <button
            id="searchToggleBtn"
            class="flex items-center gap-1 text-sm font-semibold hover:opacity-60 transition-opacity bg-white z-10 relative"
          >
            <img src="{{ asset('static/search.svg') }}" class="w-4 h-4" alt="" />
            Search
          </button>
        </div>
        <a
          href="{{ route('cart') ?? '#' }}"
          class="flex items-center gap-1 text-sm hover:opacity-60 transition-opacity"
        >
          <img src="{{ asset('static/cart.svg') }}" class="w-4 h-4" alt="" />
          Cart {{ session('cart') ? count(session('cart')) : 0 }}        
        </a>
        <a href="{{ route('login') ?? '#' }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60 transition-opacity"
          >Log In</a
        >
      </div>

      <button
        id="burgerBtn"
        onclick="toggleMobileMenu()"
        class="md:hidden flex flex-col gap-1.5"
        p-2
      >
        <span class="w-5 h-0.5 bg-gray-900 block transition-all"></span>
        <span class="w-5 h-0.5 bg-gray-900 block transition-all"></span>
        <span class="w-5 h-0.5 bg-gray-900 block transition-all"></span>
      </button>
    </nav>

    <div
      id="mobileMenu"
      class="md:hidden bg-white border-b border-gray-200 px-8 py-4 flex flex-col gap-4"
    >
      <a href="{{ route('home') }}" class="text-sm font-semibold hover:opacity-60">Home</a>
      <a href="{{ route('best-deals') ?? '#' }}" class="text-sm font-semibold hover:opacity-60">Best Deals</a>
      <a href="{{ route('contacts') ?? '#' }}" class="text-sm font-semibold hover:opacity-60">Contacts</a>
      <div>
        <button
          onclick="toggleMobileCat()"
          class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60"
        >
          Categories
          <img src="{{ asset('static/chevron-down.svg') }}" class="w-4 h-4" alt="Search" />
        </button>
        <div id="mobileCatMenu" class="hidden mt-2 ml-3 flex flex-col gap-2">
            <a href="{{ route('catalog') }}" class="text-sm font-bold text-gray-900 border-b border-gray-100 pb-2 mb-1">
                All Categories
            </a>
            @foreach($globalCategories as $category)
                <a href="{{ route('catalog', ['category_id' => $category->id]) }}" class="text-sm text-gray-600 hover:text-black">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
      </div>
      <hr class="border-gray-200" />
      <a href="#" class="text-sm font-semibold hover:opacity-60">Search</a>
      <a href="{{ route('cart') ?? '#' }}" class="text-sm font-semibold hover:opacity-60">Cart</a>
      <a href="{{ route('login') ?? '#' }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60">Log In</a>
    </div>

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
                    <span id="productQuantity" data-qty class="px-4 font-mono">1</span>
                    <button type="button" onclick="changeQuantity(this, 1)" class="px-2 text-xl font-bold hover:text-gray-500">+</button>
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