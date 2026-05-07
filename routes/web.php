<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product');

Route::get('/best-deals', function () {
    return view('pages.best-deals');
})->name('best-deals');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/order', function () {
    return view('pages.order');
})->name('order');

Route::get('/contacts', function () {
    return view('pages.contacts');
})->name('contacts');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.products');
        }

        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
})->name('login.post');

Route::post('/logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('product.update');
    Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('product.destroy');
});