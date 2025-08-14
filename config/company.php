<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configurazione Identità Aziendale
    |--------------------------------------------------------------------------
    |
    | Questo file contiene le configurazioni di default per l'identità aziendale
    | inclusi colori, font e stili predefiniti.
    |
    */

    'defaults' => [
        'colors' => [
            'primary' => '#2563eb',      // Blu principale
            'secondary' => '#7c3aed',    // Viola secondario
            'neutral' => '#6b7280',      // Grigio neutro
            'success' => '#059669',      // Verde successo
            'error' => '#dc2626',        // Rosso errore
            'warning' => '#d97706',      // Arancione warning
            'info' => '#0891b2',         // Azzurro info
        ],
        
        'fonts' => [
            'primary' => 'Inter',
            'secondary' => 'Roboto',
            'monospace' => 'JetBrains Mono',
        ],
        
        'styles' => [
            'corporate' => [
                'name' => 'Corporate',
                'description' => 'Stile professionale e formale',
                'colors' => ['#2563eb', '#7c3aed', '#6b7280'],
            ],
            'creative' => [
                'name' => 'Creativo',
                'description' => 'Stile moderno e innovativo',
                'colors' => ['#f59e0b', '#10b981', '#8b5cf6'],
            ],
            'minimal' => [
                'name' => 'Minimalista',
                'description' => 'Stile pulito e essenziale',
                'colors' => ['#374151', '#6b7280', '#9ca3af'],
            ],
        ],
        
        'logo_sizes' => [
            'large' => [
                'width' => 800,
                'height' => 400,
                'max_size' => 2048, // KB
            ],
            'icon' => [
                'width' => 64,
                'height' => 64,
                'max_size' => 1024, // KB
            ],
            'horizontal' => [
                'width' => 600,
                'height' => 200,
                'max_size' => 2048, // KB
            ],
            'vertical' => [
                'width' => 400,
                'height' => 600,
                'max_size' => 2048, // KB
            ],
            'favicon' => [
                'width' => 32,
                'height' => 32,
                'max_size' => 1024, // KB
            ],
        ],
    ],
    
    'validation' => [
        'company_name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:50',
        'website' => 'nullable|url|max:255',
        'partita_iva' => 'nullable|string|max:50',
        'codice_fiscale' => 'nullable|string|max:50',
        'rea' => 'nullable|string|max:50',
        'legal_address' => 'nullable|string|max:1000',
        'pec' => 'nullable|email|max:255',
        'sdi' => 'nullable|string|max:50',
    ],
    
    'storage' => [
        'disk' => 'public',
        'path' => 'company-logos',
        'allowed_mimes' => ['jpeg', 'jpg', 'png', 'svg', 'ico'],
    ],
];
