@extends('layouts.app')

@section('title', 'Preventivo ' . $preventivo->codice)

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, var(--efficio-accent) 0%, #a3e635 100%); display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                            <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Preventivo</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">{{ $preventivo->codice }}</h1>
                        <p style="margin: 4px 0 0 0; color: var(--efficio-muted); font-size: 16px;">{{ $preventivo->nome }}</p>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('preventivi.index') }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Lista Preventivi
                </a>
                <a href="{{ route('preventivi.edit', $preventivo) }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Modifica
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
        <!-- Dettagli Preventivo -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #6366f1;">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Dettagli Preventivo</h3>
            </div>
            
            <div style="display: grid; gap: 16px;">
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Codice</div>
                        <div style="color: var(--efficio-text); font-weight: 500; font-family: monospace; font-size: 14px;">{{ $preventivo->codice }}</div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Nome</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">{{ $preventivo->nome }}</div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Stato</div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="display: inline-flex; align-items: center; padding: 4px 12px; font-size: 12px; font-weight: 600; border-radius: 20px; 
                                @if($preventivo->stato === 'approvato') background: rgba(34, 197, 94, 0.2); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.3);
                                @elseif($preventivo->stato === 'in_attesa') background: rgba(245, 158, 11, 0.2); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3);
                                @elseif($preventivo->stato === 'rifiutato') background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);
                                @else background: rgba(156, 163, 175, 0.2); color: #9ca3af; border: 1px solid rgba(156, 163, 175, 0.3);
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $preventivo->stato)) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Valore</div>
                        <div style="color: var(--efficio-text); font-weight: 600; font-size: 16px;">€{{ number_format($preventivo->importo_totale ?? 0, 2, ',', '.') }}</div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Data Creazione</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">{{ $preventivo->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>

                @if($preventivo->data_scadenza)
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Data Scadenza</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">{{ $preventivo->data_scadenza->format('d/m/Y') }}</div>
                    </div>
                </div>
                @endif
            </div>

            @if($preventivo->descrizione)
            <div style="margin-top: 20px; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Descrizione</div>
                <div style="color: var(--efficio-text); line-height: 1.6;">{{ $preventivo->descrizione }}</div>
            </div>
            @endif

            @if($preventivo->note)
            <div style="margin-top: 16px; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Note</div>
                <div style="color: var(--efficio-text); line-height: 1.6;">{{ $preventivo->note }}</div>
            </div>
            @endif
        </div>

        <!-- Entità Collegate -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Entità Collegate</h3>
            </div>
            
            <div style="display: grid; gap: 16px;">
                <!-- Cliente -->
                <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <div style="width: 24px; height: 24px; border-radius: 6px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #6366f1;">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h4 style="margin: 0; font-size: 14px; font-weight: 600; color: var(--efficio-text);">Cliente</h4>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <div style="font-weight: 600; color: var(--efficio-text); margin-bottom: 4px;">{{ $preventivo->customer->name }}</div>
                        @if($preventivo->customer->email)
                        <div style="color: var(--efficio-muted); font-size: 13px;">{{ $preventivo->customer->email }}</div>
                        @endif
                        @if($preventivo->customer->phone)
                        <div style="color: var(--efficio-muted); font-size: 13px;">{{ $preventivo->customer->phone }}</div>
                        @endif
                    </div>
                    <a href="{{ route('customers.show', $preventivo->customer) }}" class="item" style="display: inline-flex; align-items: center; gap: 6px; color: var(--efficio-accent); text-decoration: none; font-size: 13px; font-weight: 500; transition: all 0.2s ease;">
                        Vedi dettagli cliente
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <!-- Commessa -->
                @if($preventivo->commessa)
                <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <div style="width: 24px; height: 24px; border-radius: 6px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h4 style="margin: 0; font-size: 14px; font-weight: 600; color: var(--efficio-text);">Commessa</h4>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <div style="font-weight: 600; color: var(--efficio-text); margin-bottom: 4px;">{{ $preventivo->commessa->codice }}</div>
                        <div style="color: var(--efficio-muted); font-size: 13px;">{{ $preventivo->commessa->nome }}</div>
                    </div>
                    <a href="{{ route('commesse.show', $preventivo->commessa) }}" class="item" style="display: inline-flex; align-items: center; gap: 6px; color: var(--efficio-accent); text-decoration: none; font-size: 13px; font-weight: 500; transition: all 0.2s ease;">
                        Vedi dettagli commessa
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                @endif

                <!-- Progetto -->
                @if($preventivo->project)
                <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <div style="width: 24px; height: 24px; border-radius: 6px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h4 style="margin: 0; font-size: 14px; font-weight: 600; color: var(--efficio-text);">Progetto</h4>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <div style="font-weight: 600; color: var(--efficio-text); margin-bottom: 4px;">{{ $preventivo->project->nome }}</div>
                        @if($preventivo->project->descrizione)
                        <div style="color: var(--efficio-muted); font-size: 13px;">{{ $preventivo->project->descrizione }}</div>
                        @endif
                    </div>
                    <a href="{{ route('projects.show', $preventivo->project) }}" class="item" style="display: inline-flex; align-items: center; gap: 6px; color: var(--efficio-accent); text-decoration: none; font-size: 13px; font-weight: 500; transition: all 0.2s ease;">
                        Vedi dettagli progetto
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                @endif

                <!-- Responsabile -->
                @if($preventivo->responsabile)
                <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <div style="width: 24px; height: 24px; border-radius: 6px; background: rgba(236, 72, 153, 0.1); display: flex; align-items: center; justify-content: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #ec4899;">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h4 style="margin: 0; font-size: 14px; font-weight: 600; color: var(--efficio-text);">Responsabile</h4>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <div style="font-weight: 600; color: var(--efficio-text); margin-bottom: 4px;">{{ $preventivo->responsabile->name }}</div>
                        <div style="color: var(--efficio-muted); font-size: 13px;">{{ $preventivo->responsabile->email }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Righe Preventivo -->
    @if($preventivo->righe && $preventivo->righe->count() > 0)
    <div class="card" style="padding: 24px; margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #f59e0b;">
                        <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Righe Preventivo ({{ $preventivo->righe->count() }})</h3>
            </div>
            <button onclick="openAddRigaModal()" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 6px; font-weight: 500; transition: all 0.2s ease; font-size: 14px; cursor: pointer;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Aggiungi Riga
            </button>
        </div>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                                         <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                         <th style="text-align: left; padding: 12px; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Tipo</th>
                         <th style="text-align: left; padding: 12px; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Descrizione</th>
                         <th style="text-align: right; padding: 12px; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Quantità</th>
                         <th style="text-align: right; padding: 12px; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Prezzo Unitario</th>
                         <th style="text-align: right; padding: 12px; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Sconto %</th>
                         <th style="text-align: right; padding: 12px; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Totale</th>
                         <th style="text-align: center; padding: 12px; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Azioni</th>
                     </tr>
                </thead>
                <tbody>
                    @foreach($preventivo->righe as $riga)
                                         <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                         <td style="padding: 12px; color: var(--efficio-text);">
                             <span style="display: inline-flex; align-items: center; padding: 2px 8px; font-size: 10px; font-weight: 600; border-radius: 12px; 
                                 @if($riga->tipo_riga === 'articolo') background: rgba(59, 130, 246, 0.2); color: #3b82f6;
                                 @elseif($riga->tipo_riga === 'manodopera') background: rgba(34, 197, 94, 0.2); color: #22c55e;
                                 @else background: rgba(168, 85, 247, 0.2); color: #a855f7;
                                 @endif">
                                 {{ ucfirst($riga->tipo_riga ?? 'manuale') }}
                             </span>
                         </td>
                         <td style="padding: 12px; color: var(--efficio-text);">
                             <div style="font-weight: 500;">{{ $riga->descrizione }}</div>
                             @if($riga->articolo)
                             <div style="font-size: 12px; color: var(--efficio-muted); margin-top: 2px;">Articolo: {{ $riga->articolo->codice }}</div>
                             @endif
                         </td>
                         <td style="padding: 12px; text-align: right; color: var(--efficio-text); font-weight: 500;">{{ $riga->quantita }}</td>
                         <td style="padding: 12px; text-align: right; color: var(--efficio-text); font-weight: 500;">€{{ number_format($riga->prezzo_unitario, 2, ',', '.') }}</td>
                         <td style="padding: 12px; text-align: right; color: var(--efficio-text); font-weight: 500;">
                             @if($riga->sconto_percentuale > 0)
                                 {{ number_format($riga->sconto_percentuale, 1) }}%
                             @else
                                 -
                             @endif
                         </td>
                         <td style="padding: 12px; text-align: right; color: var(--efficio-text); font-weight: 600;">
                             €{{ number_format(($riga->quantita * $riga->prezzo_unitario) * (1 - ($riga->sconto_percentuale / 100)), 2, ',', '.') }}
                         </td>
                         <td style="padding: 12px; text-align: center;">
                             <div style="display: flex; gap: 4px; justify-content: center;">
                                 <button onclick="editRiga({{ $riga->id }})" title="Modifica" style="width: 28px; height: 28px; border-radius: 6px; background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; color: #3b82f6;">
                                     <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                         <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                     </svg>
                                 </button>
                                 <button onclick="duplicateRiga({{ $riga->id }})" title="Duplica" style="width: 28px; height: 28px; border-radius: 6px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; color: #22c55e;">
                                     <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2M16 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-8a2 2 0 01-2-2v-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                     </svg>
                                 </button>
                                 <button onclick="deleteRiga({{ $riga->id }})" title="Elimina" style="width: 28px; height: 28px; border-radius: 6px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; color: #ef4444;">
                                     <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                     </svg>
                                 </button>
                             </div>
                         </td>
                     </tr>
                    @endforeach
                </tbody>
                                 <tfoot>
                     <tr style="border-top: 2px solid rgba(255,255,255,0.1);">
                         <td colspan="6" style="padding: 16px 12px; text-align: right; font-weight: 600; color: var(--efficio-text);">Totale Netto:</td>
                         <td style="padding: 16px 12px; text-align: right; font-weight: 700; color: var(--efficio-accent); font-size: 16px;">€{{ number_format($preventivo->importo_netto ?? 0, 2, ',', '.') }}</td>
                     </tr>
                     <tr>
                         <td colspan="6" style="padding: 8px 12px; text-align: right; font-weight: 600; color: var(--efficio-muted); font-size: 14px;">IVA (22%):</td>
                         <td style="padding: 8px 12px; text-align: right; font-weight: 600; color: var(--efficio-muted); font-size: 14px;">€{{ number_format($preventivo->importo_iva ?? 0, 2, ',', '.') }}</td>
                     </tr>
                     <tr style="border-top: 1px solid rgba(255,255,255,0.1);">
                         <td colspan="6" style="padding: 16px 12px; text-align: right; font-weight: 700; color: var(--efficio-text); font-size: 18px;">Totale:</td>
                         <td style="padding: 16px 12px; text-align: right; font-weight: 700; color: var(--efficio-accent); font-size: 18px;">€{{ number_format($preventivo->importo_totale ?? 0, 2, ',', '.') }}</td>
                     </tr>
                 </tfoot>
            </table>
        </div>
    </div>
    @else
    <div class="card" style="padding: 24px; margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #f59e0b;">
                        <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Righe Preventivo</h3>
            </div>
            <button onclick="openAddRigaModal()" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 6px; font-weight: 500; transition: all 0.2s ease; font-size: 14px; cursor: pointer;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Aggiungi Prima Riga
            </button>
        </div>
        
        <div style="text-align: center; padding: 40px; color: var(--efficio-muted);">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 16px; opacity: 0.5;">
                <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p style="margin: 0; font-size: 16px;">Nessuna riga presente in questo preventivo</p>
            <p style="margin: 8px 0 0 0; font-size: 14px; opacity: 0.7;">Clicca su "Aggiungi Prima Riga" per iniziare a creare le righe del preventivo</p>
        </div>
    </div>
    @endif

    <!-- Gestione Documento -->
    <div class="card" style="padding: 24px; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #6366f1;">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Gestione Documento</h3>
        </div>
        
        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('preventivi.pdf', $preventivo->id) }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 10px; background: rgba(239, 68, 68, 0.1); color: #ef4444; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease;">
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

