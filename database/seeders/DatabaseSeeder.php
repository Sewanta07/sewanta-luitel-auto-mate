<?php

namespace Database\Seeders;

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
        // Create default admin user
        \App\Models\Admin::updateOrCreate(
            [
                'email' => 'sewantaluitel@gmail.com',
            ],
            [
                'name' => 'Sewanta Luitel',
                'password' => bcrypt('Sewanta@1122'),
                'status' => 'active',
            ]
        );
    }
}
