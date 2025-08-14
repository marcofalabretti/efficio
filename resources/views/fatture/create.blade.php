@extends('layouts.app')

@section('title', 'Nuova Fattura')

@section('content')
<div style="max-width: 1400px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #ef4444 0%, #f87171 100%); display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Nuova Fattura</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">Crea Fattura</h1>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('fatture.index') }}" class="item" style="padding: 10px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Lista Fatture
                </a>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Dettagli Fattura</h3>
        </div>
        
        <form action="{{ route('fatture.store') }}" method="POST" style="padding: 24px;">
            @csrf
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 24px;">
                <!-- Numero e Data -->
                <div>
                    <label for="numero" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Numero * (es: F001/2025)
                    </label>
                    <input type="text" name="numero" id="numero" value="{{ old('numero') }}" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('numero')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="data" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Data * 
                    </label>
                    <input type="date" name="data" id="data" value="{{ old('data', date('Y-m-d')) }}" required
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
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
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
                            <option value="{{ $commessa->id }}" {{ old('commessa_id') == $commessa->id ? 'selected' : '' }}>
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
                            <option value="{{ $preventivo->id }}" {{ old('preventivo_id') == $preventivo->id ? 'selected' : '' }}>
                                {{ $preventivo->numero }} - {{ $preventivo->oggetto ?? 'Senza oggetto' }}
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
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Stato e Importi -->
                <div>
                    <label for="stato" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Stato * 
                    </label>
                    <select name="stato" id="stato" required
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona lo stato</option>
                        <option value="bozza" {{ old('stato') == 'bozza' ? 'selected' : '' }}>Bozza</option>
                        <option value="inviata" {{ old('stato') == 'inviata' ? 'selected' : '' }}>Inviata</option>
                        <option value="pagata" {{ old('stato') == 'pagata' ? 'selected' : '' }}>Pagata</option>
                        <option value="scaduta" {{ old('stato') == 'scaduta' ? 'selected' : '' }}>Scaduta</option>
                        <option value="annullata" {{ old('stato') == 'annullata' ? 'selected' : '' }}>Annullata</option>
                    </select>
                    @error('stato')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="importo_netto" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Importo Netto (€) * 
                    </label>
                    <input type="number" name="importo_netto" id="importo_netto" value="{{ old('importo_netto') }}" step="0.01" min="0" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('importo_netto')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="percentuale_iva" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Percentuale IVA (%) * 
                    </label>
                    <input type="number" name="percentuale_iva" id="percentuale_iva" value="{{ old('percentuale_iva', 22) }}" step="0.01" min="0" max="100" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('percentuale_iva')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Data Scadenza -->
                <div>
                    <label for="data_scadenza" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Data Scadenza
                    </label>
                    <input type="date" name="data_scadenza" id="data_scadenza" value="{{ old('data_scadenza') }}"
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('data_scadenza')
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
                          style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; resize: vertical;">{{ old('note') }}</textarea>
                @error('note')
                    <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Pulsanti -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08);">
                <a href="{{ route('fatture.index') }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); display: flex; align-items: center; gap: 8px; font-weight: 500; text-decoration: none; transition: all 0.2s ease;">
                    Annulla
                </a>
                <button type="submit" class="item" style="padding: 12px 20px; border: 1px solid var(--efficio-accent); border-radius: 8px; background: var(--efficio-accent); color: #000; display: flex; align-items: center; gap: 8px; font-weight: 600; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Crea Fattura
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
