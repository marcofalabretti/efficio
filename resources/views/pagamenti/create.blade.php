@extends('layouts.app')

@section('title', 'Nuovo Pagamento')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #34d399 100%); display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/>
                </svg>
            </div>
            <div>
                <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Pagamenti</div>
                <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">Nuovo Pagamento</h1>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="card">
        <div style="padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Dettagli Pagamento</h3>
        </div>
        
        <form action="{{ route('pagamenti.store') }}" method="POST" style="padding: 24px;">
            @csrf
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 24px;">
                <!-- Fattura -->
                <div>
                    <label for="fattura_id" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Fattura *
                    </label>
                    <select name="fattura_id" id="fattura_id" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona una fattura</option>
                        @foreach($fatture as $fattura)
                            <option value="{{ $fattura->id }}" 
                                    {{ old('fattura_id', $fatturaSelezionata ? $fatturaSelezionata->id : '') == $fattura->id ? 'selected' : '' }}>
                                {{ $fattura->numero }} - {{ $fattura->customer->name }} 
                                (€{{ number_format($fattura->importo_totale, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('fattura_id')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Importo -->
                <div>
                    <label for="importo" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Importo (€) *
                    </label>
                    <input type="number" name="importo" id="importo" value="{{ old('importo') }}" step="0.01" min="0" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('importo')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Data Pagamento -->
                <div>
                    <label for="data_pagamento" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Data Pagamento *
                    </label>
                    <input type="date" name="data_pagamento" id="data_pagamento" value="{{ old('data_pagamento', date('Y-m-d')) }}" required
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('data_pagamento')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Metodo Pagamento -->
                <div>
                    <label for="metodo_pagamento" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Metodo Pagamento *
                    </label>
                    <select name="metodo_pagamento" id="metodo_pagamento" required
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona metodo pagamento</option>
                        <option value="bonifico" {{ old('metodo_pagamento') == 'bonifico' ? 'selected' : '' }}>Bonifico</option>
                        <option value="assegno" {{ old('metodo_pagamento') == 'assegno' ? 'selected' : '' }}>Assegno</option>
                        <option value="carta" {{ old('metodo_pagamento') == 'carta' ? 'selected' : '' }}>Carta di Credito</option>
                        <option value="contanti" {{ old('metodo_pagamento') == 'contanti' ? 'selected' : '' }}>Contanti</option>
                    </select>
                    @error('metodo_pagamento')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Stato -->
                <div>
                    <label for="stato" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Stato *
                    </label>
                    <select name="stato" id="stato" required
                            style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                        <option value="">Seleziona stato</option>
                        <option value="pendente" {{ old('stato') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="confermato" {{ old('stato') == 'confermato' ? 'selected' : '' }}>Confermato</option>
                        <option value="annullato" {{ old('stato') == 'annullato' ? 'selected' : '' }}>Annullato</option>
                    </select>
                    @error('stato')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Riferimento Pagamento -->
                <div>
                    <label for="riferimento_pagamento" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                        Riferimento Pagamento
                    </label>
                    <input type="text" name="riferimento_pagamento" id="riferimento_pagamento" value="{{ old('riferimento_pagamento') }}"
                           placeholder="Es. Numero assegno, riferimento bonifico..."
                           style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease;">
                    @error('riferimento_pagamento')
                        <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Note -->
            <div style="margin-bottom: 24px;">
                <label for="note" style="display: block; font-size: 13px; font-weight: 600; color: var(--efficio-text); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                    Note
                </label>
                <textarea name="note" id="note" rows="4" placeholder="Note aggiuntive sul pagamento..."
                          style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; resize: vertical;">{{ old('note') }}</textarea>
                @error('note')
                    <p style="margin: 8px 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Actions -->
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <a href="{{ route('pagamenti.index') }}" 
                   style="padding: 12px 24px; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; background: transparent; color: var(--efficio-text); text-decoration: none; font-weight: 500; transition: all 0.2s ease;">
                    Annulla
                </a>
                <button type="submit" 
                        style="padding: 12px 24px; border: 1px solid var(--efficio-accent); border-radius: 8px; background: var(--efficio-accent); color: #000; font-weight: 600; cursor: pointer; transition: all 0.2s ease;">
                    Crea Pagamento
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

<script>
// Aggiorna automaticamente lo stato in base all'importo
document.addEventListener('DOMContentLoaded', function() {
    const importoInput = document.getElementById('importo');
    const fatturaSelect = document.getElementById('fattura_id');
    const statoSelect = document.getElementById('stato');
    
    function updateStato() {
        const importo = parseFloat(importoInput.value) || 0;
        const fatturaId = fatturaSelect.value;
        
        if (fatturaId && importo > 0) {
            // Trova la fattura selezionata
            const fatturaOption = fatturaSelect.querySelector(`option[value="${fatturaId}"]`);
            if (fatturaOption) {
                // Estrai l'importo totale dalla fattura dal testo dell'opzione
                const match = fatturaOption.textContent.match(/€([\d.,]+)/);
                if (match) {
                    const importoTotale = parseFloat(match[1].replace(',', '.'));
                    
                    if (importo >= importoTotale) {
                        statoSelect.value = 'confermato';
                    } else {
                        statoSelect.value = 'pendente';
                    }
                }
            }
        }
    }
    
    importoInput.addEventListener('input', updateStato);
    fatturaSelect.addEventListener('change', updateStato);
});
</script>
@endsection
