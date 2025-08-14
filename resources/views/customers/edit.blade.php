@extends('layouts.app')

@section('content')
<form class="card" method="post" action="{{ route('customers.update', $customer) }}" style="display:grid; gap:12px;">
    @csrf
    @method('PUT')
    <h2>Modifica cliente</h2>
    <div style="display:grid; grid-template-columns: repeat(12, 1fr); gap:12px;">
        <label style="grid-column: span 6; display:grid; gap:4px;">Nome
            <input name="name" required class="card" value="{{ old('name', $customer->name) }}" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">Email
            <input name="email" type="email" class="card" value="{{ old('email', $customer->email) }}" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">Telefono
            <input name="phone" class="card" value="{{ old('phone', $customer->phone) }}" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">P.IVA
            <input name="vat_number" class="card" value="{{ old('vat_number', $customer->vat_number) }}" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">CF
            <input name="fiscal_code" class="card" value="{{ old('fiscal_code', $customer->fiscal_code) }}" />
        </label>
        <label style="grid-column: span 12; display:grid; gap:4px;">Indirizzo
            <input name="street" class="card" value="{{ old('street', $customer->street) }}" />
        </label>
        <label style="grid-column: span 6; display:grid; gap:4px;">Città
            <input name="city" class="card" value="{{ old('city', $customer->city) }}" />
        </label>
        <label style="grid-column: span 3; display:grid; gap:4px;">CAP
            <input name="zip" class="card" value="{{ old('zip', $customer->zip) }}" />
        </label>
        <label style="grid-column: span 3; display:grid; gap:4px;">Nazione
            <input name="country" class="card" value="{{ old('country', $customer->country) }}" />
        </label>
        <label style="grid-column: span 12; display:grid; gap:4px;">Note
            <textarea name="notes" class="card">{{ old('notes', $customer->notes) }}</textarea>
        </label>
    </div>
    <div style="display:flex; gap:8px; justify-content:flex-end;">
        <a href="{{ route('customers.show', $customer) }}" class="item" style="padding:8px 12px;">Indietro</a>
        <button class="item" style="padding:8px 12px; border:1px solid rgba(255,255,255,.1); border-radius:8px;">Salva</button>
    </div>
</form>
@endsection


