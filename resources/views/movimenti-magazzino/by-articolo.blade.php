@extends('layouts.app')

@section('title', 'Movimenti Articolo: ' . $articolo->nome)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Movimenti Articolo</h1>
            <p class="text-lg text-gray-600 mt-2">
                {{ $articolo->codice }} - {{ $articolo->nome }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('movimenti-magazzino.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                Nuovo Movimento
            </a>
            <a href="{{ route('articoli.show', $articolo) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                Vedi Articolo
            </a>
        </div>
    </div>

    <!-- Informazioni Articolo -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ number_format($articolo->giacenza_attuale, 2) }}</div>
                <div class="text-sm text-gray-600">Giacenza Attuale</div>
                <div class="text-xs text-gray-500">{{ $articolo->unita_misura }}</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ number_format($articolo->giacenza_minima, 2) }}</div>
                <div class="text-sm text-gray-600">Scorta Minima</div>
                <div class="text-xs text-gray-500">{{ $articolo->unita_misura }}</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">€ {{ number_format($articolo->prezzo_vendita, 2) }}</div>
                <div class="text-sm text-gray-600">Prezzo Vendita</div>
                <div class="text-xs text-gray-500">Prezzo corrente</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-orange-600">€ {{ number_format($articolo->prezzo_acquisto, 2) }}</div>
                <div class="text-sm text-gray-600">Prezzo Acquisto</div>
                <div class="text-xs text-gray-500">Costo medio</div>
            </div>
        </div>

        <!-- Stato Scorte -->
        <div class="mt-6 p-4 rounded-lg 
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
                    <h3 class="text-sm font-medium 
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
                    </h3>
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

    <!-- Filtri Movimenti -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Filtri Movimenti</h2>
        <form method="GET" action="{{ route('articoli.movimenti', $articolo) }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Tipo Movimento -->
                <div>
                    <label for="tipo_movimento" class="block text-sm font-medium text-gray-700 mb-2">Tipo Movimento</label>
                    <select id="tipo_movimento" name="tipo_movimento" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tutti i tipi</option>
                        <option value="carico" {{ request('tipo_movimento') === 'carico' ? 'selected' : '' }}>Carico</option>
                        <option value="scarico" {{ request('tipo_movimento') === 'scarico' ? 'selected' : '' }}>Scarico</option>
                        <option value="trasferimento" {{ request('tipo_movimento') === 'trasferimento' ? 'selected' : '' }}>Trasferimento</option>
                        <option value="inventario" {{ request('tipo_movimento') === 'inventario' ? 'selected' : '' }}>Inventario</option>
                        <option value="reso" {{ request('tipo_movimento') === 'reso' ? 'selected' : '' }}>Reso</option>
                        <option value="altro" {{ request('tipo_movimento') === 'altro' ? 'selected' : '' }}>Altro</option>
                    </select>
                </div>

                <!-- Data Inizio -->
                <div>
                    <label for="data_inizio" class="block text-sm font-medium text-gray-700 mb-2">Data Inizio</label>
                    <input type="date" id="data_inizio" name="data_inizio" 
                           value="{{ request('data_inizio') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Data Fine -->
                <div>
                    <label for="data_fine" class="block text-sm font-medium text-gray-700 mb-2">Data Fine</label>
                    <input type="date" id="data_fine" name="data_fine" 
                           value="{{ request('data_fine') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Applica Filtri
                </button>
                <a href="{{ route('articoli.movimenti', $articolo) }}" 
                   class="text-gray-600 hover:text-gray-800 underline">
                    Reset Filtri
                </a>
            </div>
        </form>
    </div>

    <!-- Statistiche Movimenti -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Carichi Totali</p>
                    <p class="text-2xl font-bold text-green-600">{{ number_format($stats['carichi_totali'], 2) }}</p>
                    <p class="text-xs text-gray-500">{{ $articolo->unita_misura }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Scarichi Totali</p>
                    <p class="text-2xl font-bold text-red-600">{{ number_format($stats['scarichi_totali'], 2) }}</p>
                    <p class="text-xs text-gray-500">{{ $articolo->unita_misura }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Valore Movimenti</p>
                    <p class="text-2xl font-bold text-blue-600">€ {{ number_format($stats['valore_movimenti'], 2) }}</p>
                    <p class="text-xs text-gray-500">Valore totale</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Numero Movimenti</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $stats['numero_movimenti'] }}</p>
                    <p class="text-xs text-gray-500">Movimenti totali</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabella Movimenti -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b">
            <h2 class="text-xl font-semibold text-gray-800">
                Storico Movimenti ({{ $movimenti->total() }} risultati)
            </h2>
        </div>

        @if($movimenti->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Data
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tipo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantità
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Giacenza Precedente
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Giacenza Successiva
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prezzo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Causale
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Documento
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Azioni
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($movimenti as $movimento)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $movimento->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($movimento->tipo_movimento === 'carico') bg-green-100 text-green-800
                                @elseif($movimento->tipo_movimento === 'scarico') bg-red-100 text-red-800
                                @elseif($movimento->tipo_movimento === 'trasferimento') bg-blue-100 text-blue-800
                                @elseif($movimento->tipo_movimento === 'inventario') bg-purple-100 text-purple-800
                                @elseif($movimento->tipo_movimento === 'reso') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($movimento->tipo_movimento) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="@if($movimento->tipo_movimento === 'carico') text-green-600 @elseif($movimento->tipo_movimento === 'scarico') text-red-600 @else text-blue-600 @endif font-medium">
                                {{ number_format($movimento->quantita, 2) }} {{ $articolo->unita_misura }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($movimento->quantita_precedente, 2) }} {{ $articolo->unita_misura }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                            {{ number_format($movimento->quantita_successiva, 2) }} {{ $articolo->unita_misura }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($movimento->prezzo_unitario)
                                € {{ number_format($movimento->prezzo_unitario, 2) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ Str::limit($movimento->causale, 25) ?: '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($movimento->documento_tipo && $movimento->numero_documento)
                                <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">
                                    {{ ucfirst($movimento->documento_tipo) }}: {{ $movimento->numero_documento }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('movimenti-magazzino.show', $movimento) }}" 
                               class="text-blue-600 hover:text-blue-900 mr-3">Vedi</a>
                            <a href="{{ route('movimenti-magazzino.edit', $movimento) }}" 
                               class="text-indigo-600 hover:text-indigo-900">Modifica</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginazione -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $movimenti->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Nessun movimento trovato</h3>
            <p class="mt-1 text-sm text-gray-500">
                Questo articolo non ha ancora movimenti di magazzino registrati.
            </p>
            <div class="mt-6">
                <a href="{{ route('movimenti-magazzino.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Primo Movimento
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Azioni -->
    <div class="mt-6 flex justify-center space-x-4">
        <a href="{{ route('movimenti-magazzino.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            Nuovo Movimento
        </a>
        <a href="{{ route('articoli.show', $articolo) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            Dettagli Articolo
        </a>
        <a href="{{ route('movimenti-magazzino.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            Tutti i Movimenti
        </a>
    </div>
</div>
@endsection
