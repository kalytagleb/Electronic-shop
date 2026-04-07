<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/catalog', function () {
    return view('pages.catalog');
})->name('catalog');

Route::get('/product/{id}', function () {
    return view('pages.product');
})->name('product');

Route::get('/best-deals', function () {
    return view('pages.best-deals');
})->name('best-deals');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');

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
