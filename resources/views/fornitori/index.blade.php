@extends('layouts.app')

@section('title', 'Fornitori')

@section('content')
<div class="content">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold text-brand flex items-center">
                    <div class="icon-box mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Fornitori
                    </span>
                </h1>
                <p class="muted text-lg ml-16">Gestisci i fornitori e i loro dati</p>
            </div>
            <a href="{{ route('fornitori.create') }}" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nuovo Fornitore
            </a>
        </div>
    </div>

    <!-- Statistiche Rapide -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="card card-body">
            <div class="flex items-center">
                <div class="p-2 bg-blue-500 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"></circle>
                        <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-blue-600">{{ $fornitori->total() }}</div>
                    <div class="text-sm text-blue-500">Totale Fornitori</div>
                </div>
            </div>
        </div>
        
        <div class="card card-body">
            <div class="flex items-center">
                <div class="p-2 bg-green-500 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-green-600">{{ $fornitori->where('attivo', true)->count() }}</div>
                    <div class="text-sm text-green-500">Fornitori Attivi</div>
                </div>
            </div>
        </div>
        
        <div class="card card-body">
            <div class="flex items-center">
                <div class="p-2 bg-purple-500 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-purple-600">{{ $citta->count() }}</div>
                    <div class="text-sm text-purple-500">Città Coperte</div>
                </div>
            </div>
        </div>
        
        <div class="card card-body">
            <div class="flex items-center">
                <div class="p-2 bg-orange-500 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7L10 17l-5-5"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-orange-600">{{ $fornitori->sum('articoli_count') }}</div>
                    <div class="text-sm text-orange-500">Articoli Totali</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtri e Ricerca -->
    <div class="card card-body mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Filtro Stato -->
            <div>
                <label for="stato" class="form-label">Stato</label>
                <select id="stato" class="form-select">
                    <option value="">Tutti</option>
                    <option value="1">Attivi</option>
                    <option value="0">Inattivi</option>
                </select>
            </div>

            <!-- Filtro Città -->
            <div>
                <label for="citta" class="form-label">Città</label>
                <select id="citta" class="form-select">
                    <option value="">Tutte le città</option>
                    @foreach($citta as $c)
                        <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ricerca -->
            <div>
                <label for="search" class="form-label">Ricerca</label>
                <div class="relative">
                    <input type="text" id="search" placeholder="Nome, P.IVA, email..." class="form-input pl-10">
                                         <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                     </svg>
                </div>
            </div>

            <!-- Pulsante Ricerca -->
            <div class="flex items-end">
                                 <button id="btnSearch" class="btn-primary w-full">
                     <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                     </svg>
                     Cerca
                 </button>
            </div>
        </div>
    </div>

    <!-- Griglia Fornitori -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($fornitori as $fornitore)
            <div class="card hover:shadow-lg transition-all duration-300 hover:scale-[1.02] group">
                <div class="card-body">
                    <!-- Header Card -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-brand truncate group-hover:text-white transition-colors duration-200 mb-2">
                                {{ Str::limit($fornitore->ragione_sociale, 30) }}
                            </h3>
                            @if($fornitore->partita_iva)
                                <div class="flex items-center text-sm muted mb-1">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    P.IVA: {{ $fornitore->partita_iva }}
                                </div>
                            @endif
                            @if($fornitore->codice_fiscale)
                                <div class="flex items-center text-sm muted mb-1">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    C.F.: {{ $fornitore->codice_fiscale }}
                                </div>
                            @endif
                            @if($fornitore->indirizzo)
                                <div class="flex items-center text-sm muted mb-1">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $fornitore->indirizzo }}
                                </div>
                            @endif
                            @if($fornitore->cap)
                                <div class="flex items-center text-sm muted mb-1">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                    </svg>
                                    CAP: {{ $fornitore->cap }}
                                </div>
                            @endif
                            @if($fornitore->pec)
                                <div class="flex items-center text-sm muted mb-1">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    PEC: {{ Str::limit($fornitore->pec, 25) }}
                                </div>
                            @endif
                            @if($fornitore->sdi)
                                <div class="flex items-center text-sm muted mb-1">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    SDI: {{ $fornitore->sdi }}
                                </div>
                            @endif
                            @if($fornitore->note)
                                <div class="flex items-center text-sm muted mb-1">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    {{ Str::limit($fornitore->note, 50) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            @if($fornitore->attivo)
                                <span class="badge-success">Attivo</span>
                            @else
                                <span class="badge-danger">Inattivo</span>
                            @endif
                        </div>
                    </div>

                    <!-- Informazioni Principali -->
                    <div class="mb-4">
                        @if($fornitore->citta)
                            <div class="flex items-center text-sm muted mb-2">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $fornitore->citta }}{{ $fornitore->provincia ? ', ' . $fornitore->provincia : '' }}
                            </div>
                        @endif

                        @if($fornitore->telefono)
                            <div class="flex items-center text-sm muted mb-2">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $fornitore->telefono }}
                            </div>
                        @endif

                        @if($fornitore->email)
                            <div class="flex items-center text-sm muted mb-2">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ Str::limit($fornitore->email, 25) }}
                            </div>
                        @endif
                    </div>

                    <!-- Statistiche -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mb-4">
                        <div class="flex items-center justify-center gap-6">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7L10 17l-5-5"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-blue-600">{{ $fornitore->articoli_count ?? 0 }}</div>
                                    <div class="text-xs text-blue-500">Articoli</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg bg-green-50 dark:bg-green-900/20">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v4H3zM7 7v14M12 7v14M17 7v14"></path>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-green-600">{{ $fornitore->movimenti_count ?? 0 }}</div>
                                    <div class="text-xs text-green-500">Movimenti</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Azioni -->
                    <div class="flex items-center gap-2">
                                                 <a href="{{ route('fornitori.show', $fornitore) }}" class="btn-secondary flex-1 text-center">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                             </svg>
                         </a>
                                                 <a href="{{ route('fornitori.edit', $fornitore) }}" class="btn-primary">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                             </svg>
                         </a>
                                                 <button onclick="deleteFornitore({{ $fornitore->id }})" class="btn-danger">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                             </svg>
                         </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="card card-body text-center py-12">
                    <div class="icon-box mx-auto mb-4">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                            <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"></circle>
                            <path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                            <path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Nessun fornitore trovato</h3>
                    <p class="muted text-lg mb-6">Inizia creando il tuo primo fornitore</p>
                    <a href="{{ route('fornitori.create') }}" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crea Fornitore
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginazione -->
    @if($fornitori->hasPages())
        <div class="mt-8">
            <div class="card card-body">
                {{ $fornitori->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Modal Conferma Eliminazione -->
<div id="deleteModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-lg font-medium text-brand">Conferma Eliminazione</h3>
            <button onclick="closeDeleteModal()" class="modal-close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <p class="muted">Sei sicuro di voler eliminare questo fornitore? Questa azione non può essere annullata.</p>
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
                window.location.reload();
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

// Filtri e ricerca
document.getElementById('btnSearch').addEventListener('click', function() {
    const stato = document.getElementById('stato').value;
    const citta = document.getElementById('citta').value;
    const search = document.getElementById('search').value;
    
    const params = new URLSearchParams();
    if (stato) params.append('stato', stato);
    if (citta) params.append('citta', citta);
    if (search) params.append('search', search);
    
    window.location.href = '{{ route("fornitori.index") }}?' + params.toString();
});

// Ricerca con Enter
document.getElementById('search').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('btnSearch').click();
    }
});
</script>
@endpush
