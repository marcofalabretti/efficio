@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 24px;">
    <!-- Header della Commessa -->
    <div class="card" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 16px; padding: 32px; margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 24px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span style="font-size: 14px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600;">Commessa</span>
                </div>
                <h1 style="margin: 0; font-size: 32px; font-weight: 700; color: var(--efficio-text); line-height: 1.2;">
                    {{ $commessa->codice }} - {{ $commessa->nome }}
                </h1>
                @if($commessa->descrizione)
                    <p style="margin: 16px 0 0; font-size: 16px; color: var(--efficio-muted); line-height: 1.6; max-width: 600px;">
                        {{ Str::limit($commessa->descrizione, 150) }}
                    </p>
                @endif
            </div>
            <div style="display: flex; gap: 12px; flex-shrink: 0;">
                <a href="{{ route('commesse.edit', $commessa) }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 10px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Modifica
                </a>
                <a href="{{ route('commesse.index') }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; background: rgba(255, 255, 255, 0.05); color: var(--efficio-text); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Torna alle Commesse
                </a>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 24px; margin-bottom: 24px;">
        <!-- Dettagli Principali -->
        <div class="card" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; padding: 32px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                </svg>
                <h2 style="margin: 0; font-size: 24px; font-weight: 600; color: var(--efficio-text);">Dettagli Commessa</h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px;">
                <div>
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 8px; font-weight: 600;">Codice</div>
                    <div style="font-weight: 600; font-size: 20px; color: var(--efficio-text);">{{ $commessa->codice }}</div>
                </div>
                
                <div>
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 8px; font-weight: 600;">Stato</div>
                    <span style="padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; display: inline-block;
                        @if($commessa->stato === 'attiva')
                            background: rgba(34, 197, 94, 0.1); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.2);
                        @elseif($commessa->stato === 'completata')
                            background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2);
                        @elseif($commessa->stato === 'sospesa')
                            background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2);
                        @else
                            background: rgba(156, 163, 175, 0.1); color: #9ca3af; border: 1px solid rgba(156, 163, 175, 0.2);
                        @endif">
                        {{ ucfirst($commessa->stato) }}
                    </span>
                </div>
                
                <div>
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 8px; font-weight: 600;">Data Inizio</div>
                    <div style="font-weight: 600; color: var(--efficio-text); font-size: 16px;">
                        @if($commessa->data_inizio)
                            {{ $commessa->data_inizio->format('d/m/Y') }}
                        @else
                            <span style="color: var(--efficio-muted);">Non specificata</span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 8px; font-weight: 600;">Data Fine Prevista</div>
                    <div style="font-weight: 600; color: var(--efficio-text); font-size: 16px;">
                        @if($commessa->data_fine_prevista)
                            {{ $commessa->data_fine_prevista->format('d/m/Y') }}
                        @else
                            <span style="color: var(--efficio-muted);">Non specificata</span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 8px; font-weight: 600;">Budget</div>
                    <div style="font-weight: 700; font-size: 24px; color: var(--efficio-text);">
                        @if($commessa->budget)
                            € {{ number_format($commessa->budget, 2, ',', '.') }}
                        @else
                            <span style="color: var(--efficio-muted); font-size: 16px;">Non specificato</span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 8px; font-weight: 600;">Ore Stimate</div>
                    <div style="font-weight: 600; color: var(--efficio-text); font-size: 16px;">
                        @if($commessa->ore_stimate)
                            {{ $commessa->ore_stimate }} ore
                        @else
                            <span style="color: var(--efficio-muted);">Non specificate</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($commessa->descrizione && strlen($commessa->descrizione) > 150)
                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid rgba(255, 255, 255, 0.05);">
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 12px; font-weight: 600;">Descrizione Completa</div>
                    <div style="line-height: 1.7; color: var(--efficio-text); font-size: 15px;">{{ $commessa->descrizione }}</div>
                </div>
            @endif

            @if($commessa->note)
                <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid rgba(255, 255, 255, 0.05);">
                    <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 12px; font-weight: 600;">Note</div>
                    <div style="line-height: 1.7; color: var(--efficio-text); font-size: 15px;">{{ $commessa->note }}</div>
                </div>
            @endif
        </div>

        <!-- Sidebar Collegamenti -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <!-- Collegamenti -->
            <div class="card" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; padding: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                    </svg>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Collegamenti</h3>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 6px; font-weight: 600;">Cliente</div>
                        @if($commessa->customer)
                            <a href="{{ route('customers.show', $commessa->customer) }}" class="item" style="display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 10px; background: rgba(59, 130, 246, 0.05); border: 1px solid rgba(59, 130, 246, 0.1); color: #3b82f6; text-decoration: none; font-weight: 500; transition: all 0.2s ease;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                {{ $commessa->customer->name }}
                            </a>
                        @else
                            <div style="padding: 12px; border-radius: 10px; background: rgba(156, 163, 175, 0.05); border: 1px solid rgba(156, 163, 175, 0.1); color: var(--efficio-muted); font-size: 14px;">
                                Nessun cliente assegnato
                            </div>
                        @endif
                    </div>

                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 6px; font-weight: 600;">Progetto</div>
                        @if($commessa->project)
                            <a href="{{ route('projects.show', $commessa->project) }}" class="item" style="display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 10px; background: rgba(147, 51, 234, 0.05); border: 1px solid rgba(147, 51, 234, 0.1); color: #9333ea; text-decoration: none; font-weight: 500; transition: all 0.2s ease;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                    <path d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"/>
                                </svg>
                                {{ $commessa->project->name }}
                            </a>
                        @else
                            <div style="padding: 12px; border-radius: 10px; background: rgba(156, 163, 175, 0.05); border: 1px solid rgba(156, 163, 175, 0.1); color: var(--efficio-muted); font-size: 14px;">
                                Nessun progetto assegnato
                            </div>
                        @endif
                    </div>

                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 6px; font-weight: 600;">Responsabile</div>
                        @if($commessa->responsabile)
                            <div style="display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 10px; background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.1); color: #22c55e;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                {{ $commessa->responsabile->name }}
                            </div>
                        @else
                            <div style="padding: 12px; border-radius: 10px; background: rgba(156, 163, 175, 0.05); border: 1px solid rgba(156, 163, 175, 0.1); color: var(--efficio-muted); font-size: 14px;">
                                Non assegnato
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistiche -->
            <div class="card" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; padding: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3v18h18"/>
                        <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                    </svg>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Statistiche</h3>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <a href="{{ route('commesse.preventivi', $commessa) }}" class="item" style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border-radius: 10px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); color: var(--efficio-text); text-decoration: none; transition: all 0.2s ease;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span style="font-weight: 500;">Preventivi</span>
                        </div>
                        <span style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 600;">{{ $commessa->preventivi->count() }}</span>
                    </a>
                    
                    <a href="{{ route('commesse.fatture', $commessa) }}" class="item" style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border-radius: 10px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); color: var(--efficio-text); text-decoration: none; transition: all 0.2s ease;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                <polyline points="14,2 14,8 20,8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10,9 9,9 8,9"/>
                            </svg>
                            <span style="font-weight: 500;">Fatture</span>
                        </div>
                        <span style="background: rgba(34, 197, 94, 0.1); color: #22c55e; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 600;">{{ $commessa->fatture->count() }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Azioni Rapide -->
    <div class="card" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; padding: 32px; text-align: center;">
        <h3 style="margin: 0 0 24px 0; font-size: 20px; font-weight: 600; color: var(--efficio-text);">Azioni Rapide</h3>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('preventivi.create', ['commessa_id' => $commessa->id]) }}" class="item" style="padding: 16px 24px; border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 12px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 10px; transition: all 0.2s ease; min-width: 180px; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Nuovo Preventivo
            </a>
            <a href="{{ route('fatture.create', ['commessa_id' => $commessa->id]) }}" class="item" style="padding: 16px 24px; border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 12px; background: rgba(34, 197, 94, 0.1); color: #22c55e; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 10px; transition: all 0.2s ease; min-width: 180px; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                    <polyline points="14,2 14,8 20,8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10,9 9,9 8,9"/>
                </svg>
                Nuova Fattura
            </a>
        </div>
        
        <!-- Azioni Documento -->
        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
            <h4 style="margin: 0 0 20px 0; font-size: 16px; font-weight: 600; color: var(--efficio-muted);">Gestione Documento</h4>
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('commesse.pdf', $commessa->id) }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 10px; background: rgba(239, 68, 68, 0.1); color: #ef4444; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14,2 14,8 20,8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10,9 9,9 8,9"/>
                    </svg>
                    Genera PDF
                </a>
                <button onclick="window.print()" class="item" style="padding: 12px 20px; border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 10px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease; cursor: pointer; border: none; font-family: inherit;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Stampa
                </button>
                <button onclick="sendEmail()" class="item" style="padding: 12px 20px; border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 10px; background: rgba(34, 197, 94, 0.1); color: #22c55e; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease; cursor: pointer; border: none; font-family: inherit;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Invia Email
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .container {
        padding: 16px;
    }
    
    .container > div:first-child {
        grid-template-columns: 1fr;
    }
    
    .card {
        padding: 20px !important;
    }
    
    .container > div:nth-child(2) {
        grid-template-columns: 1fr;
    }
    
    .container > div:nth-child(2) > div:last-child {
        order: -1;
    }
}

.item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.card {
    transition: all 0.2s ease;
}

.card:hover {
    border-color: rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}
</style>

<script>
function sendEmail() {
    // Per ora mostra un messaggio informativo
    // In futuro implementeremo l'invio email con PDF allegato
    alert('Funzionalità di invio email in fase di sviluppo. Per ora puoi utilizzare "Genera PDF" per scaricare il documento.');
}
</script>
@endsection
