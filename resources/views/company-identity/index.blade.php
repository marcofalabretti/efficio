@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px;">
        <div>
            <h1 style="margin: 0; font-size: 28px; font-weight: 700; color: var(--efficio-text);">Identità Aziendale</h1>
            <p style="margin: 8px 0 0 0; color: var(--efficio-muted); font-size: 16px;">Gestisci l'identità visiva e i brand della tua azienda</p>
        </div>
        <a href="{{ route('company-identity.create') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Nuova Identità
        </a>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 32px;">
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #6366f1;">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--efficio-text);">{{ $identities->count() }}</div>
                    <div style="color: var(--efficio-muted); font-size: 14px;">Identità Totali</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #22c55e;">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--efficio-text);">{{ $identities->where('is_active', true)->count() }}</div>
                    <div style="color: var(--efficio-muted); font-size: 14px;">Identità Attive</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #a855f7;">
                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--efficio-text);">{{ $identities->whereNotNull('branch_code')->count() }}</div>
                    <div style="color: var(--efficio-muted); font-size: 14px;">Filiali/Sedi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Identities List -->
    <div class="card">
        <div style="padding: 24px; border-bottom: var(--border);">
            <h2 style="margin: 0; font-size: 20px; font-weight: 600; color: var(--efficio-text);">Lista Identità</h2>
        </div>

        @if($identities->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: var(--border);">
                            <th style="text-align: left; padding: 16px 24px; font-weight: 600; color: var(--efficio-text); font-size: 14px;">Azienda</th>
                            <th style="text-align: left; padding: 16px 24px; font-weight: 600; color: var(--efficio-text); font-size: 14px;">Sede</th>
                            <th style="text-align: left; padding: 16px 24px; font-weight: 600; color: var(--efficio-text); font-size: 14px;">Stato</th>
                            <th style="text-align: left; padding: 16px 24px; font-weight: 600; color: var(--efficio-text); font-size: 14px;">Logo</th>
                            <th style="text-align: left; padding: 16px 24px; font-weight: 600; color: var(--efficio-text); font-size: 14px;">Colori</th>
                            <th style="text-align: left; padding: 16px 24px; font-weight: 600; color: var(--efficio-text); font-size: 14px;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($identities as $identity)
                        <tr style="border-bottom: var(--border);">
                            <td style="padding: 16px 24px;">
                                <div>
                                    <div style="font-weight: 600; color: var(--efficio-text); margin-bottom: 4px;">
                                        {{ $identity->company_name }}
                                    </div>
                                    @if($identity->commercial_name)
                                        <div style="color: var(--efficio-muted); font-size: 14px;">
                                            {{ $identity->commercial_name }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td style="padding: 16px 24px;">
                                @if($identity->branch_code)
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span class="badge-purple">{{ $identity->branch_code }}</span>
                                        <span style="color: var(--efficio-text);">{{ $identity->branch_name }}</span>
                                    </div>
                                @else
                                    <span style="color: var(--efficio-muted);">Sede principale</span>
                                @endif
                            </td>
                            <td style="padding: 16px 24px;">
                                @if($identity->is_active)
                                    <span class="badge-success">Attiva</span>
                                @else
                                    <span class="badge-danger">Inattiva</span>
                                @endif
                            </td>
                            <td style="padding: 16px 24px;">
                                @if($identity->logo_large)
                                    <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; border: var(--border);">
                                        <img src="{{ Storage::url($identity->logo_large) }}" alt="Logo" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(255,255,255,0.05); border: var(--border); display: flex; align-items: center; justify-content: center;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--efficio-muted);">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <path d="M21 15l-5-5L5 21"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 16px 24px;">
                                <div style="display: flex; gap: 8px;">
                                    <div style="width: 20px; height: 20px; border-radius: 4px; background: {{ $identity->primary_color }}; border: 1px solid rgba(255,255,255,0.1);"></div>
                                    <div style="width: 20px; height: 20px; border-radius: 4px; background: {{ $identity->secondary_color }}; border: 1px solid rgba(255,255,255,0.1);"></div>
                                    <div style="width: 20px; height: 20px; border-radius: 4px; background: {{ $identity->neutral_color }}; border: 1px solid rgba(255,255,255,0.1);"></div>
                                </div>
                            </td>
                            <td style="padding: 16px 24px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('company-identity.show', $identity->id) }}" class="btn-secondary btn-sm" title="Visualizza">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('company-identity.edit', $identity->id) }}" class="btn-primary btn-sm" title="Modifica">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('company-identity.toggle-status', $identity->id) }}" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-sm" style="background: {{ $identity->is_active ? 'rgba(239, 68, 68, 0.2)' : 'rgba(34, 197, 94, 0.2)' }}; color: {{ $identity->is_active ? '#f87171' : '#22c55e' }}; border: 1px solid {{ $identity->is_active ? 'rgba(239, 68, 68, 0.3)' : 'rgba(34, 197, 94, 0.3)' }}; border-radius: 6px; padding: 6px 12px; font-size: 13px; cursor: pointer; transition: all 0.2s ease;" title="{{ $identity->is_active ? 'Disattiva' : 'Attiva' }}">
                                            @if($identity->is_active)
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                                                </svg>
                                            @else
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 48px 24px; text-align: center;">
                <div style="width: 64px; height: 64px; border-radius: 16px; background: rgba(255,255,255,0.05); border: var(--border); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--efficio-muted);">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 style="margin: 0 0 12px 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Nessuna identità configurata</h3>
                <p style="margin: 0 0 24px 0; color: var(--efficio-muted);">Inizia creando la prima identità aziendale per personalizzare i tuoi documenti e la comunicazione.</p>
                <a href="{{ route('company-identity.create') }}" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Crea Prima Identità
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
