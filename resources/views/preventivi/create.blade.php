@extends('layouts.app')

@section('title', 'Nuovo Preventivo')

@section('content')
<div style="min-height: 100vh; background: var(--efficio-bg); padding: 2rem 1rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; background: var(--efficio-surface); padding: 1.5rem; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3); border: var(--border);">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--efficio-accent) 0%, #a3e635 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="var(--efficio-bg)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 1.875rem; font-weight: 700; color: var(--efficio-text); margin: 0;">Nuovo Preventivo</h1>
                <p style="color: var(--efficio-muted); margin: 0.25rem 0 0 0;">Crea un nuovo preventivo per i tuoi clienti</p>
            </div>
            
            <div style="margin-left: auto;">
                <a href="{{ route('preventivi.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--efficio-muted); color: var(--efficio-bg); padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; transition: all 0.2s; font-weight: 500;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Lista Preventivi
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div style="background: var(--efficio-surface); border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3); overflow: hidden; border: var(--border);">
            <form action="{{ route('preventivi.store') }}" method="POST">
                @csrf
                
                <!-- Form Header -->
                <div style="padding: 1.5rem; border-bottom: var(--border); background: rgba(255,255,255,0.02);">
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--efficio-text); margin: 0;">Informazioni Principali</h2>
                </div>
                
                <div style="padding: 1.5rem;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                        <!-- Numero e Nome -->
                        <div>
                            <label for="numero" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Numero *
                            </label>
                            <input type="text" name="numero" id="numero" value="{{ old('numero') }}" required
                                   style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                            @error('numero')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        

                        
                        <!-- Cliente e Commessa -->
                        <div>
                            <label for="customer_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Cliente *
                            </label>
                            <select name="customer_id" id="customer_id" required
                                    style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                                <option value="">Seleziona un cliente</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="commessa_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Commessa
                            </label>
                            <select name="commessa_id" id="commessa_id"
                                    style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                                <option value="">Seleziona una commessa (opzionale)</option>
                                @foreach($commesse as $commessa)
                                    <option value="{{ $commessa->id }}" {{ old('commessa_id') == $commessa->id ? 'selected' : '' }}>
                                        {{ $commessa->codice }} - {{ $commessa->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('commessa_id')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Progetto e Responsabile -->
                        <div>
                            <label for="project_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Progetto
                            </label>
                            <select name="project_id" id="project_id"
                                    style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                                <option value="">Seleziona un progetto (opzionale)</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        

                        
                        <!-- Stato e Valore -->
                        <div>
                            <label for="stato" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Stato *
                            </label>
                            <select name="stato" id="stato" required
                                    style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                                <option value="">Seleziona lo stato</option>
                                <option value="bozza" {{ old('stato') == 'bozza' ? 'selected' : '' }}>Bozza</option>
                                <option value="inviato" {{ old('stato') == 'inviato' ? 'selected' : '' }}>Inviato</option>
                                <option value="accettato" {{ old('stato') == 'accettato' ? 'selected' : '' }}>Accettato</option>
                                <option value="rifiutato" {{ old('stato') == 'rifiutato' ? 'selected' : '' }}>Rifiutato</option>
                                <option value="scaduto" {{ old('stato') == 'scaduto' ? 'selected' : '' }}>Scaduto</option>
                            </select>
                            @error('stato')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="importo_netto" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Importo Netto (€) *
                            </label>
                            <input type="number" name="importo_netto" id="importo_netto" value="{{ old('importo_netto') }}" step="0.01" min="0" required
                                   style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                            @error('importo_netto')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="importo_iva" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Importo IVA (€) *
                            </label>
                            <input type="number" name="importo_iva" id="importo_iva" value="{{ old('importo_iva') }}" step="0.01" min="0" required
                                   style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                            @error('importo_iva')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="importo_totale" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Importo Totale (€) *
                            </label>
                            <input type="number" name="importo_totale" id="importo_totale" value="{{ old('importo_totale') }}" step="0.01" min="0" required
                                   style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                            @error('importo_totale')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Date -->
                        <div>
                            <label for="data" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Data *
                            </label>
                            <input type="date" name="data" id="data" value="{{ old('data') }}" required
                                   style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                            @error('data')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="data_scadenza" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                                Data Scadenza *
                            </label>
                            <input type="date" name="data_scadenza" id="data_scadenza" value="{{ old('data_scadenza') }}" required
                                   style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text);">
                            @error('data_scadenza')
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>
                        

                    </div>
                    

                    
                    <div style="margin-top: 1.5rem;">
                        <label for="note" style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--efficio-text); margin-bottom: 0.5rem;">
                            Note
                        </label>
                        <textarea name="note" id="note" rows="3"
                                  style="width: 100%; padding: 0.75rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; background: var(--efficio-bg); color: var(--efficio-text); resize: vertical;">{{ old('note') }}</textarea>
                        @error('note')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Form Footer -->
                <div style="padding: 1.5rem; background: rgba(255,255,255,0.02); border-top: var(--border); display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('preventivi.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--efficio-muted); color: var(--efficio-bg); padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; transition: all 0.2s; font-weight: 500;">
                        Annulla
                    </a>
                    <button type="submit" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--efficio-accent); color: var(--efficio-bg); padding: 0.75rem 1.5rem; border-radius: 12px; border: none; cursor: pointer; transition: all 0.2s; font-weight: 500;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Crea Preventivo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: var(--efficio-accent);
        box-shadow: var(--efficio-glow);
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
    
    @media (max-width: 768px) {
        .container {
            padding: 1rem 0.5rem;
        }
        
        .grid {
            grid-template-columns: 1fr;
        }
        
        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .header > div:last-child {
            margin-left: 0;
            align-self: stretch;
        }
        
        .header > div:last-child > a {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
