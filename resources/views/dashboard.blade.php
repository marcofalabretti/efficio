@extends('layouts.app')

@section('content')
<div class="card" style="display:grid; gap:16px;">
    <div>
        <h1 style="margin:0; font-size:20px; font-weight:600;">Benvenuto in <span style="color:var(--efficio-accent); text-shadow:0 0 8px rgba(201,255,46,.55)">EFFICIO</span></h1>
        <p style="margin:6px 0 0; color:var(--efficio-muted)">Successi integrati — dashboard</p>
    </div>

    <div style="display:grid; grid-template-columns: repeat(12, 1fr); gap: 16px;">
        <div class="card" style="grid-column: span 12;">
            <div style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
                <div>
                    <div style="font-size:12px; color:var(--efficio-muted); text-transform:uppercase; letter-spacing:.08em;">Metriche rapide</div>
                    <div style="font-size:18px; font-weight:600;">Overview</div>
                </div>
                <button class="icon-btn" title="Aggiorna" aria-label="Aggiorna">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 7h-5m5 0l-3-3m3 3l-3 3M4 17h5m-5 0l3 3m-3-3l3-3M7 7h1a9 9 0 019 9v1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
            </div>
                               <div style="margin-top:12px; display:grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px;">
                       @foreach ([
                           ['Clienti', 12, route('customers.index')], 
                           ['Commesse', 8, route('commesse.index')], 
                           ['Preventivi', 5, route('preventivi.index')], 
                           ['Fatture', 5, route('fatture.index')]
                       ] as [$label, $value, $link])
                           <a href="{{ $link }}" class="card" style="display:grid; gap:6px; text-decoration:none; color:inherit; transition:transform .2s ease, box-shadow .2s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow)'">
                               <div style="font-size:12px; color:var(--efficio-muted)">{{ $label }}</div>
                               <div style="font-size:22px; font-weight:700">{{ $value }}</div>
                           </a>
                       @endforeach
                   </div>
        </div>
    </div>
</div>
@endsection


