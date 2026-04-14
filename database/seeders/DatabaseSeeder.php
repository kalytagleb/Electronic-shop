<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $phonesCategory = Category::create(['name' => 'Phones']);
        Category::create(['name' => 'Laptops']);
        Category::create(['name' => 'Monitors']);

        $product1 = Product::create([
            'category_id' => $phonesCategory->id,
            'name' => 'iPhone 14 Pro 256 GB',
            'description' => '',
            'price' => 995.00,
            'stock_quantity' => 15,
            'brand' => 'Apple',
            'color' => 'Space Black'
        ]);

        ProductImage::create([
            'product_id' => $product1->id,
            'image_url' => 'images/iPhone14_pro.jpg',
            'is_primary' => true
        ]);

        $product2 = Product::create([
            'category_id' => $phonesCategory->id,
            'name' => 'iPhone 13 128GB Gold',
            'description' => '',
            'price' => 380.00,
            'stock_quantity' => 5,
            'brand' => 'Apple',
            'color' => 'Gold'
        ]);

        ProductImage::create([
            'product_id' => $product2->id,
            'image_url' => 'images/iPhone13.jpg',
            'is_primary' => true
        ]);
        Product::factory(23)->create();
    }
}