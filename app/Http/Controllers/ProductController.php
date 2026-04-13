<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['images', 'category']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('brand')) {
            $query->whereIn('brand', (array) $request->brand);
        }

        if ($request->filled('color')) {
            $query->whereIn('color', (array) $request->color);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        } else {
            $query->latest(); 
        }

        $products = $query->paginate(9)->withQueryString();

        $categories = Category::all();
        $brands = Product::select('brand')->distinct()->whereNotNull('brand')->pluck('brand');
        $colors = Product::select('color')->distinct()->whereNotNull('color')->pluck('color');

        return view('pages.catalog', compact('products', 'categories', 'brands', 'colors'));
    }
    public function show($id)
    {
        $product = \App\Models\Product::with('category', 'images')->findOrFail($id);

        return view('pages.product', compact('product'));
    }
}