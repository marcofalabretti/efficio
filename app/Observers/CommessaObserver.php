<?php

namespace App\Observers;

use App\Models\Commessa;

class CommessaObserver
{
    /**
     * Handle the Commessa "creating" event.
     */
    public function creating(Commessa $commessa): void
    {
        // Genera il codice automaticamente se non è stato specificato
        if (empty($commessa->codice)) {
            $commessa->codice = $this->generateCodice();
        }
    }

    /**
     * Genera un codice univoco per la commessa nel formato ID/ANNO
     */
    private function generateCodice(): string
    {
        $year = now()->year;
        
        // Trova l'ultima commessa creata quest'anno
        $lastCommessa = Commessa::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastCommessa) {
            // Estrai il numero dal codice esistente e incrementalo
            $parts = explode('/', $lastCommessa->codice);
            $lastNumber = (int) $parts[0];
            $nextNumber = $lastNumber + 1;
        } else {
            // Prima commessa dell'anno
            $nextNumber = 1;
        }
        
        return $nextNumber . '/' . $year;
    }
}
