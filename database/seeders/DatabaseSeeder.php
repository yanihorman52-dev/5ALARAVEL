<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@meowmart.com'],
            [
                'name' => 'Admin MeowMart',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Premium Cat Food'],
            [
                'category' => 'Makanan Kucing',
                'description' => 'Makanan premium dengan nutrisi lengkap untuk kesehatan dan bulu kucing.',
                'price' => 85000,
                'stock' => 20,
                'image' => null,
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Bola Benang Kucing'],
            [
                'category' => 'Mainan Kucing',
                'description' => 'Mainan bola benang untuk membuat kucing tetap aktif dan tidak mudah bosan.',
                'price' => 25000,
                'stock' => 15,
                'image' => null,
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Rumah Kucing Nyaman'],
            [
                'category' => 'Perlengkapan',
                'description' => 'Tempat istirahat yang nyaman dan hangat untuk kucing kesayangan.',
                'price' => 250000,
                'stock' => 8,
                'image' => null,
            ]
        );
    }
}