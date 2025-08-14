<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FatturaRiga extends Model
{
    use HasFactory;

    protected $table = 'fattura_righe';

    protected $fillable = [
        'fattura_id',
        'descrizione',
        'quantita',
        'prezzo_unitario',
        'sconto_percentuale',
        'importo_totale',
        'note',
        'ordinamento',
    ];

    protected $casts = [
        'quantita' => 'decimal:2',
        'prezzo_unitario' => 'decimal:2',
        'sconto_percentuale' => 'decimal:2',
        'importo_totale' => 'decimal:2',
        'ordinamento' => 'integer',
    ];

    // Relazioni
    public function fattura(): BelongsTo
    {
        return $this->belongsTo(Fattura::class);
    }

    // Metodi di utilità
    public function getImportoScontato(): float
    {
        $importo = $this->quantita * $this->prezzo_unitario;
        if ($this->sconto_percentuale > 0) {
            $importo = $importo * (1 - $this->sconto_percentuale / 100);
        }
        return $importo;
    }
}
