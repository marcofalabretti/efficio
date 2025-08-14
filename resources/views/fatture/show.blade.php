@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, var(--efficio-accent) 0%, #a3e635 100%); display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Fattura</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">Fattura {{ $fattura->numero }}</h1>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('fatture.index') }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Lista Fatture
                </a>
                <a href="{{ route('fatture.edit', $fattura) }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
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
        <!-- Dettagli Fattura -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #6366f1;">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16 13H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16 17H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Dettagli Fattura</h3>
            </div>
            
            <div style="display: grid; gap: 16px;">
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Numero</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">{{ $fattura->numero }}</div>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Data</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">{{ $fattura->data->format('d/m/Y') }}</div>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Stato</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">
                            <span style="padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 500;
                                @if($fattura->stato === 'pagata') background: rgba(34, 197, 94, 0.1); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.2);
                                @elseif($fattura->stato === 'parzialmente_pagata') background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2);
                                @elseif($fattura->stato === 'inviata') background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2);
                                @elseif($fattura->stato === 'scaduta') background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2);
                                @elseif($fattura->stato === 'annullata') background: rgba(156, 163, 175, 0.1); color: #9ca3af; border: 1px solid rgba(156, 163, 175, 0.2);
                                @else background: rgba(156, 163, 175, 0.1); color: #9ca3af; border: 1px solid rgba(156, 163, 175, 0.2);
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $fattura->stato)) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Importo Netto</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">€ {{ number_format($fattura->importo_netto, 2, ',', '.') }}</div>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">IVA ({{ $fattura->percentuale_iva }}%)</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">€ {{ number_format($fattura->importo_iva, 2, ',', '.') }}</div>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Totale</div>
                        <div style="color: var(--efficio-accent); font-weight: 600; font-size: 18px;">€ {{ number_format($fattura->importo_totale, 2, ',', '.') }}</div>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Data Scadenza</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">
                            {{ $fattura->data_scadenza ? $fattura->data_scadenza->format('d/m/Y') : 'Non specificata' }}
                        </div>
                    </div>
                </div>
            </div>
            
            @if($fattura->note)
                <div style="margin-top: 20px; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Note</div>
                    <div style="color: var(--efficio-text); font-weight: 500;">{{ $fattura->note }}</div>
                </div>
            @endif
        </div>

        <!-- Entità Collegate -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Entità Collegate</h3>
            </div>
            
            <div style="display: grid; gap: 16px;">
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
                        <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--efficio-text);">Cliente</h4>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <div style="color: var(--efficio-text); font-weight: 500; margin-bottom: 4px;">{{ $fattura->customer->name }}</div>
                        @if($fattura->customer->email)
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 2px;">{{ $fattura->customer->email }}</div>
                        @endif
                        @if($fattura->customer->phone)
                            <div style="color: var(--efficio-muted); font-size: 14px;">{{ $fattura->customer->phone }}</div>
                        @endif
                    </div>
                    <a href="{{ route('customers.show', $fattura->customer) }}" class="item" style="padding: 8px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; font-size: 14px;">
                        Vedi dettagli cliente
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                
                @if($fattura->commessa)
                    <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <div style="width: 24px; height: 24px; border-radius: 6px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #f59e0b;">
                                    <path d="M9 11H1a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1v-5M9 11l5 5M9 11l5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--efficio-text);">Commessa</h4>
                        </div>
                        <div style="margin-bottom: 12px;">
                            <div style="color: var(--efficio-text); font-weight: 500; margin-bottom: 4px;">{{ $fattura->commessa->codice }}</div>
                            @if($fattura->commessa->nome)
                                <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 2px;">{{ $fattura->commessa->nome }}</div>
                            @endif
                            <div style="color: var(--efficio-muted); font-size: 14px;">Stato: {{ ucfirst($fattura->commessa->stato) }}</div>
                        </div>
                        <a href="{{ route('commesse.show', $fattura->commessa) }}" class="item" style="padding: 8px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; font-size: 14px;">
                            Vedi dettagli commessa
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                @endif
                
                @if($fattura->preventivo)
                    <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <div style="width: 24px; height: 24px; border-radius: 6px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                                    <path d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--efficio-text);">Preventivo</h4>
                        </div>
                        <div style="margin-bottom: 12px;">
                            <div style="color: var(--efficio-text); font-weight: 500; margin-bottom: 4px;">{{ $fattura->preventivo->numero }}</div>
                            @if($fattura->preventivo->oggetto)
                                <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 2px;">{{ $fattura->preventivo->oggetto }}</div>
                            @endif
                            <div style="color: var(--efficio-muted); font-size: 14px;">Stato: {{ ucfirst(str_replace('_', ' ', $fattura->preventivo->stato)) }}</div>
                        </div>
                        <a href="{{ route('preventivi.show', $fattura->preventivo) }}" class="item" style="padding: 8px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; font-size: 14px;">
                            Vedi dettagli preventivo
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                @endif
                
                @if($fattura->project)
                    <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <div style="width: 24px; height: 24px; border-radius: 6px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--efficio-text);">Progetto</h4>
                        </div>
                        <div style="margin-bottom: 12px;">
                            <div style="color: var(--efficio-text); font-weight: 500; margin-bottom: 4px;">{{ $fattura->project->name }}</div>
                            @if($fattura->project->description)
                                <div style="color: var(--efficio-muted); font-size: 14px;">{{ $fattura->project->description }}</div>
                            @endif
                        </div>
                        <a href="{{ route('projects.show', $fattura->project) }}" class="item" style="padding: 8px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; font-size: 14px;">
                            Vedi dettagli progetto
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Section -->
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
        <!-- Azioni Rapide -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Azioni Rapide</h3>
            </div>
            
            <div style="display: grid; gap: 12px;">
                <a href="{{ route('fatture.create') }}" class="item" style="padding: 12px 16px; border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: #3b82f6;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Nuova Fattura
                </a>
                
                @if($fattura->commessa)
                    <a href="{{ route('commesse.fatture', $fattura->commessa) }}" class="item" style="padding: 12px 16px; border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: #22c55e;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 11H1a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1v-5M9 11l5 5M9 11l5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Fatture Commessa
                    </a>
                @endif
                
                @if($fattura->preventivo)
                    <a href="{{ route('preventivi.fatture', $fattura->preventivo) }}" class="item" style="padding: 12px 16px; border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 8px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: #f59e0b;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Fatture Preventivo
                    </a>
                @endif
                
                <a href="{{ route('customers.fatture', $fattura->customer) }}" class="item" style="padding: 12px 16px; border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 8px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: #6366f1;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Fatture Cliente
                </a>
            </div>
            
            <!-- Gestione Documento -->
            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <h4 style="margin: 0 0 16px 0; font-size: 14px; font-weight: 600; color: var(--efficio-muted);">Gestione Documento</h4>
                <div style="display: grid; gap: 8px;">
                    <a href="{{ route('fatture.pdf', $fattura->id) }}" class="item" style="padding: 10px 16px; border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 8px; background: rgba(239, 68, 68, 0.1); color: #ef4444; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease; font-size: 13px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                            <polyline points="14,2 14,8 20,8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10,9 9,9 8,9"/>
                        </svg>
                        Genera PDF
                    </a>
                    <button onclick="window.print()" class="item" style="padding: 10px 16px; border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease; cursor: pointer; border: none; font-family: inherit; font-size: 13px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Stampa
                    </button>
                    <button onclick="sendEmail()" class="item" style="padding: 10px 16px; border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 8px; background: rgba(34, 197, 94, 0.1); color: #22c55e; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s ease; cursor: pointer; border: none; font-family: inherit; font-size: 13px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        Invia Email
                    </button>
                </div>
            </div>
        </div>

        <!-- Stato Pagamenti -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Stato Pagamenti</h3>
            </div>
            
            <div style="display: grid; gap: 16px;">
                <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Percentuale Pagato</div>
                        <div style="color: var(--efficio-accent); font-weight: 600; font-size: 18px;">
                            {{ number_format(($fattura->pagamenti->where('stato', 'confermato')->sum('importo') / $fattura->importo_totale) * 100, 1) }}%
                        </div>
                    </div>
                    <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ min(100, ($fattura->pagamenti->where('stato', 'confermato')->sum('importo') / $fattura->importo_totale) * 100) }}%; height: 100%; background: linear-gradient(90deg, var(--efficio-accent) 0%, #a3e635 100%); border-radius: 4px;"></div>
                    </div>
                </div>
                
                <div style="display: grid; gap: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Importo Dovuto</div>
                        <div style="color: var(--efficio-text); font-weight: 600;">€ {{ number_format($fattura->importo_totale, 2, ',', '.') }}</div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Importo Pagato</div>
                        <div style="color: #22c55e; font-weight: 600;">€ {{ number_format($fattura->pagamenti->where('stato', 'confermato')->sum('importo'), 2, ',', '.') }}</div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em;">Saldo Mancante</div>
                        <div style="color: {{ $fattura->importo_totale - $fattura->pagamenti->where('stato', 'confermato')->sum('importo') > 0 ? '#ef4444' : ($fattura->importo_totale - $fattura->pagamenti->where('stato', 'confermato')->sum('importo') == 0 ? '#22c55e' : '#eab308') }}; font-weight: 600;">
                            € {{ number_format($fattura->importo_totale - $fattura->pagamenti->where('stato', 'confermato')->sum('importo'), 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagamenti -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Pagamenti</h3>
            </div>
            
            @if($fattura->pagamenti->count() > 0)
                <div style="display: grid; gap: 12px;">
                    @foreach($fattura->pagamenti as $pagamento)
                        <div onclick="apriModalPagamento({{ $pagamento->id }})" class="pagamento-item" style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: all 0.2s ease;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                <div style="color: var(--efficio-text); font-weight: 500;">€ {{ number_format($pagamento->importo, 2, ',', '.') }}</div>
                                <span style="padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 500;
                                    @if($pagamento->stato === 'confermato') background: rgba(34, 197, 94, 0.1); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.2);
                                    @elseif($pagamento->stato === 'in_attesa') background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2);
                                    @else background: rgba(156, 163, 175, 0.1); color: #9ca3af; border: 1px solid rgba(156, 163, 175, 0.2);
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $pagamento->stato)) }}
                                </span>
                            </div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px;">
                                {{ $pagamento->data_pagamento ? $pagamento->data_pagamento->format('d/m/Y') : 'Data non specificata' }}
                            </div>
                            @if($pagamento->note)
                                <div style="color: var(--efficio-muted); font-size: 13px; font-style: italic;">{{ $pagamento->note }}</div>
                            @endif
                            <div style="display: flex; align-items: center; gap: 4px; margin-top: 8px; color: var(--efficio-muted); font-size: 12px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Clicca per vedere i dettagli
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="padding: 20px; text-align: center; color: var(--efficio-muted);">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 0 auto 16px; opacity: 0.5;">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="font-size: 14px; margin-bottom: 8px;">Nessun pagamento registrato</div>
                    <div style="font-size: 12px; opacity: 0.7;">I pagamenti appariranno qui quando verranno aggiunti</div>
                </div>
            @endif
            
            <div style="margin-top: 20px;">
                <a href="{{ route('pagamenti.create', ['fattura_id' => $fattura->id]) }}" class="item" style="padding: 12px 16px; border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: #a855f7;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Aggiungi Pagamento
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dettagli Pagamento -->
<div id="modalPagamento" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; backdrop-filter: blur(4px);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 500px; background: var(--efficio-bg); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
        <!-- Header Modal -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 24px 24px 0 24px; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 20px; font-weight: 600; color: var(--efficio-text);">Dettagli Pagamento</h3>
            <button onclick="chiudiModalPagamento()" style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                    <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <!-- Contenuto Modal -->
        <div id="modalPagamentoContent" style="padding: 0 24px 24px 24px;">
            <!-- Il contenuto verrà popolato dinamicamente -->
        </div>
    </div>
