<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
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
          href="{{ route('best-deals') }}"
          class="font-semibold text-sm hover:opacity-60 transition-opacity"
          >Best Deals</a
        >
        <a href="{{ route('contacts') }}" class="font-semibold text-sm hover:opacity-60 transition-opacity"
          >Contacts</a
        >
        <!-- Categories dropdown-->
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
            <a href="#" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50">Phones</a>
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
          href="{{ route('cart') }}"
          class="flex items-center gap-1 text-sm hover:opacity-60 transition-opacity"
        >
          <img src="{{ asset('static/cart.svg') }}" class="w-4 h-4" alt="" />
          Cart {{ session('cart') ? count(session('cart')) : 0 }}        
        </a>
        <a href="{{ route('login') }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60 transition-opacity"
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
      <a href="{{ route('best-deals') }}" class="text-sm font-semibold hover:opacity-60">Best Deals</a>
      <a href="{{ route('contacts') }}" class="text-sm font-semibold hover:opacity-60">Contacts</a>
      <div>
        <button
          onclick="toggleMobileCat()"
          class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60"
        >
          Categories
          <img src="{{ asset('static/chevron-down.svg') }}" class="w-4 h-4" alt="Search" />
        </button>
        <div id="mobileCatMenu" class="hidden mt-2 ml-3 flex flex-col gap-2">
          <a href="#" class="text-sm text-gray-600 hover:text-black">Phones</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Laptops</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Monitors</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Audio</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Accessories</a>
        </div>
      </div>
      <hr class="border-gray-200" />
      <a href="#" class="text-sm font-semibold hover:opacity-60">Search</a>
      <a href="{{ route('cart') }}" class="text-sm font-semibold hover:opacity-60">Cart</a>
      <a href="{{ route('login') }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60">Log In</a>
    </div>

    <main class="w-full 2xl:px-16 px-8 py-8">
      <h1 class="text-3xl font-extrabold mb-6">Electronic shop</h1>
      
      <form method="GET" action="{{ route('catalog') }}" id="filterForm">
          
          @php
              $sortLabels = [
                  '' => 'By relevance',
                  'price_asc' => 'Price: low to high',
                  'price_desc' => 'Price: high to low',
              ];
              $currentSort = request('sort', '');
          @endphp
          
          <input type="hidden" name="sort" id="sortInput" value="{{ $currentSort }}">
          
          <div class="flex items-center justify-end mb-6 gap-4">
            <div class="relative">
              <button
                type="button"
                onclick="toggleSort('sortMenu')"
                class="flex items-center gap-1 text-sm font-semibold hover:opacity-60 transition-opacity"
              >
                {{ $sortLabels[$currentSort] ?? 'Sort by relevance' }}
                <img src="{{ asset('static/chevron-down.svg') }}" class="w-4 h-4" alt="" />
              </button>
              
              <div
                id="sortMenu"
                class="sort-dropdown bg-white border border-gray-200 rounded-xl shadow-lg min-w-48 py-1 z-10"
              >
                <button type="button" onclick="document.getElementById('sortInput').value=''; this.form.submit();" class="block w-full text-left px-4 py-2 text-sm font-semibold hover:bg-gray-50 {{ $currentSort == '' ? 'bg-gray-50' : '' }}">
                  By relevance
                </button>
                <button type="button" onclick="document.getElementById('sortInput').value='price_asc'; this.form.submit();" class="block w-full text-left px-4 py-2 text-sm font-semibold hover:bg-gray-50 {{ $currentSort == 'price_asc' ? 'bg-gray-50' : '' }}">
                  Price: low to high
                </button>
                <button type="button" onclick="document.getElementById('sortInput').value='price_desc'; this.form.submit();" class="block w-full text-left px-4 py-2 text-sm font-semibold hover:bg-gray-50 {{ $currentSort == 'price_desc' ? 'bg-gray-50' : '' }}">
                  Price: high to low
                </button>
              </div>
            </div>
            <span class="text-sm text-gray-400 mono">{{ $products->total() }} goods</span>
          </div>

          <div class="flex flex-col md:flex-row gap-8">
            
            <aside class="w-full md:w-52 shrink-0">
              <h2 class="font-bold text-base mb-4">Filters</h2>

              @php
                  $activeBrands = request('brand', []);
                  $activeColors = request('color', []);
                  
                  $isBrandOpen = count($activeBrands) > 0;
                  $isColorOpen = count($activeColors) > 0;
              @endphp

              <div class="border-b border-gray-200 py-3">
                <button type="button" onclick="toggleFilter('brand')" class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60 transition-opacity {{ $isBrandOpen ? 'filter-open' : '' }}">
                  Brand
                  <img src="{{ asset('static/plus.svg') }}" class="filter-icon-plus w-4 h-4" alt="" />
                  <img src="{{ asset('static/minus.svg') }}" class="filter-icon-minus w-4 h-4" alt="" />
                </button>

                <div id="brand" class="filter-body mt-3 space-y-2 {{ $isBrandOpen ? 'open' : '' }}">
                  @foreach($brands as $b)
                  <label class="flex items-center gap-2 text-sm cursor-pointer hover:text-gray-600">
                    <input type="checkbox" name="brand[]" value="{{ $b }}" class="w-4 h-4 accent-black rounded" 
                          @if(in_array($b, $activeBrands)) checked @endif 
                          onchange="this.form.submit()" />
                    {{ $b }}
                  </label>
                  @endforeach
                </div>
              </div>

              <div class="border-b border-gray-200 py-3">
                <button type="button" onclick="toggleFilter('color')" class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60 transition-opacity {{ $isColorOpen ? 'filter-open' : '' }}">
                  Color
                  <img src="{{ asset('static/plus.svg') }}" class="filter-icon-plus w-4 h-4" alt="" />
                  <img src="{{ asset('static/minus.svg') }}" class="filter-icon-minus w-4 h-4" alt="" />
                </button>
                <div id="color" class="filter-body mt-3 space-y-2 {{ $isColorOpen ? 'open' : '' }}">
                  @foreach($colors as $c)
                  <label class="flex items-center gap-2 text-sm cursor-pointer hover:text-gray-600">
                    <input type="checkbox" name="color[]" value="{{ $c }}" class="w-4 h-4 accent-black rounded" 
                          @if(in_array($c, $activeColors)) checked @endif 
                          onchange="this.form.submit()" />
                    {{ $c }}
                  </label>
                  @endforeach
                </div>
              </div>

              <div class="border-b border-gray-200 py-3">
                <button type="button" onclick="toggleFilter('price')" class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60 transition-opacity filter-open" id="priceBtn">
                  Price
                  <img src="{{ asset('static/plus.svg') }}" class="filter-icon-plus w-4 h-4" alt="" />
                  <img src="{{ asset('static/minus.svg') }}" class="filter-icon-minus w-4 h-4" alt="" />
                </button>

                <div id="price" class="filter-body open mt-3">
                  <div class="flex justify-between text-xs text-gray-500 mono mb-2">
                    <span id="priceMin">$0</span>
                    <span id="priceMax">${{ request('max_price', 1500) }}</span>
                  </div>
                  <input type="hidden" name="min_price" value="0">
                  <input
                    type="range"
                    name="max_price"
                    min="0"
                    max="1500"
                    value="{{ request('max_price', 1500) }}"
                    step="10"
                    class="w-full accent-black cursor-pointer"
                    oninput="document.getElementById('priceMax').textContent = '$' + this.value"
                    onchange="this.form.submit()"
                  />
                </div>
              </div>
              
              @if(request()->anyFilled(['brand', 'color', 'max_price', 'sort']))
                  <a href="{{ route('catalog') }}" class="block w-full text-center mt-6 text-sm font-semibold text-gray-500 hover:text-black transition-colors">
                    Clear Filters
                  </a>
              @endif
            </aside>

            <div class="flex-1 flex flex-col gap-8" id="catalogResults">
              <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                  @forelse($products as $product)
                      <a href="{{ route('product', $product->id) }}" class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:border-gray-400 hover:-translate-y-0.5 transition-all duration-200">
                          <div class="relative">
                              <div class="w-full h-52 bg-gray-100 overflow-hidden">
                                  <img src="{{ asset($product->primary_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                              </div>
                              <span class="absolute top-2 left-2 bg-black text-white text-xs font-bold px-3 py-1 rounded-full">
                                  {{ $product->category->name }}
                              </span>
                          </div>
                          <div class="p-3 text-center">
                              <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
                              <p class="text-sm text-gray-500 mt-1 mono">${{ number_format($product->price, 2) }}</p>
                          </div>
                      </a>
                  @empty
                      <div class="col-span-full text-center py-12 bg-white rounded-xl border border-gray-200">
                          <p class="text-gray-500 text-lg">No products found matching your filters.</p>
                      </div>
                  @endforelse
              </div>

              <div class="mt-4">
                  {{ $products->links() }}
              </div>
              
            </div>
          </div>
      </form>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
