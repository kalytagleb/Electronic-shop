<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CatalogController;

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

Route::get('/admin/products', function () {
    return view('pages.admin-products');
})->name('admin.products');

Route::get('/admin/products/form', function () {
    return view('pages.admin-product-form');
})->name('admin.product.form');
