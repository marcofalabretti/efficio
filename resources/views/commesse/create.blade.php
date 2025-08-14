@extends('layouts.app')

@section('content')
<div class="card" style="display:grid; gap:16px;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <div style="font-size:12px; color:var(--efficio-muted); text-transform:uppercase; letter-spacing:.08em;">Nuova Commessa</div>
            <h2 style="margin:4px 0 0;">Crea Nuova Commessa</h2>
        </div>
        <a href="{{ route('commesse.index') }}" class="item" style="padding:8px 12px; border:1px solid rgba(255,255,255,.1); border-radius:8px;">
            Torna alle Commesse
        </a>
    </div>

    <form action="{{ route('commesse.store') }}" method="POST" class="card" style="display:grid; gap:20px;">
        @csrf
        
        <div style="display:grid; grid-template-columns: repeat(12, 1fr); gap:16px;">
            <!-- Informazioni base -->
            <div style="grid-column: span 12;">
                <label for="nome" style="display:block; margin-bottom:8px; font-weight:500;">Nome *</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                @error('nome')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 12;">
                <label for="descrizione" style="display:block; margin-bottom:8px; font-weight:500;">Descrizione</label>
                <textarea id="descrizione" name="descrizione" rows="3" style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white; resize:vertical;">{{ old('descrizione') }}</textarea>
                @error('descrizione')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date e stato -->
            <div style="grid-column: span 4;">
                <label for="stato" style="display:block; margin-bottom:8px; font-weight:500;">Stato *</label>
                <select id="stato" name="stato" required
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                    <option value="">Seleziona stato</option>
                    <option value="attiva" {{ old('stato') == 'attiva' ? 'selected' : '' }}>Attiva</option>
                    <option value="completata" {{ old('stato') == 'completata' ? 'selected' : '' }}>Completata</option>
                    <option value="sospesa" {{ old('stato') == 'sospesa' ? 'selected' : '' }}>Sospesa</option>
                    <option value="annullata" {{ old('stato') == 'annullata' ? 'selected' : '' }}>Annullata</option>
                </select>
                @error('stato')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 4;">
                <label for="data_inizio" style="display:block; margin-bottom:8px; font-weight:500;">Data Inizio *</label>
                <input type="date" id="data_inizio" name="data_inizio" value="{{ old('data_inizio') }}" required
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                @error('data_inizio')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 4;">
                <label for="data_fine_prevista" style="display:block; margin-bottom:8px; font-weight:500;">Data Fine Prevista</label>
                <input type="date" id="data_fine_prevista" name="data_fine_prevista" value="{{ old('data_fine_prevista') }}"
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                @error('data_fine_prevista')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Budget e ore -->
            <div style="grid-column: span 4;">
                <label for="budget" style="display:block; margin-bottom:8px; font-weight:500;">Budget (€)</label>
                <input type="number" id="budget" name="budget" value="{{ old('budget') }}" step="0.01" min="0"
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                @error('budget')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 4;">
                <label for="ore_stimate" style="display:block; margin-bottom:8px; font-weight:500;">Ore Stimate</label>
                <input type="number" id="ore_stimate" name="ore_stimate" value="{{ old('ore_stimate') }}" step="0.5" min="0"
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                @error('ore_stimate')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 4;">
                <label for="note" style="display:block; margin-bottom:8px; font-weight:500;">Note</label>
                <input type="text" id="note" name="note" value="{{ old('note') }}"
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                @error('note')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Collegamenti -->
            <div style="grid-column: span 6;">
                <label for="customer_id" style="display:block; margin-bottom:8px; font-weight:500;">Cliente *</label>
                <select id="customer_id" name="customer_id" required
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                    <option value="">Seleziona cliente</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 6;">
                <label for="project_id" style="display:block; margin-bottom:8px; font-weight:500;">Progetto</label>
                <select id="project_id" name="project_id"
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                    <option value="">Seleziona progetto</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 6;">
                <label for="responsabile_id" style="display:block; margin-bottom:8px; font-weight:500;">Responsabile</label>
                <select id="responsabile_id" name="responsabile_id"
                    style="width:100%; padding:10px; border:1px solid rgba(255,255,255,.1); border-radius:6px; background:rgba(255,255,255,.05); color:white;">
                    <option value="">Seleziona responsabile</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('responsabile_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('responsabile_id')
                    <div style="color:#ef4444; font-size:14px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="display:flex; gap:12px; justify-content:flex-end;">
            <a href="{{ route('commesse.index') }}" class="item" style="padding:10px 16px; border:1px solid rgba(255,255,255,.1); border-radius:8px;">
                Annulla
            </a>
            <button type="submit" style="padding:10px 16px; background:var(--efficio-primary); color:white; border:none; border-radius:8px; cursor:pointer;">
                Crea Commessa
            </button>
        </div>
    </form>
</div>

<style>
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
