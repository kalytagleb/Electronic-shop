<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('style.css')}}" />
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100 text-gray-900">
    @if(session('success') || session('error'))
        <div id="flash-message" class="fixed top-20 right-8 z-50 animate-bounce">
            <div class="{{ session('success') ? 'bg-black' : 'bg-red-600' }} text-white px-6 py-3 rounded-xl shadow-2xl flex items-center gap-3">
                <span class="text-sm font-bold uppercase tracking-wider">
                    {{ session('success') ?? session('error') }}
                </span>
                <button onclick="document.getElementById('flash-message').remove()" class="hover:opacity-50">
                    ✕
                </button>
            </div>
        </div>

        <script>
            setTimeout(() => {
                const msg = document.getElementById('flash-message');
                if(msg) msg.style.display = 'none';
            }, 4000);
        </script>
    @endif
    <nav
      class="bg-white border-b border-gray-200 px-8 flex items-center justify-between h-16 sticky top-0 z-20"
    >
      <div class="hidden md:flex items-center gap-9">
        <a href="{{ route('home') }}" class="font-semibold text-sm hover:opacity-60 transition-opacity">Home</a>
        <a
          href="{{ route('best-deals') }}"
          class="font-semibold text-sm hover:opacity-60 transition-opacity"
          >Best Deals</a
        >
        <a
          href="{{ route('contacts') }}"
          class="font-semibold text-sm hover:opacity-60 transition-opacity"
          >Contacts</a
        >
        <!-- Categories dropdown-->
        <div class="relative">
          <button
            onclick="toggleSort('catMenu')"
            class="font-semibold text-sm flex items-center hover:opacity-60 transition-opacity"
          >
            Categories
            <img src="static/chevron-down.svg" class="w-4 h-4" alt="Search" />
          </button>
          <div
            id="catMenu"
            class="sort-dropdown bg-white border border-gray-200 rounded-xl shadow-lg min-w-40 py-1 z-30"
          >
            @foreach($globalCategories as $cat)
                <a href="{{ route('catalog', ['category_id' => [$cat->id]]) }}" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50">
                    {{ $cat->name }}
                </a>
            @endforeach
          </div>
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
            <img src="static/search.svg" class="w-4 h-4" alt="" />
            Search
          </button>
        </div>
        <a
          href="{{ route('cart') }}"
          class="flex items-center gap-1 text-sm hover:opacity-60 transition-opacity"
        >
          <img src="static/cart.svg" class="w-4 h-4" alt="" />
          Cart {{ session('cart') ? count(session('cart')) : 0 }}        
        </a>
        @guest
          <a href="{{ route('login') }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60">Log In</a>
      @endguest
      @auth
          @if(auth()->user()->role === 'admin')
              <a href="{{ route('admin.products') }}" class="text-sm font-bold text-red-600 hover:opacity-60">Admin Panel</a>
          @endif
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="text-sm font-semibold hover:opacity-60 text-left w-full">Log out</button>
          </form>
      @endauth
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
      <a href="{{ route('best-deals') }}" class="text-sm font-semibold hover:opacity-60">Best Deals</a>
      <a href="{{ route('contacts') }}" class="text-sm font-semibold hover:opacity-60">Contacts</a>
      <div>
        <button
          onclick="toggleMobileCat()"
          class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60"
        >
          Categories
          <img src="static/chevron-down.svg" class="w-4 h-4" alt="Search" />
        </button>

        <div id="mobileCatMenu" class="hidden mt-2 ml-3 flex flex-col gap-2">
            @foreach($globalCategories as $cat)
                <a href="{{ route('catalog', ['category_id' => [$cat->id]]) }}" class="text-sm text-gray-600 hover:text-black">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
      </div>
      <hr class="border-gray-200" />
      <a href="#" class="text-sm font-semibold hover:opacity-60">Search</a>
      <a href="{{ route('cart') }}" class="text-sm font-semibold hover:opacity-60">Cart</a>
      @guest
          <a href="{{ route('login') }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60">Log In</a>
      @endguest
      @auth
          @if(auth()->user()->role === 'admin')
              <a href="{{ route('admin.products') }}" class="text-sm font-bold text-red-600 hover:opacity-60">Admin Panel</a>
          @endif
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="text-sm font-semibold hover:opacity-60 text-left w-full">Log out</button>
          </form>
      @endauth    </div>

    <main class="w-full px-8 2xl:px-16 py-8 flex flex-col gap-12">
      <section
        class="bg-white border border-gray-200 rounded-2xl px-8 py-16 flex flex-col items-center text-center gap-6"
      >
        <h1 class="text-4xl font-extrabold tracking-tight">Electronic shop</h1>
        <p class="text-gray-500 text-base max-w-md">
          Find the best smartphones, laptops and tablets
        </p>
        <a
          href="{{ route('catalog') }}"
          class="bg-black text-white font-bold text-sm px-8 py-3 rounded-xl hover:opacity-80 transition-opacity"
          >Shop now</a
        >
      </section>

      <section>
        <h2 class="text-xl font-extrabold tracking-tight text-center mb-6">Shop by Category</h2>
        
        @php
            $catPhones = $globalCategories->where('name', 'Phones')->first();
            $catLaptops = $globalCategories->where('name', 'Laptops')->first();
            $catMonitors = $globalCategories->where('name', 'Monitors')->first();
            $catAudio = $globalCategories->where('name', 'Audio')->first();
            $catAccessories = $globalCategories->where('name', 'Accessories')->first();
        @endphp

        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
          <a
            href="{{ $catPhones ? route('catalog', ['category_id' => [$catPhones->id]]) : route('catalog') }}"
            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
          >
            <div class="w-full h-28 bg-gray-100 overflow-hidden">
              <img src="images/iPhone14_pro.jpg" alt="" class="w-full h-full object-cover" />
            </div>
            <div class="p-2 text-center">
              <span class="text-xs font-bold uppercase tracking-wider">Phones</span>
            </div>
          </a>

          <a
            href="{{ $catLaptops ? route('catalog', ['category_id' => [$catLaptops->id]]) : route('catalog') }}"
            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
          >
            <div class="w-full h-28 bg-gray-100 flex items-center justify-center">
              <img src="static/laptops.svg" class="w-10 h-10 opacity-20" alt="" />
            </div>
            <div class="p-2 text-center">
              <span class="text-xs font-bold uppercase tracking-wider">Laptops</span>
            </div>
          </a>

          <a
            href="{{ $catMonitors ? route('catalog', ['category_id' => [$catMonitors->id]]) : route('catalog') }}"
            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
          >
            <div class="w-full h-28 bg-gray-100 flex items-center justify-center">
              <img src="static/monitors.svg" class="w-10 h-10 opacity-20" alt="" />
            </div>
            <div class="p-2 text-center">
              <span class="text-xs font-bold uppercase tracking-wider">Monitors</span>
            </div>
          </a>

          <a
            href="{{ $catAudio ? route('catalog', ['category_id' => [$catAudio->id]]) : route('catalog') }}"
            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
          >
            <div class="w-full h-28 bg-gray-100 flex items-center justify-center">
              <img src="static/audio.svg" class="w-10 h-10 opacity-20" alt="" />
            </div>
            <div class="p-2 text-center">
              <span class="text-xs font-bold uppercase tracking-wider">Audio</span>
            </div>
          </a>

          <a
            href="{{ $catAccessories ? route('catalog', ['category_id' => [$catAccessories->id]]) : route('catalog') }}"
            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
          >
            <div class="w-full h-28 bg-gray-100 flex items-center justify-center">
              <img src="static/accessories.svg" class="w-10 h-10 opacity-20" alt="" />
            </div>
            <div class="p-2 text-center">
              <span class="text-xs font-bold uppercase tracking-wider">Accessories</span>
            </div>
          </a>

          <a
            href="#deals"
            class="bg-black text-white border border-black rounded-xl overflow-hidden hover:opacity-80 transition-all duration-200"
          >
            <div class="w-full h-28 bg-gray-100 flex items-center justify-center">
              <img src="static/best_deals.svg" class="w-10 h-10 opacity-20" alt="" />
            </div>
            <div class="p-2 text-center">
              <span class="text-xs font-bold uppercase tracking-wider">Best Deals</span>
            </div>
          </a>
        </div>
      </section>
      
      <section id="deals">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
          @foreach($featuredProducts as $product)
          <a
            href="{{ route('product', $product->id) }}"
            class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200"
          >
            <div class="relative">
              <div class="w-full h-52 bg-gray-100 overflow-hidden">
                <img src="{{ asset($product->primary_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />              </div>
              <span class="absolute top-2 left-2 bg-black text-white text-xs font-bold px-3 py-1 rounded-full">
                  {{ $product->category->name ?? 'NEW' }}
              </span>
              <form action="{{ route('cart.add') }}" method="POST" class="absolute top-2 right-2">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" onclick="event.stopPropagation();" class="bg-black text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-700">
                    <img src="{{ asset('static/cart_catalog.svg') }}" class="w-4 h-4" alt="Add to cart" />
                  </button>
              </form>
            </div>
            <div class="p-3 text-center">
              <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
              <p class="text-sm text-gray-500 mt-1 mono">${{ number_format($product->price, 2) }}</p>
            </div>
          </a>
          @endforeach
      </div>

        <div class="flex justify-center mt-6">
          <a
            href="{{ route('catalog') }}"
            class="text-sm font-semibold text-gray-900 hover:opacity-60 transition-opacity border-b border-gray-900 pb-0.5"
          >
            View all
          </a>
        </div>
      </section>
    </main>

    <script src="script.js"></script>
  </body>
</html>
