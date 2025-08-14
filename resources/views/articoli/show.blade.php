@extends('layouts.app')

@section('title', 'Articolo: ' . $articolo->nome)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dettagli Articolo</h1>
            <p class="text-lg text-gray-600 mt-2">
                {{ $articolo->codice }} - {{ $articolo->nome }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('articoli.edit', $articolo) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                Modifica
            </a>
            <a href="{{ route('movimenti-magazzino.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                Nuovo Movimento
            </a>
            <a href="{{ route('articoli.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                Lista Articoli
            </a>
        </div>
    </div>

    <!-- Informazioni Principali -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informazioni Principali</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Codice</label>
                <p class="text-lg font-semibold text-gray-900">{{ $articolo->codice }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <p class="text-lg font-semibold text-gray-900">{{ $articolo->nome }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($articolo->tipo === 'prodotto') bg-blue-100 text-blue-800
                    @elseif($articolo->tipo === 'servizio') bg-green-100 text-green-800
                    @elseif($articolo->tipo === 'manodopera') bg-purple-100 text-purple-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($articolo->tipo) }}
                </span>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                <p class="text-gray-900">
                    @if($articolo->categoria)
                        {{ $articolo->categoria->nome }}
                    @else
                        <span class="text-gray-500">Nessuna categoria</span>
                    @endif
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fornitore</label>
                <p class="text-gray-900">
                    @if($articolo->fornitore)
                        {{ $articolo->fornitore->ragione_sociale }}
                    @else
                        <span class="text-gray-500">Nessun fornitore</span>
                    @endif
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Unità Misura</label>
                <p class="text-gray-900">{{ $articolo->unita_misura }}</p>
            </div>
        </div>
        
        @if($articolo->descrizione)
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Descrizione</label>
                <p class="text-gray-900">{{ $articolo->descrizione }}</p>
            </div>
        @endif
    </div>

    <!-- Informazioni Prezzi e Giacenza -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Prezzi -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Prezzi</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Prezzo di Acquisto</span>
                    <span class="text-lg font-bold text-gray-900">€ {{ number_format($articolo->prezzo_acquisto, 2) }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                    <span class="text-gray-700">Prezzo di Vendita</span>
                    <span class="text-lg font-bold text-blue-600">€ {{ number_format($articolo->prezzo_vendita, 2) }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                    <span class="text-gray-700">Margine</span>
                    <span class="text-lg font-bold text-green-600">
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
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Giacenza</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 
                    @if($articolo->giacenza_attuale <= 0) bg-red-50
                    @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima) bg-yellow-50
                    @else bg-green-50
                    @endif rounded-lg">
                    <span class="text-gray-700">Giacenza Attuale</span>
                    <span class="text-lg font-bold 
                        @if($articolo->giacenza_attuale <= 0) text-red-600
                        @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima) text-yellow-600
                        @else text-green-600
                        @endif">
                        {{ number_format($articolo->giacenza_attuale, 2) }} {{ $articolo->unita_misura }}
                    </span>
                </div>
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Scorta Minima</span>
                    <span class="text-lg font-bold text-gray-900">{{ number_format($articolo->giacenza_minima, 2) }} {{ $articolo->unita_misura }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                    <span class="text-gray-700">Valore Giacenza</span>
                    <span class="text-lg font-bold text-blue-600">€ {{ number_format($articolo->giacenza_attuale * $articolo->prezzo_acquisto, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stato Scorte -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Stato Scorte</h3>
        <div class="p-4 rounded-lg 
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
                    <div class="mt-1 text-sm 
                        @if($articolo->giacenza_attuale <= 0) text-red-700
                        @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima) text-yellow-700
                        @else text-green-700
                        @endif">
                        @if($articolo->giacenza_attuale <= 0)
                            L'articolo non è più disponibile in magazzino.
                        @elseif($articolo->giacenza_attuale <= $articolo->giacenza_minima)
                            La giacenza è scesa sotto la scorta minima. Considera di riordinare.
                        @else
                            La giacenza è adeguata per soddisfare la domanda.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Azioni Rapide -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Azioni Rapide</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('articoli.movimenti', $articolo) }}" 
               class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <div>
                    <div class="font-medium text-blue-900">Movimenti</div>
                    <div class="text-sm text-blue-700">Visualizza cronologia movimenti</div>
                </div>
            </a>
            
            <a href="{{ route('movimenti-magazzino.create') }}" 
               class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <div>
                    <div class="font-medium text-green-900">Nuovo Movimento</div>
                    <div class="text-sm text-green-700">Registra carico/scarico</div>
                </div>
            </a>
            
            <a href="{{ route('articoli.edit', $articolo) }}" 
               class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <div>
                    <div class="font-medium text-purple-900">Modifica</div>
                    <div class="text-sm text-purple-700">Aggiorna informazioni</div>
                </div>
            </a>
        </div>
    </div>

    <!-- Informazioni Sistema -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informazioni Sistema</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Creato da</label>
                <p class="text-gray-900">{{ $articolo->creator->name ?? 'Sistema' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data creazione</label>
                <p class="text-gray-900">{{ $articolo->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ultima modifica</label>
                <p class="text-gray-900">{{ $articolo->updated_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stato</label>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($articolo->attivo) bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ $articolo->attivo ? 'Attivo' : 'Inattivo' }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