<!-- Modal per Aggiungere Nuove Righe -->
<div id="addRigaModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; backdrop-filter: blur(4px);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; background: var(--efficio-bg); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
        <!-- Header Modal -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 24px 24px 0 24px; margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 20px; font-weight: 600; color: var(--efficio-text);">Aggiungi Nuova Riga</h3>
            </div>
            <button onclick="closeAddRigaModal()" style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; color: var(--efficio-muted);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form id="addRigaForm" style="padding: 0 24px 24px 24px;">
            <input type="hidden" name="preventivo_id" value="{{ $preventivo->id }}">
            
            <!-- Tipo Riga -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Tipo Riga *</label>
                <select name="tipo_riga" id="tipoRiga" required style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    <option value="">Seleziona tipo...</option>
                    <option value="manuale">Manuale</option>
                    <option value="articolo">Articolo</option>
                    <option value="manodopera">Manodopera</option>
                </select>
            </div>

            <!-- Articolo (condizionale) -->
            <div id="articoloSection" style="margin-bottom: 20px; display: none;">
                <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Articolo *</label>
                <div style="position: relative;">
                    <input type="text" id="articoloSearch" placeholder="Cerca articolo..." style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                    <input type="hidden" name="articolo_id" id="articoloId">
                    <div id="articoloResults" style="position: absolute; top: 100%; left: 0; right: 0; background: var(--efficio-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; max-height: 200px; overflow-y: auto; z-index: 10; display: none;"></div>
                </div>
            </div>

            <!-- Descrizione (condizionale) -->
            <div id="descrizioneSection" style="margin-bottom: 20px; display: none;">
                <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Descrizione *</label>
                <textarea name="descrizione" id="descrizione" rows="3" placeholder="Inserisci la descrizione della riga..." style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; resize: vertical;"></textarea>
            </div>

            <!-- Quantità e Prezzo -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Quantità *</label>
                    <input type="number" name="quantita" id="quantita" step="0.01" min="0.01" required placeholder="1.00" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Prezzo Unitario *</label>
                    <input type="number" name="prezzo_unitario" id="prezzoUnitario" step="0.01" min="0" required placeholder="0.00" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
            </div>

            <!-- Sconto e Note -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Sconto %</label>
                    <input type="number" name="sconto_percentuale" id="scontoPercentuale" step="0.1" min="0" max="100" placeholder="0.0" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Note</label>
                    <input type="text" name="note" id="note" placeholder="Note opzionali..." style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
            </div>

            <!-- Anteprima Totale -->
            <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 14px; color: var(--efficio-muted);">Anteprima Totale:</span>
                    <span id="anteprimaTotale" style="font-size: 18px; font-weight: 600; color: var(--efficio-accent);">€0.00</span>
                </div>
            </div>

            <!-- Pulsanti -->
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeAddRigaModal()" style="padding: 12px 24px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-weight: 500; cursor: pointer; transition: all 0.2s ease;">
                    Annulla
                </button>
                <button type="submit" style="padding: 12px 24px; border: none; border-radius: 8px; background: var(--efficio-accent); color: #000; font-weight: 600; cursor: pointer; transition: all 0.2s ease;">
                    Aggiungi Riga
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal per Modificare Righe Esistenti -->
<div id="editRigaModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; backdrop-filter: blur(4px);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; background: var(--efficio-bg); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
        <!-- Header Modal -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 24px 24px 0 24px; margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 20px; font-weight: 600; color: var(--efficio-text);">Modifica Riga</h3>
            </div>
            <button onclick="closeEditRigaModal()" style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; color: var(--efficio-muted);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Form di Modifica -->
        <form id="editRigaForm" style="padding: 0 24px 24px 24px;">
            <input type="hidden" name="riga_id" id="editRigaId">
            <input type="hidden" name="preventivo_id" value="{{ $preventivo->id }}">
            
            <!-- Tipo Riga -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Tipo Riga *</label>
                <select name="tipo_riga" id="editTipoRiga" required style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    <option value="">Seleziona tipo...</option>
                    <option value="manuale">Manuale</option>
                    <option value="articolo">Articolo</option>
                    <option value="manodopera">Manodopera</option>
                </select>
            </div>

            <!-- Articolo (condizionale) -->
            <div id="editArticoloSection" style="margin-bottom: 20px; display: none;">
                <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Articolo *</label>
                <div style="position: relative;">
                    <input type="text" id="editArticoloSearch" placeholder="Cerca articolo..." style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                    <input type="hidden" name="articolo_id" id="editArticoloId">
                    <div id="editArticoloResults" style="position: absolute; top: 100%; left: 0; right: 0; background: var(--efficio-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; max-height: 200px; overflow-y: auto; z-index: 10; display: none;"></div>
                </div>
            </div>

            <!-- Descrizione (condizionale) -->
            <div id="editDescrizioneSection" style="margin-bottom: 20px; display: none;">
                <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Descrizione *</label>
                <textarea name="descrizione" id="editDescrizione" rows="3" placeholder="Inserisci la descrizione della riga..." style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; resize: vertical;"></textarea>
            </div>

            <!-- Quantità e Prezzo -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Quantità *</label>
                    <input type="number" name="quantita" id="editQuantita" step="0.01" min="0.01" required placeholder="1.00" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Prezzo Unitario *</label>
                    <input type="number" name="prezzo_unitario" id="editPrezzoUnitario" step="0.01" min="0" required placeholder="0.00" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
            </div>

            <!-- Sconto e Note -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Sconto %</label>
                    <input type="number" name="sconto_percentuale" id="editScontoPercentuale" step="0.1" min="0" max="100" placeholder="0.0" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Note</label>
                    <input type="text" name="note" id="editNote" placeholder="Note opzionali..." style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;">
                </div>
            </div>

            <!-- Anteprima Totale -->
            <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 14px; color: var(--efficio-muted);">Anteprima Totale:</span>
                    <span id="editAnteprimaTotale" style="font-size: 18px; font-weight: 600; color: var(--efficio-accent);">€0.00</span>
                </div>
            </div>

            <!-- Pulsanti -->
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeEditRigaModal()" style="padding: 12px 24px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-weight: 500; cursor: pointer; transition: all 0.2s ease;">
                    Annulla
                </button>
                <button type="submit" style="padding: 12px 24px; border: none; border-radius: 8px; background: #3b82f6; color: white; font-weight: 600; cursor: pointer; transition: all 0.2s ease;">
                    Salva Modifiche
                </button>
            </div>
        </form>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .card {
        padding: 16px !important;
    }
    
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
    
    h1 {
        font-size: 24px !important;
    }
    
    .item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    table {
        font-size: 14px;
    }
    
    th, td {
        padding: 8px !important;
    }
    }
    
    /* Stili per il modal e le azioni */
    .articolo-result:hover {
        background: rgba(255,255,255,0.05) !important;
    }
    
    button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    #addRigaModal input:focus,
    #addRigaModal select:focus,
    #addRigaModal textarea:focus {
        outline: none;
        border-color: var(--efficio-accent);
        box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
    }
    
    #addRigaModal button[type="submit"]:hover {
        background: #a855f7 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
    }
    
    /* Stili per la modal di modifica */
    #editRigaModal input:focus,
    #editRigaModal select:focus,
    #editRigaModal textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    #editRigaModal button[type="submit"]:hover {
        background: #2563eb !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inizializza il modal e gli eventi
    initializeModal();
    initializeFormEvents();
    initializeArticoloSearch();
    
    // Inizializza la modal di modifica
    initializeEditModal();
});

