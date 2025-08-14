<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Fattura;
use App\Models\Pagamento;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'vat_number', 'fiscal_code',
        'street', 'city', 'zip', 'country', 'notes',
    ];

    // Relazioni
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function commesse(): HasMany
    {
        return $this->hasMany(Commessa::class);
    }

    public function preventivi(): HasMany
    {
        return $this->hasMany(Preventivo::class);
    }

    public function fatture(): HasMany
    {
        return $this->hasMany(Fattura::class);
    }

    // Metodo per ottenere le statistiche dei pagamenti
    public function getPaymentStats(): array
    {
        $fatture = $this->fatture()->with('pagamenti')->get();
        
        $totalFatture = $fatture->count();
        $fatturePagate = $fatture->where('stato', Fattura::STATO_PAGATA)->count();
        $fattureInviate = $fatture->where('stato', Fattura::STATO_INVIATA)->count();
        $fattureScadute = $fatture->where('stato', Fattura::STATO_SCADUTA)->count();
        $fattureBozza = $fatture->where('stato', Fattura::STATO_BOZZA)->count();
        
        // Calcola importi totali
        $importoTotaleFatturato = $fatture->sum('importo_totale');
        
        // Calcola importo pagato basandosi sui pagamenti confermati effettivamente associati alle fatture
        $importoPagato = 0;
        foreach ($fatture as $fattura) {
            $pagamentiConfermati = $fattura->pagamenti()->where('stato', \App\Models\Pagamento::STATO_CONFERMATO)->sum('importo');
            $importoPagato += $pagamentiConfermati;
        }
        
        $importoInSospeso = $fatture->whereIn('stato', [Fattura::STATO_INVIATA, Fattura::STATO_SCADUTA])->sum('importo_totale');
        
        // Calcola importo dovuto (tutte le fatture tranne quelle in bozza)
        $importoDovuto = $fatture->whereNotIn('stato', [Fattura::STATO_BOZZA])->sum('importo_totale');
        
        // Calcola saldo mancante (importo dovuto - importo pagato)
        $saldoMancante = $importoDovuto - $importoPagato;
        
        return [
            'totali' => [
                'fatture' => $totalFatture,
                'pagate' => $fatturePagate,
                'inviate' => $fattureInviate,
                'scadute' => $fattureScadute,
                'bozza' => $fattureBozza,
            ],
            'importi' => [
                'fatturato' => $importoTotaleFatturato,
                'pagato' => $importoPagato,
                'in_sospeso' => $importoInSospeso,
                'dovuto' => $importoDovuto,
                'saldo_mancante' => $saldoMancante,
            ],
            'percentuale_pagato' => $importoDovuto > 0 ? round(($importoPagato / $importoDovuto) * 100, 1) : 0,
        ];
    }
}


