<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'priority',
        'start_date',
        'due_date',
        'budget',
        'progress',
        'customer_id',
        'manager_id',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'budget' => 'decimal:2',
        'progress' => 'decimal:2',
    ];

    // Stati possibili del progetto
    const STATUS_ACTIVE = 'attivo';
    const STATUS_COMPLETED = 'completato';
    const STATUS_SUSPENDED = 'sospeso';
    const STATUS_CANCELLED = 'cancellato';

    // Priorità possibili
    const PRIORITY_LOW = 'bassa';
    const PRIORITY_MEDIUM = 'media';
    const PRIORITY_HIGH = 'alta';
    const PRIORITY_CRITICAL = 'critica';

    // Relazioni
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function commesse(): HasMany
    {
        return $this->hasMany(Commessa::class);
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
    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && $this->status !== self::STATUS_COMPLETED;
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            self::STATUS_ACTIVE => 'blue',
            self::STATUS_COMPLETED => 'green',
            self::STATUS_SUSPENDED => 'yellow',
            self::STATUS_CANCELLED => 'red',
            default => 'gray'
        };
    }

    public function getPriorityColor(): string
    {
        return match($this->priority) {
            self::PRIORITY_LOW => 'green',
            self::PRIORITY_MEDIUM => 'blue',
            self::PRIORITY_HIGH => 'orange',
            self::PRIORITY_CRITICAL => 'red',
            default => 'gray'
        };
    }

    // Scope per filtri
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())->where('status', '!=', self::STATUS_COMPLETED);
    }
}