// ===== GESTIONE MODAL =====
function openAddRigaModal() {
    document.getElementById('addRigaModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
    resetForm();
}

function closeAddRigaModal() {
    document.getElementById('addRigaModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    resetForm();
}

// ===== INIZIALIZZAZIONE MODAL =====
function initializeModal() {
    // Chiudi modal cliccando fuori
    document.getElementById('addRigaModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddRigaModal();
        }
    });
    
    // Chiudi modal con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('addRigaModal').style.display === 'block') {
            closeAddRigaModal();
        }
    });
}

function initializeEditModal() {
    // Chiudi modal di modifica cliccando fuori
    document.getElementById('editRigaModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditRigaModal();
        }
    });
    
    // Chiudi modal di modifica con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('editRigaModal').style.display === 'block') {
            closeEditRigaModal();
        }
    });
}

// ===== INIZIALIZZAZIONE FORM =====
function initializeFormEvents() {
    const form = document.getElementById('addRigaForm');
    const tipoRiga = document.getElementById('tipoRiga');
    
    // Gestione cambio tipo riga
    tipoRiga.addEventListener('change', function() {
        toggleFormSections(this.value);
        updateAnteprimaTotale();
    });
    
    // Gestione submit form
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitRiga();
    });
    
    // Gestione input per anteprima totale
    document.getElementById('quantita').addEventListener('input', updateAnteprimaTotale);
    document.getElementById('prezzoUnitario').addEventListener('input', updateAnteprimaTotale);
    document.getElementById('scontoPercentuale').addEventListener('input', updateAnteprimaTotale);
}

