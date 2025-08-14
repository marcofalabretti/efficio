<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commessa {{ $commessa->codice }}</title>
    <style>
        @page {
            margin: 2cm;
            size: A4;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 0;
        }
        
        .header {
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-info {
            float: left;
            width: 60%;
        }
        
        .company-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .company-details {
            font-size: 11px;
            line-height: 1.3;
        }
        
        .document-title {
            float: right;
            text-align: right;
            width: 35%;
        }
        
        .document-title h1 {
            font-size: 32px;
            font-weight: bold;
            margin: 0 0 10px 0;
            text-transform: uppercase;
        }
        
        .clear {
            clear: both;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
            padding: 3px 0;
        }
        
        .info-value {
            display: table-cell;
            width: 70%;
            padding: 3px 0;
        }
        
        .customer-section {
            float: left;
            width: 48%;
        }
        
        .project-section {
            float: right;
            width: 48%;
        }
        
        .timeline-section {
            clear: both;
            margin-top: 20px;
        }
        
        .timeline-item {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }
        
        .timeline-date {
            font-weight: bold;
            color: #333;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 20px;
        }
        
        .signature {
            margin-top: 30px;
            text-align: right;
        }
        
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-left: auto;
            margin-top: 30px;
        }
        
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <div class="company-logo">
                [LOGO EFFICIO]
            </div>
            <div class="company-details">
                <strong>EFFICIO</strong><br>
                Sistema di Gestione Aziendale<br>
                Via del Progresso, 123<br>
                00100 Roma, Italia<br>
                Tel: +39 06 1234567<br>
                Email: info@efficio.it
            </div>
        </div>
        
        <div class="document-title">
            <h1>COMMESSA</h1>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Codice:</div>
                    <div class="info-value">{{ $commessa->codice }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Data Inizio:</div>
                    <div class="info-value">{{ $commessa->data_inizio ? \Carbon\Carbon::parse($commessa->data_inizio)->format('d/m/Y') : 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Data Fine:</div>
                    <div class="info-value">{{ $commessa->data_fine_prevista ? \Carbon\Carbon::parse($commessa->data_fine_prevista)->format('d/m/Y') : 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Stato:</div>
                    <div class="info-value">{{ ucfirst($commessa->stato) }}</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="section">
        <div class="customer-section">
            <div class="section-title">CLIENTE</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nome:</div>
                    <div class="info-value">{{ $commessa->customer->name ?? 'Non specificato' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $commessa->customer->email ?? 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telefono:</div>
                    <div class="info-value">{{ $commessa->customer->phone ?? 'Non specificato' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Indirizzo:</div>
                    <div class="info-value">
                        @if($commessa->customer->street || $commessa->customer->city || $commessa->customer->zip)
                            {{ $commessa->customer->street ?? '' }} {{ $commessa->customer->city ?? '' }} {{ $commessa->customer->zip ?? '' }}
                        @else
                            Non specificato
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="project-section">
            <div class="section-title">PROGETTO</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nome:</div>
                    <div class="info-value">{{ $commessa->project->name ?? 'Non specificato' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Descrizione:</div>
                    <div class="info-value">{{ $commessa->project->description ?? 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Responsabile:</div>
                    <div class="info-value">
                        @if($commessa->project && $commessa->project->manager)
                            {{ $commessa->project->manager->name ?? 'Non specificato' }}
                        @else
                            Non specificato
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="timeline-section">
        <div class="section-title">TEMPISTICHE E MILESTONE</div>
        @if($commessa->data_inizio && $commessa->data_fine_prevista)
            <div class="timeline-item">
                <div class="timeline-date">Inizio Progetto: {{ \Carbon\Carbon::parse($commessa->data_inizio)->format('d/m/Y') }}</div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">Fine Progetto: {{ \Carbon\Carbon::parse($commessa->data_fine_prevista)->format('d/m/Y') }}</div>
            </div>
            @php
                $durata = \Carbon\Carbon::parse($commessa->data_inizio)->diffInDays(\Carbon\Carbon::parse($commessa->data_fine_prevista));
            @endphp
            <div class="timeline-item">
                <div class="timeline-date">Durata Totale: {{ $durata }} giorni</div>
            </div>
        @else
            <div class="timeline-item">
                <div class="timeline-date">Tempistiche non ancora definite</div>
            </div>
        @endif
    </div>

    <div class="footer">
        <div class="signature">
            <div class="signature-line"></div>
            <strong>Responsabile Commessa</strong><br>
            Efficio Team
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <strong>GRAZIE PER LA COLLABORAZIONE</strong><br>
            www.efficio.it
        </div>
    </div>
</body>
</html>
