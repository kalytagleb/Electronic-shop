<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function create() {
        $categories = Category::all();
        return view('pages.admin-product-form', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'brand' => $data['brand'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            
            $product->images()->create([
                'image_url' => 'storage/' . $path,
                'is_primary' => true
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product successfully created!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        
        return view('pages.admin-product-form', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'brand' => $data['brand'] ?? $product->brand,
            'description' => $data['description'] ?? $product->description,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            
            $product->images()->update(['is_primary' => false]);
            
            $product->images()->create([
                'image_url' => 'storage/' . $path,
                'is_primary' => true
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }
}