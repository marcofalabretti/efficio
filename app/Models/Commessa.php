<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commessa extends Model
{
    use HasFactory;

    protected $table = 'commesse';

    protected $fillable = [
        'nome',
        'descrizione',
        'stato',
        'data_inizio',
        'data_fine_prevista',
        'data_fine_effettiva',
        'budget',
        'ore_stimate',
        'ore_effettive',
        'note',
        'customer_id',
        'project_id',
        'responsabile_id',
        'created_by',
    ];

    protected $casts = [
        'data_inizio' => 'date',
        'data_fine_prevista' => 'date',
        'data_fine_effettiva' => 'date',
        'budget' => 'decimal:2',
        'ore_stimate' => 'decimal:2',
        'ore_effettive' => 'decimal:2',
    ];

    // Stati possibili della commessa
    const STATO_ATTIVA = 'attiva';
    const STATO_COMPLETATA = 'completata';
    const STATO_SOSPESA = 'sospesa';
    const STATO_ANNULLATA = 'annullata';

    // Relazioni
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function responsabile(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsabile_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function preventivi(): HasMany
    {
        return $this->hasMany(Preventivo::class);
    }

    public function fatture(): HasMany
    {
        return $this->hasMany(Fattura::class);
    }

    // Metodi di utilità
    public function isScaduta(): bool
    {
        return $this->data_fine_prevista && $this->data_fine_prevista->isPast() && $this->stato !== self::STATO_COMPLETATA;
    }

    public function getStatoColor(): string
    {
        return match($this->stato) {
            self::STATO_ATTIVA => 'blue',
            self::STATO_COMPLETATA => 'green',
            self::STATO_SOSPESA => 'yellow',
            self::STATO_ANNULLATA => 'red',
            default => 'gray'
        };
    }

    // Scope per filtri
    public function scopeAttive($query)
    {
        return $query->where('stato', self::STATO_ATTIVA);
    }

    public function scopeScadute($query)
    {
        return $query->where('data_fine_prevista', '<', now())->where('stato', '!=', self::STATO_COMPLETATA);
    }

    /**
     * Ottiene il codice formattato della commessa
     */
    public function getCodiceFormattatoAttribute(): string
    {
        return $this->codice ?? 'N/A';
    }

    /**
     * Ottiene il numero progressivo della commessa
     */
    public function getNumeroProgressivoAttribute(): int
    {
        if (!$this->codice) return 0;
        
        $parts = explode('/', $this->codice);
        return (int) ($parts[0] ?? 0);
    }

    /**
     * Ottiene l'anno della commessa
     */
    public function getAnnoAttribute(): int
    {
        if (!$this->codice) return now()->year;
        
        $parts = explode('/', $this->codice);
        return (int) ($parts[1] ?? now()->year);
    }
}
