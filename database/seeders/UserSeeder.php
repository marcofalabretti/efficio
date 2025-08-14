<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@email.it',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');

        $this->command->info('Admin user created successfully!');
        $this->command->info('Name: Admin');
        $this->command->info('Email: admin@email.it');
        $this->command->info('Password: admin');
    }
}
