<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View; 

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                \Illuminate\Support\Facades\View::share('globalCategories', \App\Models\Category::all());
            }
        } catch (\Exception $e) {}
    }
}