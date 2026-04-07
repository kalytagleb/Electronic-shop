<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Edit Product | Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
  </head>
  <body class="bg-gray-50 text-gray-900 flex min-h-screen">
    <aside
      class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex sticky top-0 h-screen"
    >
      <div class="h-16 flex items-center px-8 border-b border-gray-200">
        <span class="font-extrabold text-lg tracking-tight">Admin Panel</span>
      </div>
      <nav class="flex-1 p-4 flex flex-col gap-2">
        <a
          href="{{ route('admin.products') }}"
          class="px-4 py-2.5 text-sm font-semibold rounded-lg bg-black text-white pointer-events-none"
          >Products</a
        >
      </nav>
      <div class="p-4 border-t border-gray-200">
        <a
          href="{{ route('home') }}"
          class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-500 hover:text-black transition-colors"
        >
          Back to Store
        </a>
      </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0">
      <header
        class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 sticky top-0 z-10"
      >
        <div class="flex items-center gap-4">
          <a
            href="{{ route('admin.products') }}"
            class="text-sm font-bold text-gray-400 hover:text-black transition-colors"
            >Back</a
          >
          <h1 class="text-xl font-bold">Add / Edit Product</h1>
        </div>
      </header>

      <div class="p-8 flex-1 overflow-auto">
        <div class="max-w-3xl bg-white border border-gray-200 rounded-xl shadow-sm p-6 md:p-8">
          <form action="{{ route('admin.products') }}" class="flex flex-col gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                  >Product Name</label
                >
                <input
                  type="text"
                  value="iPhone 14 Pro 256GB"
                  placeholder="e.g., iPhone 13"
                  class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-mono outline-none focus:border-black transition-colors"
                />
              </div>

              <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                  >Category</label
                >
                <select
                  class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-semibold outline-none focus:border-black transition-colors appearance-none cursor-pointer"
                >
                  <option>Phones</option>
                  <option>Laptops</option>
                  <option>Monitors</option>
                  <option>Audio</option>
                  <option>Accessories</option>
                </select>
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                >Price ($)</label
              >
              <input
                type="number"
                value="995.00"
                step="0.01"
                class="w-1/2 bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-mono outline-none focus:border-black transition-colors"
              />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                >Description</label
              >
              <textarea
                rows="4"
                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-mono outline-none focus:border-black transition-colors resize-none"
              >
The ultimate iPhone features an Always-On display, the first-ever 48MP camera on iPhone, Crash Detection, Emergency SOS via satellite, and an innovative new way to receive notifications and activities with the Dynamic Island.</textarea
              >
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                >Images (Min 2)</label
              >
              <div
                class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer mb-4"
              >
                <p class="text-sm font-semibold text-gray-500">
                  Click to upload or drag and drop files
                </p>
                <input type="file" multiple class="hidden" />
              </div>

              <div class="flex gap-4">
                <div
                  class="relative w-24 h-24 border border-gray-200 rounded-lg overflow-hidden group"
                >
                  <img src="{{ asset('images/iPhone14_pro.jpg') }}" class="w-full h-full object-cover" alt="" />
                  <button
                    type="button"
                    class="absolute top-1 right-1 bg-white border border-gray-200 rounded-md w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:border-red-400 hover:text-red-500"
                  >
                    <span class="text-xs font-bold">X</span>
                  </button>
                </div>
                <div
                  class="relative w-24 h-24 border border-gray-200 rounded-lg overflow-hidden group"
                >
                  <img src="{{ asset('images/iPhone13.jpg') }}" class="w-full h-full object-cover" alt="" />
                  <button
                    type="button"
                    class="absolute top-1 right-1 bg-white border border-gray-200 rounded-md w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:border-red-400 hover:text-red-500"
                  >
                    <span class="text-xs font-bold">X</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="border-t border-gray-200 pt-6 flex justify-end gap-3 mt-2">
              <a
                href="{{ route('admin.products') }}"
                class="px-6 py-3 rounded-lg text-sm font-bold border border-gray-200 hover:bg-gray-50 transition-colors"
                >Cancel</a
              >
              <button
                type="button"
                class="px-8 py-3 rounded-lg text-sm font-bold bg-black text-white hover:bg-gray-800 transition-colors"
              >
                Save Product
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>
