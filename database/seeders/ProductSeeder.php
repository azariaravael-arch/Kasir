<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Ayam Goreng',
                'sku' => 'AYG-001',
                'price' => 35000,
                'stock' => 50
            ],
            [
                'name' => 'Nasi Putih',
                'sku' => 'NSP-001',
                'price' => 8000,
                'stock' => 100
            ],
            [
                'name' => 'Teh Tawar',
                'sku' => 'TTW-001',
                'price' => 3000,
                'stock' => 200
            ],
            [
                'name' => 'Es Teh',
                'sku' => 'EST-001',
                'price' => 5000,
                'stock' => 150
            ],
            [
                'name' => 'Lumpia',
                'sku' => 'LMP-001',
                'price' => 10000,
                'stock' => 75
            ],
            [
                'name' => 'Perkedel',
                'sku' => 'PRK-001',
                'price' => 8000,
                'stock' => 60
            ],
            [
                'name' => 'Bakso',
                'sku' => 'BKS-001',
                'price' => 15000,
                'stock' => 40
            ],
            [
                'name' => 'Kopi',
                'sku' => 'KOP-001',
                'price' => 7000,
                'stock' => 120
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
