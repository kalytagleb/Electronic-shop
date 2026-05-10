<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name'  => 'User',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('admin123'),
            'phone'      => '123456789',
            'role'       => 'admin',
        ]);

        $this->call(ElectronicsSeeder::class);
    }
}