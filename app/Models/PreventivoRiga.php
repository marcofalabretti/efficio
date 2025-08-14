<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreventivoRiga extends Model
{
    use HasFactory;

    protected $table = 'preventivo_righe';

    protected $fillable = [
        'preventivo_id',
        'articolo_id',
        'tipo_riga',
        'descrizione',
        'quantita',
        'unita_misura',
        'prezzo_unitario',
        'prezzo_originale',
        'sconto_percentuale',
        'importo_totale',
        'note',
        'ordinamento',
    ];

    protected $casts = [
        'quantita' => 'decimal:2',
        'prezzo_unitario' => 'decimal:2',
        'prezzo_originale' => 'decimal:2',
        'sconto_percentuale' => 'decimal:2',
        'importo_totale' => 'decimal:2',
        'ordinamento' => 'integer',
    ];

    // Costanti per i tipi di riga
    const TIPO_MANUALE = 'manuale';
    const TIPO_ARTICOLO = 'articolo';
    const TIPO_MANODOPERA = 'manodopera';

    // Relazioni
    public function preventivo(): BelongsTo
    {
        return $this->belongsTo(Preventivo::class);
    }

    public function articolo(): BelongsTo
    {
        return $this->belongsTo(Articolo::class, 'articolo_id');
    }

    // Metodi di utilità
    public function isManuale(): bool
    {
        return $this->tipo_riga === self::TIPO_MANUALE;
    }

    public function isArticolo(): bool
    {
        return $this->tipo_riga === self::TIPO_ARTICOLO;
    }

    public function isManodopera(): bool
    {
        return $this->tipo_riga === self::TIPO_MANODOPERA;
    }

    public function getImportoScontato(): float
    {
        $importo = $this->quantita * $this->prezzo_unitario;
        if ($this->sconto_percentuale > 0) {
            $importo = $importo * (1 - $this->sconto_percentuale / 100);
        }
        return $importo;
    }

    public function getDescrizioneCompleta(): string
    {
        if ($this->isArticolo() && $this->articolo) {
            return $this->articolo->nome . ($this->note ? ' - ' . $this->note : '');
        }
        
        return $this->descrizione;
    }

    public function getUnitaMisura(): string
    {
        if ($this->isArticolo() && $this->articolo) {
            return $this->articolo->unita_misura;
        }
        
        return $this->unita_misura ?? 'pz';
    }

    public function getPrezzoUnitario(): float
    {
        if ($this->isArticolo() && $this->articolo) {
            return $this->prezzo_unitario ?? $this->articolo->prezzo_vendita;
        }
        
        return $this->prezzo_unitario;
    }

    public function aggiornaDaArticolo(): void
    {
        if ($this->isArticolo() && $this->articolo) {
            $this->descrizione = $this->articolo->nome;
            $this->unita_misura = $this->articolo->unita_misura;
            $this->prezzo_originale = $this->articolo->prezzo_vendita;
            
            if (!$this->prezzo_unitario) {
                $this->prezzo_unitario = $this->articolo->prezzo_vendita;
            }
            
            $this->save();
        }
    }
}
