@extends('layouts.app')

@section('content')


<div class="card" style="display:grid; gap:16px;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <div style="font-size:12px; color:var(--efficio-muted); text-transform:uppercase; letter-spacing:.08em;">
                @if(isset($customer))
                    Commesse del Cliente: {{ $customer->name }}
                @else
                    Commesse
                @endif
            </div>
            <h2 style="margin:4px 0 0;">
                @if(isset($customer))
                    Commesse di {{ $customer->name }}
                @else
                    Gestione Commesse
                @endif
            </h2>
        </div>
        <a href="{{ route('commesse.create') }}" class="item" style="padding:8px 12px; border:1px solid rgba(255,255,255,.1); border-radius:8px;">
            Nuova Commessa
        </a>
    </div>

    @if(isset($customer))
        <div style="display:flex; gap:8px;">
            <a href="{{ route('customers.show', $customer) }}" class="item" style="padding:6px 10px; font-size:14px;">
                ← Torna al Cliente
            </a>
            <a href="{{ route('customers.preventivi', $customer) }}" class="item" style="padding:6px 10px; font-size:14px;">
                Preventivi
            </a>
            <a href="{{ route('customers.fatture', $customer) }}" class="item" style="padding:6px 10px; font-size:14px;">
                Fatture
            </a>
        </div>
    @endif

    <div class="card" style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid rgba(255,255,255,.1);">
                    <th style="text-align:left; padding:12px; font-weight:600;">Codice</th>
                    <th style="text-align:left; padding:12px; font-weight:600;">Nome</th>
                    <th style="text-align:left; padding:12px; font-weight:600;">Cliente</th>
                    <th style="text-align:left; padding:12px; font-weight:600;">Stato</th>
                    <th style="text-align:left; padding:12px; font-weight:600;">Data Inizio</th>
                    <th style="text-align:left; padding:12px; font-weight:600;">Budget</th>
                    <th style="text-align:left; padding:12px; font-weight:600;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commesse as $commessa)
                    <tr style="border-bottom:1px solid rgba(255,255,255,.05);">
                        <td style="padding:12px;">
                            <strong>{{ $commessa->codice }}</strong>
                        </td>
                        <td style="padding:12px;">
                            <div style="font-weight:500;">{{ $commessa->nome }}</div>
                            @if($commessa->descrizione)
                                <div style="font-size:14px; color:var(--efficio-muted); margin-top:2px;">
                                    {{ Str::limit($commessa->descrizione, 50) }}
                                </div>
                            @endif
                        </td>
                        <td style="padding:12px;">
                            @if($commessa->customer)
                                <a href="{{ route('customers.show', $commessa->customer) }}" class="item" style="font-size:14px;">
                                    {{ $commessa->customer->name }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td style="padding:12px;">
                            <span class="badge" style="background:var(--efficio-{{ $commessa->getStatoColor() }}); color:white; padding:4px 8px; border-radius:4px; font-size:12px;">
                                {{ ucfirst($commessa->stato) }}
                            </span>
                        </td>
                        <td style="padding:12px;">
                            {{ $commessa->data_inizio ? $commessa->data_inizio->format('d/m/Y') : '—' }}
                        </td>
                        <td style="padding:12px;">
                            @if($commessa->budget)
                                € {{ number_format($commessa->budget, 2, ',', '.') }}
                            @else
                                —
                            @endif
                        </td>
                        <td style="padding:12px;">
                            <div style="display:flex; gap:8px;">
                                <a href="{{ route('commesse.show', $commessa) }}" class="item" style="padding:4px 8px; font-size:12px;">
                                    Visualizza
                                </a>
                                <a href="{{ route('commesse.edit', $commessa) }}" class="item" style="padding:4px 8px; font-size:12px;">
                                    Modifica
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:24px; text-align:center; color:var(--efficio-muted);">
                            @if(isset($customer))
                                Nessuna commessa trovata per questo cliente.
                            @else
                                Nessuna commessa trovata.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($commesse->hasPages())
        <div style="display:flex; justify-content:center;">
            {{ $commesse->links() }}
        </div>
    @endif
</div>
@endsection
