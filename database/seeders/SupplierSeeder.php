<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT. Maju Jaya',
                'contact_person' => 'Budi Santoso',
                'phone' => '081234567890',
                'email' => 'budi@majujaya.com',
                'city' => 'Jakarta',
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'is_active' => true
            ],
            [
                'name' => 'CV. Bintang Terang',
                'contact_person' => 'Siti Nurhaliza',
                'phone' => '082345678901',
                'email' => 'siti@bintangterang.com',
                'city' => 'Surabaya',
                'address' => 'Jl. Ahmad Yani No. 456, Surabaya',
                'is_active' => true
            ],
            [
                'name' => 'PT. Global Supplier',
                'contact_person' => 'Rinto Harahap',
                'phone' => '083456789012',
                'email' => 'rinto@globalsupplier.com',
                'city' => 'Bandung',
                'address' => 'Jl. Gatot Subroto No. 789, Bandung',
                'is_active' => true
            ],
            [
                'name' => 'UD. Sentosa Makmur',
                'contact_person' => 'Dewi Lestari',
                'phone' => '084567890123',
                'email' => 'dewi@sentosamakmur.com',
                'city' => 'Medan',
                'address' => 'Jl. Pemuda No. 321, Medan',
                'is_active' => true
            ],
            [
                'name' => 'PT. Elektronik Modern',
                'contact_person' => 'Ahmad Wijaya',
                'phone' => '085678901234',
                'email' => 'ahmad@elektronikmodern.com',
                'city' => 'Yogyakarta',
                'address' => 'Jl. Malioboro No. 654, Yogyakarta',
                'is_active' => true
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
