# Sistema Identità Aziendale

## Panoramica

Il sistema di identità aziendale di Efficio permette di gestire tutte le informazioni relative alla tua azienda, inclusi:
- Dati aziendali (nome, contatti, indirizzi)
- Branding (logo, colori, font)
- Informazioni legali (P.IVA, CF, REA, PEC, SDI)
- Contenuti aziendali (mission, vision, valori)
- Social media e canali di contatto
- Gestione di sedi multiple

## Funzionalità Principali

### 1. Gestione Identità
- **Creazione**: Crea nuove identità aziendali con tutti i dettagli
- **Modifica**: Aggiorna informazioni esistenti
- **Eliminazione**: Rimuovi identità non più necessarie
- **Attivazione/Disattivazione**: Gestisci quale identità è attiva

### 2. Gestione Sedi Multiple
- **Sede Principale**: Identità principale dell'azienda
- **Filiali**: Identità separate per sedi secondarie
- **Codici Sede**: Identificatori univoci per ogni sede

### 3. Branding Completo
- **Logo**: Supporto per diversi formati e dimensioni
- **Colori**: Palette personalizzabile per il brand
- **Font**: Tipografie personalizzabili
- **Stili**: Template predefiniti (corporate, creative, minimal)

## Utilizzo

### Interfaccia Web

1. **Accedi** al sistema con le tue credenziali
2. **Vai** su "Identità Aziendale" nel menu
3. **Crea** una nuova identità o **modifica** quella esistente
4. **Configura** tutti i campi necessari
5. **Carica** i tuoi logo e immagini
6. **Salva** e **attiva** l'identità

### Comando Artisan

```bash
# Lista tutte le identità
php artisan company:identity list

# Crea una nuova identità
php artisan company:identity create

# Crea con parametri
php artisan company:identity create --name="La Mia Azienda" --email="info@miaazienda.it"

# Aggiorna un'identità
php artisan company:identity update

# Elimina un'identità
php artisan company:identity delete

# Attiva un'identità
php artisan company:identity activate
```

### Helper nelle Viste

```php
// Nome azienda
{{ \App\Helpers\CompanyHelper::getCompanyName() }}

// Logo
<img src="{{ \App\Helpers\CompanyHelper::getLogo('large') }}" alt="Logo">

// Colori CSS
@foreach(\App\Helpers\CompanyHelper::getColors() as $variable => $value)
    {{ $variable }}: {{ $value }};
@endforeach

// Contatti
Email: {{ \App\Helpers\CompanyHelper::getEmail() }}
Telefono: {{ \App\Helpers\CompanyHelper::getPhone() }}
```

## Struttura Database

### Tabella: `company_identity`

| Campo | Tipo | Descrizione |
|-------|------|-------------|
| `id` | bigint | ID univoco |
| `company_name` | varchar(255) | Nome azienda |
| `commercial_name` | varchar(255) | Nome commerciale |
| `slogan` | varchar(500) | Slogan/Tagline |
| `website` | varchar(255) | Sito web |
| `email` | varchar(255) | Email di contatto |
| `phone` | varchar(50) | Telefono |
| `mission` | text | Mission aziendale |
| `vision` | text | Vision aziendale |
| `values` | json | Valori aziendali |
| `partita_iva` | varchar(50) | Partita IVA |
| `codice_fiscale` | varchar(50) | Codice fiscale |
| `rea` | varchar(50) | REA |
| `legal_address` | text | Indirizzo legale |
| `pec` | varchar(255) | PEC |
| `sdi` | varchar(50) | Codice SDI |
| `logo_large` | varchar(255) | Logo grande |
| `logo_icon` | varchar(255) | Icona |
| `logo_horizontal` | varchar(255) | Logo orizzontale |
| `logo_vertical` | varchar(255) | Logo verticale |
| `favicon` | varchar(255) | Favicon |
| `primary_color` | varchar(7) | Colore primario |
| `secondary_color` | varchar(7) | Colore secondario |
| `neutral_color` | varchar(7) | Colore neutro |
| `success_color` | varchar(7) | Colore successo |
| `error_color` | varchar(7) | Colore errore |
| `primary_font` | varchar(100) | Font primario |
| `secondary_font` | varchar(100) | Font secondario |
| `style_type` | enum | Tipo stile |
| `social_media` | json | Social media |
| `contact_channels` | json | Canali contatto |
| `branch_code` | varchar(50) | Codice sede |
| `branch_name` | varchar(255) | Nome sede |
| `is_active` | boolean | Stato attivo |
| `created_at` | timestamp | Data creazione |
| `updated_at` | timestamp | Data aggiornamento |

## Configurazione

### File: `config/company.php`

```php
'defaults' => [
    'colors' => [
        'primary' => '#2563eb',
        'secondary' => '#7c3aed',
        // ...
    ],
    'fonts' => [
        'primary' => 'Inter',
        'secondary' => 'Roboto',
        // ...
    ],
    'styles' => [
        'corporate' => 'Stile professionale',
        'creative' => 'Stile moderno',
        'minimal' => 'Stile essenziale',
    ],
],
```

## Best Practices

### 1. Logo e Immagini
- **Formati supportati**: JPEG, PNG, SVG, ICO
- **Dimensioni consigliate**: Segui le specifiche nel config
- **Qualità**: Usa immagini ad alta risoluzione
- **Ottimizzazione**: Comprimi le immagini per il web

### 2. Colori
- **Contrasto**: Assicurati che i colori abbiano sufficiente contrasto
- **Accessibilità**: Rispetta le linee guida WCAG
- **Consistenza**: Mantieni la coerenza in tutta l'applicazione

### 3. Contenuti
- **Mission/Vision**: Scrivi contenuti chiari e concisi
- **Valori**: Limita il numero di valori (3-5 è ideale)
- **Slogan**: Crea frasi memorabili e rappresentative

### 4. Gestione Sedi
- **Codici univoci**: Usa codici chiari e significativi
- **Gerarchia**: Mantieni una struttura logica
- **Attivazione**: Solo un'identità per sede può essere attiva

## Troubleshooting

### Problemi Comuni

1. **Logo non visualizzato**
   - Verifica che il file sia stato caricato correttamente
   - Controlla i permessi della cartella storage
   - Verifica il formato del file

2. **Colori non applicati**
   - Controlla che i colori siano in formato esadecimale (#RRGGBB)
   - Verifica che l'identità sia attiva
   - Controlla la cache del browser

3. **Errore di validazione**
   - Verifica che tutti i campi obbligatori siano compilati
   - Controlla i formati (email, URL, telefono)
   - Verifica le dimensioni dei file

### Log e Debug

```bash
# Verifica lo stato del database
php artisan migrate:status

# Controlla i log
tail -f storage/logs/laravel.log

# Testa la connessione
php artisan tinker
>>> App\Models\CompanyIdentity::count()
```

## Supporto

Per assistenza tecnica o domande:
- Contatta il team di sviluppo
- Consulta la documentazione API
- Verifica i log di sistema
- Controlla la documentazione Laravel

## Aggiornamenti

Il sistema viene aggiornato regolarmente con:
- Nuove funzionalità
- Miglioramenti di sicurezza
- Ottimizzazioni delle performance
- Supporto per nuovi formati

Mantieni sempre aggiornata la tua installazione per beneficiare delle ultime funzionalità.
