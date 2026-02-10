<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123',
                'city' => 'Jakarta',
                'postal_code' => '12345',
                'is_active' => true
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'phone' => '082345678901',
                'address' => 'Jl. Sudirman No. 456',
                'city' => 'Bandung',
                'postal_code' => '40123',
                'is_active' => true
            ],
            [
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'phone' => '083456789012',
                'address' => 'Jl. Diponegoro No. 789',
                'city' => 'Surabaya',
                'postal_code' => '60123',
                'is_active' => true
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'phone' => '084567890123',
                'address' => 'Jl. Ahmad Yani No. 321',
                'city' => 'Medan',
                'postal_code' => '20123',
                'is_active' => true
            ],
            [
                'name' => 'Rinto Harahap',
                'email' => null,
                'phone' => '085678901234',
                'address' => 'Jl. Gatot Subroto No. 654',
                'city' => 'Yogyakarta',
                'postal_code' => '55123',
                'is_active' => true
            ],
        ];

        foreach ($customers as $customer) {
            Customer::firstOrCreate(
                ['email' => $customer['email']],
                $customer
            );
        }
    }
}
