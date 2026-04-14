<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images']);

        if ($request->filled('category_id')) {
            $query->whereIn('category_id', $request->category_id);
        }

        if ($request->filled('brand')) {
            $query->whereIn('brand', $request->brand);
        }

        if ($request->filled('color')) {
            $query->whereIn('color', $request->color);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm)
                  ->orWhere('brand', 'like', $searchTerm);
            });
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

        $brands = Product::whereNotNull('brand')->distinct()->pluck('brand');
        $colors = Product::whereNotNull('color')->distinct()->pluck('color');
        $categories = Category::all();

        return view('pages.catalog', compact('products', 'brands', 'colors', 'categories'));
    }
}