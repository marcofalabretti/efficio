<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Prima crea i ruoli e permessi
        $this->call(RolePermissionSeeder::class);
        
        // Poi crea l'utente admin
        $this->call(UserSeeder::class);
        
        // Utente demo opzionale
        if (!User::where('email','test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
        
        // Seeder per i dati di esempio
        $this->call([
            CompanyIdentitySeeder::class,
            CustomerSeeder::class,
            ProjectSeeder::class,
            CommessaSeeder::class,
            PreventivoSeeder::class,
            FatturaSeeder::class,
            FornitoreSeeder::class,
        ]);
    }
}
