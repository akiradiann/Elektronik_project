<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Smartphone Galaxy S24',
            'description' => 'Flagship smartphone with AI features and AMOLED display.',
            'price' => 15000000,
            'stock' => 25,
        ]);

        \App\Models\Product::create([
            'name' => 'Laptop Pro 14',
            'description' => 'High performance laptop for professionals and creators.',
            'price' => 22000000,
            'stock' => 10,
        ]);

        \App\Models\Product::create([
            'name' => 'Wireless Earbuds X',
            'description' => 'Noise cancelling earbuds with long battery life.',
            'price' => 2500000,
            'stock' => 50,
        ]);

        \App\Models\Product::create([
            'name' => 'Smart TV 55 Inch',
            'description' => '4K Ultra HD Smart TV with HDR support.',
            'price' => 8500000,
            'stock' => 5,
        ]);

        \App\Models\Product::create([
            'name' => 'Mouse Gaming RGB',
            'description' => 'mouse gaming presisi tinggi',
            'price' => 450000,
            'stock' => 30,
        ]);

        \App\Models\Product::create([
            'name' => 'Keyboard Mechanical',
            'description' => 'keyboard switch biru nyaman mengetik',
            'price' => 950000,
            'stock' => 18,
        ]);

        \App\Models\Product::create([
            'name' => 'Power Bank 20000mAh',
            'description' => 'kapasitas besar fast charging',
            'price' => 375000,
            'stock' => 40,
        ]);

        \App\Models\Product::create([
            'name' => 'Kamera Mirrorless X5',
            'description' => 'kamera jernih untuk konten kreator',
            'price' => 12000000,
            'stock' => 7,
        ]);

        \App\Models\Product::create([
            'name' => 'Printer Inkjet Color',
            'description' => 'printer warna hemat tinta',
            'price' => 2200000,
            'stock' => 12,
        ]);

        \App\Models\Product::create([
            'name' => 'Router WiFi 6',
            'description' => 'koneksi cepat stabil untuk rumah',
            'price' => 1500000,
            'stock' => 20,
        ]);

        \App\Models\Product::create([
            'name' => 'Monitor LED 24 Inch',
            'description' => 'layar full HD cocok untuk kerja',
            'price' => 2800000,
            'stock' => 14,
        ]);
    }
}
