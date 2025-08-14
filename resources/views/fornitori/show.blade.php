@extends('layouts.app')

@section('title', $fornitore->ragione_sociale)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    <svg class="inline w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    {{ $fornitore->ragione_sociale }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    @if($fornitore->partita_iva)
                        P.IVA: {{ $fornitore->partita_iva }}
                    @endif
                    @if($fornitore->codice_fiscale)
                        @if($fornitore->partita_iva) • @endif
                        CF: {{ $fornitore->codice_fiscale }}
                    @endif
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('fornitori.edit', $fornitore) }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifica
                </a>
                <a href="{{ route('fornitori.index') }}" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                    Torna ai Fornitori
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Colonna Principale -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informazioni Principali -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informazioni Principali
                    </h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Ragione Sociale</h4>
                            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $fornitore->ragione_sociale }}</p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Stato</h4>
                            <div class="mt-1">
                                @if($fornitore->attivo)
                                    <span class="badge-success">Attivo</span>
                                @else
                                    <span class="badge-danger">Inattivo</span>
                                @endif
                            </div>
                        </div>

                        @if($fornitore->partita_iva)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Partita IVA</h4>
                            <p class="mt-1 text-lg text-gray-900 dark:text-white font-mono">{{ $fornitore->partita_iva }}</p>
                        </div>
                        @endif

                        @if($fornitore->codice_fiscale)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Codice Fiscale</h4>
                            <p class="mt-1 text-lg text-gray-900 dark:text-white font-mono">{{ $fornitore->codice_fiscale }}</p>
                        </div>
                        @endif

                        @if($fornitore->sdi)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Codice SDI</h4>
                            <p class="mt-1 text-lg text-gray-900 dark:text-white font-mono">{{ $fornitore->sdi }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Indirizzo -->
            @if($fornitore->indirizzo || $fornitore->citta)
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Indirizzo
                    </h3>
                </div>
                <div class="card-body">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            @if($fornitore->indirizzo)
                                <p class="text-gray-900 dark:text-white">{{ $fornitore->indirizzo }}</p>
                            @endif
                            <p class="text-gray-600 dark:text-gray-400">
                                @if($fornitore->cap){{ $fornitore->cap }} @endif
                                @if($fornitore->citta){{ $fornitore->citta }} @endif
                                @if($fornitore->provincia)({{ $fornitore->provincia }})@endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Contatti -->
            @if($fornitore->telefono || $fornitore->email || $fornitore->pec)
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Contatti
                    </h3>
                </div>
                <div class="card-body">
                    <div class="space-y-3">
                        @if($fornitore->telefono)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:{{ $fornitore->telefono }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                {{ $fornitore->telefono }}
                            </a>
                        </div>
                        @endif

                        @if($fornitore->email)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:{{ $fornitore->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                {{ $fornitore->email }}
                            </a>
                        </div>
                        @endif

                        @if($fornitore->pec)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:{{ $fornitore->pec }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                {{ $fornitore->pec }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Note -->
            @if($fornitore->note)
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Note
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-gray-700 dark:text-gray-300">{{ $fornitore->note }}</p>
                </div>
            </div>
            @endif

            <!-- Tab Navigation -->
            <div class="card">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <button onclick="showTab('articoli')" id="tab-articoli" class="tab-button active">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Articoli ({{ $fornitore->articoli->count() }})
                        </button>
                        <button onclick="showTab('movimenti')" id="tab-movimenti" class="tab-button">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Movimenti ({{ $fornitore->movimentiMagazzino->count() }})
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Tab Articoli -->
                    <div id="content-articoli" class="tab-content active">
                        @if($fornitore->articoli->count() > 0)
                            <div class="space-y-4">
                                @foreach($fornitore->articoli as $articolo)
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $articolo->nome }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $articolo->codice }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900 dark:text-white">€ {{ number_format($articolo->prezzo_acquisto, 2, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Giacenza: {{ $articolo->giacenza_attuale }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nessun articolo</h3>
                                <p class="text-gray-500 dark:text-gray-400">Questo fornitore non ha ancora articoli associati</p>
                            </div>
                        @endif
                    </div>

                    <!-- Tab Movimenti -->
                    <div id="content-movimenti" class="tab-content hidden">
                        @if($fornitore->movimentiMagazzino->count() > 0)
                            <div class="space-y-4">
                                @foreach($fornitore->movimentiMagazzino->take(10) as $movimento)
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $movimento->articolo->nome }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $movimento->getTipoMovimentoLabel() }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $movimento->quantita }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $movimento->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if($fornitore->movimentiMagazzino->count() > 10)
                                <div class="mt-4 text-center">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Mostrando i primi 10 movimenti di {{ $fornitore->movimentiMagazzino->count() }}</p>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nessun movimento</h3>
                                <p class="text-gray-500 dark:text-gray-400">Nessun movimento di magazzino registrato per questo fornitore</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Statistiche -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Statistiche
                    </h3>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $fornitore->articoli->count() }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Articoli</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $fornitore->movimentiMagazzino->count() }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Movimenti</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">{{ $fornitore->movimentiMagazzino->where('tipo_movimento', 'carico')->count() }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Carichi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Azioni Rapide -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Azioni Rapide
                    </h3>
                </div>
                <div class="card-body">
                    <div class="space-y-3">
                        <a href="{{ route('articoli.create', ['fornitore_id' => $fornitore->id]) }}" class="btn-secondary w-full">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nuovo Articolo
                        </a>
                        <button onclick="deleteFornitore({{ $fornitore->id }})" class="btn-danger w-full">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Elimina Fornitore
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Conferma Eliminazione -->
<div id="deleteModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Conferma Eliminazione</h3>
            <button onclick="closeDeleteModal()" class="modal-close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-gray-600 dark:text-gray-400">Sei sicuro di voler eliminare questo fornitore? Questa azione non può essere annullata.</p>
        </div>
        <div class="modal-footer">
            <button onclick="closeDeleteModal()" class="btn-secondary">Annulla</button>
            <button id="confirmDelete" class="btn-danger">Elimina</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Gestione tab
function showTab(tabName) {
    // Nascondi tutti i contenuti
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Rimuovi classe active da tutti i tab
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Mostra il contenuto selezionato
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Aggiungi classe active al tab selezionato
    document.getElementById('tab-' + tabName).classList.add('active');
}

// Eliminazione fornitore
let currentFornitoreId = null;

function deleteFornitore(id) {
    currentFornitoreId = id;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    currentFornitoreId = null;
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    if (currentFornitoreId) {
        fetch(`/fornitori/${currentFornitoreId}`, {
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
                window.location.href = '{{ route("fornitori.index") }}';
            } else {
                alert('Errore durante l\'eliminazione: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Errore durante l\'eliminazione');
        });
    }
    closeDeleteModal();
});
</script>
@endpush
