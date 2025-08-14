<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Commessa;
use Illuminate\Support\Facades\DB;

class UpdateCommessaCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commesse:update-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiorna i codici delle commesse esistenti nel formato ID/ANNO';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Aggiornamento codici commesse...');

        // Raggruppa le commesse per anno di creazione
        $commessePerAnno = Commessa::selectRaw('YEAR(created_at) as anno, id, codice')
            ->orderBy('created_at')
            ->get()
            ->groupBy('anno');

        $totalUpdated = 0;

        foreach ($commessePerAnno as $anno => $commesse) {
            $this->info("Processando commesse dell'anno {$anno}...");
            
            $counter = 1;
            foreach ($commesse as $commessa) {
                $newCode = $counter . '/' . $anno;
                
                // Aggiorna il codice solo se è diverso
                if ($commessa->codice !== $newCode) {
                    DB::table('commesse')->where('id', $commessa->id)->update(['codice' => $newCode]);
                    $this->line("  Commessa ID {$commessa->id}: {$commessa->codice} → {$newCode}");
                    $totalUpdated++;
                }
                
                $counter++;
            }
        }

        $this->info("Aggiornamento completato! {$totalUpdated} codici aggiornati.");
        
        return 0;
    }
}
