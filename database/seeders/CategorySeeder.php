<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'description' => 'Produk elektronik dan perangkat digital'
            ],
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Kategori makanan dan minuman'
            ],
            [
                'name' => 'Pakaian',
                'description' => 'Produk pakaian dan fashion'
            ],
            [
                'name' => 'Perabotan',
                'description' => 'Furnitur dan perabotan rumah tangga'
            ],
            [
                'name' => 'Kecantikan',
                'description' => 'Produk perawatan dan kecantikan'
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
