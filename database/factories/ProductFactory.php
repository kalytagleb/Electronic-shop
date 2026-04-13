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
        $brands = ['Apple', 'Samsung', 'Sony', 'Dell', 'Asus'];
        $brand = fake()->randomElement($brands);

        $models = [
            'Apple' => ['iPhone 13', 'iPhone 14 Pro', 'MacBook Air M2', 'iPad Pro 11', 'AirPods Pro', 'Watch Series 8'],
            'Samsung' => ['Galaxy S22 Ultra', 'Galaxy Z Flip 4', 'Galaxy Tab S8', 'Odyssey G7 Monitor', 'Watch 5 Pro'],
            'Sony' => ['PlayStation 5', 'WH-1000XM5 Headphones', 'Bravia XR Smart TV', 'Alpha a7 IV Camera'],
            'Dell' => ['XPS 15 Laptop', 'Alienware Aurora R13', 'UltraSharp 27 Monitor', 'Inspiron 16'],
            'Asus' => ['ROG Zephyrus G14', 'ZenBook 14 OLED', 'TUF Gaming Monitor', 'ROG Phone 6']
        ];

        $name = fake()->randomElement($models[$brand]);
        
        $color = fake()->randomElement(['Black', 'White', 'Silver', 'Space Grey', 'Blue']);

        return [
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? 1,
            'name' => "$brand $name $color", 
            'description' => fake()->realText(150),
            'price' => fake()->randomElement([199.99, 299.00, 499.50, 899.00, 1199.00, 1499.99]),
            'stock_quantity' => fake()->numberBetween(0, 50),
            'brand' => $brand,
            'color' => $color,
        ];
    }
}
