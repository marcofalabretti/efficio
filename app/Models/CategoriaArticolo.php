<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaArticolo extends Model
{
    use HasFactory;

    protected $table = 'categorie_articoli';

    protected $fillable = [
        'nome',
        'codice',
        'descrizione',
        'colore',
        'categoria_padre_id',
        'attiva',
        'ordinamento',
    ];

    protected $casts = [
        'attiva' => 'boolean',
        'ordinamento' => 'integer',
    ];

    // Relazioni
    public function categoriaPadre(): BelongsTo
    {
        return $this->belongsTo(CategoriaArticolo::class, 'categoria_padre_id');
    }

    public function sottocategorie(): HasMany
    {
        return $this->hasMany(CategoriaArticolo::class, 'categoria_padre_id');
    }

    public function articoli(): HasMany
    {
        return $this->hasMany(Articolo::class, 'categoria_id');
    }

    // Scope per filtri
    public function scopeAttive($query)
    {
        return $query->where('attiva', true);
    }

    public function scopePrincipali($query)
    {
        return $query->whereNull('categoria_padre_id');
    }

    public function scopeOrdinate($query)
    {
        return $query->orderBy('ordinamento')->orderBy('nome');
    }

    // Metodi di utilità
    public function isPrincipale(): bool
    {
        return is_null($this->categoria_padre_id);
    }

    public function hasSottocategorie(): bool
    {
        return $this->sottocategorie()->count() > 0;
    }

    public function getPercorsoCompleto(): string
    {
        if ($this->isPrincipale()) {
            return $this->nome;
        }
        
        return $this->categoriaPadre->getPercorsoCompleto() . ' > ' . $this->nome;
    }

    public function getColoreCss(): string
    {
        return $this->colore ?? '#3b82f6';
    }
}
