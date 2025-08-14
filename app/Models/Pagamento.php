<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagamento extends Model
{
    use HasFactory;
    
    protected $table = 'pagamenti';

    protected $fillable = [
        'fattura_id',
        'importo',
        'data_pagamento',
        'metodo_pagamento',
        'riferimento_pagamento',
        'note',
        'stato',
        'created_by',
    ];

    protected $casts = [
        'data_pagamento' => 'date',
        'importo' => 'decimal:2',
    ];

    // Stati possibili del pagamento
    const STATO_PENDENTE = 'pendente';
    const STATO_CONFERMATO = 'confermato';
    const STATO_ANNULLATO = 'annullato';

    // Metodi di pagamento
    const PAGAMENTO_BONIFICO = 'bonifico';
    const PAGAMENTO_ASSEGNO = 'assegno';
    const PAGAMENTO_CARTA = 'carta';
    const PAGAMENTO_CONTANTI = 'contanti';

    // Relazioni
    public function fattura(): BelongsTo
    {
        return $this->belongsTo(Fattura::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Metodi di utilità
    public function isConfermato(): bool
    {
        return $this->stato === self::STATO_CONFERMATO;
    }

    public function isPendente(): bool
    {
        return $this->stato === self::STATO_PENDENTE;
    }

    public function getStatoColor(): string
    {
        return match($this->stato) {
            self::STATO_PENDENTE => 'bg-yellow-100 text-yellow-800',
            self::STATO_CONFERMATO => 'bg-green-100 text-green-800',
            self::STATO_ANNULLATO => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    // Scope per filtri
    public function scopeConfermati($query)
    {
        return $query->where('stato', self::STATO_CONFERMATO);
    }

    public function scopePendenti($query)
    {
        return $query->where('stato', self::STATO_PENDENTE);
    }
}
