<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Ganti 'password123' dengan password sebenarnya
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'), // Ganti 'password123' dengan password sebenarnya
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
