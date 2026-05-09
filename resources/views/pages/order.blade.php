<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Confirmed - Electronic shop</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100 text-gray-900">
    @include('components.navbar')


    <main class="flex items-start justify-center px-4 py-8 min-h-[calc(100vh-64px)]">
      <div class="bg-white border border-gray-200 rounded-2xl w-full max-w-lg p-8">
        <div class="flex justify-center mb-4">
          <div class="w-14 h-14 bg-black rounded-full flex items-center justify-center">
            <img src="{{ asset('static/order.svg') }}" class="w-8 h-8" alt="" />
          </div>
        </div>

        <h1 class="text-2xl font-extrabold text-center mb-2">Order confirmed!</h1>
        <p class="text-sm text-gray-500 text-center mb-6">
          Thank you for your purchase. We have sent a confirmation<br />
          to <span class="font-semibold text-gray-900">gleb@gmail.com</span>
        </p>

        <div class="bg-gray-100 rounded-xl px-4 py-3 flex justify-between items-center mb-4">
          <span class="text-xs font-bold uppercase text-gray-500"> Order Number </span>
          <span class="text-sm font-bold mono">#ORD-2026-2203</span>
        </div>

        <div class="border border-gray-200 rounded-xl overflow-hidden mb-5">
          <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100">
            <span class="text-sm text-gray-500">Delivery</span>
            <span class="text-sm font-semibold">Courier . 1-3 days</span>
          </div>
          <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100">
            <span class="text-sm text-gray-500">Payment</span>
            <span class="text-sm font-semibold">Card</span>
          </div>
          <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100">
            <span class="text-sm text-gray-500">Address</span>
            <span class="text-sm font-semibold">Nevskiy 12, St. Petersburg</span>
          </div>
          <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100">
            <span class="text-sm text-gray-500">Total paid</span>
            <span class="text-sm font-semibold">$575.99</span>
          </div>
        </div>

        <p class="text-xs font-bold uppercase text-gray-400 mb-3">Items Ordered</p>
        <div class="flex flex-col gap-2 mb-6">
          <div class="bg-gray-100 rounded-xl px-3 py-2.5 flex items-center gap-3">
            <div
              class="w-10 h-10 bg-white rounded-lg shrink-0 overflow-hidden border border-gray-200"
            >
              <img src="{{ asset('images/iPhone14_pro.jpg') }}" alt="" class="w-full h-full object-cover" />
            </div>
            <span class="flex-1 text-sm font-semibold truncate">iPhone 14 Pro</span>
            <span class="text-xs text-gray-400 mr-3">x1</span>
            <span class="text-sm font-bold mono">$299.00</span>
          </div>

          <div class="bg-gray-100 rounded-xl px-3 py-2.5 flex items-center gap-3">
            <div
              class="w-10 h-10 bg-white rounded-lg shrink-0 overflow-hidden border border-gray-200"
            >
              <img src="{{ asset('images/iPhone13.jpg') }}" alt="" class="w-full h-full object-cover" />
            </div>
            <span class="flex-1 text-sm font-semibold truncate">iPhone 13</span>
            <span class="text-xs text-gray-400 mr-3">x1</span>
            <span class="text-sm font-bold mono">$129.00</span>
          </div>

          <div class="bg-gray-100 rounded-xl px-3 py-2.5 flex items-center gap-3">
            <div
              class="w-10 h-10 bg-white rounded-lg shrink-0 overflow-hidden border border-gray-200"
            >
              <img src="{{ asset('images/iPhone12_pro.jpg') }}" alt="" class="w-full h-full object-cover" />
            </div>
            <span class="flex-1 text-sm font-semibold truncate">iPhone 12 Pro</span>
            <span class="text-xs text-gray-400 mr-3">x1</span>
            <span class="text-sm font-bold mono">$89.00</span>
          </div>
        </div>

        <a
          href="{{ route('home') }}"
          class="block w-full bg-black text-white text-sm font-bold text-center py-3.5 rounded-xl hover:opacity-80 transition-opacity mb-3"
        >
          Back to Home
        </a>
        <a
          href="#"
          class="block w-full border border-gray-200 text-sm font-bold text-center py-3.5 rounded-xl hover:border-gray-900 transition-colors"
        >
          View my orders
        </a>
      </div>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
