<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyIdentity extends Model
{
    use HasFactory;

    protected $table = 'company_identity';

    protected $fillable = [
        'company_name',
        'commercial_name',
        'slogan',
        'website',
        'email',
        'phone',
        'mission',
        'vision',
        'values',
        'partita_iva',
        'codice_fiscale',
        'rea',
        'legal_address',
        'pec',
        'sdi',
        'logo_large',
        'logo_icon',
        'logo_horizontal',
        'logo_vertical',
        'favicon',
        'primary_color',
        'secondary_color',
        'neutral_color',
        'success_color',
        'error_color',
        'primary_font',
        'secondary_font',
        'style_type',
        'social_media',
        'contact_channels',
        'branch_code',
        'branch_name',
        'is_active'
    ];

    protected $casts = [
        'values' => 'array',
        'social_media' => 'array',
        'contact_channels' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope per identità attive
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope per sede specifica
     */
    public function scopeByBranch($query, $branchCode)
    {
        return $query->where('branch_code', $branchCode);
    }

    /**
     * Ottiene l'identità attiva principale
     */
    public static function getActiveIdentity()
    {
        return static::active()->whereNull('branch_code')->first();
    }

    /**
     * Ottiene l'identità per una sede specifica
     */
    public static function getBranchIdentity($branchCode)
    {
        return static::active()->byBranch($branchCode)->first();
    }

    /**
     * Genera le variabili CSS personalizzate
     */
    public function getCssVariables()
    {
        return [
            '--brand-primary' => $this->primary_color,
            '--brand-secondary' => $this->secondary_color,
            '--brand-neutral' => $this->neutral_color,
            '--brand-success' => $this->success_color,
            '--brand-error' => $this->error_color,
            '--brand-font-primary' => $this->primary_font,
            '--brand-font-secondary' => $this->secondary_font,
        ];
    }

    /**
     * Ottiene il logo appropriato per il tipo di documento
     */
    public function getLogoForDocument($type = 'large')
    {
        switch ($type) {
            case 'icon':
                return $this->logo_icon;
            case 'horizontal':
                return $this->logo_horizontal;
            case 'vertical':
                return $this->logo_vertical;
            default:
                return $this->logo_large;
        }
    }
}
