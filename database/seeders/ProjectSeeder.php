<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Sviluppo Web',
                'description' => 'Progetto per lo sviluppo di applicazioni web moderne e responsive',
                'status' => 'attivo',
                'start_date' => now()->subMonths(6),
                'due_date' => now()->addMonths(3),
                'budget' => 25000,
                'priority' => 'media',
                'progress' => 60,
                'customer_id' => 1,
                'manager_id' => 1,
                'created_by' => 1,
            ],
            [
                'name' => 'App Mobile',
                'description' => 'Sviluppo di applicazioni mobile per iOS e Android',
                'status' => 'attivo',
                'start_date' => now()->subMonths(4),
                'due_date' => now()->addMonths(5),
                'budget' => 30000,
                'priority' => 'alta',
                'progress' => 40,
                'customer_id' => 2,
                'manager_id' => 1,
                'created_by' => 1,
            ],
            [
                'name' => 'E-commerce',
                'description' => 'Piattaforma di e-commerce completa con gestione ordini e pagamenti',
                'status' => 'attivo',
                'start_date' => now()->subMonths(2),
                'due_date' => now()->addMonths(4),
                'budget' => 20000,
                'priority' => 'media',
                'progress' => 25,
                'customer_id' => 3,
                'manager_id' => 1,
                'created_by' => 1,
            ],
            [
                'name' => 'CRM Aziendale',
                'description' => 'Sistema di gestione delle relazioni con i clienti',
                'status' => 'attivo',
                'start_date' => now()->subMonths(1),
                'due_date' => now()->addMonths(6),
                'budget' => 35000,
                'priority' => 'alta',
                'progress' => 15,
                'customer_id' => 4,
                'manager_id' => 1,
                'created_by' => 1,
            ],
            [
                'name' => 'Dashboard Analytics',
                'description' => 'Dashboard per l\'analisi dei dati e reportistica',
                'status' => 'attivo',
                'start_date' => now()->subWeeks(2),
                'due_date' => now()->addMonths(2),
                'budget' => 15000,
                'priority' => 'bassa',
                'progress' => 80,
                'customer_id' => 5,
                'manager_id' => 1,
                'created_by' => 1,
            ]
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }

        $this->command->info('Progetti creati con successo!');
    }
}
