@extends('layouts.app')

@section('title', isset($customer) ? 'Fatture per ' . $customer->name : (isset($commessa) ? 'Fatture per Commessa ' . $commessa->codice : (isset($preventivo) ? 'Fatture per Preventivo ' . $preventivo->codice : 'Fatture')))

@section('content')
<div style="max-width: 1400px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Fatture</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">
                            @if(isset($customer))
                                Fatture per {{ $customer->name }}
                            @elseif(isset($commessa))
                                Fatture per Commessa {{ $commessa->codice }}
                            @elseif(isset($preventivo))
                                Fatture per Preventivo {{ $preventivo->codice }}
                            @else
                                Tutte le Fatture
                            @endif
                        </h1>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                @if(isset($customer))
                    <a href="{{ route('customers.show', $customer) }}" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Torna al Cliente
                    </a>
                @elseif(isset($commessa))
                    <a href="{{ route('commesse.show', $commessa) }}" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Torna alla Commessa
                    </a>
                @elseif(isset($preventivo))
                    <a href="{{ route('preventivi.show', $preventivo) }}" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Torna al Preventivo
                    </a>
                @endif
                
                <a href="{{ route('fatture.create') }}" class="item" style="padding: 12px 20px; border: 1px solid var(--efficio-accent); border-radius: 10px; background: var(--efficio-accent); color: #000; display: flex; align-items: center; gap: 8px; font-weight: 600; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Nuova Fattura
                </a>
            </div>
        </div>
    </div>

    <!-- Context Information Cards -->
    @if(isset($customer))
        <div class="card" style="margin-bottom: 24px; padding: 20px; border-left: 4px solid #3b82f6;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--efficio-text);">Cliente: {{ $customer->name }}</h3>
                    <p style="margin: 4px 0 0; color: var(--efficio-muted); font-size: 14px;">
                        {{ $customer->email ?? '—' }} | {{ $customer->phone ?? '—' }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if(isset($commessa))
        <div class="card" style="margin-bottom: 24px; padding: 20px; border-left: 4px solid #22c55e;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--efficio-text);">Commessa: {{ $commessa->codice }}</h3>
                    <p style="margin: 4px 0 0; color: var(--efficio-muted); font-size: 14px;">{{ $commessa->nome }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(isset($preventivo))
        <div class="card" style="margin-bottom: 24px; padding: 20px; border-left: 4px solid #a855f7;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--efficio-text);">Preventivo: {{ $preventivo->codice }}</h3>
                    <p style="margin: 4px 0 0; color: var(--efficio-muted); font-size: 14px;">{{ $preventivo->nome }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Fatture Table -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Lista Fatture</h3>
        </div>
        
        @if($fatture->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Codice</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Emissione</th>
                        @if(!isset($customer))
                            <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Cliente</th>
                        @endif
                        @if(!isset($commessa))
                            <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Commessa</th>
                        @endif
                        @if(!isset($preventivo))
                            <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Preventivo</th>
                        @endif
                        <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Stato</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Totale</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($fatture as $fattura)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.04); transition: background-color 0.2s ease;">
                                <td style="padding: 16px 20px; font-size: 14px; font-weight: 600; color: var(--efficio-text);">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--efficio-accent);"></div>
                                        {{ $fattura->codice }}
                                    </div>
                                </td>
                                <td style="padding: 16px 20px; font-size: 14px; color: var(--efficio-text);">
                                    {{ $fattura->data ? \Carbon\Carbon::parse($fattura->data)->format('d/m/Y') : '—' }}
                                </td>
                                @if(!isset($customer))
                                    <td style="padding: 16px 20px; font-size: 14px; color: var(--efficio-text);">
                                        <a href="{{ route('customers.show', $fattura->customer) }}" style="color: #3b82f6; text-decoration: none; font-weight: 500; transition: color 0.2s ease;">
                                            {{ $fattura->customer->name }}
                                        </a>
                                    </td>
                                @endif
                                @if(!isset($commessa))
                                    <td style="padding: 16px 20px; font-size: 14px; color: var(--efficio-text);">
                                        @if($fattura->commessa)
                                            <a href="{{ route('commesse.show', $fattura->commessa) }}" style="color: #22c55e; text-decoration: none; font-weight: 500; transition: color 0.2s ease;">
                                                {{ $fattura->commessa->codice }}
                                            </a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                @endif
                                @if(!isset($preventivo))
                                    <td style="padding: 16px 20px; font-size: 14px; color: var(--efficio-text);">
                                        @if($fattura->preventivo)
                                            <a href="{{ route('preventivi.show', $fattura->preventivo) }}" style="color: #a855f7; text-decoration: none; font-weight: 500; transition: color 0.2s ease;">
                                                {{ $fattura->preventivo->codice }}
                                            </a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                @endif
                                <td style="padding: 16px 20px;">
                                    @php
                                        $statoColors = [
                                            'bozza' => ['bg' => 'rgba(156, 163, 175, 0.2)', 'text' => '#9ca3af', 'border' => 'rgba(156, 163, 175, 0.3)'],
                                            'inviata' => ['bg' => 'rgba(59, 130, 246, 0.2)', 'text' => '#3b82f6', 'border' => 'rgba(59, 130, 246, 0.3)'],
                                            'pagata' => ['bg' => 'rgba(34, 197, 94, 0.2)', 'text' => '#22c55e', 'border' => 'rgba(34, 197, 94, 0.3)'],
                                            'scaduta' => ['bg' => 'rgba(239, 68, 68, 0.2)', 'text' => '#ef4444', 'border' => 'rgba(239, 68, 68, 0.3)'],
                                        ];
                                        $stato = $fattura->stato ?? 'bozza';
                                        $colors = $statoColors[$stato] ?? $statoColors['bozza'];
                                    @endphp
                                    <span style="padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; background: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; border: 1px solid {{ $colors['border'] }}; text-transform: capitalize;">
                                        {{ $stato }}
                                    </span>
                                </td>
                                <td style="padding: 16px 20px; font-size: 14px; font-weight: 600; color: var(--efficio-text);">
                                    € {{ number_format($fattura->importo_totale ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="padding: 16px 20px;">
                                    <div style="display: flex; gap: 8px;">
                                        <a href="{{ route('fatture.show', $fattura) }}" class="item" style="padding: 6px; border-radius: 6px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); transition: all 0.2s ease;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('fatture.edit', $fattura) }}" class="item" style="padding: 6px; border-radius: 6px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); transition: all 0.2s ease;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 60px 20px; text-align: center;">
                <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0 0 8px; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Nessuna fattura trovata</h3>
                <p style="margin: 0; color: var(--efficio-muted); font-size: 14px;">
                    @if(isset($customer))
                        Questo cliente non ha ancora fatture.
                    @elseif(isset($commessa))
                        Questa commessa non ha ancora fatture.
                    @elseif(isset($preventivo))
                        Questo preventivo non ha ancora fatture.
                    @else
                        Non ci sono ancora fatture nel sistema.
                    @endif
                </p>
                <a href="{{ route('fatture.create') }}" class="item" style="display: inline-flex; align-items: center; gap: 8px; margin-top: 16px; padding: 12px 20px; border: 1px solid var(--efficio-accent); border-radius: 8px; background: var(--efficio-accent); color: #000; font-weight: 600; text-decoration: none;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Crea la prima fattura
                </a>
            </div>
        @endif
    </div>
</div>

<style>
@media (max-width: 768px) {
    .card {
        padding: 16px !important;
    }
    
    div[style*="flex-wrap: wrap"] {
        flex-direction: column;
        width: 100%;
    }
    
    div[style*="flex-wrap: wrap"] .item {
        width: 100%;
        justify-content: center;
    }
    
    h1 {
        font-size: 24px !important;
    }
    
    table {
        font-size: 12px;
    }
    
    th, td {
        padding: 12px 16px !important;
    }
    
    .item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
}
</style>
@endsection
