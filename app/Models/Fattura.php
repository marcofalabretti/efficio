<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fattura extends Model
{
    use HasFactory;
    
    protected $table = 'fatture';

    protected $fillable = [
        'numero',
        'data',
        'data_scadenza',
        'stato',
        'importo_totale',
        'importo_iva',
        'importo_netto',
        'percentuale_iva',
        'note',
        'customer_id',
        'commessa_id',
        'preventivo_id',
        'project_id',
        'created_by',
    ];

    protected $casts = [
        'data' => 'date',
        'data_scadenza' => 'date',
        'importo_totale' => 'decimal:2',
        'importo_iva' => 'decimal:2',
        'importo_netto' => 'decimal:2',
        'percentuale_iva' => 'decimal:2',
    ];

    // Stati possibili della fattura
    const STATO_BOZZA = 'bozza';
    const STATO_INVIATA = 'inviata';
    const STATO_PARZIALMENTE_PAGATA = 'parzialmente_pagata';
    const STATO_PAGATA = 'pagata';
    const STATO_SCADUTA = 'scaduta';
    const STATO_ANNULLATA = 'annullata';

    // Relazioni
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function commessa(): BelongsTo
    {
        return $this->belongsTo(Commessa::class);
    }

    public function preventivo(): BelongsTo
    {
        return $this->belongsTo(Preventivo::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function righe(): HasMany
    {
        return $this->hasMany(FatturaRiga::class);
    }

    public function pagamenti(): HasMany
    {
        return $this->hasMany(Pagamento::class);
    }

    // Metodi di utilità
    public function isScaduta(): bool
    {
        return $this->data_scadenza && $this->data_scadenza->isPast() && $this->stato !== self::STATO_PAGATA;
    }

    public function isPagata(): bool
    {
        return $this->stato === self::STATO_PAGATA;
    }

    public function getStatoColor(): string
    {
        return match($this->stato) {
            self::STATO_BOZZA => 'gray',
            self::STATO_INVIATA => 'blue',
            self::STATO_PARZIALMENTE_PAGATA => 'yellow',
            self::STATO_PAGATA => 'green',
            self::STATO_SCADUTA => 'red',
            self::STATO_ANNULLATA => 'orange',
            default => 'gray'
        };
    }

    // Calcolo automatico dell'IVA
    public function calcolaIva(): void
    {
        if ($this->importo_netto && $this->percentuale_iva) {
            $this->importo_iva = round($this->importo_netto * ($this->percentuale_iva / 100), 2);
            $this->importo_totale = $this->importo_netto + $this->importo_iva;
        }
    }

    // Calcolo dell'importo totale pagato
    public function getImportoPagato(): float
    {
        return $this->pagamenti()
            ->where('stato', Pagamento::STATO_CONFERMATO)
            ->sum('importo');
    }

    // Calcolo dell'importo residuo
    public function getImportoResiduo(): float
    {
        return $this->importo_totale - $this->getImportoPagato();
    }

    // Verifica se la fattura è completamente pagata
    public function isCompletamentePagata(): bool
    {
        return $this->getImportoPagato() >= $this->importo_totale;
    }

    // Calcolo automatico dello stato basato sui pagamenti
    public function calcolaStatoAutomatico(): void
    {
        $importoPagato = $this->getImportoPagato();
        
        if ($importoPagato >= $this->importo_totale) {
            $this->stato = self::STATO_PAGATA;
        } elseif ($importoPagato > 0) {
            $this->stato = self::STATO_PARZIALMENTE_PAGATA;
        } else {
            $this->stato = self::STATO_INVIATA;
        }
        
        $this->save();
    }

    // Aggiorna lo stato quando cambiano i pagamenti
    public function aggiornaStatoDaPagamenti(): void
    {
        $this->calcolaStatoAutomatico();
    }

    // Scope per filtri
    public function scopeAttive($query)
    {
        return $query->whereIn('stato', [self::STATO_BOZZA, self::STATO_INVIATA, self::STATO_PARZIALMENTE_PAGATA]);
    }

    public function scopePagate($query)
    {
        return $query->where('stato', self::STATO_PAGATA);
    }

    public function scopeParzialmentePagate($query)
    {
        return $query->where('stato', self::STATO_PARZIALMENTE_PAGATA);
    }

    public function scopeScadute($query)
    {
        return $query->where('data_scadenza', '<', now())->whereNotIn('stato', [self::STATO_PAGATA, self::STATO_ANNULLATA]);
    }
}