// ===== GESTIONE SEZIONI FORM =====
function toggleFormSections(tipo) {
    const articoloSection = document.getElementById('articoloSection');
    const descrizioneSection = document.getElementById('descrizioneSection');
    
    if (tipo === 'articolo') {
        articoloSection.style.display = 'block';
        descrizioneSection.style.display = 'none';
        document.getElementById('descrizione').removeAttribute('required');
        document.getElementById('articoloSearch').setAttribute('required', '');
    } else {
        articoloSection.style.display = 'none';
        descrizioneSection.style.display = 'block';
        document.getElementById('descrizione').setAttribute('required', '');
        document.getElementById('articoloSearch').removeAttribute('required');
    }
}

// ===== RICERCA ARTICOLI =====
function initializeArticoloSearch() {
    const searchInput = document.getElementById('articoloSearch');
    const resultsDiv = document.getElementById('articoloResults');
    
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            resultsDiv.style.display = 'none';
            return;
        }
        
        searchTimeout = setTimeout(() => {
            searchArticoli(query);
        }, 300);
    });
    
    // Nascondi risultati quando si clicca fuori
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsDiv.contains(e.target)) {
            resultsDiv.style.display = 'none';
        }
    });
}

async function searchArticoli(query) {
    try {
        const response = await fetch(`/preventivo-righe/search-articoli?q=${encodeURIComponent(query)}`);
        const data = await response.json();
        
        if (data.success) {
            displayArticoloResults(data.articoli);
        }
    } catch (error) {
        console.error('Errore nella ricerca articoli:', error);
    }
}

