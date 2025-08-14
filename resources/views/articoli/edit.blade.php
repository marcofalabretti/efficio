@extends('layouts.app')

@section('title', 'Modifica Articolo: ' . $articolo->nome)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Modifica Articolo</h1>
            <p class="text-lg text-gray-600 mt-2">
                {{ $articolo->codice }} - {{ $articolo->nome }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('articoli.show', $articolo) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                Visualizza
            </a>
            <a href="{{ route('articoli.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                Lista Articoli
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('articoli.update', $articolo) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Informazioni Principali -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Informazioni Principali
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Codice -->
                    <div>
                        <label for="codice" class="block text-sm font-medium text-gray-700 mb-2">
                            Codice <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="codice" name="codice" 
                               value="{{ old('codice', $articolo->codice) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Es. ART001">
                        @error('codice')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nome" name="nome" 
                               value="{{ old('nome', $articolo->nome) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nome dell'articolo">
                        @error('nome')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo <span class="text-red-500">*</span>
                        </label>
                        <select id="tipo" name="tipo" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="prodotto" {{ $articolo->tipo === 'prodotto' ? 'selected' : '' }}>Prodotto</option>
                            <option value="servizio" {{ $articolo->tipo === 'servizio' ? 'selected' : '' }}>Servizio</option>
                            <option value="manodopera" {{ $articolo->tipo === 'manodopera' ? 'selected' : '' }}>Manodopera</option>
                        </select>
                        @error('tipo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Categoria
                        </label>
                        <select id="categoria_id" name="categoria_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleziona categoria...</option>
                            @foreach($categorie as $categoria)
                                <option value="{{ $categoria->id }}" {{ $articolo->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
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
                                <option value="{{ $fornitore->id }}" {{ $articolo->fornitore_id == $fornitore->id ? 'selected' : '' }}>
                                    {{ $fornitore->ragione_sociale }}
                                </option>
                            @endforeach
                        </select>
                        @error('fornitore_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unità Misura -->
                    <div>
                        <label for="unita_misura" class="block text-sm font-medium text-gray-700 mb-2">
                            Unità Misura <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="unita_misura" name="unita_misura" 
                               value="{{ old('unita_misura', $articolo->unita_misura) }}" required maxlength="20"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Es. pz, kg, ore, m...">
                        @error('unita_misura')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Descrizione -->
                <div class="mt-6">
                    <label for="descrizione" class="block text-sm font-medium text-gray-700 mb-2">
                        Descrizione
                    </label>
                    <textarea id="descrizione" name="descrizione" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Descrizione dettagliata dell'articolo...">{{ old('descrizione', $articolo->descrizione) }}</textarea>
                    @error('descrizione')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Prezzi -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Prezzi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Prezzo di Acquisto -->
                    <div>
                        <label for="prezzo_acquisto" class="block text-sm font-medium text-gray-700 mb-2">
                            Prezzo di Acquisto
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                            <input type="number" id="prezzo_acquisto" name="prezzo_acquisto" 
                                   value="{{ old('prezzo_acquisto', $articolo->prezzo_acquisto) }}" 
                                   step="0.01" min="0"
                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                        </div>
                        @error('prezzo_acquisto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prezzo di Vendita -->
                    <div>
                        <label for="prezzo_vendita" class="block text-sm font-medium text-gray-700 mb-2">
                            Prezzo di Vendita <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                            <input type="number" id="prezzo_vendita" name="prezzo_vendita" 
                                   value="{{ old('prezzo_vendita', $articolo->prezzo_vendita) }}" required
                                   step="0.01" min="0"
                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                        </div>
                        @error('prezzo_vendita')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Calcolo Margine -->
                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">Margine di Guadagno:</span>
                        <span id="margine-calcolo" class="text-lg font-bold text-green-600">
                            @if($articolo->prezzo_acquisto > 0)
                                {{ number_format((($articolo->prezzo_vendita - $articolo->prezzo_acquisto) / $articolo->prezzo_acquisto) * 100, 1) }}%
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Giacenza -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Gestione Giacenza
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Giacenza Attuale -->
                    <div>
                        <label for="giacenza_attuale" class="block text-sm font-medium text-gray-700 mb-2">
                            Giacenza Attuale
                        </label>
                        <div class="relative">
                            <input type="number" id="giacenza_attuale" name="giacenza_attuale" 
                                   value="{{ old('giacenza_attuale', $articolo->giacenza_attuale) }}" 
                                   step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">{{ $articolo->unita_misura }}</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            ⚠️ Modificare questo valore creerà un movimento di inventario
                        </p>
                        @error('giacenza_attuale')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giacenza Minima -->
                    <div>
                        <label for="giacenza_minima" class="block text-sm font-medium text-gray-700 mb-2">
                            Scorta Minima
                        </label>
                        <div class="relative">
                            <input type="number" id="giacenza_minima" name="giacenza_minima" 
                                   value="{{ old('giacenza_minima', $articolo->giacenza_minima) }}" 
                                   step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">{{ $articolo->unita_misura }}</span>
                            </div>
                        </div>
                        @error('giacenza_minima')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Stato Scorte -->
                <div class="mt-4 p-4 rounded-lg 
                    @if($articolo->giacenza_attuale <= 0) bg-red-50 border border-red-200
                    @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima) bg-yellow-50 border border-yellow-200
                    @else bg-green-50 border border-green-200
                    @endif">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if($articolo->giacenza_attuale <= 0)
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima)
                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium 
                                @if($articolo->giacenza_attuale <= 0) text-red-800
                                @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima) text-yellow-800
                                @else text-green-800
                                @endif">
                                @if($articolo->giacenza_attuale <= 0)
                                    Scorte Esaurite
                                @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima)
                                    Scorte Basse
                                @else
                                    Scorte Sufficienti
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Altre Impostazioni -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Altre Impostazioni
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Stato -->
                    <div>
                        <label for="attivo" class="block text-sm font-medium text-gray-700 mb-2">
                            Stato
                        </label>
                        <select id="attivo" name="attivo"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="1" {{ $articolo->attivo ? 'selected' : '' }}>Attivo</option>
                            <option value="0" {{ !$articolo->attivo ? 'selected' : '' }}>Inattivo</option>
                        </select>
                        @error('attivo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Note -->
                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                            Note
                        </label>
                        <textarea id="note" name="note" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Note aggiuntive...">{{ old('note', $articolo->note) }}</textarea>
                        @error('note')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pulsanti -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('articoli.show', $articolo) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
                    Annulla
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
                    Aggiorna Articolo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const prezzoAcquisto = document.getElementById('prezzo_acquisto');
    const prezzoVendita = document.getElementById('prezzo_vendita');
    const margineCalcolo = document.getElementById('margine-calcolo');
    
    function calcolaMargine() {
        const acquisto = parseFloat(prezzoAcquisto.value) || 0;
        const vendita = parseFloat(prezzoVendita.value) || 0;
        
        if (acquisto > 0 && vendita > 0) {
            const margine = ((vendita - acquisto) / acquisto) * 100;
            margineCalcolo.textContent = margine.toFixed(1) + '%';
            
            if (margine < 0) {
                margineCalcolo.className = 'text-lg font-bold text-red-600';
            } else if (margine < 20) {
                margineCalcolo.className = 'text-lg font-bold text-yellow-600';
            } else {
                margineCalcolo.className = 'text-lg font-bold text-green-600';
            }
        } else {
            margineCalcolo.textContent = '-';
            margineCalcolo.className = 'text-lg font-bold text-gray-600';
        }
    }
    
    prezzoAcquisto.addEventListener('input', calcolaMargine);
    prezzoVendita.addEventListener('input', calcolaMargine);
    
    // Calcolo iniziale
    calcolaMargine();
});
</script>
@endsection
