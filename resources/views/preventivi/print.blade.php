<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preventivo {{ $preventivo->numero }}</title>
    <style>
        @page { margin: 2cm; size: A4; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 12px; line-height: 1.4; color: #000; background: #fff; margin: 0; padding: 0; }
        .header { border-bottom: 3px solid #000; padding-bottom: 20px; margin-bottom: 30px; }
        .company-info { float: left; width: 60%; }
        .company-logo { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        .company-details { font-size: 11px; line-height: 1.3; }
        .document-title { float: right; text-align: right; width: 35%; }
        .document-title h1 { font-size: 32px; font-weight: bold; margin: 0 0 10px 0; text-transform: uppercase; }
        .clear { clear: both; }
        .section { margin-bottom: 25px; }
        .section-title { font-size: 14px; font-weight: bold; text-transform: uppercase; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 15px; }
        .info-grid { display: table; width: 100%; }
        .info-row { display: table-row; }
        .info-label { display: table-cell; width: 30%; font-weight: bold; padding: 3px 0; }
        .info-value { display: table-cell; width: 70%; padding: 3px 0; }
        .customer-section { float: left; width: 48%; }
        .preventivo-section { float: right; width: 48%; }
        .items-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .items-table th { background: #f5f5f5; border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; }
        .items-table td { border: 1px solid #ddd; padding: 8px; }
        .items-table .text-right { text-align: right; }
        .totals-section { float: right; width: 40%; margin-top: 20px; }
        .total-row { display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #eee; }
        .total-row.grand-total { font-weight: bold; font-size: 16px; border-bottom: 2px solid #000; margin-top: 10px; }
        .validity-section { clear: both; margin-top: 30px; }
        .footer { margin-top: 40px; text-align: center; border-top: 1px solid #000; padding-top: 20px; }
        .signature { margin-top: 30px; text-align: right; }
        .signature-line { border-top: 1px solid #000; width: 200px; margin-left: auto; margin-top: 30px; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .status-bozza { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }
        .status-inviato { background: #dbeafe; color: #1e40af; border: 1px solid #93c5fd; }
        .status-accettato { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .status-rifiutato { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .status-scaduto { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
        @media print { body { margin: 0; } .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <div class="company-logo">[LOGO EFFICIO]</div>
            <div class="company-details">
                <strong>EFFICIO</strong><br>Sistema di Gestione Aziendale<br>Via del Progresso, 123<br>00100 Roma, Italia<br>Tel: +39 06 1234567<br>Email: info@efficio.it
            </div>
        </div>
        <div class="document-title">
            <h1>PREVENTIVO</h1>
            <div class="info-grid">
                <div class="info-row"><div class="info-label">Numero:</div><div class="info-value">{{ $preventivo->numero }}</div></div>
                <div class="info-row"><div class="info-label">Data:</div><div class="info-value">{{ $preventivo->data ? \Carbon\Carbon::parse($preventivo->data)->format('d/m/Y') : 'Non specificata' }}</div></div>
                <div class="info-row"><div class="info-label">Scadenza:</div><div class="info-value">{{ $preventivo->data_scadenza ? \Carbon\Carbon::parse($preventivo->data_scadenza)->format('d/m/Y') : 'Non specificata' }}</div></div>
                <div class="info-row"><div class="info-label">Stato:</div><div class="info-value">
                    <span class="status-badge status-{{ $preventivo->stato }}">
                        {{ ucfirst($preventivo->stato) }}
                    </span>
                </div></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="section">
        <div class="customer-section">
            <div class="section-title">CLIENTE</div>
            <div class="info-grid">
                <div class="info-row"><div class="info-label">Nome:</div><div class="info-value">{{ $preventivo->customer->name ?? 'Non specificato' }}</div></div>
                <div class="info-row"><div class="info-label">Email:</div><div class="info-value">{{ $preventivo->customer->email ?? 'Non specificata' }}</div></div>
                <div class="info-row"><div class="info-label">Telefono:</div><div class="info-value">{{ $preventivo->customer->phone ?? 'Non specificato' }}</div></div>
                <div class="info-row"><div class="info-label">Indirizzo:</div><div class="info-value">@if($preventivo->customer->street || $preventivo->customer->city || $preventivo->customer->zip){{ $preventivo->customer->street ?? '' }} {{ $preventivo->customer->city ?? '' }} {{ $preventivo->customer->zip ?? '' }}@else Non specificato @endif</div></div>
            </div>
        </div>
        <div class="preventivo-section">
            <div class="section-title">DETTAGLI PREVENTIVO</div>
            <div class="info-grid">
                <div class="info-row"><div class="info-label">Commessa:</div><div class="info-value">{{ $preventivo->commessa->codice ?? 'Non specificata' }}</div></div>
                <div class="info-row"><div class="info-label">Progetto:</div><div class="info-value">{{ $preventivo->project->name ?? 'Non specificato' }}</div></div>
                <div class="info-row"><div class="info-label">Creato da:</div><div class="info-value">{{ $preventivo->creator->name ?? 'Non specificato' }}</div></div>
                <div class="info-row"><div class="info-label">Note:</div><div class="info-value">{{ $preventivo->note ?? 'Nessuna nota' }}</div></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="section">
        <div class="section-title">DETTAGLIO SERVIZI E ARTICOLI</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>DESCRIZIONE</th>
                    <th class="text-right">PREZZO UNIT.</th>
                    <th class="text-right">QUANTITÀ</th>
                    <th class="text-right">SCONTO</th>
                    <th class="text-right">TOTALE</th>
                </tr>
            </thead>
            <tbody>
                @forelse($preventivo->righe as $riga)
                    <tr>
                        <td>
                            @if($riga->tipo_riga === 'articolo' && $riga->articolo)
                                <strong>{{ $riga->articolo->nome }}</strong>
                                @if($riga->note)<br><small>{{ $riga->note }}</small>@endif
                            @else
                                {{ $riga->descrizione ?? 'Servizio' }}
                            @endif
                            <br><small style="color: #666;">
                                @if($riga->tipo_riga === 'articolo') Articolo
                                @elseif($riga->tipo_riga === 'manodopera') Manodopera
                                @else Servizio
                                @endif
                            </small>
                        </td>
                        <td class="text-right">€ {{ number_format($riga->prezzo_unitario ?? 0, 2, ',', '.') }}</td>
                        <td class="text-right">{{ $riga->quantita ?? 1 }} {{ $riga->getUnitaMisura() }}</td>
                        <td class="text-right">
                            @if($riga->sconto_percentuale > 0)
                                {{ $riga->sconto_percentuale }}%
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right">€ {{ number_format($riga->getImportoScontato(), 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align: center; padding: 20px; color: #666;">Nessuna riga presente</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="totals-section">
        <div class="total-row"><span>SUB TOTALE:</span><span>€ {{ number_format($preventivo->importo_netto ?? 0, 2, ',', '.') }}</span></div>
        <div class="total-row"><span>IVA 22%:</span><span>€ {{ number_format($preventivo->importo_iva ?? 0, 2, ',', '.') }}</span></div>
        <div class="total-row grand-total"><span>TOTALE COMPLESSIVO:</span><span>€ {{ number_format($preventivo->importo_totale ?? 0, 2, ',', '.') }}</span></div>
    </div>

    <div class="validity-section">
        <div class="section-title">VALIDITÀ E ACCETTAZIONE</div>
        <div class="info-grid">
            <div class="info-row"><div class="info-label">Validità:</div><div class="info-value">
                @if($preventivo->data_scadenza)
                    Questo preventivo è valido fino al {{ \Carbon\Carbon::parse($preventivo->data_scadenza)->format('d/m/Y') }}
                @else
                    Validità non specificata
                @endif
            </div></div>
            @if($preventivo->stato === 'accettato' && $preventivo->accettatoDa)
                <div class="info-row"><div class="info-label">Accettato da:</div><div class="info-value">{{ $preventivo->accettatoDa->name }} il {{ \Carbon\Carbon::parse($preventivo->data_accettazione)->format('d/m/Y') }}</div></div>
            @endif
        </div>
    </div>

    <div class="footer">
        <div class="signature">
            <div class="signature-line"></div>
            <strong>Responsabile Preventivo</strong><br>Efficio Team
        </div>
        <div style="margin-top: 20px; text-align: center;">
            <strong>GRAZIE PER LA COLLABORAZIONE</strong><br>www.efficio.it
        </div>
    </div>
</body>
</html>
