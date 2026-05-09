<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Product::with(['category', 'images']);

        if ($request->filled('category_id')) {
            $baseQuery->whereIn('category_id', $request->category_id);
        }

        if ($request->filled('brand')) {
            $baseQuery->whereIn('brand', $request->brand);
        }

        if ($request->filled('color')) {
            $baseQuery->whereIn('color', $request->color);
        }

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $baseQuery->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm)
                  ->orWhere('brand', 'like', $searchTerm);
            });
        }

        $priceMin = (int) ((clone $baseQuery)->min('price') ?? 0);
        $priceMax = (int) ((clone $baseQuery)->max('price') ?? 0);

        $query = clone $baseQuery;

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
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

        $brands     = Product::whereNotNull('brand')->distinct()->pluck('brand');
        $colors     = Product::whereNotNull('color')->distinct()->pluck('color');
        $categories = Category::all();

        return view('pages.catalog', compact('products', 'brands', 'colors', 'categories', 'priceMin', 'priceMax'));
    }
}