function displayArticoloResults(articoli) {
    const resultsDiv = document.getElementById('articoloResults');
    const searchInput = document.getElementById('articoloSearch');
    
    if (articoli.length === 0) {
        resultsDiv.innerHTML = '<div style="padding: 12px; color: var(--efficio-muted); text-align: center;">Nessun articolo trovato</div>';
        resultsDiv.style.display = 'block';
        return;
    }
    
    resultsDiv.innerHTML = articoli.map(articolo => {
        // Escape dei caratteri speciali per evitare problemi con le virgolette
        const codice = articolo.codice ? articolo.codice.replace(/'/g, '\\\'') : '';
        const nome = articolo.nome ? articolo.nome.replace(/'/g, '\\\'') : '';
        
        return `
            <div class="articolo-result" onclick="selectArticolo(${articolo.id}, '${codice}', '${nome}', ${articolo.prezzo_vendita})" style="padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: all 0.2s ease; hover:background: rgba(255,255,255,0.05);">
                <div style="font-weight: 500; color: var(--efficio-text);">${articolo.codice || ''}</div>
                <div style="font-size: 12px; color: var(--efficio-muted);">${articolo.nome || ''}</div>
                <div style="font-size: 12px; color: var(--efficio-accent);">€${articolo.prezzo_vendita || 0}</div>
            </div>
        `;
    }).join('');
    
    resultsDiv.style.display = 'block';
}

