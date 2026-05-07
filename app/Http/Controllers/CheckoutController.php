<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\OrderItem; 

class CheckoutController extends Controller
{
    public function index()
    {
        if (empty(session('cart'))) {
            return redirect()->route('catalog')->with('error', 'Your cart is empty!');
        }

        return view('pages.checkout');
    }

    public function process(Request $request)
    {
        $cart = session('cart');
        if (empty($cart)) {
            return redirect()->route('catalog');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string',
            'address'    => 'required|string',
            'city'       => 'required|string',
            'zip_code'   => 'required|string',
            'delivery_method' => 'required|string',
            'payment_method'  => 'required|string',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $total = $subtotal > 0 ? $subtotal + 9.99 : 0; // 9.99 - доставка

        $order = Order::create(array_merge(
            $validated, 
            ['total_amount' => $total]
        ));
        
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }
        
        session()->forget('cart');

        return redirect()->route('order')->with('success', 'Your order has been placed successfully!');
    }
}
