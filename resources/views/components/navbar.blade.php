<nav class="bg-white border-b border-gray-200 px-8 flex items-center justify-between h-16 sticky top-0 z-20">
  <div class="hidden md:flex items-center gap-9">
    <a href="{{ route('home') }}" class="font-semibold text-sm hover:opacity-60 transition-opacity">Home</a>
    <a href="{{ route('best-deals') }}" class="font-semibold text-sm hover:opacity-60 transition-opacity">Best Deals</a>
    <a href="{{ route('contacts') }}" class="font-semibold text-sm hover:opacity-60 transition-opacity">Contacts</a>

    <div class="relative">
      <button onclick="toggleSort('catMenu')" class="font-semibold text-sm flex items-center hover:opacity-60 transition-opacity">
        Categories
        <img src="{{ asset('static/chevron-down.svg') }}" class="w-4 h-4" alt="" />
      </button>
      <div id="catMenu" class="sort-dropdown bg-white border border-gray-200 rounded-xl shadow-lg min-w-40 py-1 z-30">
        @foreach($globalCategories as $cat)
          <a href="{{ route('catalog', ['category_id' => [$cat->id]]) }}" class="block px-4 py-2 text-sm font-semibold hover:bg-gray-50">
            {{ $cat->name }}
          </a>
        @endforeach
      </div>
    </div>
  </div>

  <div class="hidden md:flex items-center gap-6">
    <div class="relative flex items-center">
      <div id="searchWrapper" class="absolute right-full mr-3 opacity-0 pointer-events-none translate-x-4 transition-all duration-300 ease-in-out">
        <input type="text" id="searchInput" placeholder="Search products..."
          class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors w-48 xl:w-64 shadow-sm" />
      </div>
      <button id="searchToggleBtn" class="flex items-center gap-1 text-sm font-semibold hover:opacity-60 transition-opacity bg-white z-10 relative">
        <img src="{{ asset('static/search.svg') }}" class="w-4 h-4" alt="" />
        Search
      </button>
    </div>

    <a href="{{ route('cart') }}" class="flex items-center gap-1 text-sm hover:opacity-60 transition-opacity">
      <img src="{{ asset('static/cart.svg') }}" class="w-4 h-4" alt="" />
      Cart {{ session('cart') ? count(session('cart')) : 0 }}
    </a>

    {{-- If user logged in, show him - Log Out --}} 
    @auth
      @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.products') }}" class="text-sm font-bold text-red-600 hover:opacity-60 transition-opacity">Admin Panel</a>
      @endif
      <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="text-sm font-semibold hover:opacity-60 transition-opacity">
          Log Out
        </button>
      </form>
    @else
      <a href="{{ route('login') }}" class="text-sm font-semibold hover:opacity-60 transition-opacity">Log In</a>
    @endauth
  </div>

  <button id="burgerBtn" onclick="toggleMobileMenu()" class="md:hidden flex flex-col gap-1.5 p-2">
    <span class="w-5 h-0.5 bg-gray-900 block transition-all"></span>
    <span class="w-5 h-0.5 bg-gray-900 block transition-all"></span>
    <span class="w-5 h-0.5 bg-gray-900 block transition-all"></span>
  </button>
</nav>

<div id="mobileMenu" class="md:hidden bg-white border-b border-gray-200 px-8 py-4 flex flex-col gap-4">
  <a href="{{ route('home') }}" class="text-sm font-semibold hover:opacity-60">Home</a>
  <a href="{{ route('best-deals') }}" class="text-sm font-semibold hover:opacity-60">Best Deals</a>
  <a href="{{ route('contacts') }}" class="text-sm font-semibold hover:opacity-60">Contacts</a>
  <div>
    <button onclick="toggleMobileCat()" class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60">
      Categories
      <img src="{{ asset('static/chevron-down.svg') }}" class="w-4 h-4" alt="" />
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
  <a href="{{ route('cart') }}" class="text-sm font-semibold hover:opacity-60">Cart</a>
  @auth
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="text-sm font-semibold hover:opacity-60 text-left">Log Out</button>
    </form>
  @else
    <a href="{{ route('login') }}" class="text-sm font-semibold hover:opacity-60">Log In</a>
  @endauth
</div>
