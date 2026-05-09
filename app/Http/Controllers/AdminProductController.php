<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'ilike', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);
        return view('pages.admin-products', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.admin-product-form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string',
            'description' => 'nullable|string',
            'images' => 'required|array|min:2',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'brand'       => $request->brand,
            'description' => $request->description,
        ]);

        foreach ($request->file('images') as $index => $file) {
            $path = $file->store('products', 'public');
            $product->images()->create([
                'image_url' => 'storage/' . $path,
                'is_primary' => $index === 0,
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product successfully created!');
    }

    public function edit($id)
    {
        $product    = Product::with('images')->findOrFail($id);
        $categories = Category::all();

        return view('pages.admin-product-form', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'brand' => $request->brand ?? $product->brand,
            'description' => $request->description ?? $product->description,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image_url' => 'storage/' . $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroyImage(int $productId, int $imageId)
    {
        $product = Product::findOrFail($productId);
        $image   = ProductImage::where('product_id', $productId)->findOrFail($imageId);

        Storage::disk('public')->delete(Str::after($image->image_url, 'storage/'));
        $wasPrimary = $image->is_primary;
        $image->delete();

        if ($wasPrimary) {
            $product->images()->first()?->update(['is_primary' => true]);
        }

        return redirect()->back()->with('success', 'Image deleted!');
    }

    public function setPrimaryImage(int $productId, int $imageId)
    {
        $product = Product::findOrFail($productId);
        $product->images()->update(['is_primary' => false]);
        $product->images()->where('id', $imageId)->update(['is_primary' => true]);

        return redirect()->back()->with('success', 'Primary image updated!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }
}
