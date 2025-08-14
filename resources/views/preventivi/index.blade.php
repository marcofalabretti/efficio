@extends('layouts.app')

@section('title', isset($customer) ? 'Preventivi per ' . $customer->name : (isset($commessa) ? 'Preventivi per Commessa ' . $commessa->codice : 'Preventivi'))

@section('content')
<div style="min-height: 100vh; background: var(--efficio-bg); padding: 2rem 1rem;">
    <div style="max-width: 1400px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; background: var(--efficio-surface); padding: 1.5rem; border-radius: 16px; border: var(--border); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #a855f7 0%, #c084fc 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 1.875rem; font-weight: 700; color: var(--efficio-text); margin: 0;">
                    @if(isset($customer))
                        Preventivi per {{ $customer->name }}
                    @elseif(isset($commessa))
                        Preventivi per Commessa {{ $commessa->codice }}
                    @else
                        Tutti i Preventivi
                    @endif
                </h1>
                <p style="color: var(--efficio-muted); margin: 0.25rem 0 0 0; font-size: 1rem;">
                    @if(isset($customer))
                        Gestisci i preventivi per questo cliente
                    @elseif(isset($commessa))
                        Gestisci i preventivi per questa commessa
                    @else
                        Gestisci tutti i preventivi del sistema
                    @endif
                </p>
            </div>
            <div style="margin-left: auto; display: flex; gap: 0.75rem; flex-wrap: wrap;">
                @if(isset($customer))
                    <a href="{{ route('customers.show', $customer) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--efficio-muted); color: var(--efficio-text); padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; transition: all 0.2s; font-weight: 500; border: var(--border);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Torna al Cliente
                    </a>
                @elseif(isset($commessa))
                    <a href="{{ route('commesse.show', $commessa) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--efficio-muted); color: var(--efficio-text); padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; transition: all 0.2s; font-weight: 500; border: var(--border);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Torna alla Commessa
                    </a>
                @endif
                
                <a href="{{ route('preventivi.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--efficio-accent); color: var(--efficio-bg); padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; transition: all 0.2s; font-weight: 600; box-shadow: var(--efficio-glow);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Nuovo Preventivo
                </a>
            </div>
        </div>

        <!-- Context Information Cards -->
        @if(isset($customer))
            <div style="background: var(--efficio-surface); border-radius: 16px; border: var(--border); padding: 1.5rem; margin-bottom: 2rem; border-left: 4px solid #3b82f6;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; background: rgba(59, 130, 246, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <h3 style="margin: 0; font-size: 1.125rem; font-weight: 600; color: var(--efficio-text);">Cliente: {{ $customer->name }}</h3>
                        <p style="margin: 0.25rem 0 0 0; color: var(--efficio-muted); font-size: 0.875rem;">
                            {{ $customer->email ?? '—' }} | {{ $customer->phone ?? '—' }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($commessa))
            <div style="background: var(--efficio-surface); border-radius: 16px; border: var(--border); padding: 1.5rem; margin-bottom: 2rem; border-left: 4px solid #22c55e;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; background: rgba(34, 197, 94, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h3 style="margin: 0; font-size: 1.125rem; font-weight: 600; color: var(--efficio-text);">Commessa: {{ $commessa->codice }}</h3>
                        <p style="margin: 0.25rem 0 0 0; color: var(--efficio-muted); font-size: 0.875rem;">{{ $commessa->nome }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Preventivi Table -->
        <div style="background: var(--efficio-surface); border-radius: 16px; border: var(--border); overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: var(--border); background: rgba(255,255,255,0.02);">
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: var(--efficio-text);">Lista Preventivi</h3>
            </div>
            
            @if($preventivi->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: rgba(255,255,255,0.02); border-bottom: var(--border);">
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Codice</th>
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Nome</th>
                                @if(!isset($customer))
                                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Cliente</th>
                                @endif
                                @if(!isset($commessa))
                                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Commessa</th>
                                @endif
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Stato</th>
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Data Creazione</th>
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Valore</th>
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preventivi as $preventivo)
                                <tr style="border-bottom: var(--border); transition: background-color 0.2s ease;">
                                    <td style="padding: 1rem 1.25rem; font-size: 0.875rem; font-weight: 600; color: var(--efficio-text);">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 8px; height: 8px; border-radius: 50%; background: #a855f7;"></div>
                                            {{ $preventivo->codice }}
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 1.25rem; font-size: 0.875rem; color: var(--efficio-text);">
                                        {{ $preventivo->nome }}
                                    </td>
                                    @if(!isset($customer))
                                        <td style="padding: 1rem 1.25rem; font-size: 0.875rem; color: var(--efficio-text);">
                                            <a href="{{ route('customers.show', $preventivo->customer) }}" style="color: #3b82f6; text-decoration: none; font-weight: 500; transition: color 0.2s ease;">
                                                {{ $preventivo->customer->name }}
                                            </a>
                                        </td>
                                    @endif
                                    @if(!isset($commessa))
                                        <td style="padding: 1rem 1.25rem; font-size: 0.875rem; color: var(--efficio-text);">
                                            @if($preventivo->commessa)
                                                <a href="{{ route('commesse.show', $preventivo->commessa) }}" style="color: #22c55e; text-decoration: none; font-weight: 500; transition: color 0.2s ease;">
                                                    {{ $preventivo->commessa->codice }}
                                                </a>
                                            @else
                                                —
                                            @endif
                                        </td>
                                    @endif
                                    <td style="padding: 1rem 1.25rem;">
                                        @php
                                            $statoColors = [
                                                'bozza' => ['bg' => 'rgba(255,255,255,0.05)', 'text' => 'var(--efficio-muted)', 'border' => 'var(--border)'],
                                                'inviato' => ['bg' => 'rgba(59,130,246,0.1)', 'text' => '#60a5fa', 'border' => 'rgba(59,130,246,0.2)'],
                                                'accettato' => ['bg' => 'rgba(34,197,94,0.1)', 'text' => '#22c55e', 'border' => 'rgba(34,197,94,0.2)'],
                                                'rifiutato' => ['bg' => 'rgba(239,68,68,0.1)', 'text' => '#ef4444', 'border' => 'rgba(239,68,68,0.2)'],
                                                'scaduto' => ['bg' => 'rgba(245,158,11,0.1)', 'text' => '#f59e0b', 'border' => 'rgba(245,158,11,0.2)'],
                                            ];
                                            $stato = $preventivo->stato ?? 'bozza';
                                            $colors = $statoColors[$stato] ?? $statoColors['bozza'];
                                        @endphp
                                        <span style="padding: 0.375rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500; background: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; border: 1px solid {{ $colors['border'] }}; text-transform: capitalize;">
                                            {{ $stato }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem 1.25rem; font-size: 0.875rem; color: var(--efficio-text);">
                                        {{ $preventivo->created_at ? \Carbon\Carbon::parse($preventivo->created_at)->format('d/m/Y') : '—' }}
                                    </td>
                                    <td style="padding: 1rem 1.25rem; font-size: 0.875rem; font-weight: 600; color: var(--efficio-text);">
                                        € {{ number_format($preventivo->valore ?? 0, 2, ',', '.') }}
                                    </td>
                                    <td style="padding: 1rem 1.25rem;">
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ route('preventivi.show', $preventivo) }}" style="padding: 0.5rem; border-radius: 8px; background: rgba(255,255,255,0.05); border: var(--border); transition: all 0.2s ease; display: flex; align-items: center; justify-content: center;">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('preventivi.edit', $preventivo) }}" style="padding: 0.5rem; border-radius: 8px; background: rgba(255,255,255,0.05); border: var(--border); transition: all 0.2s ease; display: flex; align-items: center; justify-content: center;">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
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
                <div style="padding: 4rem 1.5rem; text-align: center;">
                    <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; border: var(--border);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                            <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0 0 0.5rem; font-size: 1.125rem; font-weight: 600; color: var(--efficio-text);">Nessun preventivo trovato</h3>
                    <p style="margin: 0; color: var(--efficio-muted); font-size: 0.875rem;">
                        @if(isset($customer))
                            Questo cliente non ha ancora preventivi.
                        @elseif(isset($commessa))
                            Questa commessa non ha ancora preventivi.
                        @else
                            Non ci sono ancora preventivi nel sistema.
                        @endif
                    </p>
                    <a href="{{ route('preventivi.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 1rem; padding: 0.75rem 1.5rem; border: 1px solid var(--efficio-accent); border-radius: 8px; background: var(--efficio-accent); color: var(--efficio-bg); font-weight: 600; text-decoration: none; transition: all 0.2s; box-shadow: var(--efficio-glow);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Crea il primo preventivo
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    div[style*="flex-wrap: wrap"] {
        flex-direction: column;
        width: 100%;
    }
    
    div[style*="flex-wrap: wrap"] a {
        width: 100%;
        justify-content: center;
    }
    
    h1 {
        font-size: 1.5rem !important;
    }
    
    table {
        font-size: 0.75rem;
    }
    
    th, td {
        padding: 0.75rem 1rem !important;
    }
    
    a:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
}
</style>
@endsection
