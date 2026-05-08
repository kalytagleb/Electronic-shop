<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Products | Electronic shop</title>
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
        <h1 class="text-xl font-bold">Products</h1>
        <div class="flex items-center gap-4">
          <span class="text-sm font-semibold text-gray-500">Admin User</span>
         <form action="{{ route('logout') }}" method="POST" class="inline">
              @csrf
              <button type="submit" class="text-sm font-bold underline hover:opacity-60 transition-opacity">Log out</button>
          </form>
        </div>
      </header>

      <div class="p-8 flex-1 overflow-auto">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
          <div class="relative" id="searchWrapper">
            <input
              type="text"
              id="searchInput"
              value="{{ request('search') }}"
              placeholder="Search products..."
              class="bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm font-mono outline-none focus:border-black w-64 shadow-sm"
            />
          </div>
          <a
            href="{{ route('admin.product.create') }}"
            class="bg-black text-white text-sm font-bold px-5 py-2.5 rounded-lg hover:bg-gray-800 transition-colors flex items-center gap-2"
          >
            + Add New Product
          </a>
        </div>

        <div id="adminProductsTable" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr
                class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold"
              >
                <th class="p-4">Product</th>
                <th class="p-4">Category</th>
                <th class="p-4">Price</th>
                <th class="p-4 text-right">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
              @forelse($products as $product)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="p-4 flex items-center gap-3">
                  <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 shrink-0 flex items-center justify-center">
                    <img src="{{ asset($product->primary_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                  </div>
                  <span class="font-semibold text-gray-900">{{ $product->name }}</span>
                </td>
                <td class="p-4 font-semibold text-gray-500">{{ $product->category->name ?? 'N/A' }}</td>
                <td class="p-4 font-bold mono">${{ number_format($product->price, 2) }}</td>
                <td class="p-4 text-right">
                  <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="text-sm font-bold text-gray-400 hover:text-black transition-colors">Edit</a>
                    
                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 transition-colors" title="Delete">
                          <img src="{{ asset('static/trash.svg') }}" class="w-5 h-5" alt="Delete" />
                        </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="4" class="p-8 text-center text-gray-500 font-semibold">
                      No products found.
                  </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          
          @if(method_exists($products, 'links'))
            <div class="p-4 border-t border-gray-200">
                {{ $products->links() }}
            </div>
          @endif
        </div>
      </div>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>