function selectArticolo(id, codice, nome, prezzo) {
    document.getElementById('articoloId').value = id;
    document.getElementById('articoloSearch').value = `${codice} - ${nome}`;
    document.getElementById('prezzoUnitario').value = prezzo;
    document.getElementById('articoloResults').style.display = 'none';
    updateAnteprimaTotale();
}

// ===== CALCOLO ANTEPRIMA TOTALE =====
function updateAnteprimaTotale() {
    const quantita = parseFloat(document.getElementById('quantita').value) || 0;
    const prezzo = parseFloat(document.getElementById('prezzoUnitario').value) || 0;
    const sconto = parseFloat(document.getElementById('scontoPercentuale').value) || 0;
    
    let totale = quantita * prezzo;
    if (sconto > 0) {
        totale = totale * (1 - sconto / 100);
    }
    
    document.getElementById('anteprimaTotale').textContent = `€${totale.toFixed(2).replace('.', ',')}`;
}

// ===== SUBMIT RIGA =====
async function submitRiga() {
    const form = document.getElementById('addRigaForm');
    const formData = new FormData(form);
    
    try {
        const response = await fetch('/preventivo-righe', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Riga aggiunta con successo!', 'success');
            closeAddRigaModal();
            // Ricarica la pagina per mostrare le nuove righe
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showToast(data.message || 'Errore durante il salvataggio', 'error');
        }
    } catch (error) {
        console.error('Errore:', error);
        showToast('Errore di connessione', 'error');
    }
}

// ===== AZIONI RAPIDE =====
async function editRiga(rigaId) {
    // Apre la modal di modifica inline
    await openEditRigaModal(rigaId);
}

