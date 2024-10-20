<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'create posts']);

        // Assign permissions to roles
        $role = Role::findByName('admin');
        $role->givePermissionTo(['manage users', 'create posts']);
    }
}
