<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $delivery = 9.99;
        $total = $subtotal > 0 ? $subtotal + $delivery : 0;

        return view('pages.cart', compact('subtotal', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $quantity = $request->input('quantity', 1); 
        
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $image = $product->images()->where('is_primary', true)->first();
            
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $image ? $image->image_url : 'images/default.jpg',
                "category" => $product->category->name ?? 'PRODUCT' 
            ];
        }

        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'cart_count' => count($cart)
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}