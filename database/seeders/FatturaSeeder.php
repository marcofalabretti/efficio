<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fattura;
use App\Models\FatturaRiga;
use App\Models\Customer;
use App\Models\Commessa;
use App\Models\Preventivo;
use App\Models\Project;
use App\Models\User;

class FatturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ottieni alcuni utenti e clienti esistenti
        $customers = Customer::all();
        $commesse = Commessa::all();
        $preventivi = Preventivo::all();
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

        if ($preventivi->isEmpty()) {
            $this->command->info('Nessun preventivo trovato. Eseguire prima PreventivoSeeder.');
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

        $stati = ['bozza', 'inviata', 'pagata', 'scaduta', 'annullata'];
        $metodiPagamento = ['bonifico', 'assegno', 'carta', 'contanti'];

        foreach ($customers as $customer) {
            // Crea 1-2 fatture per ogni cliente
            $numFatture = rand(1, 2);
            
            for ($i = 0; $i < $numFatture; $i++) {
                $commesseCliente = $commesse->where('customer_id', $customer->id);
                $commessa = $commesseCliente->isNotEmpty() ? $commesseCliente->random() : null;
                $preventivo = $preventivi->where('customer_id', $customer->id)->where('stato', 'accettato')->first();
                $project = $projects->where('customer_id', $customer->id)->first();
                $stato = $stati[array_rand($stati)];
                
                $fattura = Fattura::create([
                    'numero' => 'FAT-' . str_pad($customer->id, 3, '0', STR_PAD_LEFT) . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                    'data' => now()->subDays(rand(1, 30)),
                    'data_scadenza' => now()->addDays(rand(15, 60)),
                    'stato' => $stato,
                    'importo_totale' => 0,
                    'importo_iva' => 0,
                    'importo_netto' => 0,
                    'note' => 'Note per la fattura ' . ($i + 1),
                    'customer_id' => $customer->id,
                    'commessa_id' => $commessa ? $commessa->id : null,
                    'preventivo_id' => $preventivo ? $preventivo->id : null,
                    'project_id' => $project ? $project->id : null,
                    'created_by' => $users->random()->id,
                    'data_pagamento' => $stato === 'pagata' ? now()->subDays(rand(1, 15)) : null,
                    'importo_pagato' => $stato === 'pagata' ? 0 : 0, // Sarà aggiornato dopo
                    'metodo_pagamento' => $stato === 'pagata' ? $metodiPagamento[array_rand($metodiPagamento)] : null,
                ]);

                // Crea alcune righe per la fattura
                $this->createFatturaRighe($fattura, $preventivo);
                
                // Aggiorna gli importi totali
                $this->updateFatturaTotali($fattura);
            }
        }

        $this->command->info('Fatture create con successo!');
    }

    private function createFatturaRighe(Fattura $fattura, ?Preventivo $preventivo): void
    {
        if ($preventivo) {
            // Se c'è un preventivo, copia le righe
            foreach ($preventivo->righe as $rigaPreventivo) {
                FatturaRiga::create([
                    'fattura_id' => $fattura->id,
                    'descrizione' => $rigaPreventivo->descrizione,
                    'quantita' => $rigaPreventivo->quantita,
                    'prezzo_unitario' => $rigaPreventivo->prezzo_unitario,
                    'sconto_percentuale' => $rigaPreventivo->sconto_percentuale,
                    'importo_totale' => $rigaPreventivo->importo_totale,
                    'note' => $rigaPreventivo->note,
                    'ordinamento' => $rigaPreventivo->ordinamento,
                ]);
            }
        } else {
            // Altrimenti crea righe casuali
            $numRighe = rand(3, 8);
            
            for ($i = 0; $i < $numRighe; $i++) {
                $quantita = rand(1, 10);
                $prezzoUnitario = rand(50, 500);
                $sconto = rand(0, 20);
                $importoTotale = $quantita * $prezzoUnitario * (1 - $sconto / 100);

                FatturaRiga::create([
                    'fattura_id' => $fattura->id,
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
    }

    private function updateFatturaTotali(Fattura $fattura): void
    {
        $righe = $fattura->righe;
        $importoNetto = $righe->sum('importo_totale');
        $importoIva = $importoNetto * 0.22; // 22% IVA
        $importoTotale = $importoNetto + $importoIva;

        $fattura->update([
            'importo_netto' => $importoNetto,
            'importo_iva' => $importoIva,
            'importo_totale' => $importoTotale,
            'importo_pagato' => $fattura->stato === 'pagata' ? $importoTotale : 0,
        ]);
    }
}
