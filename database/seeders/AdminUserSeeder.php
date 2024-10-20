<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if the admin user already exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'), // Set a default password
            ])->assignRole('admin'); // Assign admin role
        }
    }
}
