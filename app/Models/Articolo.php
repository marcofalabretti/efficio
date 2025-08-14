<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Articolo extends Model
{
    use HasFactory;

    protected $table = 'articoli';

    protected $fillable = [
        'codice',
        'nome',
        'descrizione',
        'categoria_id',
        'fornitore_id',
        'prezzo_acquisto',
        'prezzo_vendita',
        'prezzo_vendita_minimo',
        'giacenza_attuale',
        'giacenza_minima',
        'unita_misura',
        'peso',
        'dimensioni',
        'marca',
        'modello',
        'codice_ean',
        'codice_fornitore',
        'tipo',
        'attivo',
        'vendibile',
        'acquistabile',
        'ordinamento',
    ];

    protected $casts = [
        'prezzo_acquisto' => 'decimal:2',
        'prezzo_vendita' => 'decimal:2',
        'prezzo_vendita_minimo' => 'decimal:2',
        'giacenza_attuale' => 'decimal:2',
        'giacenza_minima' => 'decimal:2',
        'peso' => 'decimal:3',
        'attivo' => 'boolean',
        'vendibile' => 'boolean',
        'acquistabile' => 'boolean',
        'ordinamento' => 'integer',
    ];

    // Costanti per i tipi
    const TIPO_PRODOTTO = 'prodotto';
    const TIPO_SERVIZIO = 'servizio';
    const TIPO_MANODOPERA = 'manodopera';

    // Relazioni
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaArticolo::class, 'categoria_id');
    }

    public function fornitore(): BelongsTo
    {
        return $this->belongsTo(Fornitore::class, 'fornitore_id');
    }

    public function movimentiMagazzino(): HasMany
    {
        return $this->hasMany(MovimentoMagazzino::class, 'articolo_id');
    }

    public function righePreventivo(): HasMany
    {
        return $this->hasMany(PreventivoRiga::class, 'articolo_id');
    }

    // Scope per filtri
    public function scopeAttivi($query)
    {
        return $query->where('attivo', true);
    }

    public function scopeVendibili($query)
    {
        return $query->where('vendibile', true);
    }

    public function scopeAcquistabili($query)
    {
        return $query->where('acquistabile', true);
    }

    public function scopePerCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
    }

    public function scopePerFornitore($query, $fornitoreId)
    {
        return $query->where('fornitore_id', $fornitoreId);
    }

    public function scopePerTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function scopeSottoScorta($query)
    {
        return $query->whereRaw('giacenza_attuale <= giacenza_minima');
    }

    public function scopeOrdineAlfabetico($query)
    {
        return $query->orderBy('nome');
    }

    // Metodi di utilità
    public function isProdotto(): bool
    {
        return $this->tipo === self::TIPO_PRODOTTO;
    }

    public function isServizio(): bool
    {
        return $this->tipo === self::TIPO_SERVIZIO;
    }

    public function isManodopera(): bool
    {
        return $this->tipo === self::TIPO_MANODOPERA;
    }

    public function isSottoScorta(): bool
    {
        return $this->giacenza_attuale <= $this->giacenza_minima;
    }

    public function getMargine(): float
    {
        if ($this->prezzo_acquisto > 0) {
            return (($this->prezzo_vendita - $this->prezzo_acquisto) / $this->prezzo_acquisto) * 100;
        }
        return 0;
    }

    public function getValoreGiacenza(): float
    {
        return $this->giacenza_attuale * $this->prezzo_acquisto;
    }

    public function getStatoGiacenza(): string
    {
        if ($this->giacenza_attuale <= 0) {
            return 'esaurito';
        }
        
        if ($this->isSottoScorta()) {
            return 'sotto_scorta';
        }
        
        return 'normale';
    }

    public function getStatoGiacenzaColor(): string
    {
        return match($this->getStatoGiacenza()) {
            'esaurito' => 'red',
            'sotto_scorta' => 'orange',
            'normale' => 'green',
            default => 'gray'
        };
    }

    public function aggiornaGiacenza(float $quantita, string $tipo = 'carico'): void
    {
        $quantitaPrecedente = $this->giacenza_attuale;
        
        if ($tipo === 'carico') {
            $this->giacenza_attuale += $quantita;
        } else {
            $this->giacenza_attuale -= $quantita;
        }
        
        // Assicurati che la giacenza non sia negativa
        if ($this->giacenza_attuale < 0) {
            $this->giacenza_attuale = 0;
        }
        
        $this->save();
        
        // Registra il movimento
        MovimentoMagazzino::create([
            'articolo_id' => $this->id,
            'tipo_movimento' => $tipo,
            'quantita' => $quantita,
            'quantita_precedente' => $quantitaPrecedente,
            'quantita_successiva' => $this->giacenza_attuale,
            'created_by' => auth()->id(),
        ]);
    }
}
