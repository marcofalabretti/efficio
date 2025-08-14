@extends('layouts.app')

@section('title', 'Categorie Articoli')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Categorie Articoli</h1>
                <p class="text-gray-400">Gestisci le categorie per organizzare il tuo inventario</p>
            </div>
            <a href="{{ route('categoria-articoli.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nuova Categoria
            </a>
        </div>
    </div>

    <!-- Filtri e Ricerca -->
    <div class="bg-gray-800 rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Stato</label>
                <select id="filtro-stato" class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tutte</option>
                    <option value="1">Attive</option>
                    <option value="0">Inattive</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tipo</label>
                <select id="filtro-tipo" class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tutte</option>
                    <option value="principali">Principali</option>
                    <option value="sottocategorie">Sottocategorie</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Ricerca</label>
                <input type="text" id="ricerca" placeholder="Cerca per nome o codice..." 
                       class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <!-- Lista Categorie -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="categorie-container">
        @foreach($categorie as $categoria)
        <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-750 transition-colors duration-200 border border-gray-700">
            <!-- Header Categoria -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-4 h-4 rounded-full" style="background-color: {{ $categoria->colore }}"></div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">{{ $categoria->nome }}</h3>
                        <p class="text-sm text-gray-400">{{ $categoria->codice }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('categoria-articoli.edit', $categoria) }}" 
                       class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <button onclick="eliminaCategoria({{ $categoria->id }})" 
                            class="text-red-400 hover:text-red-300 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Descrizione -->
            @if($categoria->descrizione)
            <p class="text-gray-300 text-sm mb-4">{{ Str::limit($categoria->descrizione, 100) }}</p>
            @endif

            <!-- Informazioni -->
            <div class="space-y-2 mb-4">
                @if($categoria->categoriaPadre)
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-gray-400">Categoria padre:</span>
                    <span class="text-blue-400">{{ $categoria->categoriaPadre->nome }}</span>
                </div>
                @endif
                
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-gray-400">Articoli:</span>
                    <span class="text-white font-medium">{{ $categoria->articoli_count ?? 0 }}</span>
                </div>
                
                @if($categoria->sottocategorie_count > 0)
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-gray-400">Sottocategorie:</span>
                    <span class="text-white font-medium">{{ $categoria->sottocategorie_count }}</span>
                </div>
                @endif
            </div>

            <!-- Azioni -->
            <div class="flex items-center gap-2">
                <a href="{{ route('categoria-articoli.show', $categoria) }}" 
                   class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-center py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                    Visualizza
                </a>
                @if($categoria->sottocategorie_count > 0)
                <a href="{{ route('categoria-articoli.show', $categoria) }}?tab=sottocategorie" 
                   class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                    Sottocategorie
                </a>
                @endif
            </div>

            <!-- Status -->
            <div class="mt-4 pt-4 border-t border-gray-700">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400">Stato</span>
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $categoria->attiva ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                        {{ $categoria->attiva ? 'Attiva' : 'Inattiva' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginazione -->
    @if($categorie->hasPages())
    <div class="mt-8">
        {{ $categorie->links() }}
    </div>
    @endif

    <!-- Messaggio Nessuna Categoria -->
    @if($categorie->isEmpty())
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-300">Nessuna categoria trovata</h3>
        <p class="mt-1 text-sm text-gray-500">Inizia creando la tua prima categoria articoli.</p>
        <div class="mt-6">
            <a href="{{ route('categoria-articoli.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nuova Categoria
            </a>
        </div>
    </div>
    @endif
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
            
            <p class="text-gray-300 mb-6">Sei sicuro di voler eliminare questa categoria? Tutti gli articoli associati verranno spostati in "Senza Categoria".</p>
            
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

document.getElementById('btnConfermaElimina').addEventListener('click', function() {
    if (categoriaDaEliminare) {
        // Invia richiesta di eliminazione
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
                // Ricarica la pagina
                window.location.reload();
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

// Filtri
document.getElementById('filtro-stato').addEventListener('change', applicaFiltri);
document.getElementById('filtro-tipo').addEventListener('change', applicaFiltri);
document.getElementById('ricerca').addEventListener('input', applicaFiltri);

function applicaFiltri() {
    const stato = document.getElementById('filtro-stato').value;
    const tipo = document.getElementById('filtro-tipo').value;
    const ricerca = document.getElementById('ricerca').value.toLowerCase();
    
    // Qui implementeremo la logica di filtro AJAX
    // Per ora ricarichiamo la pagina con i parametri
    const params = new URLSearchParams();
    if (stato) params.append('stato', stato);
    if (tipo) params.append('tipo', tipo);
    if (ricerca) params.append('ricerca', ricerca);
    
    window.location.search = params.toString();
}

// Chiudi modal cliccando fuori
document.getElementById('modalElimina').addEventListener('click', function(e) {
    if (e.target === this) {
        chiudiModalElimina();
    }
});
</script>
@endsection
