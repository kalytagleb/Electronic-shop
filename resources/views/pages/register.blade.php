<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Electronic shop</title>
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
          Cart 0
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
      <a href="{{ route('login') }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60">Log In</a>
    </div>

    <main class="flex-1 flex flex-col items-center justify-center px-6 py-12">
      <h1 class="text-3xl font-extrabold tracking-tight mb-8">Electronic shop</h1>
      <form id="registerForm" class="w-full max-w-md border border-gray-200 rounded-2xl px-10 py-10">
        <h2 class="text-3xl font-extrabold tracking-tight mb-1">Create account</h2>
        <p class="text-sm text-gray-500 mb-8">
          Already have one?
          <a href="{{ route('login') }}" class="font-bold text-gray-900 underline underline-offset-2"
            >Log in</a
          >
        </p>

        <div class="grid grid-cols-2 gap-3 mb-4">
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest mb-2">First name</label>
            <input
              type="text"
              id="regFirstName"
              placeholder="Gleb"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
            />
          </div>
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest mb-2">Last name</label>
            <input
              type="text"
              id="regLastName"
              placeholder="Kalyta"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
            />
          </div>
        </div>

        <div class="mb-4">
          <label class="block text-xs font-bold uppercase tracking-widest mb-2">Email</label>
          <input
            type="email"
            id="regEmail"
            placeholder="kalytagleb@gmail.com"
            class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
          />
        </div>

        <div class="mb-4">
          <label class="block text-xs font-bold uppercase tracking-widest mb-2">Password</label>
          <input
            type="password"
            id="regPassword"
            placeholder="Min. 8 characters"
            class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
          />
        </div>

        <div class="mb-6">
          <label class="block text-xs font-bold uppercase tracking-widest mb-2"
            >Confirm password</label
          >
          <input
            type="password"
            placeholder="Repeat password"
            class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
          />
        </div>

        <label class="flex items-start gap-3 mb-6 cursor-pointer">
          <input type="checkbox" class="mt-0.5 w-4 h-4 accent-black cursor-pointer shrink-0" />
          <span class="text-sm text-gray-500">
            I agree to the
            <a href="#" class="text-gray-900 underline underline-offset-2">Terms of Service</a>
            and
            <a href="#" class="text-gray-900 underline underline-offset-2">Privacy Policy</a>
          </span>
        </label>

        <button
          type="submit"
          class="w-full bg-black text-white font-bold text-sm py-4 rounded-xl hover:opacity-80 transition-opacity"
        >
          Create account
        </button>
      </form>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
