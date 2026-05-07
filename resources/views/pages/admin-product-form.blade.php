<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - {{ isset($product) ? 'Edit Product' : 'Add Product' }} | Electronic shop</title>
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
          <h1 class="text-xl font-bold">
              {{ isset($product) ? 'Edit Product' : 'Add New Product' }}
          </h1>
        </div>
      </header>

      <div class="p-8 flex-1 overflow-auto">
        <div class="max-w-3xl bg-white border border-gray-200 rounded-xl shadow-sm p-6 md:p-8">
          
          @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

          <form action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            
            @if(isset($product))
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                  >Product Name</label
                >
                <input
                  type="text"
                  name="name"
                  value="{{ old('name', $product->name ?? '') }}"
                  placeholder="e.g., iPhone 13"
                  class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-mono outline-none focus:border-black transition-colors"
                  required
                />
              </div>

              <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                  >Category</label
                >
                <select
                  name="category_id"
                  class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-semibold outline-none focus:border-black transition-colors appearance-none cursor-pointer"
                  required
                >
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                  >Price ($)</label
                >
                <input
                  type="number"
                  name="price"
                  value="{{ old('price', $product->price ?? '') }}"
                  step="0.01"
                  placeholder="995.00"
                  class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-mono outline-none focus:border-black transition-colors"
                  required
                />
              </div>
              
              <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                  >Brand</label
                >
                <input
                  type="text"
                  name="brand"
                  value="{{ old('brand', $product->brand ?? '') }}"
                  placeholder="e.g., Apple"
                  class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-mono outline-none focus:border-black transition-colors"
                />
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2"
                >Description</label
              >
              <textarea
                name="description"
                rows="4"
                placeholder="Product description..."
                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm font-mono outline-none focus:border-black transition-colors resize-none"
              >{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2">Main Image</label>
              
              @if(isset($product) && $product->primary_image)
                  <div class="mb-4">
                      <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                      <img src="{{ asset($product->primary_image) }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                  </div>
              @endif

              <label class="block border-2 border-dashed border-gray-200 rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer mb-4">
                <p id="fileName" class="text-sm font-semibold text-gray-500">
                  Click here to upload a new image
                </p>
                <input 
                    type="file" 
                    name="image" 
                    class="hidden" 
                    accept="image/*" 
                    onchange="document.getElementById('fileName').innerText = 'Selected: ' + this.files[0].name"
                />
              </label>
            </div>

            <div class="border-t border-gray-200 pt-6 flex justify-end gap-3 mt-2">
              <a
                href="{{ route('admin.products') }}"
                class="px-6 py-3 rounded-lg text-sm font-bold border border-gray-200 hover:bg-gray-50 transition-colors"
                >Cancel</a
              >
              <button
                type="submit"
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