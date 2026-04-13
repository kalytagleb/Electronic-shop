<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage; 

class ElectronicsSeeder extends Seeder
{
    public function run()
    {
        $phones = Category::firstOrCreate(['name' => 'Phones']);
        $laptops = Category::firstOrCreate(['name' => 'Laptops']);
        $monitors = Category::firstOrCreate(['name' => 'Monitors']);
        $audio = Category::firstOrCreate(['name' => 'Audio']);

        $productsData = [
            ['category_id' => $phones->id, 'name' => 'iPhone 15 Pro Max', 'brand' => 'Apple', 'color' => 'Titanium', 'price' => 1199.00, 'stock_quantity' => 15, 'description' => 'The ultimate iPhone with a titanium design, A17 Pro chip, and a more advanced Pro camera system.'],
            ['category_id' => $phones->id, 'name' => 'Samsung Galaxy S24 Ultra', 'brand' => 'Samsung', 'color' => 'Black', 'price' => 1299.00, 'stock_quantity' => 10, 'description' => 'Galaxy AI is here. Welcome to the era of mobile AI. With Galaxy S24 Ultra in your hands.'],
            ['category_id' => $phones->id, 'name' => 'Google Pixel 8 Pro', 'brand' => 'Google', 'color' => 'Blue', 'price' => 999.00, 'stock_quantity' => 20, 'description' => 'The most powerful Pixel yet. With Google Tensor G3 and pro-level cameras.'],
            
            ['category_id' => $laptops->id, 'name' => 'MacBook Pro 16" M3 Max', 'brand' => 'Apple', 'color' => 'Silver', 'price' => 3499.00, 'stock_quantity' => 5, 'description' => 'Mind-blowing performance. M3 Max brings massive power and capabilities for the most extreme workflows.'],
            ['category_id' => $laptops->id, 'name' => 'Dell XPS 15', 'brand' => 'Dell', 'color' => 'Silver', 'price' => 1899.99, 'stock_quantity' => 8, 'description' => '15.6" OLED display, Intel Core i7, 32GB RAM, 1TB SSD. The perfect balance of power and portability.'],
            ['category_id' => $laptops->id, 'name' => 'ASUS ROG Zephyrus G14', 'brand' => 'ASUS', 'color' => 'White', 'price' => 1599.50, 'stock_quantity' => 12, 'description' => 'Ultra-slim gaming laptop with AMD Ryzen 9 and NVIDIA RTX 4060.'],
            
            ['category_id' => $monitors->id, 'name' => 'LG UltraGear 27"', 'brand' => 'LG', 'color' => 'Black', 'price' => 399.99, 'stock_quantity' => 30, 'description' => '1440p resolution, 165Hz refresh rate, 1ms response time IPS display.'],
            ['category_id' => $monitors->id, 'name' => 'Dell UltraSharp 32" 4K', 'brand' => 'Dell', 'color' => 'Black', 'price' => 899.00, 'stock_quantity' => 7, 'description' => 'Experience brilliant color and sharp details on this 32-inch 4K hub monitor.'],
            
            ['category_id' => $audio->id, 'name' => 'Sony WH-1000XM5', 'brand' => 'Sony', 'color' => 'Black', 'price' => 398.00, 'stock_quantity' => 25, 'description' => 'Industry-leading noise canceling headphones with Auto Noise Canceling Optimizer.'],
            ['category_id' => $audio->id, 'name' => 'AirPods Pro (2nd Gen)', 'brand' => 'Apple', 'color' => 'White', 'price' => 249.00, 'stock_quantity' => 50, 'description' => 'Richer audio experience, next-level Active Noise Cancellation, and Adaptive Transparency.'],
            ['category_id' => $audio->id, 'name' => 'Marshall Motif A.N.C.', 'brand' => 'Marshall', 'color' => 'Black', 'price' => 199.99, 'stock_quantity' => 14, 'description' => 'True wireless earbuds with active noise cancellation and iconic Marshall design.'],
        ];

        foreach ($productsData as $data) {
            $product = Product::create($data);

            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => 'images/default.jpg',
                'is_primary' => true
            ]);
            
        }

        $this->command->info('Electronics added successfully!');
    }
}