@extends('layouts.app')

@section('title', $categoria->nome)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('categoria-articoli.index') }}" 
               class="text-gray-400 hover:text-white transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full" style="background-color: {{ $categoria->colore }}"></div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $categoria->nome }}</h1>
                    <p class="text-gray-400">{{ $categoria->codice }}</p>
                </div>
            </div>
            <div class="ml-auto flex items-center gap-3">
                <a href="{{ route('categoria-articoli.edit', $categoria) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifica
                </a>
                <button onclick="eliminaCategoria({{ $categoria->id }})" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Elimina
                </button>
            </div>
        </div>
    </div>

    <!-- Informazioni Principali -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Dettagli Categoria -->
        <div class="lg:col-span-2 bg-gray-800 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Dettagli Categoria
            </h3>
            
            <div class="space-y-4">
                @if($categoria->descrizione)
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Descrizione</label>
                    <p class="text-white">{{ $categoria->descrizione }}</p>
                </div>
                @endif
                
                @if($categoria->categoriaPadre)
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Categoria Padre</label>
                    <a href="{{ route('categoria-articoli.show', $categoria->categoriaPadre) }}" 
                       class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                        {{ $categoria->categoriaPadre->nome }}
                    </a>
                </div>
                @endif
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Ordinamento</label>
                        <p class="text-white">{{ $categoria->ordinamento }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Stato</label>
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $categoria->attiva ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                            {{ $categoria->attiva ? 'Attiva' : 'Inattiva' }}
                        </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Data Creazione</label>
                        <p class="text-white">{{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Ultima Modifica</label>
                        <p class="text-white">{{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiche -->
        <div class="bg-gray-800 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Statistiche
            </h3>
            
            <div class="space-y-4">
                <div class="text-center p-4 bg-gray-700 rounded-lg">
                    <div class="text-2xl font-bold text-white">{{ $categoria->articoli_count ?? 0 }}</div>
                    <div class="text-sm text-gray-400">Articoli Totali</div>
                </div>
                
                @if($categoria->sottocategorie_count > 0)
                <div class="text-center p-4 bg-gray-700 rounded-lg">
                    <div class="text-2xl font-bold text-white">{{ $categoria->sottocategorie_count }}</div>
                    <div class="text-sm text-gray-400">Sottocategorie</div>
                </div>
                @endif
                
                @if($categoria->categoriaPadre)
                <div class="text-center p-4 bg-gray-700 rounded-lg">
                    <div class="text-2xl font-bold text-blue-400">1</div>
                    <div class="text-sm text-gray-400">Livello</div>
                </div>
                @else
                <div class="text-center p-4 bg-gray-700 rounded-lg">
                    <div class="text-2xl font-bold text-green-400">Principale</div>
                    <div class="text-sm text-gray-400">Tipo</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-gray-800 rounded-lg mb-6">
        <div class="border-b border-gray-700">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <button onclick="cambiaTab('articoli')" 
                        id="tab-articoli"
                        class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-blue-500 text-blue-400">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Articoli ({{ $categoria->articoli_count ?? 0 }})
                </button>
                
                @if($categoria->sottocategorie_count > 0)
                <button onclick="cambiaTab('sottocategorie')" 
                        id="tab-sottocategorie"
                        class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-300">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Sottocategorie ({{ $categoria->sottocategorie_count }})
                </button>
                @endif
            </nav>
        </div>
    </div>

    <!-- Tab Content -->
    <div id="tab-content">
        <!-- Tab Articoli -->
        <div id="content-articoli" class="tab-content">
            @if(($categoria->articoli_count ?? 0) > 0)
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">Articoli in questa categoria</h3>
                    <a href="{{ route('articoli.create', ['categoria_id' => $categoria->id]) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nuovo Articolo
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Articolo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Prezzo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Giacenza</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Stato</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Azioni</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach($categoria->articoli as $articolo)
                            <tr class="hover:bg-gray-750 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $articolo->nome }}</div>
                                            <div class="text-sm text-gray-400">{{ $articolo->codice }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $articolo->tipo === 'prodotto' ? 'bg-blue-100 text-blue-800' : 
                                           ($articolo->tipo === 'servizio' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ ucfirst($articolo->tipo) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                    € {{ number_format($articolo->prezzo_vendita, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                    {{ $articolo->giacenza_attuale }} {{ $articolo->unita_misura }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $articolo->attivo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $articolo->attivo ? 'Attivo' : 'Inattivo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('articoli.show', $articolo) }}" class="text-blue-400 hover:text-blue-300 mr-3">Visualizza</a>
                                    <a href="{{ route('articoli.edit', $articolo) }}" class="text-indigo-400 hover:text-indigo-300">Modifica</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="text-center py-12 bg-gray-800 rounded-lg">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-300">Nessun articolo in questa categoria</h3>
                <p class="mt-1 text-sm text-gray-500">Inizia aggiungendo il primo articolo.</p>
                <div class="mt-6">
                    <a href="{{ route('articoli.create', ['categoria_id' => $categoria->id]) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nuovo Articolo
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Tab Sottocategorie -->
        @if($categoria->sottocategorie_count > 0)
        <div id="content-sottocategorie" class="tab-content hidden">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">Sottocategorie</h3>
                    <a href="{{ route('categoria-articoli.create', ['categoria_padre_id' => $categoria->id]) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nuova Sottocategoria
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoria->sottocategorie as $sottocategoria)
                    <div class="bg-gray-700 rounded-lg p-4 hover:bg-gray-650 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full" style="background-color: {{ $sottocategoria->colore }}"></div>
                                <h4 class="text-white font-medium">{{ $sottocategoria->nome }}</h4>
                            </div>
                            <span class="text-xs text-gray-400">{{ $sottocategoria->codice }}</span>
                        </div>
                        
                        @if($sottocategoria->descrizione)
                        <p class="text-gray-300 text-sm mb-3">{{ Str::limit($sottocategoria->descrizione, 80) }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">{{ $sottocategoria->articoli_count ?? 0 }} articoli</span>
                            <div class="flex gap-2">
                                <a href="{{ route('categoria-articoli.show', $sottocategoria) }}" 
                                   class="text-blue-400 hover:text-blue-300">Visualizza</a>
                                <a href="{{ route('categoria-articoli.edit', $sottocategoria) }}" 
                                   class="text-indigo-400 hover:text-indigo-300">Modifica</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Conferma Eliminazione -->
<div id="modalElimina" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-white">Conferma Eliminazione</h3>
                    <p class="text-sm text-gray-400">Questa azione non può essere annullata</p>
                </div>
            </div>
            
            <p class="text-gray-300 mb-6">Sei sicuro di voler eliminare la categoria "{{ $categoria->nome }}"? Tutti gli articoli associati verranno spostati in "Senza Categoria".</p>
            
            <div class="flex gap-3">
                <button onclick="chiudiModalElimina()" 
                        class="flex-1 bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                    Annulla
                </button>
                <button id="btnConfermaElimina" 
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                    Elimina
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gray-750 {
    background-color: #374151;
}
.bg-gray-650 {
    background-color: #4b5563;
}
</style>

<script>
let categoriaDaEliminare = null;

function eliminaCategoria(id) {
    categoriaDaEliminare = id;
    document.getElementById('modalElimina').classList.remove('hidden');
}

function chiudiModalElimina() {
    document.getElementById('modalElimina').classList.add('hidden');
    categoriaDaEliminare = null;
}

function cambiaTab(tab) {
    // Nascondi tutti i contenuti
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Rimuovi stile attivo da tutti i tab
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-400');
        button.classList.add('border-transparent', 'text-gray-400');
    });
    
    // Mostra contenuto selezionato
    document.getElementById(`content-${tab}`).classList.remove('hidden');
    
    // Attiva tab selezionato
    document.getElementById(`tab-${tab}`).classList.remove('border-transparent', 'text-gray-400');
    document.getElementById(`tab-${tab}`).classList.add('border-blue-500', 'text-blue-400');
}

document.getElementById('btnConfermaElimina').addEventListener('click', function() {
    if (categoriaDaEliminare) {
        fetch(`/categoria-articoli/${categoriaDaEliminare}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("categoria-articoli.index") }}';
            } else {
                alert('Errore durante l\'eliminazione: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Errore:', error);
            alert('Errore durante l\'eliminazione');
        })
        .finally(() => {
            chiudiModalElimina();
        });
    }
});

// Chiudi modal cliccando fuori
document.getElementById('modalElimina').addEventListener('click', function(e) {
    if (e.target === this) {
        chiudiModalElimina();
    }
});

// Controlla se c'è un tab specifico nell'URL
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    if (tab && (tab === 'sottocategorie' || tab === 'articoli')) {
        cambiaTab(tab);
    }
});
</script>
@endsection