</div>

<!-- Stili CSS -->
<style>
.pagamento-item:hover {
    background: rgba(255,255,255,0.05) !important;
    border-color: rgba(255,255,255,0.1) !important;
}
</style>

<!-- Script per la modal -->
<script>
function apriModalPagamento(pagamentoId) {
    // Mostra la modal
    document.getElementById('modalPagamento').style.display = 'block';
    
    // Popola il contenuto con i dati del pagamento
    fetch(`/pagamenti/${pagamentoId}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.json())
        .then(data => {
            const content = document.getElementById('modalPagamentoContent');
            
            // Gestisci i campi mancanti
            const importo = data.importo ? parseFloat(data.importo).toFixed(2).replace('.', ',') : '0,00';
            const stato = data.stato || 'pendente';
            const dataPagamento = data.data_pagamento ? new Date(data.data_pagamento).toLocaleDateString('it-IT') : 'Data non specificata';
            const metodoPagamento = data.metodo_pagamento ? data.metodo_pagamento.charAt(0).toUpperCase() + data.metodo_pagamento.slice(1) : 'Non specificato';
            const riferimento = data.riferimento_pagamento || '';
            const note = data.note || '';
            
            content.innerHTML = `
                <div style="display: grid; gap: 20px;">
                    <!-- Importo e Stato -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="font-size: 24px; font-weight: 700; color: var(--efficio-text);">€ ${importo}</div>
                        <span style="padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 600;
                            ${stato === 'confermato' ? 'background: rgba(34, 197, 94, 0.1); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.2);' : 
                              stato === 'pendente' ? 'background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2);' : 
                              'background: rgba(156, 163, 175, 0.1); color: #9ca3af; border: 1px solid rgba(156, 163, 175, 0.2);'}">
                            ${stato === 'confermato' ? 'Confermato' : stato === 'pendente' ? 'Pendente' : 'Annullato'}
                        </span>
                    </div>
                    
                    <!-- Dettagli -->
                    <div style="display: grid; gap: 16px;">
                        <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                            <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Data Pagamento</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">${dataPagamento}</div>
                        </div>
                        
                        <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                            <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Metodo di Pagamento</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">${metodoPagamento}</div>
                        </div>
                        
                        ${riferimento ? `
                        <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                            <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Riferimento</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">${riferimento}</div>
                        </div>
                        ` : ''}
                        
                        ${note ? `
                        <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                            <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Note</div>
                            <div style="color: var(--efficio-text); font-style: italic;">${note}</div>
                        </div>
                        ` : ''}
                    </div>
                    
                    <!-- Azioni -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 20px;">
                        <a href="/pagamenti/${data.id}/edit" class="item" style="padding: 12px 16px; border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: #3b82f6; text-decoration: none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Modifica
                        </a>
                        
                        <button onclick="eliminaPagamento(${data.id})" style="padding: 12px 16px; border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: #ef4444; cursor: pointer;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Elimina
                        </button>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Errore nel caricamento del pagamento:', error);
            document.getElementById('modalPagamentoContent').innerHTML = `
                <div style="padding: 40px; text-align: center; color: var(--efficio-muted);">
                    <div style="font-size: 16px; margin-bottom: 8px;">Errore nel caricamento</div>
                    <div style="font-size: 14px; opacity: 0.7;">Impossibile caricare i dettagli del pagamento</div>
                </div>
            `;
        });
}

function chiudiModalPagamento() {
    document.getElementById('modalPagamento').style.display = 'none';
}

function eliminaPagamento(pagamentoId) {
    if (confirm('Sei sicuro di voler eliminare questo pagamento?')) {
        fetch(`/pagamenti/${pagamentoId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                // Chiudi la modal
                chiudiModalPagamento();
                // Ricarica la pagina per aggiornare la lista
                window.location.reload();
            } else {
                alert('Errore nell\'eliminazione del pagamento');
            }
        }).catch(error => {
            console.error('Errore:', error);
            alert('Errore nell\'eliminazione del pagamento');
        });
    }
}

// Chiudi modal cliccando fuori
document.getElementById('modalPagamento').addEventListener('click', function(e) {
    if (e.target === this) {
        chiudiModalPagamento();
    }
});

function sendEmail() {
    // Per ora mostra un messaggio informativo
    // In futuro implementeremo l'invio email con PDF allegato
    alert('Funzionalità di invio email in fase di sviluppo. Per ora puoi utilizzare "Genera PDF" per scaricare il documento.');
}
</script>

@endsection
