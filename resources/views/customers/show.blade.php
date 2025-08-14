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
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Cliente</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">{{ $customer->name }}</h1>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('customers.edit', $customer) }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
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
        <!-- Contact Information -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #6366f1;">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Informazioni di Contatto</h3>
            </div>
            
            <div style="display: grid; gap: 16px;">
                @if($customer->email)
                <div class="copyable-card" data-content="{{ $customer->email }}" data-label="Email" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: all 0.2s ease; position: relative;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Email</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">{{ $customer->email }}</div>
                    </div>
                    <div class="copy-icon" style="opacity: 0; transition: opacity 0.2s ease; color: var(--efficio-muted);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                @endif

                @if($customer->phone)
                <div class="copyable-card" data-content="{{ $customer->phone }}" data-label="Telefono" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: all 0.2s ease; position: relative;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Telefono</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">{{ $customer->phone }}</div>
                    </div>
                    <div class="copy-icon" style="opacity: 0; transition: opacity 0.2s ease; color: var(--efficio-muted);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                @endif

                @if($customer->street || $customer->city)
                <div class="copyable-card" data-content="@if($customer->street){{ $customer->street }}@endif @if($customer->city), {{ $customer->city }}@endif @if($customer->zip) {{ $customer->zip }}@endif @if($customer->country)({{ $customer->country }})@endif" data-label="Indirizzo" style="display: flex; align-items: flex-start; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: all 0.2s ease; position: relative;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted); margin-top: 2px;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Indirizzo</div>
                        <div style="color: var(--efficio-text); font-weight: 500;">
                            @if($customer->street){{ $customer->street }}@endif
                            @if($customer->city), {{ $customer->city }}@endif
                            @if($customer->zip) {{ $customer->zip }}@endif
                            @if($customer->country)({{ $customer->country }})@endif
                        </div>
                    </div>
                    <div class="copy-icon" style="opacity: 0; transition: opacity 0.2s ease; color: var(--efficio-muted);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Fiscal Information -->
        <div class="card" style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Dati Fiscali</h3>
            </div>
            
            <div style="display: grid; gap: 16px;">
                @if($customer->vat_number)
                <div class="copyable-card" data-content="{{ $customer->vat_number }}" data-label="Partita IVA" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: all 0.2s ease; position: relative;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Partita IVA</div>
                        <div style="color: var(--efficio-text); font-weight: 500; font-family: monospace; font-size: 14px;">{{ $customer->vat_number }}</div>
                    </div>
                    <div class="copy-icon" style="opacity: 0; transition: opacity 0.2s ease; color: var(--efficio-muted);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                @endif

                @if($customer->fiscal_code)
                <div class="copyable-card" data-content="{{ $customer->fiscal_code }}" data-label="Codice Fiscale" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: all 0.2s ease; position: relative;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--efficio-muted);">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="flex: 1;">
                        <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px;">Codice Fiscale</div>
                        <div style="color: var(--efficio-text); font-weight: 500; font-family: monospace; font-size: 14px;">{{ $customer->fiscal_code }}</div>
                    </div>
                    <div class="copy-icon" style="opacity: 0; transition: opacity 0.2s ease; color: var(--efficio-muted);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                @endif

                @if(!$customer->vat_number && !$customer->fiscal_code)
                <div style="padding: 16px; text-align: center; color: var(--efficio-muted); font-style: italic;">
                    Nessun dato fiscale disponibile
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions & Statistics -->
    <div class="card" style="padding: 24px; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Attività e Collegamenti</h3>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
            <a href="{{ route('customers.commesse', $customer) }}" class="item" style="padding: 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.02); transition: all 0.2s ease; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 12px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--efficio-text); margin-bottom: 4px;">{{ $customer->commesse->count() }}</div>
                    <div style="font-size: 14px; color: var(--efficio-muted); font-weight: 500;">Commesse</div>
                </div>
            </a>

            <a href="{{ route('customers.preventivi', $customer) }}" class="item" style="padding: 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.02); transition: all 0.2s ease; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 12px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--efficio-text); margin-bottom: 4px;">{{ $customer->preventivi->count() }}</div>
                    <div style="font-size: 14px; color: var(--efficio-muted); font-weight: 500;">Preventivi</div>
                </div>
            </a>

            <a href="{{ route('customers.fatture', $customer) }}" class="item" style="padding: 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.02); transition: all 0.2s ease; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 12px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #f59e0b;">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--efficio-text); margin-bottom: 4px;">{{ $customer->fatture->count() }}</div>
                    <div style="font-size: 14px; color: var(--efficio-muted); font-weight: 500;">Fatture</div>
                </div>
            </a>
        </div>
    </div>

    <!-- Stato Pagamenti Card -->
    <div class="card" style="padding: 24px; margin-bottom: 24px; 
        @if($paymentStats['importi']['saldo_mancante'] > 0)
            border-left: 4px solid #ef4444; background: rgba(239, 68, 68, 0.05);
        @elseif($paymentStats['importi']['saldo_mancante'] == 0)
            border-left: 4px solid #22c55e; background: rgba(34, 197, 94, 0.05);
        @else
            border-left: 4px solid #f59e0b; background: rgba(245, 158, 11, 0.05);
        @endif">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; 
                @if($paymentStats['importi']['saldo_mancante'] > 0)
                    background: rgba(239, 68, 68, 0.1);
                @elseif($paymentStats['importi']['saldo_mancante'] == 0)
                    background: rgba(34, 197, 94, 0.1);
                @else
                    background: rgba(245, 158, 11, 0.1);
                @endif
                display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="
                    @if($paymentStats['importi']['saldo_mancante'] > 0)
                        color: #ef4444;
                    @elseif($paymentStats['importi']['saldo_mancante'] == 0)
                        color: #22c55e;
                    @else
                        color: #f59e0b;
                    @endif">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Stato Pagamenti</h3>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <!-- Percentuale Pagato -->
            <div style="padding: 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.02); display: flex; flex-direction: column; align-items: center; text-align: center; gap: 12px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #10b981;">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 28px; font-weight: 700; color: var(--efficio-text); margin-bottom: 4px;">{{ $paymentStats['percentuale_pagato'] }}%</div>
                    <div style="font-size: 14px; color: var(--efficio-muted); font-weight: 500;">Pagato</div>
                </div>
            </div>

            <!-- Importo Dovuto -->
            <div style="padding: 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.02); display: flex; flex-direction: column; align-items: center; text-align: center; gap: 12px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #ef4444;">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 28px; font-weight: 700; color: var(--efficio-text); margin-bottom: 4px;">€{{ number_format($paymentStats['importi']['dovuto'], 2, ',', '.') }}</div>
                    <div style="font-size: 14px; color: var(--efficio-muted); font-weight: 500;">Importo Dovuto</div>
                </div>
            </div>

            <!-- Importo Pagato -->
            <div style="padding: 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.02); display: flex; flex-direction: column; align-items: center; text-align: center; gap: 12px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 28px; font-weight: 700; color: var(--efficio-text); margin-bottom: 4px;">€{{ number_format($paymentStats['importi']['pagato'], 2, ',', '.') }}</div>
                    <div style="font-size: 14px; color: var(--efficio-muted); font-weight: 500;">Importo Pagato</div>
                </div>
            </div>

            <!-- Saldo Mancante -->
            <div style="padding: 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.02); display: flex; flex-direction: column; align-items: center; text-align: center; gap: 12px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; 
                    @if($paymentStats['importi']['saldo_mancante'] > 0)
                        background: rgba(239, 68, 68, 0.1);
                    @elseif($paymentStats['importi']['saldo_mancante'] == 0)
                        background: rgba(34, 197, 94, 0.1);
                    @else
                        background: rgba(245, 158, 11, 0.1);
                    @endif
                    display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="
                        @if($paymentStats['importi']['saldo_mancante'] > 0)
                            color: #ef4444;
                        @elseif($paymentStats['importi']['saldo_mancante'] == 0)
                            color: #22c55e;
                        @else
                            color: #f59e0b;
                        @endif">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 28px; font-weight: 700; 
                        @if($paymentStats['importi']['saldo_mancante'] > 0)
                            color: #ef4444;
                        @elseif($paymentStats['importi']['saldo_mancante'] == 0)
                            color: #22c55e;
                        @else
                            color: #f59e0b;
                        @endif
                        margin-bottom: 4px;">€{{ number_format($paymentStats['importi']['saldo_mancante'], 2, ',', '.') }}</div>
                    <div style="font-size: 14px; color: var(--efficio-muted); font-weight: 500;">Saldo Mancante</div>
                </div>
            </div>
        </div>

        <!-- Dettagli aggiuntivi -->
        <div style="margin-top: 20px; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px; text-align: center;">
                <div>
                    <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Totale Fatturato</div>
                    <div style="font-size: 16px; font-weight: 600; color: var(--efficio-text);">€{{ number_format($paymentStats['importi']['fatturato'], 2, ',', '.') }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Fatture Pagate</div>
                    <div style="font-size: 16px; font-weight: 600; color: #22c55e;">{{ $paymentStats['totali']['pagate'] }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">In Sospeso</div>
                    <div style="font-size: 16px; font-weight: 600; color: #f59e0b;">{{ $paymentStats['totali']['inviate'] }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Scadute</div>
                    <div style="font-size: 16px; font-weight: 600; color: #ef4444;">{{ $paymentStats['totali']['scadute'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes Section (if available) -->
    @if($customer->notes)
    <div class="card" style="padding: 24px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(236, 72, 153, 0.1); display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #ec4899;">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Note</h3>
        </div>
        
        <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); color: var(--efficio-text); line-height: 1.6;">
            {{ $customer->notes }}
        </div>
    </div>
    @endif
</div>

<style>
@media (max-width: 768px) {
    .card {
        padding: 16px !important;
    }
    
    div[style*="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr))"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))"] {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 12px !important;
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
}

/* Stili per le card copiabili */
.copyable-card {
    cursor: pointer;
    transition: all 0.2s ease;
}

.copyable-card:hover {
    background: rgba(255,255,255,0.05) !important;
    border-color: rgba(255,255,255,0.15) !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.copyable-card:hover .copy-icon {
    opacity: 1 !important;
    color: var(--efficio-accent) !important;
}

.copyable-card.copied {
    background: rgba(34, 197, 94, 0.1) !important;
    border-color: #22c55e !important;
}

.copyable-card.copied .copy-icon {
    opacity: 1 !important;
    color: #22c55e !important;
}

.copyable-card.copied .copy-icon svg {
    animation: checkmark 0.3s ease-in-out;
}

@keyframes checkmark {
    0% { transform: scale(0.8); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Toast di conferma */
.copy-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: rgba(34, 197, 94, 0.95);
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 500;
    z-index: 1000;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.copy-toast.show {
    transform: translateX(0);
}

@media (max-width: 768px) {
    .copy-toast {
        top: 10px;
        right: 10px;
        left: 10px;
        transform: translateY(-100%);
    }
    
    .copy-toast.show {
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestione delle card copiabili
    const copyableCards = document.querySelectorAll('.copyable-card');
    
    copyableCards.forEach(card => {
        card.addEventListener('click', function() {
            const content = this.dataset.content;
            const label = this.dataset.label;
            
            // Copia negli appunti
            copyToClipboard(content, label, this);
        });
        
        // Mostra icona copia al hover
        card.addEventListener('mouseenter', function() {
            const copyIcon = this.querySelector('.copy-icon');
            if (copyIcon) {
                copyIcon.style.opacity = '1';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const copyIcon = this.querySelector('.copy-icon');
            if (copyIcon && !this.classList.contains('copied')) {
                copyIcon.style.opacity = '0';
            }
        });
    });
    
    // Funzione per copiare negli appunti
    function copyToClipboard(text, label, cardElement) {
        // Prova prima con l'API moderna
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(() => {
                showCopySuccess(label, cardElement);
            }).catch(() => {
                // Fallback per browser più vecchi
                fallbackCopyToClipboard(text, label, cardElement);
            });
        } else {
            // Fallback per browser più vecchi
            fallbackCopyToClipboard(text, label, cardElement);
        }
    }
    
    // Fallback per browser più vecchi
    function fallbackCopyToClipboard(text, label, cardElement) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showCopySuccess(label, cardElement);
        } catch (err) {
            console.error('Fallback: Impossibile copiare', err);
            showCopyError(label);
        }
        
        document.body.removeChild(textArea);
    }
    
    // Mostra successo della copia
    function showCopySuccess(label, cardElement) {
        // Aggiungi classe per feedback visivo
        cardElement.classList.add('copied');
        
        // Mostra toast di conferma
        showToast(`${label} copiato negli appunti!`, 'success');
        
        // Rimuovi classe dopo 2 secondi
        setTimeout(() => {
            cardElement.classList.remove('copied');
        }, 2000);
    }
    
    // Mostra errore della copia
    function showCopyError(label) {
        showToast(`Errore nella copia di ${label}`, 'error');
    }
    
    // Mostra toast
    function showToast(message, type = 'success') {
        // Rimuovi toast esistenti
        const existingToast = document.querySelector('.copy-toast');
        if (existingToast) {
            existingToast.remove();
        }
        
        // Crea nuovo toast
        const toast = document.createElement('div');
        toast.className = 'copy-toast';
        toast.textContent = message;
        
        // Stile in base al tipo
        if (type === 'error') {
            toast.style.background = 'rgba(239, 68, 68, 0.95)';
        }
        
        document.body.appendChild(toast);
        
        // Mostra toast
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);
        
        // Nascondi toast dopo 3 secondi
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 300);
        }, 3000);
    }
});
</script>
@endsection


