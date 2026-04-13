<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In - Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
  </head>
  <body class="bg-white text-gray-900 min-h-screen flex flex-col">
    <nav class="border-b border-gray-200 px-8 flex items-center justify-between h-16 z-20">
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
      <a href="#" class="text-sm font-semibold hover:opacity-60">Categories</a>
      <div>
        <button
          onclick="toggleMobileCat()"
          class="flex items-center justify-between w-full text-sm font-semibold hover:opacity-60"
        >
          Categories
          <img src="{{ asset('static/chevron-down.svg') }}" class="w-4 h-4" alt="Search" />
        </button>
        <div id="mobileCatMenu" class="hidden mt-2 ml-3 flex flex-col gap-2">
          <a href="{{ route('catalog') }}" class="text-sm text-gray-600 hover:text-black">Phones</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Laptops</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Monitors</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Audio</a>
          <a href="#" class="text-sm text-gray-600 hover:text-black">Accessories</a>
        </div>
      </div>
      <hr class="border-gray-200" />
      <a href="#" class="text-sm font-semibold hover:opacity-60">Search</a>
      <a href="{{ route('cart') }}" class="text-sm font-semibold hover:opacity-60">Cart</a>
      <a href="#" id="navLoginLink" class="text-sm font-semibold hover:opacity-60">Log In</a>
    </div>

    <main class="flex-1 flex flex-col items-center justify-center px-6 py-12">
      <h1 class="text-3xl font-extrabold tracking-tight mb-8">Electronic shop</h1>
      <div class="w-full max-w-md border border-gray-200 rounded-2xl px-10 py-10">
        <h2 class="text-3xl font-extrabold tracking-tight mb-1">Welcome back</h2>
        <p class="text-sm text-gray-500 mb-8">
          No account yet?
          <a href="{{ route('register') }}" class="font-bold text-gray-900 underline underline-offset-2"
            >Create one</a
          >
        </p>

        <form id="loginForm" class="w-full max-w-md">
          <div class="mb-4">
            <label class="block text-xs font-bold uppercase tracking-widest mb-2">Email</label>
            <input
              type="email"
              id="loginEmail"
              placeholder="kalytagleb@gmail.com"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
            />
          </div>

          <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
              <label class="block text-xs font-bold uppercase tracking-widest">Password</label>
              <a href="#" class="text-xs text-gray-400 hover:text-gray-900 transition-colors"
                >Forgot password?</a
              >
            </div>
            <input
              type="password"
              id="loginPassword"
              placeholder="Your password"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
            />
          </div>

          <button
            type="submit"
            class="w-full bg-black text-white font-bold text-sm py-4 rounded-xl hover:opacity-80 transition-opacity mb-6"
          >
            Log in
          </button>
        </form>

        <div class="flex items-center gap-3 mb-6">
          <div class="flex-1 h-px bg-gray-200"></div>
          <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">or</span>
          <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        <button
          class="w-full flex items-center justify-center gap-3 border border-gray-200 rounded-xl py-3 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all"
        >
          <img src="{{ asset('static/google.svg') }}" class="w-[18px] h-[18px]" alt="" />
          Continue with Google
        </button>
      </div>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
