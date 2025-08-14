<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fattura {{ $fattura->numero }}</title>
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
        
        .fattura-section {
            float: right;
            width: 48%;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .items-table th {
            background: #f5f5f5;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .totals-section {
            float: right;
            width: 40%;
            margin-top: 20px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        
        .total-row.grand-total {
            font-weight: bold;
            font-size: 16px;
            border-bottom: 2px solid #000;
            margin-top: 10px;
        }
        
        .payment-section {
            clear: both;
            margin-top: 30px;
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
            <h1>FATTURA</h1>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Numero:</div>
                    <div class="info-value">{{ $fattura->numero }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Data Emissione:</div>
                    <div class="info-value">{{ $fattura->data_emissione ? \Carbon\Carbon::parse($fattura->data_emissione)->format('d/m/Y') : 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Data Scadenza:</div>
                    <div class="info-value">{{ $fattura->data_scadenza ? \Carbon\Carbon::parse($fattura->data_scadenza)->format('d/m/Y') : 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Stato:</div>
                    <div class="info-value">{{ ucfirst($fattura->stato) }}</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="section">
        <div class="customer-section">
            <div class="section-title">FATTURARE A</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nome:</div>
                    <div class="info-value">{{ $fattura->customer->name ?? 'Non specificato' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $fattura->customer->email ?? 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telefono:</div>
                    <div class="info-value">{{ $fattura->customer->phone ?? 'Non specificato' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Indirizzo:</div>
                    <div class="info-value">
                        @if($fattura->customer->street || $fattura->customer->city || $fattura->customer->zip)
                            {{ $fattura->customer->street ?? '' }} {{ $fattura->customer->city ?? '' }} {{ $fattura->customer->zip ?? '' }}
                        @else
                            Non specificato
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="fattura-section">
            <div class="section-title">DETTAGLI FATTURA</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Commessa:</div>
                    <div class="info-value">{{ $fattura->commessa->codice ?? 'Non specificata' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Preventivo:</div>
                    <div class="info-value">{{ $fattura->preventivo->numero ?? 'Non specificato' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Note:</div>
                    <div class="info-value">{{ $fattura->note ?? 'Nessuna nota' }}</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="section">
        <div class="section-title">DETTAGLIO SERVIZI</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>DESCRIZIONE</th>
                    <th class="text-right">PREZZO</th>
                    <th class="text-right">QUANTITÀ</th>
                    <th class="text-right">TOTALE</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fattura->righe as $riga)
                    <tr>
                        <td>{{ $riga->descrizione ?? 'Servizio' }}</td>
                        <td class="text-right">€ {{ number_format($riga->prezzo_unitario ?? 0, 2, ',', '.') }}</td>
                        <td class="text-right">{{ $riga->quantita ?? 1 }}</td>
                        <td class="text-right">€ {{ number_format(($riga->prezzo_unitario ?? 0) * ($riga->quantita ?? 1), 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px; color: #666;">
                            Nessuna riga presente
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="totals-section">
        <div class="total-row">
            <span>SUB TOTALE:</span>
            <span>€ {{ number_format($fattura->importo_totale ?? 0, 2, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>IVA {{ $fattura->percentuale_iva ?? 22 }}%:</span>
            <span>€ {{ number_format((($fattura->importo_totale ?? 0) * ($fattura->percentuale_iva ?? 22) / 100), 2, ',', '.') }}</span>
        </div>
        <div class="total-row grand-total">
            <span>TOTALE COMPLESSIVO:</span>
            <span>€ {{ number_format(($fattura->importo_totale ?? 0) * (1 + ($fattura->percentuale_iva ?? 22) / 100), 2, ',', '.') }}</span>
        </div>
    </div>

    <div class="payment-section">
        <div class="section-title">METODO DI PAGAMENTO</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Stato Pagamento:</div>
                <div class="info-value">
                    @if($fattura->stato === 'pagata')
                        Completamente Pagata
                    @elseif($fattura->stato === 'parzialmente_pagata')
                        Parzialmente Pagata
                    @else
                        In Attesa di Pagamento
                    @endif
                </div>
            </div>
            @if($fattura->pagamenti && $fattura->pagamenti->count() > 0)
                <div class="info-row">
                    <div class="info-label">Pagamenti Effettuati:</div>
                    <div class="info-value">
                        @foreach($fattura->pagamenti as $pagamento)
                            € {{ number_format($pagamento->importo, 2, ',', '.') }} - {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}<br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <div class="signature">
            <div class="signature-line"></div>
            <strong>Responsabile Fatturazione</strong><br>
            Efficio Team
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <strong>GRAZIE PER LA COLLABORAZIONE</strong><br>
            www.efficio.it
        </div>
    </div>
</body>
</html>
