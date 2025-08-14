@extends('layouts.app')

@section('content')
<form class="card" method="post" action="{{ route('customers.store') }}" style="display:grid; gap:12px;">
    @csrf
    <h2>Nuovo cliente</h2>
    <div style="display:grid; grid-template-columns: repeat(12, 1fr); gap:12px;">
        <label style="grid-column: span 6; display:grid; gap:4px;">Nome
            <input name="name" required class="card" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">Email
            <input name="email" type="email" class="card" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">Telefono
            <input name="phone" class="card" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">P.IVA
            <input name="vat_number" class="card" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">CF
            <input name="fiscal_code" class="card" />
        </label>
        <label style="grid-column: span 12; display:grid; gap:4px;">Indirizzo
            <input name="street" class="card" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">Città
            <input name="city" class="card" />
        </label>
        <label style="grid-column: span 3; display:grid; gap:4px;">CAP
            <input name="zip" class="card" />
        </label>
        <label style="grid-column: span 3; display:grid; gap:4px;">Nazione
            <input name="country" class="card" />
        </label>
        <label style="grid-column: span 12; display:grid; gap:4px;">Note
            <textarea name="notes" class="card"></textarea>
        </label>
    </div>
    <div style="display:flex; gap:8px; justify-content:flex-end;">
        <a href="{{ route('customers.index') }}" class="item" style="padding:8px 12px;">Annulla</a>
        <button class="item" style="padding:8px 12px; border:1px solid rgba(255,255,255,.1); border-radius:8px;">Salva</button>
    </div>
</form>
@endsection


