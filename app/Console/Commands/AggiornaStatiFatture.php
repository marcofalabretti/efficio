<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fattura;

class AggiornaStatiFatture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fatture:aggiorna-stati {--dry-run : Mostra solo le modifiche senza applicarle}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiorna automaticamente lo stato di tutte le fatture basandosi sui pagamenti';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fatture = Fattura::with('pagamenti')->get();
        $dryRun = $this->option('dry-run');
        
        $this->info("Analizzando {$fatture->count()} fatture...");
        
        $aggiornate = 0;
        $statiCambiati = [];
        
        foreach ($fatture as $fattura) {
            $statoAttuale = $fattura->stato;
            $importoPagato = $fattura->getImportoPagato();
            $importoTotale = $fattura->importo_totale;
            
            // Calcola il nuovo stato
            if ($importoPagato >= $importoTotale) {
                $nuovoStato = 'pagata';
            } elseif ($importoPagato > 0) {
                $nuovoStato = 'parzialmente_pagata';
            } else {
                $nuovoStato = 'inviata';
            }
            
            // Se lo stato è diverso, registra il cambiamento
            if ($statoAttuale !== $nuovoStato) {
                $statiCambiati[] = [
                    'fattura' => $fattura->numero,
                    'stato_attuale' => $statoAttuale,
                    'nuovo_stato' => $nuovoStato,
                    'importo_pagato' => $importoPagato,
                    'importo_totale' => $importoTotale
                ];
                
                if (!$dryRun) {
                    $fattura->stato = $nuovoStato;
                    $fattura->save();
                    $aggiornate++;
                }
            }
        }
        
        if (empty($statiCambiati)) {
            $this->info('✅ Tutte le fatture hanno già lo stato corretto!');
            return 0;
        }
        
        $this->info("\n📊 Fatture che necessitano aggiornamento stato:");
        $this->table(
            ['Fattura', 'Stato Attuale', 'Nuovo Stato', 'Importo Pagato', 'Importo Totale'],
            $statiCambiati
        );
        
        if ($dryRun) {
            $this->info("\n🔍 Modalità dry-run: nessuna modifica applicata");
            $this->info("Esegui senza --dry-run per applicare le modifiche");
        } else {
            $this->info("\n✅ Aggiornate {$aggiornate} fatture!");
        }
        
        return 0;
    }
}
