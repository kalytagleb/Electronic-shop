<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart - Electronic shop</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
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
    @include('components.navbar')


    <main class="w-full 2xl:px-16 px-8 py-8">
      <h1 class="text-3xl font-extrabold tracking-tight mb-6">Shopping Cart</h1>
      <div class="flex flex-col md:flex-row gap-6 items-start">
        <div class="flex-1 flex flex-col gap-3">
          @if(session('cart') && count(session('cart')) > 0)
            @foreach(session('cart') as $id => $details)
                <div class="cart-item bg-white border border-gray-200 rounded-xl p-4 flex items-center gap-4" data-price="{{ $details['price'] }}" data-id="{{ $id }}">
                    <div class="w-20 h-20 bg-gray-200 rounded-lg shrink-0 overflow-hidden">
                        <img src="{{ asset($details['image']) }}" alt="" class="w-full h-full object-cover" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="bg-black text-white text-[10px] font-bold px-2 py-0.5 rounded-full inline-block mb-1 uppercase">
                            {{ $details['category'] ?? 'ITEM' }}
                        </span>
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $details['name'] }}</p>
                        <p class="text-sm text-gray-400 mono">${{ number_format($details['price'], 2) }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="changeQuantity(this, -1)" class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-black transition-colors text-lg font-bold">-</button>
                        <input type="number" name="quantity" data-qty value="{{ $details['quantity'] }}" min="1" class="w-16 text-center font-mono text-sm border border-gray-200 rounded outline-none" onchange="changeQuantity(this, 0)">                        <button type="button" onclick="changeQuantity(this, 1)" class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-black transition-colors text-lg font-bold">+</button>
                    </div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="ml-2">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                          <img src="{{ asset('static/trash.svg') }}" class="w-5 h-5" alt="Remove" />
                      </button>
                  </form>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Your cart is empty.</p>
        @endif
        </div> 
        <div class="w-full md:w-80 md:shrink-0 bg-white border border-gray-200 rounded-xl p-6 md:sticky md:top-20">
          <h2 class="text-base font-extrabold mb-5">Order Summary</h2>

          <div class="flex justify-between text-sm mb-3">
            <span class="text-gray-500">Subtotal</span>
            <span class="font-semibold mono" id="subtotal">${{ number_format($subtotal ?? 0, 2) }}</span>          
          </div>
          <div class="flex justify-between text-sm mb-4">
            <span class="text-gray-500">Delivery</span>
            <span class="font-semibold mono">$9.99</span>
          </div>

          <div class="border-t border-gray-200 pt-4 mb-5">
            <div class="flex justify-between">
              <span class="font-extrabold text-base">Total</span>
              <span class="font-extrabold text-base mono" id="total">${{ number_format($total ?? 0, 2) }}</span>            
            </div>
          </div>
          <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden mb-5 focus-within:border-gray-400 transition-all bg-white ring-1 ring-transparent focus-within:ring-black">
              <input
                  type="text"
                  placeholder="Promo Code"
                  class="w-full pl-4 py-3 text-sm font-medium text-gray-700 outline-none bg-transparent placeholder:text-gray-400"
              />
              <button
                  type="button"
                  class="bg-black text-white font-bold text-sm h-full px-6 py-3 hover:bg-zinc-800 active:scale-95 transition-all shrink-0"
              >
                  Apply
              </button>
          </div>

          <a href="{{ route('checkout') }}" class="block w-full bg-black text-white text-sm font-bold text-center py-3 rounded-xl hover:opacity-60 transition-opacity mb-3">
            Proceed to Checkout
          </a>
          <a href="{{ route('catalog') }}" class="block text-center text-sm text-gray-400 hover:text-gray-900 transition-colors">
            <- Continue shopping
          </a>
        </div>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
