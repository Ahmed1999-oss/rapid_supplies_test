<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Call the AdminUserSeeder to create an admin user
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminUserSeeder::class);
        
        // Call the BookSeeder to populate the books table
        $this->call(BookSeeder::class);
    }

}
