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
        $phones       = Category::firstOrCreate(['name' => 'Phones']);
        $laptops      = Category::firstOrCreate(['name' => 'Laptops']);
        $monitors     = Category::firstOrCreate(['name' => 'Monitors']);
        $audio        = Category::firstOrCreate(['name' => 'Audio']);
        $accessories  = Category::firstOrCreate(['name' => 'Accessories']);

        $productsData = [
            // Phones
            [
                'product' => ['category_id' => $phones->id, 'name' => 'iPhone 15 Pro Max', 'brand' => 'Apple', 'color' => 'Titanium', 'price' => 1199.00, 'stock_quantity' => 15, 'description' => 'The ultimate iPhone with a titanium design, A17 Pro chip, and a more advanced Pro camera system.'],
                'images'  => ['images/iPhone14_pro.jpg', 'images/iPhone13.jpg'],
            ],
            [
                'product' => ['category_id' => $phones->id, 'name' => 'Samsung Galaxy S24 Ultra', 'brand' => 'Samsung', 'color' => 'Black', 'price' => 1299.00, 'stock_quantity' => 10, 'description' => 'Galaxy AI is here. Welcome to the era of mobile AI. With Galaxy S24 Ultra in your hands.'],
                'images'  => ['images/galaxy_s22_ultra.jpg', 'images/galaxy_z_flip_4.jpg'],
            ],
            [
                'product' => ['category_id' => $phones->id, 'name' => 'Google Pixel 8 Pro', 'brand' => 'Google', 'color' => 'Blue', 'price' => 999.00, 'stock_quantity' => 20, 'description' => 'The most powerful Pixel yet. With Google Tensor G3 and pro-level cameras.'],
                'images'  => ['images/iPhone12_pro.jpg', 'images/iPhone11_pro.jpg'],
            ],
            [
                'product' => ['category_id' => $phones->id, 'name' => 'Samsung Galaxy Z Flip 4', 'brand' => 'Samsung', 'color' => 'Purple', 'price' => 899.00, 'stock_quantity' => 18, 'description' => 'Compact and stylish foldable phone with Flex Mode and enhanced camera.'],
                'images'  => ['images/galaxy_z_flip_4.jpg', 'images/galaxy_s22_ultra.jpg'],
            ],
            [
                'product' => ['category_id' => $phones->id, 'name' => 'Samsung Galaxy Tab S8', 'brand' => 'Samsung', 'color' => 'Graphite', 'price' => 699.00, 'stock_quantity' => 12, 'description' => 'Powerful Android tablet with S Pen included, 11-inch display, and Snapdragon 8 Gen 1.'],
                'images'  => ['images/galaxy_tab_s8.jpg', 'images/galaxy_s22_ultra.jpg'],
            ],
            [
                'product' => ['category_id' => $phones->id, 'name' => 'iPad Pro 11"', 'brand' => 'Apple', 'color' => 'Silver', 'price' => 799.00, 'stock_quantity' => 10, 'description' => 'Apple M2 chip, Liquid Retina display, and Thunderbolt connectivity.'],
                'images'  => ['images/ipad_pro_11.jpg', 'images/macbook_air_m2.jpg'],
            ],

            // Laptops
            [
                'product' => ['category_id' => $laptops->id, 'name' => 'MacBook Air M2', 'brand' => 'Apple', 'color' => 'Silver', 'price' => 1299.00, 'stock_quantity' => 5, 'description' => 'Supercharged by M2. Strikingly thin design, 18-hour battery life, and a stunning Liquid Retina display.'],
                'images'  => ['images/macbook_air_m2.jpg', 'images/ipad_pro_11.jpg'],
            ],
            [
                'product' => ['category_id' => $laptops->id, 'name' => 'MacBook Pro 16" M3 Max', 'brand' => 'Apple', 'color' => 'Space Black', 'price' => 3499.00, 'stock_quantity' => 3, 'description' => 'Mind-blowing performance. M3 Max brings massive power and capabilities for the most extreme workflows.'],
                'images'  => ['images/macbook_air_m2.jpg', 'images/ipad_pro_11.jpg'],
            ],
            [
                'product' => ['category_id' => $laptops->id, 'name' => 'HP EliteBook 840 G10', 'brand' => 'HP', 'color' => 'Silver', 'price' => 1149.00, 'stock_quantity' => 8, 'description' => 'Business-class laptop with Intel Core i7, 16GB RAM, and a stunning 14" display. Built for professionals.'],
                'images'  => ['images/hp_elitbook.jpg', 'images/laptop_thinkpad.jpg'],
            ],
            [
                'product' => ['category_id' => $laptops->id, 'name' => 'Lenovo ThinkPad X1 Carbon', 'brand' => 'Lenovo', 'color' => 'Black', 'price' => 1399.00, 'stock_quantity' => 6, 'description' => 'Ultra-light business laptop at just 1.12kg. Intel Core i7, 16GB RAM, military-grade durability.'],
                'images'  => ['images/laptop_thinkpad.jpg', 'images/hp_elitbook.jpg'],
            ],

            // Monitors
            [
                'product' => ['category_id' => $monitors->id, 'name' => 'ASUS TUF Gaming 27"', 'brand' => 'ASUS', 'color' => 'Black', 'price' => 349.99, 'stock_quantity' => 20, 'description' => '1440p IPS, 165Hz, 1ms response time. Built for serious gaming sessions.'],
                'images'  => ['images/asus_tuf_monitor.jpg', 'images/odyssey_g7.jpg'],
            ],
            [
                'product' => ['category_id' => $monitors->id, 'name' => 'Samsung Odyssey G7 32"', 'brand' => 'Samsung', 'color' => 'Black', 'price' => 699.00, 'stock_quantity' => 7, 'description' => '4K 144Hz curved gaming monitor with G-Sync and FreeSync Premium Pro.'],
                'images'  => ['images/odyssey_g7.jpg', 'images/asus_tuf_monitor.jpg'],
            ],

            // Audio
            [
                'product' => ['category_id' => $audio->id, 'name' => 'Sony WH-1000XM5', 'brand' => 'Sony', 'color' => 'Black', 'price' => 398.00, 'stock_quantity' => 25, 'description' => 'Industry-leading noise canceling headphones with Auto Noise Canceling Optimizer.'],
                'images'  => ['images/sony_wh1000xm5.jpg', 'images/airpods_pro.jpg'],
            ],
            [
                'product' => ['category_id' => $audio->id, 'name' => 'AirPods Pro (2nd Gen)', 'brand' => 'Apple', 'color' => 'White', 'price' => 249.00, 'stock_quantity' => 50, 'description' => 'Richer audio experience, next-level Active Noise Cancellation, and Adaptive Transparency.'],
                'images'  => ['images/airpods_pro.jpg', 'images/sony_wh1000xm5.jpg'],
            ],

            // Accessories
            [
                'product' => ['category_id' => $accessories->id, 'name' => 'Apple Watch Series 8', 'brand' => 'Apple', 'color' => 'Midnight', 'price' => 399.00, 'stock_quantity' => 30, 'description' => 'Advanced health sensors, crash detection, and temperature sensing. The most capable Apple Watch yet.'],
                'images'  => ['images/watch_series_8.jpg', 'images/accessories.webp'],
            ],
            [
                'product' => ['category_id' => $accessories->id, 'name' => 'Keychron K2 Mechanical Keyboard', 'brand' => 'Keychron', 'color' => 'Black', 'price' => 89.00, 'stock_quantity' => 40, 'description' => 'Compact 75% wireless mechanical keyboard with Bluetooth 5.1, RGB backlight, and hot-swappable switches.'],
                'images'  => ['images/keyboard_mechanic.jpg', 'images/accessories.webp'],
            ],
            [
                'product' => ['category_id' => $accessories->id, 'name' => 'Logitech MX Master 3S', 'brand' => 'Logitech', 'color' => 'Black', 'price' => 99.00, 'stock_quantity' => 35, 'description' => 'Advanced wireless mouse with ultra-fast MagSpeed scrolling, 8K DPI, and ergonomic design for all-day comfort.'],
                'images'  => ['images/mouse_logitech.jpg', 'images/accessories.webp'],
            ],
            [
                'product' => ['category_id' => $accessories->id, 'name' => 'HP Wireless Mouse 200', 'brand' => 'HP', 'color' => 'Black', 'price' => 29.00, 'stock_quantity' => 60, 'description' => 'Reliable wireless mouse with 2.4GHz connectivity, 1600 DPI, and 12-month battery life.'],
                'images'  => ['images/mouse_hp.jpg', 'images/accessories.webp'],
            ],
            [
                'product' => ['category_id' => $accessories->id, 'name' => 'USB-C Hub 7-in-1', 'brand' => 'Anker', 'color' => 'Silver', 'price' => 49.00, 'stock_quantity' => 45, 'description' => '7-in-1 USB-C hub with 4K HDMI, 100W Power Delivery, 3x USB-A, SD and microSD card readers.'],
                'images'  => ['images/usbc.jpg', 'images/accessories.webp'],
            ],
        ];

        foreach ($productsData as $entry) {
            $product = Product::create($entry['product']);

            foreach ($entry['images'] as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url'  => $imageUrl,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        $this->command->info('Electronics added successfully!');
    }
}