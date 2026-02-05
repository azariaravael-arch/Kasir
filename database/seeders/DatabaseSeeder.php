<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);

        // Create test kasir user
        User::factory()->create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
            'role' => 'kasir'
        ]);

        // Run product seeder
        $this->call(ProductSeeder::class);
    }
}

