<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $flatModels = null;
        static $currentIndex = 0;

        if ($flatModels === null) {
            $models = [
                'Apple' => [
                    ['name' => 'iPhone 13', 'cat' => 'Phones'],
                    ['name' => 'iPhone 14 Pro', 'cat' => 'Phones'],
                    ['name' => 'MacBook Air M2', 'cat' => 'Laptops'],
                    ['name' => 'iPad Pro 11', 'cat' => 'Laptops'], 
                    ['name' => 'AirPods Pro', 'cat' => 'Audio'],
                    ['name' => 'Watch Series 8', 'cat' => 'Phones'],
                ],
                'Samsung' => [
                    ['name' => 'Galaxy S22 Ultra', 'cat' => 'Phones'],
                    ['name' => 'Galaxy Z Flip 4', 'cat' => 'Phones'],
                    ['name' => 'Galaxy Tab S8', 'cat' => 'Laptops'],
                    ['name' => 'Odyssey G7 Monitor', 'cat' => 'Monitors'],
                    ['name' => 'Watch 5 Pro', 'cat' => 'Phones'],
                ],
                'Sony' => [
                    ['name' => 'PlayStation 5', 'cat' => 'Monitors'], 
                    ['name' => 'WH-1000XM5 Headphones', 'cat' => 'Audio'],
                    ['name' => 'Bravia XR Smart TV', 'cat' => 'Monitors'],
                    ['name' => 'Alpha a7 IV Camera', 'cat' => 'Phones'], 
                ],
                'Dell' => [
                    ['name' => 'XPS 15 Laptop', 'cat' => 'Laptops'],
                    ['name' => 'Alienware Aurora R13', 'cat' => 'Laptops'],
                    ['name' => 'UltraSharp 27 Monitor', 'cat' => 'Monitors'],
                    ['name' => 'Inspiron 16', 'cat' => 'Laptops'],
                ],
                'Asus' => [
                    ['name' => 'ROG Zephyrus G14', 'cat' => 'Laptops'],
                    ['name' => 'ZenBook 14 OLED', 'cat' => 'Laptops'],
                    ['name' => 'TUF Gaming Monitor', 'cat' => 'Monitors'],
                    ['name' => 'ROG Phone 6', 'cat' => 'Phones']
                ]
            ];

            $flatModels = [];
            $colors = ['Black', 'White', 'Silver', 'Space Grey', 'Blue'];
            
            foreach ($models as $brand => $products) {
                foreach ($products as $product) {
                    $product['brand'] = $brand;
                    $product['color'] = $colors[count($flatModels) % count($colors)];
                    $flatModels[] = $product;
                }
            }
        }

        $productInfo = $flatModels[$currentIndex % count($flatModels)];
        $currentIndex++;

        $categoryName = $productInfo['cat'];
        $category = \App\Models\Category::firstOrCreate(['name' => $categoryName]);

        return [
            'category_id' => $category->id,
            'name' => "{$productInfo['brand']} {$productInfo['name']} {$productInfo['color']}", 
            'description' => fake()->realText(150),
            'price' => fake()->randomElement([199.99, 299.00, 499.50, 899.00, 1199.00, 1499.99]),
            'stock_quantity' => fake()->numberBetween(5, 50),
            'brand' => $productInfo['brand'],
            'color' => $productInfo['color'],
        ];
    }
    public function configure(): static
    {
        return $this->afterCreating(function (\App\Models\Product $product) {
            
            $imageUrl = 'images/placeholder.jpg'; 
            $name = $product->name;

            if (str_contains($name, 'iPhone 13')) {
                $imageUrl = 'images/iPhone13.jpg'; 
            } elseif (str_contains($name, 'iPhone 14 Pro')) {
                $imageUrl = 'images/iPhone14_pro.jpg'; 
            } elseif (str_contains($name, 'MacBook Air M2')) {
                $imageUrl = 'images/macbook_air_m2.jpg';
            } elseif (str_contains($name, 'iPad Pro 11')) {
                $imageUrl = 'images/ipad_pro_11.jpg';
            } elseif (str_contains($name, 'AirPods Pro')) {
                $imageUrl = 'images/airpods_pro.jpg';
            } elseif (str_contains($name, 'Watch Series 8')) {
                $imageUrl = 'images/watch_series_8.jpg';
            }
            
            elseif (str_contains($name, 'Galaxy S22 Ultra')) {
                $imageUrl = 'images/galaxy_s22_ultra.jpg';
            } elseif (str_contains($name, 'Galaxy Z Flip 4')) {
                $imageUrl = 'images/galaxy_z_flip_4.jpg';
            } elseif (str_contains($name, 'Galaxy Tab S8')) {
                $imageUrl = 'images/galaxy_tab_s8.jpg';
            } elseif (str_contains($name, 'Odyssey G7 Monitor')) {
                $imageUrl = 'images/odyssey_g7.jpg';
            } elseif (str_contains($name, 'Watch 5 Pro')) {
                $imageUrl = 'images/watch_5_pro.jpg';
            }
            
            elseif (str_contains($name, 'PlayStation 5')) {
                $imageUrl = 'images/ps5.jpg';
            } elseif (str_contains($name, 'WH-1000XM5')) {
                $imageUrl = 'images/sony_wh1000xm5.jpg';
            } elseif (str_contains($name, 'Bravia XR')) {
                $imageUrl = 'images/sony_bravia.jpg';
            } elseif (str_contains($name, 'Alpha a7 IV')) {
                $imageUrl = 'images/sony_alpha_a7.jpg';
            }
            
            elseif (str_contains($name, 'XPS 15')) {
                $imageUrl = 'images/dell_xps_15.jpg';
            } elseif (str_contains($name, 'Alienware Aurora R13')) {
                $imageUrl = 'images/alienware_aurora.jpg';
            } elseif (str_contains($name, 'UltraSharp 27')) {
                $imageUrl = 'images/dell_ultrasharp.jpg';
            } elseif (str_contains($name, 'Inspiron 16')) {
                $imageUrl = 'images/dell_inspiron.jpg';
            }
            
            elseif (str_contains($name, 'ROG Zephyrus G14')) {
                $imageUrl = 'images/asus_rog_zephyrus.jpg';
            } elseif (str_contains($name, 'ZenBook 14 OLED')) {
                $imageUrl = 'images/asus_zenbook.jpg';
            } elseif (str_contains($name, 'TUF Gaming Monitor')) {
                $imageUrl = 'images/asus_tuf_monitor.jpg';
            } elseif (str_contains($name, 'ROG Phone 6')) {
                $imageUrl = 'images/asus_rog_phone.jpg';
            }

            \App\Models\ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $imageUrl,
                'is_primary' => true
            ]);
        });
    }
}
