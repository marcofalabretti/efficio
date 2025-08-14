<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Base permissions
        $permissions = [
            'view sales',
            'view reporting',
            'manage users',
        ];
        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $sales = Role::firstOrCreate(['name' => 'sales']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $admin->syncPermissions($permissions);
        $manager->syncPermissions(['view reporting']);
        $sales->syncPermissions(['view sales']);
        $user->syncPermissions([]);

        // Promote first user to admin if exists
        if ($first = User::orderBy('id')->first()) {
            $first->assignRole('admin');
        }
    }
}


