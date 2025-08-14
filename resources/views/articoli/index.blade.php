@extends('layouts.app')

@section('title', 'Articoli')

@section('content')
<div class="content">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-brand flex items-center gap-3">
                    <div class="icon-box">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    Articoli
                </h1>
                <p class="muted mt-2 text-lg">
                    Gestisci il catalogo prodotti, servizi e manodopera
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('articoli.create') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuovo Articolo
                </a>
            </div>
        </div>
    </div>

    <!-- Filtri e Ricerca -->
    <div class="card mb-6">
        <div class="card-body">
            <form method="GET" action="{{ route('articoli.index') }}" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Ricerca -->
                    <div>
                        <label for="search" class="form-label">Ricerca</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="form-input"
                               placeholder="Codice, nome, descrizione...">
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label for="categoria_id" class="form-label">Categoria</label>
                        <select id="categoria_id" name="categoria_id" class="form-select">
                            <option value="">Tutte le categorie</option>
                            @foreach($categorie as $categoria)
                                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" name="tipo" class="form-select">
                            <option value="">Tutti i tipi</option>
                            <option value="prodotto" {{ request('tipo') == 'prodotto' ? 'selected' : '' }}>Prodotto</option>
                            <option value="servizio" {{ request('tipo') == 'servizio' ? 'selected' : '' }}>Servizio</option>
                            <option value="manodopera" {{ request('tipo') == 'manodopera' ? 'selected' : '' }}>Manodopera</option>
                        </select>
                    </div>

                    <!-- Stato -->
                    <div>
                        <label for="stato" class="form-label">Stato</label>
                        <select id="stato" name="stato" class="form-select">
                            <option value="">Tutti gli stati</option>
                            <option value="attivo" {{ request('stato') == 'attivo' ? 'selected' : '' }}>Attivo</option>
                            <option value="inattivo" {{ request('stato') == 'inattivo' ? 'selected' : '' }}>Inattivo</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <button type="submit" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Filtra
                        </button>
                        <a href="{{ route('articoli.index') }}" class="btn-secondary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                    </div>

                    <div class="text-sm muted">
                        {{ $articoli->total() }} articoli trovati
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Griglia Articoli -->
    @if($articoli->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($articoli as $articolo)
                <div class="card hover:shadow-lg transition-all duration-300 hover:scale-[1.02] group">
                    <div class="card-body">
                        <!-- Header Card -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-brand truncate group-hover:text-white transition-colors duration-200">
                                    {{ $articolo->nome }}
                                </h3>
                                <p class="text-sm muted font-mono mt-1">
                                    {{ $articolo->codice }}
                                </p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <!-- Stato -->
                                @if($articolo->attivo)
                                    <span class="badge-success text-xs">Attivo</span>
                                @else
                                    <span class="badge-danger text-xs">Inattivo</span>
                                @endif
                                
                                <!-- Tipo -->
                                <span class="badge-{{ $articolo->tipo === 'prodotto' ? 'blue' : ($articolo->tipo === 'servizio' ? 'green' : 'purple') }} text-xs">
                                    {{ ucfirst($articolo->tipo) }}
                                </span>
                            </div>
                        </div>

                        <!-- Descrizione -->
                        @if($articolo->descrizione)
                            <p class="muted text-sm mb-4 line-clamp-2 leading-relaxed">
                                {{ $articolo->descrizione }}
                            </p>
                        @endif

                        <!-- Categoria -->
                        @if($articolo->categoria)
                            <div class="mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-all duration-200 hover:scale-105"
                                      style="background-color: {{ $articolo->categoria->getColoreCss() }}20; color: {{ $articolo->categoria->getColoreCss() }}; border: 1px solid {{ $articolo->categoria->getColoreCss() }}30;">
                                    {{ $articolo->categoria->nome }}
                                </span>
                            </div>
                        @endif

                        <!-- Prezzi -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-center p-3 rounded-lg" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2);">
                                <span class="text-xs muted block mb-1">Prezzo Vendita</span>
                                <p class="text-lg font-bold text-green-400">
                                    € {{ number_format($articolo->prezzo_vendita, 2, ',', '.') }}
                                </p>
                            </div>
                            @if($articolo->prezzo_acquisto)
                                <div class="text-center p-3 rounded-lg" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2);">
                                    <span class="text-xs muted block mb-1">Prezzo Acquisto</span>
                                    <p class="text-sm font-semibold text-blue-400">
                                        € {{ number_format($articolo->prezzo_acquisto, 2, ',', '.') }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Giacenza (solo per prodotti) -->
                        @if($articolo->tipo === 'prodotto')
                            <div class="mb-4 p-3 rounded-lg" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08);">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="muted">Giacenza</span>
                                    <span class="font-semibold {{ $articolo->isSottoScorta() ? 'text-red-400' : 'text-brand' }}">
                                        {{ $articolo->giacenza_attuale }} {{ $articolo->unita_misura }}
                                    </span>
                                </div>
                                @if($articolo->giacenza_minima)
                                    <div class="text-xs muted text-center">
                                        Min: {{ $articolo->giacenza_minima }} {{ $articolo->unita_misura }}
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Fornitore -->
                        @if($articolo->fornitore)
                            <div class="mb-4 text-sm p-3 rounded-lg" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05);">
                                <span class="muted">Fornitore:</span>
                                <span class="text-white font-medium">{{ $articolo->fornitore->ragione_sociale }}</span>
                            </div>
                        @endif

                        <!-- Azioni -->
                        <div class="flex items-center gap-3 pt-4 border-t" style="border-color: rgba(255,255,255,0.08);">
                            <a href="{{ route('articoli.show', $articolo) }}" 
                               class="btn-secondary btn-sm flex-1 justify-center group-hover:neon-outline transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Visualizza
                            </a>
                            <a href="{{ route('articoli.edit', $articolo) }}" 
                               class="btn-primary btn-sm flex-1 justify-center group-hover:ring-brand-glow transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Modifica
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginazione -->
        @if($articoli->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="card">
                    <div class="card-body">
                        {{ $articoli->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- Nessun articolo trovato -->
        <div class="text-center py-16">
            <div class="icon-box mx-auto mb-6" style="width: 80px; height: 80px;">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-2">Nessun articolo trovato</h3>
            <p class="muted text-lg mb-8 max-w-md mx-auto">
                @if(request()->hasAny(['search', 'categoria_id', 'tipo', 'stato']))
                    Prova a modificare i filtri di ricerca per trovare quello che stai cercando.
                @else
                    Inizia creando il tuo primo articolo per popolare il catalogo.
                @endif
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('articoli.create') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuovo Articolo
                </a>
                @if(request()->hasAny(['search', 'categoria_id', 'tipo', 'stato']))
                    <a href="{{ route('articoli.index') }}" class="btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset Filtri
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive improvements */
@media (max-width: 640px) {
    .content {
        padding: 12px;
    }
    
    .card {
        padding: 12px;
    }
}

/* Smooth transitions for all interactive elements */
.card, .btn-primary, .btn-secondary, .form-input, .form-select {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Hover effects for better UX */
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

/* Focus states for accessibility */
.form-input:focus, .form-select:focus {
    transform: scale(1.02);
}

/* Loading states */
.btn-primary:disabled, .btn-secondary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}
</style>
@endpush
