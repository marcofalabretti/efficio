<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Commessa;
use App\Models\Customer;
use App\Models\Project;
use App\Models\User;

class CommessaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ottieni alcuni utenti e clienti esistenti
        $customers = Customer::all();
        $projects = Project::all();
        $users = User::all();

        if ($customers->isEmpty()) {
            $this->command->info('Nessun cliente trovato. Eseguire prima CustomerSeeder.');
            return;
        }

        if ($projects->isEmpty()) {
            $this->command->info('Nessun progetto trovato. Eseguire prima ProjectSeeder.');
            return;
        }

        if ($users->isEmpty()) {
            $this->command->info('Nessun utente trovato. Eseguire prima UserSeeder.');
            return;
        }

        $stati = ['attiva', 'completata', 'sospesa', 'annullata'];

        foreach ($customers as $customer) {
            // Crea 2-4 commesse per ogni cliente
            $numCommesse = rand(2, 4);
            
            for ($i = 0; $i < $numCommesse; $i++) {
                $project = $projects->random();
                $stato = $stati[array_rand($stati)];
                
                Commessa::create([
                    'nome' => 'Commessa ' . ($i + 1) . ' - ' . $customer->name,
                    'descrizione' => 'Descrizione della commessa ' . ($i + 1) . ' per il cliente ' . $customer->name,
                    'stato' => $stato,
                    'data_inizio' => now()->subDays(rand(30, 180)),
                    'data_fine_prevista' => now()->addDays(rand(30, 90)),
                    'data_fine_effettiva' => $stato === 'completata' ? now()->subDays(rand(1, 30)) : null,
                    'budget' => rand(5000, 50000),
                    'ore_stimate' => rand(40, 200),
                    'ore_effettive' => $stato === 'completata' ? rand(40, 200) : null,
                    'note' => 'Note per la commessa ' . ($i + 1),
                    'customer_id' => $customer->id,
                    'project_id' => $project->id,
                    'responsabile_id' => $users->random()->id,
                    'created_by' => $users->random()->id,
                ]);
            }
        }

        $this->command->info('Commesse create con successo!');
    }
}
