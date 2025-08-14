<?php

namespace App\Observers;

use App\Models\Pagamento;

class PagamentoObserver
{
    /**
     * Handle the Pagamento "created" event.
     */
    public function created(Pagamento $pagamento): void
    {
        // Aggiorna lo stato della fattura quando viene creato un nuovo pagamento
        if ($pagamento->fattura) {
            $pagamento->fattura->aggiornaStatoDaPagamenti();
        }
    }

    /**
     * Handle the Pagamento "updated" event.
     */
    public function updated(Pagamento $pagamento): void
    {
        // Aggiorna lo stato della fattura quando viene modificato un pagamento
        if ($pagamento->fattura) {
            $pagamento->fattura->aggiornaStatoDaPagamenti();
        }
    }

    /**
     * Handle the Pagamento "deleted" event.
     */
    public function deleted(Pagamento $pagamento): void
    {
        // Aggiorna lo stato della fattura quando viene eliminato un pagamento
        if ($pagamento->fattura) {
            $pagamento->fattura->aggiornaStatoDaPagamenti();
        }
    }

    /**
     * Handle the Pagamento "restored" event.
     */
    public function restored(Pagamento $pagamento): void
    {
        // Aggiorna lo stato della fattura quando viene ripristinato un pagamento
        if ($pagamento->fattura) {
            $pagamento->fattura->aggiornaStatoDaPagamenti();
        }
    }

    /**
     * Handle the Pagamento "force deleted" event.
     */
    public function forceDeleted(Pagamento $pagamento): void
    {
        // Aggiorna lo stato della fattura quando viene eliminato definitivamente un pagamento
        if ($pagamento->fattura) {
            $pagamento->fattura->aggiornaStatoDaPagamenti();
        }
    }
}
