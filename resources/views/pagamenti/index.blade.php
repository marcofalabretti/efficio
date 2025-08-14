@extends('layouts.app')

@section('title', 'Pagamenti')

@section('content')
<div style="max-width: 1400px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #34d399 100%); display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Pagamenti</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">Gestisci Pagamenti</h1>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('pagamenti.create') }}" class="item" style="padding: 12px 20px; border: 1px solid var(--efficio-accent); border-radius: 8px; background: var(--efficio-accent); color: #000; display: flex; align-items: center; gap: 8px; font-weight: 600; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Nuovo Pagamento
                </a>
            </div>
        </div>
    </div>

    <!-- Filtri -->
    <div class="card" style="margin-bottom: 24px;">
        <div style="padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Filtri</h3>
        </div>
        <div style="padding: 24px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div>
                    <label for="stato_filter" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">Stato</label>
                    <select id="stato_filter" style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Tutti gli stati</option>
                        <option value="pendente">Pendente</option>
                        <option value="confermato">Confermato</option>
                        <option value="annullato">Annullato</option>
                    </select>
                </div>
                <div>
                    <label for="metodo_filter" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">Metodo</label>
                    <select id="metodo_filter" style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Tutti i metodi</option>
                        <option value="bonifico">Bonifico</option>
                        <option value="assegno">Assegno</option>
                        <option value="carta">Carta</option>
                        <option value="contanti">Contanti</option>
                    </select>
                </div>
                <div>
                    <label for="data_filter" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">Data</label>
                    <input type="date" id="data_filter" style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                </div>
            </div>
        </div>
    </div>

    <!-- Tabella Pagamenti -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Lista Pagamenti</h3>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: rgba(255,255,255,0.05);">
                    <tr>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Fattura
                        </th>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Cliente
                        </th>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Importo
                        </th>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Data Pagamento
                        </th>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Metodo
                        </th>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Stato
                        </th>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Creato da
                        </th>
                        <th style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255,255,255,0.08);">
                            Azioni
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pagamenti as $pagamento)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.08); transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 16px;">
                            <div style="font-size: 14px; font-weight: 500; color: var(--efficio-text);">
                                @php
                                    $fattura = $pagamento->fattura;
                                @endphp
                                @if($fattura)
                                    <a href="{{ route('fatture.show', $fattura) }}" style="color: var(--efficio-accent); text-decoration: none; hover:underline;">
                                        {{ $fattura->numero }}
                                    </a>
                                @else
                                    <span style="color: var(--efficio-muted);">Fattura non trovata</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 16px;">
                            <div style="font-size: 14px; color: var(--efficio-text);">
                                @if($fattura && $fattura->customer)
                                    <a href="{{ route('customers.show', $fattura->customer) }}" style="color: var(--efficio-accent); text-decoration: none; hover:underline;">
                                        {{ $fattura->customer->name }}
                                    </a>
                                @else
                                    <span style="color: var(--efficio-muted);">Cliente non trovato</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 16px;">
                            <div style="font-size: 14px; font-weight: 600; color: var(--efficio-text);">
                                € {{ number_format($pagamento->importo, 2, ',', '.') }}
                            </div>
                        </td>
                        <td style="padding: 16px;">
                            <div style="font-size: 14px; color: var(--efficio-text);">
                                {{ $pagamento->data_pagamento->format('d/m/Y') }}
                            </div>
                        </td>
                        <td style="padding: 16px;">
                            <div style="font-size: 14px; color: var(--efficio-text);">
                                {{ ucfirst($pagamento->metodo_pagamento) }}
                            </div>
                        </td>
                        <td style="padding: 16px;">
                            <span style="padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; {{ $pagamento->getStatoColor() }}">
                                {{ ucfirst($pagamento->stato) }}
                            </span>
                        </td>
                        <td style="padding: 16px;">
                            <div style="font-size: 14px; color: var(--efficio-text);">
                                {{ $pagamento->creator->name }}
                            </div>
                        </td>
                        <td style="padding: 16px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('pagamenti.show', $pagamento) }}" style="padding: 6px 12px; border-radius: 6px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s ease;">
                                    Visualizza
                                </a>
                                <a href="{{ route('pagamenti.edit', $pagamento) }}" style="padding: 6px 12px; border-radius: 6px; background: rgba(34, 197, 94, 0.1); color: #22c55e; font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s ease;">
                                    Modifica
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding: 48px 16px; text-align: center;">
                            <div style="color: var(--efficio-muted);">
                                <div style="font-size: 48px; margin-bottom: 16px;">💳</div>
                                <p style="font-size: 16px; margin-bottom: 8px;">Nessun pagamento trovato</p>
                                <p style="font-size: 14px; color: var(--efficio-muted);">Crea il tuo primo pagamento per iniziare</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pagamenti->hasPages())
        <div style="padding: 20px; border-top: 1px solid rgba(255,255,255,0.08);">
            {{ $pagamenti->links() }}
        </div>
        @endif
    </div>
</div>

<style>
@media (max-width: 768px) {
    .card {
        padding: 16px !important;
    }
    
    div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }
    
    h1 {
        font-size: 24px !important;
    }
    
    .item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: var(--efficio-accent) !important;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1) !important;
}

/* Stili per le opzioni delle select nel tema scuro */
select option {
    background-color: var(--efficio-surface) !important;
    color: var(--efficio-text) !important;
}

/* Stili per le select quando sono aperte */
select:focus option:checked {
    background-color: var(--efficio-accent) !important;
    color: #000 !important;
}

select:focus option:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: var(--efficio-text) !important;
}
</style>
@endsection
