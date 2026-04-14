<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
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
      <a href="{{ route('login') }}" id="navLoginLink" class="text-sm font-semibold hover:opacity-60">Log In</a>
    </div>

    <main class="w-full px-4 md:px-8 2xl:px-16 py-8">
  <h1 class="text-3xl font-extrabold mb-6">Checkout</h1>

  <form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    
    <div class="flex flex-col lg:flex-row gap-6 items-start">
      
      <div class="flex-1 flex flex-col gap-4 w-full">
        
        <div class="bg-white border border-gray-200 rounded-xl p-5">
          <h2 class="text-xs font-bold uppercase mb-4">Delivery Method</h2>
          <div class="flex flex-col gap-2">
            <label class="delivery-option flex items-center gap-4 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-gray-400 transition-colors has-[:checked]:border-black">
              <input type="radio" name="delivery_method" value="Courier" class="accent-black" checked />
              <img src="{{ asset('static/truck.svg') }}" class="w-6 h-6 shrink-0" alt="" />
              <div class="flex-1">
                <p class="text-sm font-semibold">Courier</p>
                <p class="text-xs text-gray-400">Delivered to your doors in 1-3 days</p>
              </div>
              <span class="text-sm font-bold mono">$9.99</span>
            </label>

            <label class="delivery-option flex items-center gap-4 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-gray-400 transition-colors has-[:checked]:border-black">
              <input type="radio" name="delivery_method" value="Pickup Point" class="accent-black" />
              <img src="{{ asset('static/box.svg') }}" class="w-6 h-6 shrink-0" alt="" />
              <div class="flex-1">
                <p class="text-sm font-semibold">Pickup Point</p>
                <p class="text-xs text-gray-400">Pickup from nearby parcel locker</p>
              </div>
              <span class="text-sm font-bold mono">$4.99</span>
            </label>

            <label class="delivery-option flex items-center gap-4 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-gray-400 transition-colors has-[:checked]:border-black">
              <input type="radio" name="delivery_method" value="Store Pickup" class="accent-black" />
              <img src="{{ asset('static/store.svg') }}" class="w-6 h-6 shrink-0" alt="" />
              <div class="flex-1">
                <p class="text-sm font-semibold">Store Pickup</p>
                <p class="text-xs text-gray-400">Free pick up from our store</p>
              </div>
              <span class="text-sm font-bold mono">Free</span>
            </label>
          </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5">
          <h2 class="text-xs font-bold uppercase mb-4">Payment Method</h2>
          <div class="flex flex-col gap-2">
            <label class="flex items-center gap-4 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-gray-400 transition-colors has-[:checked]:border-black">
              <input type="radio" name="payment_method" value="Card" class="accent-black" checked />
              <img src="{{ asset('static/card.svg') }}" class="w-6 h-6 shrink-0" alt="" />
              <div>
                <p class="text-sm font-semibold">Card</p>
                <p class="text-xs text-gray-400">Visa, Mastercard, Apple Pay</p>
              </div>
            </label>

            <label class="flex items-center gap-4 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-gray-400 transition-colors has-[:checked]:border-black">
              <input type="radio" name="payment_method" value="Cash" class="accent-black" />
              <img src="{{ asset('static/cash.svg') }}" class="w-6 h-6 shrink-0" alt="" />
              <div>
                <p class="text-sm font-semibold">Cash on Delivery</p>
                <p class="text-xs text-gray-400">Pay when your order arrives</p>
              </div>
            </label>
          </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5">
          <h2 class="text-xs font-bold uppercase mb-4">Delivery Details</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold uppercase mb-1">First Name</label>
              <input type="text" name="first_name" required placeholder="Gleb" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-2.5 text-sm mono outline-none focus:border-black transition-colors" />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase mb-1">Last Name</label>
              <input type="text" name="last_name" required placeholder="Kalyta" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-2.5 text-sm mono outline-none focus:border-black transition-colors" />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase mb-1">Email</label>
              <input type="email" name="email" required placeholder="gleb@gmail.com" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-2.5 text-sm mono outline-none focus:border-black transition-colors" />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase mb-1">Phone</label>
              <input type="tel" name="phone" required placeholder="+7 952 409 984" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-2.5 text-sm mono outline-none focus:border-black transition-colors" />
            </div>
            <div class="sm:col-span-2">
              <label class="block text-xs font-bold uppercase mb-1">Address</label>
              <input type="text" name="address" required placeholder="Street, house number" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-2.5 text-sm mono outline-none focus:border-black transition-colors" />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase mb-1">City</label>
              <input type="text" name="city" required placeholder="St. Petersburg" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-2.5 text-sm mono outline-none focus:border-black transition-colors" />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase mb-1">ZIP Code</label>
              <input type="text" name="zip_code" required placeholder="811 01" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-2.5 text-sm mono outline-none focus:border-black transition-colors" />
            </div>
          </div>
        </div>
      </div>

      <div class="w-full lg:w-80 lg:shrink-0 bg-white border border-gray-200 rounded-xl p-6 lg:sticky lg:top-20">
        <h2 class="text-base font-extrabold mb-5">Order Summary</h2>
        
        <div class="flex flex-col gap-3 mb-4">
          @if(session('cart') && count(session('cart')) > 0)
              @foreach(session('cart') as $details)
              <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-gray-100 rounded-lg shrink-0 overflow-hidden">
                  <img src="{{ asset($details['image']) }}" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-sm font-semibold truncate">{{ $details['name'] }}</p>
                  <p class="text-xs text-gray-400">x{{ $details['quantity'] }}</p>
                </div>
                <span class="text-sm font-bold mono shrink-0">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
              </div>
              @endforeach
          @else
              <p class="text-sm text-gray-500">Your cart is empty.</p>
          @endif
        </div>

        @php
            $subtotal = 0;
            if(session('cart')) {
                foreach(session('cart') as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                }
            }
            $delivery = 9.99;
            $total = $subtotal > 0 ? $subtotal + $delivery : 0;
        @endphp

        <div class="border-t border-gray-200 pt-4 flex flex-col gap-2 mb-4">
          <div class="flex justify-between text-sm">
            <span class="text-gray-500">Subtotal</span>
            <span class="font-semibold mono">${{ number_format($subtotal, 2) }}</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-500">Delivery</span>
            <span class="font-semibold mono">${{ number_format($delivery, 2) }}</span>
          </div>
        </div>

        <div class="border-t border-gray-200 pt-4 mb-5">
          <div class="flex justify-between">
            <span class="font-extrabold text-base">Total</span>
            <span class="font-extrabold text-base mono">${{ number_format($total, 2) }}</span>
          </div>
        </div>

        <button type="submit" class="block w-full bg-black text-white text-sm font-bold text-center py-3 rounded-xl hover:opacity-60 transition-opacity mb-3">
          Place Order
        </button>
        <a href="{{ route('cart') }}" class="block text-center text-xs text-gray-400 hover:text-gray-900 transition-colors">
          <- Back to cart
        </a>
      </div>
    </div>
  </form>
</main>
    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
