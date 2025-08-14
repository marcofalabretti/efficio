<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Preventivo extends Model
{
    use HasFactory;
    protected $table = 'preventivi';
    
    protected $fillable = [
        'numero',
        'data',
        'data_scadenza',
        'stato',
        'importo_totale',
        'importo_iva',
        'importo_netto',
        'note',
        'customer_id',
        'commessa_id',
        'project_id',
        'created_by',
        'accettato_da',
        'data_accettazione',
    ];

    protected $casts = [
        'data' => 'date',
        'data_scadenza' => 'date',
        'data_accettazione' => 'date',
        'importo_totale' => 'decimal:2',
        'importo_iva' => 'decimal:2',
        'importo_netto' => 'decimal:2',
    ];

    // Stati possibili del preventivo
    const STATO_BOZZA = 'bozza';
    const STATO_INVIATO = 'inviato';
    const STATO_ACCETTATO = 'accettato';
    const STATO_RIFIUTATO = 'rifiutato';
    const STATO_SCADUTO = 'scaduto';

    // Relazioni
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function commessa(): BelongsTo
    {
        return $this->belongsTo(Commessa::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function accettatoDa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accettato_da');
    }

    public function righe(): HasMany
    {
        return $this->hasMany(PreventivoRiga::class);
    }

    public function fatture(): HasMany
    {
        return $this->hasMany(Fattura::class);
    }

    // Metodi di utilità
    public function isScaduto(): bool
    {
        return $this->data_scadenza && $this->data_scadenza->isPast() && $this->stato !== self::STATO_ACCETTATO;
    }

    public function getStatoColor(): string
    {
        return match($this->stato) {
            self::STATO_BOZZA => 'gray',
            self::STATO_INVIATO => 'blue',
            self::STATO_ACCETTATO => 'green',
            self::STATO_RIFIUTATO => 'red',
            self::STATO_SCADUTO => 'orange',
            default => 'gray'
        };
    }

    // Nuovi metodi per gestione articoli e calcoli
    public function calcolaTotali(): void
    {
        $importoNetto = 0;
        
        foreach ($this->righe as $riga) {
            $importoNetto += $riga->getImportoScontato();
        }
        
        $this->importo_netto = $importoNetto;
        $this->importo_iva = $importoNetto * 0.22; // IVA 22% - da rendere configurabile
        $this->importo_totale = $importoNetto + $this->importo_iva;
        
        $this->save();
    }

    public function getRigheArticoli()
    {
        return $this->righe()->where('tipo_riga', PreventivoRiga::TIPO_ARTICOLO)->get();
    }

    public function getRigheManodopera()
    {
        return $this->righe()->where('tipo_riga', PreventivoRiga::TIPO_MANODOPERA)->get();
    }

    public function getRigheManuali()
    {
        return $this->righe()->where('tipo_riga', PreventivoRiga::TIPO_MANUALE)->get();
    }

    public function haArticoli(): bool
    {
        return $this->righe()->where('tipo_riga', PreventivoRiga::TIPO_ARTICOLO)->exists();
    }

    public function haManodopera(): bool
    {
        return $this->righe()->where('tipo_riga', PreventivoRiga::TIPO_MANODOPERA)->exists();
    }

    public function getValoreArticoli(): float
    {
        return $this->righe()
            ->where('tipo_riga', PreventivoRiga::TIPO_ARTICOLO)
            ->get()
            ->sum(function($riga) {
                return $riga->getImportoScontato();
            });
    }

    public function getValoreManodopera(): float
    {
        return $this->righe()
            ->where('tipo_riga', PreventivoRiga::TIPO_MANODOPERA)
            ->get()
            ->sum(function($riga) {
                return $riga->getImportoScontato();
            });
    }

    public function getValoreServizi(): float
    {
        return $this->righe()
            ->where('tipo_riga', PreventivoRiga::TIPO_MANUALE)
            ->get()
            ->sum(function($riga) {
                return $riga->getImportoScontato();
            });
    }

    // Scope per filtri
    public function scopeAttivi($query)
    {
        return $query->whereIn('stato', [self::STATO_BOZZA, self::STATO_INVIATO]);
    }

    public function scopeAccettati($query)
    {
        return $query->where('stato', self::STATO_ACCETTATO);
    }

    public function scopeScaduti($query)
    {
        return $query->where('data_scadenza', '<', now())->where('stato', '!=', self::STATO_ACCETTATO);
    }

    public function scopeConArticoli($query)
    {
        return $query->whereHas('righe', function($q) {
            $q->where('tipo_riga', PreventivoRiga::TIPO_ARTICOLO);
        });
    }

    public function scopeConManodopera($query)
    {
        return $query->whereHas('righe', function($q) {
            $q->where('tipo_riga', PreventivoRiga::TIPO_MANODOPERA);
        });
    }
}
