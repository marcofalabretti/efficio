<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fornitore extends Model
{
    use HasFactory;

    protected $table = 'fornitori';

    protected $fillable = [
        'ragione_sociale',
        'partita_iva',
        'codice_fiscale',
        'indirizzo',
        'cap',
        'citta',
        'provincia',
        'telefono',
        'email',
        'pec',
        'sdi',
        'note',
        'attivo',
    ];

    protected $casts = [
        'attivo' => 'boolean',
    ];

    // Relazioni
    public function articoli(): HasMany
    {
        return $this->hasMany(Articolo::class, 'fornitore_id');
    }

    public function movimentiMagazzino(): HasMany
    {
        return $this->hasMany(MovimentoMagazzino::class, 'fornitore_id');
    }

    // Scope per filtri
    public function scopeAttivi($query)
    {
        return $query->where('attivo', true);
    }

    public function scopePerCitta($query, $citta)
    {
        return $query->where('citta', 'like', "%{$citta}%");
    }

    // Metodi di utilità
    public function getIndirizzoCompleto(): string
    {
        $parti = [];
        
        if ($this->indirizzo) {
            $parti[] = $this->indirizzo;
        }
        
        if ($this->cap || $this->citta || $this->provincia) {
            $parti[] = trim(implode(' ', array_filter([$this->cap, $this->citta, $this->provincia])));
        }
        
        return implode(', ', $parti);
    }

    public function hasContatti(): bool
    {
        return !empty($this->telefono) || !empty($this->email) || !empty($this->pec);
    }

    public function getContattiPrincipali(): array
    {
        $contatti = [];
        
        if ($this->telefono) {
            $contatti['telefono'] = $this->telefono;
        }
        
        if ($this->email) {
            $contatti['email'] = $this->email;
        }
        
        if ($this->pec) {
            $contatti['pec'] = $this->pec;
        }
        
        return $contatti;
    }
}
