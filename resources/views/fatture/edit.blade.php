@extends('layouts.app')

@section('title', 'Modifica Fattura ' . $fattura->codice)

@section('content')
<div style="max-width: 1400px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #ef4444 0%, #f87171 100%); display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Modifica Fattura</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">{{ $fattura->codice }}</h1>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('fatture.show', $fattura) }}" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Dettagli Fattura
                </a>
                <a href="{{ route('fatture.index') }}" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Lista Fatture
                </a>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Modifica Dettagli</h3>
        </div>
        
        <form action="{{ route('fatture.update', $fattura) }}" method="POST" style="padding: 24px;">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 24px;">
                <!-- Codice e Data -->
                <div>
                    <label for="codice" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Codice *
                    </label>
                    <input type="text" name="codice" id="codice" value="{{ old('codice', $fattura->codice) }}" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('codice')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="data" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Data *
                    </label>
                    <input type="date" name="data" id="data" value="{{ old('data', $fattura->data->format('Y-m-d')) }}" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('data')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cliente e Commessa -->
                <div>
                    <label for="customer_id" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Cliente *
                    </label>
                    <select name="customer_id" id="customer_id" required
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona un cliente</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id', $fattura->customer_id) == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }} ({{ $customer->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="commessa_id" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Commessa
                    </label>
                    <select name="commessa_id" id="commessa_id"
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona una commessa (opzionale)</option>
                        @foreach($commesse as $commessa)
                            <option value="{{ $commessa->id }}" {{ old('commessa_id', $fattura->commessa_id) == $commessa->id ? 'selected' : '' }}>
                                {{ $commessa->codice }} - {{ $commessa->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('commessa_id')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preventivo e Progetto -->
                <div>
                    <label for="preventivo_id" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Preventivo
                    </label>
                    <select name="preventivo_id" id="preventivo_id"
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona un preventivo (opzionale)</option>
                        @foreach($preventivi as $preventivo)
                            <option value="{{ $preventivo->id }}" {{ old('preventivo_id', $fattura->preventivo_id) == $preventivo->id ? 'selected' : '' }}>
                                {{ $preventivo->codice }} - {{ $preventivo->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('preventivo_id')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="project_id" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Progetto
                    </label>
                    <select name="project_id" id="project_id"
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona un progetto (opzionale)</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $fattura->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stato e Totale -->
                <div>
                    <label for="stato" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Stato *
                    </label>
                    <select name="stato" id="stato" required
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona lo stato</option>
                        <option value="emessa" {{ old('stato', $fattura->stato) == 'emessa' ? 'selected' : '' }}>Emessa</option>
                        <option value="pagata" {{ old('stato', $fattura->stato) == 'pagata' ? 'selected' : '' }}>Pagata</option>
                        <option value="parzialmente_pagata" {{ old('stato', $fattura->stato) == 'parzialmente_pagata' ? 'selected' : '' }}>Parzialmente Pagata</option>
                        <option value="scaduta" {{ old('stato', $fattura->stato) == 'scaduta' ? 'selected' : '' }}>Scaduta</option>
                    </select>
                    @error('stato')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="totale" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Totale (€) *
                    </label>
                    <input type="number" name="totale" id="totale" value="{{ old('totale', $fattura->totale) }}" step="0.01" min="0" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('totale')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date -->
                <div>
                    <label for="data_scadenza" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Data Scadenza
                    </label>
                    <input type="date" name="data_scadenza" id="data_scadenza" 
                           value="{{ old('data_scadenza', $fattura->data_scadenza ? $fattura->data_scadenza->format('Y-m-d') : '') }}"
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('data_scadenza')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="data_pagamento" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Data Pagamento
                    </label>
                    <input type="date" name="data_pagamento" id="data_pagamento" 
                           value="{{ old('data_pagamento', $fattura->data_pagamento ? $fattura->data_pagamento->format('Y-m-d') : '') }}"
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('data_pagamento')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Note -->
            <div style="margin-bottom: 24px;">
                <label for="note" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                    Note
                </label>
                <textarea name="note" id="note" rows="3"
                          style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; resize: vertical;">{{ old('note', $fattura->note) }}</textarea>
                @error('note')
                    <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pulsanti -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08);">
                <a href="{{ route('fatture.show', $fattura) }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); display: flex; align-items: center; gap: 8px; font-weight: 500; text-decoration: none; transition: all 0.2s ease;">
                    Annulla
                </a>
                <button type="submit" class="item" style="padding: 12px 20px; border: 1px solid var(--efficio-accent); border-radius: 8px; background: var(--efficio-accent); color: #000; display: flex; align-items: center; gap: 8px; font-weight: 600; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Aggiorna Fattura
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
