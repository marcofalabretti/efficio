@extends('layouts.app')

@section('title', 'Modifica Movimento Magazzino')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Modifica Movimento Magazzino</h1>
        <a href="{{ route('movimenti-magazzino.show', $movimento) }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Torna ai Dettagli
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b">
            <h2 class="text-xl font-semibold text-gray-800">
                Modifica Movimento: {{ $movimento->articolo->nome }}
            </h2>
            <p class="text-gray-600 mt-1">
                Codice: {{ $movimento->articolo->codice }} | 
                Tipo: {{ ucfirst($movimento->tipo_movimento) }} | 
                Data: {{ $movimento->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        <form action="{{ route('movimenti-magazzino.update', $movimento) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Articolo (non modificabile) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Articolo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           value="{{ $movimento->articolo->nome }} ({{ $movimento->articolo->codice }})" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                           readonly>
                    <input type="hidden" name="articolo_id" value="{{ $movimento->articolo_id }}">
                    <p class="text-sm text-gray-500 mt-1">
                        Giacenza attuale: <span class="font-semibold">{{ number_format($movimento->articolo->giacenza_attuale, 2) }}</span> 
                        {{ $movimento->articolo->unita_misura }}
                    </p>
                </div>

                <!-- Tipo Movimento -->
                <div>
                    <label for="tipo_movimento" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo Movimento <span class="text-red-500">*</span>
                    </label>
                    <select id="tipo_movimento" name="tipo_movimento" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="carico" {{ $movimento->tipo_movimento === 'carico' ? 'selected' : '' }}>Carico</option>
                        <option value="scarico" {{ $movimento->tipo_movimento === 'scarico' ? 'selected' : '' }}>Scarico</option>
                        <option value="trasferimento" {{ $movimento->tipo_movimento === 'trasferimento' ? 'selected' : '' }}>Trasferimento</option>
                        <option value="inventario" {{ $movimento->tipo_movimento === 'inventario' ? 'selected' : '' }}>Inventario</option>
                        <option value="reso" {{ $movimento->tipo_movimento === 'reso' ? 'selected' : '' }}>Reso</option>
                        <option value="altro" {{ $movimento->tipo_movimento === 'altro' ? 'selected' : '' }}>Altro</option>
                    </select>
                    @error('tipo_movimento')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Quantità -->
                <div>
                    <label for="quantita" class="block text-sm font-medium text-gray-700 mb-2">
                        Quantità <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" id="quantita" name="quantita" 
                               value="{{ old('quantita', $movimento->quantita) }}" 
                               step="0.01" min="0.01" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 text-sm">{{ $movimento->articolo->unita_misura }}</span>
                        </div>
                    </div>
                    @error('quantita')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prezzo Unitario -->
                <div>
                    <label for="prezzo_unitario" class="block text-sm font-medium text-gray-700 mb-2">
                        Prezzo Unitario
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">€</span>
                        </div>
                        <input type="number" id="prezzo_unitario" name="prezzo_unitario" 
                               value="{{ old('prezzo_unitario', $movimento->prezzo_unitario) }}" 
                               step="0.01" min="0"
                               class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    @error('prezzo_unitario')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Causale -->
                <div>
                    <label for="causale" class="block text-sm font-medium text-gray-700 mb-2">
                        Causale
                    </label>
                    <input type="text" id="causale" name="causale" 
                           value="{{ old('causale', $movimento->causale) }}" 
                           maxlength="200"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Es. Acquisto, Vendita, Inventario...">
                    @error('causale')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Documento Tipo -->
                <div>
                    <label for="documento_tipo" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo Documento
                    </label>
                    <select id="documento_tipo" name="documento_tipo"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleziona tipo...</option>
                        <option value="fattura" {{ $movimento->documento_tipo === 'fattura' ? 'selected' : '' }}>Fattura</option>
                        <option value="ddt" {{ $movimento->documento_tipo === 'ddt' ? 'selected' : '' }}>DDT</option>
                        <option value="ordine" {{ $movimento->documento_tipo === 'ordine' ? 'selected' : '' }}>Ordine</option>
                        <option value="preventivo" {{ $movimento->documento_tipo === 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                        <option value="commessa" {{ $movimento->documento_tipo === 'commessa' ? 'selected' : '' }}>Commessa</option>
                        <option value="altro" {{ $movimento->tipo_movimento === 'altro' ? 'selected' : '' }}>Altro</option>
                    </select>
                    @error('documento_tipo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Numero Documento -->
                <div>
                    <label for="numero_documento" class="block text-sm font-medium text-gray-700 mb-2">
                        Numero Documento
                    </label>
                    <input type="text" id="numero_documento" name="numero_documento" 
                           value="{{ old('numero_documento', $movimento->numero_documento) }}" 
                           maxlength="50"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Es. F001/2024">
                    @error('numero_documento')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fornitore -->
                <div>
                    <label for="fornitore_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Fornitore
                    </label>
                    <select id="fornitore_id" name="fornitore_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleziona fornitore...</option>
                        @foreach($fornitori as $fornitore)
                            <option value="{{ $fornitore->id }}" {{ $movimento->fornitore_id == $fornitore->id ? 'selected' : '' }}>
                                {{ $fornitore->ragione_sociale }}
                            </option>
                        @endforeach
                    </select>
                    @error('fornitore_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Customer -->
                <div>
                    <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Cliente
                    </label>
                    <select id="customer_id" name="customer_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleziona cliente...</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $movimento->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Note -->
            <div class="mt-6">
                <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                    Note
                </label>
                <textarea id="note" name="note" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Note aggiuntive sul movimento...">{{ old('note', $movimento->note) }}</textarea>
                @error('note')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Calcolo Giacenza -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Calcolo Giacenza</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="text-center">
                        <span class="text-gray-600">Giacenza Attuale:</span>
                        <div class="text-lg font-bold text-blue-600">
                            {{ number_format($movimento->articolo->giacenza_attuale, 2) }} {{ $movimento->articolo->unita_misura }}
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-gray-600">Quantità Movimento:</span>
                        <div id="quantita-display" class="text-lg font-bold text-green-600">
                            {{ number_format($movimento->quantita, 2) }} {{ $movimento->articolo->unita_misura }}
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-gray-600">Nuova Giacenza:</span>
                        <div id="nuova-giacenza" class="text-lg font-bold text-purple-600">
                            Calcolo in tempo reale...
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <span class="text-xs text-gray-500">
                        ⚠️ Attenzione: La modifica di questo movimento influenzerà la giacenza dell'articolo
                    </span>
                </div>
            </div>

            <!-- Pulsanti -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('movimenti-magazzino.show', $movimento) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
                    Annulla
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
                    Aggiorna Movimento
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoMovimentoSelect = document.getElementById('tipo_movimento');
    const quantitaInput = document.getElementById('quantita');
    const quantitaDisplay = document.getElementById('quantita-display');
    const nuovaGiacenzaDisplay = document.getElementById('nuova-giacenza');
    
    const giacenzaAttuale = {{ $movimento->articolo->giacenza_attuale }};
    
    function calcolaNuovaGiacenza() {
        const quantita = parseFloat(quantitaInput.value) || 0;
        const tipoMovimento = tipoMovimentoSelect.value;
        
        let nuovaGiacenza = giacenzaAttuale;
        
        if (tipoMovimento === 'carico' || tipoMovimento === 'reso') {
            nuovaGiacenza += quantita;
        } else if (tipoMovimento === 'scarico') {
            nuovaGiacenza -= quantita;
        } else if (tipoMovimento === 'inventario') {
            // Per l'inventario, la quantità diventa la nuova giacenza
            nuovaGiacenza = quantita;
        }
        // Per trasferimento e altro, non modifica la giacenza
        
        quantitaDisplay.textContent = quantita.toFixed(2) + ' {{ $movimento->articolo->unita_misura }}';
        nuovaGiacenzaDisplay.textContent = nuovaGiacenza.toFixed(2) + ' {{ $movimento->articolo->unita_misura }}';
        
        // Colori per la nuova giacenza
        if (nuovaGiacenza < 0) {
            nuovaGiacenzaDisplay.className = 'text-lg font-bold text-red-600';
        } else if (nuovaGiacenza < {{ $movimento->articolo->giacenza_minima }}) {
            nuovaGiacenzaDisplay.className = 'text-lg font-bold text-yellow-600';
        } else {
            nuovaGiacenzaDisplay.className = 'text-lg font-bold text-purple-600';
        }
    }
    
    // Eventi per il calcolo in tempo reale
    tipoMovimentoSelect.addEventListener('change', calcolaNuovaGiacenza);
    quantitaInput.addEventListener('input', calcolaNuovaGiacenza);
    
    // Calcolo iniziale
    calcolaNuovaGiacenza();
});
</script>
@endsection
