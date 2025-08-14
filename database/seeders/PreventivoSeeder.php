<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Preventivo;
use App\Models\PreventivoRiga;
use App\Models\Customer;
use App\Models\Commessa;
use App\Models\Project;
use App\Models\User;

class PreventivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ottieni alcuni utenti e clienti esistenti
        $customers = Customer::all();
        $commesse = Commessa::all();
        $projects = Project::all();
        $users = User::all();

        if ($customers->isEmpty()) {
            $this->command->info('Nessun cliente trovato. Eseguire prima CustomerSeeder.');
            return;
        }

        if ($commesse->isEmpty()) {
            $this->command->info('Nessuna commessa trovata. Eseguire prima CommessaSeeder.');
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

        $stati = ['bozza', 'inviato', 'accettato', 'rifiutato', 'scaduto'];

        foreach ($customers as $customer) {
            // Crea 1-3 preventivi per ogni cliente
            $numPreventivi = rand(1, 3);
            
            for ($i = 0; $i < $numPreventivi; $i++) {
                $commesseCliente = $commesse->where('customer_id', $customer->id);
                $commessa = $commesseCliente->isNotEmpty() ? $commesseCliente->random() : null;
                $project = $projects->where('customer_id', $customer->id)->first();
                $stato = $stati[array_rand($stati)];
                
                $preventivo = Preventivo::create([
                    'numero' => 'PRE-' . str_pad($customer->id, 3, '0', STR_PAD_LEFT) . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                    'data' => now()->subDays(rand(1, 30)),
                    'data_scadenza' => now()->addDays(rand(15, 60)),
                    'stato' => $stato,
                    'importo_totale' => 0,
                    'importo_iva' => 0,
                    'importo_netto' => 0,
                    'note' => 'Note per il preventivo ' . ($i + 1),
                    'customer_id' => $customer->id,
                    'commessa_id' => $commessa ? $commessa->id : null,
                    'project_id' => $project ? $project->id : null,
                    'created_by' => $users->random()->id,
                    'accettato_da' => $stato === 'accettato' ? $users->random()->id : null,
                    'data_accettazione' => $stato === 'accettato' ? now()->subDays(rand(1, 15)) : null,
                ]);

                // Crea alcune righe per il preventivo
                $this->createPreventivoRighe($preventivo);
                
                // Aggiorna gli importi totali
                $this->updatePreventivoTotali($preventivo);
            }
        }

        $this->command->info('Preventivi creati con successo!');
    }

    private function createPreventivoRighe(Preventivo $preventivo): void
    {
        $numRighe = rand(3, 8);
        
        for ($i = 0; $i < $numRighe; $i++) {
            $quantita = rand(1, 10);
            $prezzoUnitario = rand(50, 500);
            $sconto = rand(0, 20);
            $importoTotale = $quantita * $prezzoUnitario * (1 - $sconto / 100);

            PreventivoRiga::create([
                'preventivo_id' => $preventivo->id,
                'descrizione' => 'Servizio/Prodotto ' . ($i + 1),
                'quantita' => $quantita,
                'prezzo_unitario' => $prezzoUnitario,
                'sconto_percentuale' => $sconto,
                'importo_totale' => $importoTotale,
                'note' => 'Note per la riga ' . ($i + 1),
                'ordinamento' => $i + 1,
            ]);
        }
    }

    private function updatePreventivoTotali(Preventivo $preventivo): void
    {
        $righe = $preventivo->righe;
        $importoNetto = $righe->sum('importo_totale');
        $importoIva = $importoNetto * 0.22; // 22% IVA
        $importoTotale = $importoNetto + $importoIva;

        $preventivo->update([
            'importo_netto' => $importoNetto,
            'importo_iva' => $importoIva,
            'importo_totale' => $importoTotale,
        ]);
    }
}
