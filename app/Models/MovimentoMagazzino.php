<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimentoMagazzino extends Model
{
    use HasFactory;

    protected $table = 'movimenti_magazzino';

    protected $fillable = [
        'articolo_id',
        'tipo_movimento',
        'quantita',
        'quantita_precedente',
        'quantita_successiva',
        'documento_tipo',
        'documento_id',
        'numero_documento',
        'prezzo_unitario',
        'causale',
        'note',
        'created_by',
        'fornitore_id',
        'customer_id',
    ];

    protected $casts = [
        'quantita' => 'decimal:2',
        'quantita_precedente' => 'decimal:2',
        'quantita_successiva' => 'decimal:2',
        'prezzo_unitario' => 'decimal:2',
    ];

    // Costanti per i tipi di movimento
    const TIPO_CARICO = 'carico';
    const TIPO_SCARICO = 'scarico';
    const TIPO_TRASFERIMENTO = 'trasferimento';
    const TIPO_INVENTARIO = 'inventario';
    const TIPO_RESO = 'reso';
    const TIPO_ALTRO = 'altro';

    // Relazioni
    public function articolo(): BelongsTo
    {
        return $this->belongsTo(Articolo::class, 'articolo_id');
    }

    public function utente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function fornitore(): BelongsTo
    {
        return $this->belongsTo(Fornitore::class, 'fornitore_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Scope per filtri
    public function scopePerArticolo($query, $articoloId)
    {
        return $query->where('articolo_id', $articoloId);
    }

    public function scopePerTipo($query, $tipo)
    {
        return $query->where('tipo_movimento', $tipo);
    }

    public function scopePerDocumento($query, $tipo, $id)
    {
        return $query->where('documento_tipo', $tipo)->where('documento_id', $id);
    }

    public function scopePerFornitore($query, $fornitoreId)
    {
        return $query->where('fornitore_id', $fornitoreId);
    }

    public function scopePerCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    public function scopeCarichi($query)
    {
        return $query->where('tipo_movimento', self::TIPO_CARICO);
    }

    public function scopeScarichi($query)
    {
        return $query->where('tipo_movimento', self::TIPO_SCARICO);
    }

    public function scopeOrdineCronologico($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Metodi di utilità
    public function isCarico(): bool
    {
        return $this->tipo_movimento === self::TIPO_CARICO;
    }

    public function isScarico(): bool
    {
        return $this->tipo_movimento === self::TIPO_SCARICO;
    }

    public function getVariazioneGiacenza(): float
    {
        return $this->quantita_successiva - $this->quantita_precedente;
    }

    public function getValoreMovimento(): float
    {
        if ($this->prezzo_unitario) {
            return $this->quantita * $this->prezzo_unitario;
        }
        return 0;
    }

    public function getTipoMovimentoLabel(): string
    {
        return match($this->tipo_movimento) {
            self::TIPO_CARICO => 'Carico',
            self::TIPO_SCARICO => 'Scarico',
            self::TIPO_TRASFERIMENTO => 'Trasferimento',
            self::TIPO_INVENTARIO => 'Inventario',
            self::TIPO_RESO => 'Reso',
            self::TIPO_ALTRO => 'Altro',
            default => 'Sconosciuto'
        };
    }

    public function getTipoMovimentoColor(): string
    {
        return match($this->tipo_movimento) {
            self::TIPO_CARICO => 'green',
            self::TIPO_SCARICO => 'red',
            self::TIPO_TRASFERIMENTO => 'blue',
            self::TIPO_INVENTARIO => 'purple',
            self::TIPO_RESO => 'orange',
            self::TIPO_ALTRO => 'gray',
            default => 'gray'
        };
    }

    public function getDocumentoRiferimento(): ?string
    {
        if ($this->documento_tipo && $this->numero_documento) {
            return ucfirst($this->documento_tipo) . ' ' . $this->numero_documento;
        }
        
        return null;
    }
}