async function duplicateRiga(rigaId) {
    if (!confirm('Vuoi duplicare questa riga?')) return;
    
    try {
        const response = await fetch(`/preventivo-righe/${rigaId}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Riga duplicata con successo!', 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showToast(data.message || 'Errore durante la duplicazione', 'error');
        }
    } catch (error) {
        console.error('Errore:', error);
        showToast('Errore di connessione', 'error');
    }
}

async function deleteRiga(rigaId) {
    if (!confirm('Sei sicuro di voler eliminare questa riga? Questa azione non può essere annullata.')) return;
    
    try {
        const response = await fetch(`/preventivo-righe/${rigaId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Riga eliminata con successo!', 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showToast(data.message || 'Errore durante l\'eliminazione', 'error');
        }
    } catch (error) {
        console.error('Errore:', error);
        showToast('Errore di connessione', 'error');
    }
}

// ===== UTILITY =====
function resetForm() {
    document.getElementById('addRigaForm').reset();
    document.getElementById('articoloId').value = '';
    document.getElementById('articoloResults').style.display = 'none';
    toggleFormSections('');
    updateAnteprimaTotale();
}

function showToast(message, type = 'success') {
    // Crea un toast temporaneo
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed; top: 20px; right: 20px; z-index: 10000;
        padding: 16px 20px; border-radius: 8px; color: white; font-weight: 500;
        background: ${type === 'success' ? '#22c55e' : '#ef4444'};
        box-shadow: 0 10px 25px rgba(0,0,0,0.2); transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Mostra il toast
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Nascondi e rimuovi il toast
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// ===== MODAL DI MODIFICA =====
async function openEditRigaModal(rigaId) {
    try {
        // Carica i dati della riga
        const response = await fetch(`/preventivo-righe/${rigaId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        if (!response.ok) {
            throw new Error('Errore nel caricamento della riga');
        }
        
        const riga = await response.json();
        
        // Popola il form con i dati esistenti
        populateEditForm(riga);
        
        // Mostra la modal
        document.getElementById('editRigaModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Inizializza gli eventi della modal di modifica
        initializeEditModalEvents();
        
    } catch (error) {
        console.error('Errore:', error);
        showToast('Errore nel caricamento della riga', 'error');
    }
}

function closeEditRigaModal() {
    document.getElementById('editRigaModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    resetEditForm();
}

function populateEditForm(riga) {
    // Popola i campi del form con i dati esistenti
    document.getElementById('editRigaId').value = riga.id;
    document.getElementById('editTipoRiga').value = riga.tipo_riga || 'manuale';
    document.getElementById('editQuantita').value = riga.quantita;
    document.getElementById('editPrezzoUnitario').value = riga.prezzo_unitario;
    document.getElementById('editScontoPercentuale').value = riga.sconto_percentuale || 0;
    document.getElementById('editNote').value = riga.note || '';
    
    // Gestisce i campi condizionali
    if (riga.tipo_riga === 'articolo') {
        document.getElementById('editArticoloSection').style.display = 'block';
        document.getElementById('editDescrizioneSection').style.display = 'none';
        document.getElementById('editArticoloSearch').value = riga.articolo ? riga.articolo.codice : '';
        document.getElementById('editArticoloId').value = riga.articolo_id || '';
    } else {
        document.getElementById('editArticoloSection').style.display = 'none';
        document.getElementById('editDescrizioneSection').style.display = 'block';
        document.getElementById('editDescrizione').value = riga.descrizione || '';
    }
    
    // Aggiorna l'anteprima totale
    updateEditAnteprimaTotale();
}

function initializeEditModalEvents() {
    const form = document.getElementById('editRigaForm');
    const tipoRiga = document.getElementById('editTipoRiga');
    
    // Gestione cambio tipo riga
    tipoRiga.addEventListener('change', function() {
        toggleEditFormSections(this.value);
        updateEditAnteprimaTotale();
    });
    
    // Gestione submit form
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitEditRiga();
    });
    
    // Eventi per il calcolo in tempo reale
    const inputs = ['editQuantita', 'editPrezzoUnitario', 'editScontoPercentuale'];
    inputs.forEach(id => {
        document.getElementById(id).addEventListener('input', updateEditAnteprimaTotale);
    });
    
    // Inizializza la ricerca articoli per la modal di modifica
    initializeEditArticoloSearch();
}

function toggleEditFormSections(tipoRiga) {
    const articoloSection = document.getElementById('editArticoloSection');
    const descrizioneSection = document.getElementById('editDescrizioneSection');
    
    if (tipoRiga === 'articolo') {
        articoloSection.style.display = 'block';
        descrizioneSection.style.display = 'none';
        document.getElementById('editDescrizione').removeAttribute('required');
        document.getElementById('editArticoloSearch').setAttribute('required', '');
    } else {
        articoloSection.style.display = 'none';
        descrizioneSection.style.display = 'block';
        document.getElementById('editDescrizione').setAttribute('required', '');
        document.getElementById('editArticoloSearch').removeAttribute('required');
    }
}

function updateEditAnteprimaTotale() {
    const quantita = parseFloat(document.getElementById('editQuantita').value) || 0;
    const prezzo = parseFloat(document.getElementById('editPrezzoUnitario').value) || 0;
    const sconto = parseFloat(document.getElementById('editScontoPercentuale').value) || 0;
    
    let totale = quantita * prezzo;
    if (sconto > 0) {
        totale = totale * (1 - sconto / 100);
    }
    
    document.getElementById('editAnteprimaTotale').textContent = `€${totale.toFixed(2).replace('.', ',')}`;
}

function initializeEditArticoloSearch() {
    const searchInput = document.getElementById('editArticoloSearch');
    const resultsDiv = document.getElementById('editArticoloResults');
    
    searchInput.addEventListener('input', function() {
        if (this.value.length >= 2) {
            searchEditArticoli(this.value);
        } else {
            resultsDiv.style.display = 'none';
        }
    });
    
    // Nascondi risultati quando si clicca fuori
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#editArticoloSection')) {
            resultsDiv.style.display = 'none';
        }
    });
}

async function searchEditArticoli(query) {
    try {
        const response = await fetch(`/preventivo-righe/search-articoli?q=${encodeURIComponent(query)}`);
        const articoli = await response.json();
        displayEditArticoloResults(articoli);
    } catch (error) {
        console.error('Errore nella ricerca articoli:', error);
    }
}

function displayEditArticoloResults(articoli) {
    const resultsDiv = document.getElementById('editArticoloResults');
    
    if (articoli.length === 0) {
        resultsDiv.innerHTML = '<div style="padding: 12px; text-align: center; color: var(--efficio-muted);">Nessun articolo trovato</div>';
    } else {
        resultsDiv.innerHTML = articoli.map(articolo => {
            // Escape dei caratteri speciali per evitare problemi con le virgolette
            const codice = articolo.codice ? articolo.codice.replace(/'/g, '\\\'') : '';
            const descrizione = articolo.descrizione ? articolo.descrizione.replace(/'/g, '\\\'') : '';
            
            return `
                <div class="articolo-result" onclick="selectEditArticolo(${articolo.id}, '${codice}', '${descrizione}')" style="padding: 12px; cursor: pointer; border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s ease;">
                    <div style="font-weight: 500; color: var(--efficio-text);">${articolo.codice || ''}</div>
                    <div style="font-size: 12px; color: var(--efficio-muted);">${articolo.descrizione || ''}</div>
                </div>
            `;
        }).join('');
    }
    
    resultsDiv.style.display = 'block';
}

function selectEditArticolo(articoloId, codice, descrizione) {
    document.getElementById('editArticoloId').value = articoloId;
    document.getElementById('editArticoloSearch').value = codice;
    document.getElementById('editArticoloResults').style.display = 'none';
    
    // Aggiorna l'anteprima totale
    updateEditAnteprimaTotale();
}

async function submitEditRiga() {
    const form = document.getElementById('editRigaForm');
    const formData = new FormData(form);
    const rigaId = document.getElementById('editRigaId').value;
    
    try {
        const response = await fetch(`/preventivo-righe/${rigaId}`, {
            method: 'PUT',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Riga modificata con successo!', 'success');
            closeEditRigaModal();
            // Ricarica la pagina per mostrare le modifiche
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showToast(data.message || 'Errore durante il salvataggio', 'error');
        }
    } catch (error) {
        console.error('Errore:', error);
        showToast('Errore di connessione', 'error');
    }
}

function resetEditForm() {
    document.getElementById('editRigaForm').reset();
    document.getElementById('editArticoloId').value = '';
    document.getElementById('editArticoloResults').style.display = 'none';
    toggleEditFormSections('');
    updateEditAnteprimaTotale();
}

function sendEmail() {
    alert('Funzionalità di invio email in fase di sviluppo. Per ora puoi utilizzare "Genera PDF" per scaricare il documento.');
}
</script>
@endsection
