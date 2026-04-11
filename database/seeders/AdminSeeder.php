<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            [ 'email' => 'sewantaluitel@gmail.com' ],
            [
                'name' => 'Admin',
                'email' => 'sewantaluitel@gmail.com',
                'password' => Hash::make('Sewanta@1122'),
                'status' => 'active',
                'phone' => '9742869500',
                'current_address' => 'Itahari',
            ]
        );
    }
}
