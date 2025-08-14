@extends('layouts.app')

@section('title', 'Report Movimenti Magazzino')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Report Movimenti Magazzino</h1>
        <div class="flex space-x-3">
            <a href="{{ route('movimenti-magazzino.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                Nuovo Movimento
            </a>
            <a href="{{ route('movimenti-magazzino.index') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                Lista Movimenti
            </a>
        </div>
    </div>

    <!-- Filtri -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Filtri Report</h2>
        <form method="GET" action="{{ route('movimenti-magazzino.report') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Articolo -->
                <div>
                    <label for="articolo_id" class="block text-sm font-medium text-gray-700 mb-2">Articolo</label>
                    <select id="articolo_id" name="articolo_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tutti gli articoli</option>
                        @foreach($articoli as $articolo)
                            <option value="{{ $articolo->id }}" {{ request('articolo_id') == $articolo->id ? 'selected' : '' }}>
                                {{ $articolo->codice }} - {{ $articolo->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Fornitore -->
                <div>
                    <label for="fornitore_id" class="block text-sm font-medium text-gray-700 mb-2">Fornitore</label>
                    <select id="fornitore_id" name="fornitore_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tutti i fornitori</option>
                        @foreach($fornitori as $fornitore)
                            <option value="{{ $fornitore->id }}" {{ request('fornitore_id') == $fornitore->id ? 'selected' : '' }}>
                                {{ $fornitore->ragione_sociale }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Customer -->
                <div>
                    <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">Cliente</label>
                    <select id="customer_id" name="customer_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tutti i clienti</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Ricerca Testuale -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Ricerca</label>
                    <input type="text" id="search" name="search" 
                           value="{{ request('search') }}"
                           placeholder="Causale, note, numero documento..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Applica Filtri
                </button>
                <a href="{{ route('movimenti-magazzino.report') }}" 
                   class="text-gray-600 hover:text-gray-800 underline">
                    Reset Filtri
                </a>
            </div>
        </form>
    </div>

    <!-- Statistiche -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Carichi</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['carichi'] }}</p>
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
                    <p class="text-sm font-medium text-gray-600">Scarichi</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['scarichi'] }}</p>
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
                    <p class="text-sm font-medium text-gray-600">Valore Totale</p>
                    <p class="text-2xl font-bold text-blue-600">€ {{ number_format($stats['valore_totale'], 2) }}</p>
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
                    <p class="text-sm font-medium text-gray-600">Periodo</p>
                    <p class="text-lg font-bold text-purple-600">
                        @if(request('data_inizio') && request('data_fine'))
                            {{ \Carbon\Carbon::parse(request('data_inizio'))->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse(request('data_fine'))->format('d/m/Y') }}
                        @else
                            Ultimi 30 giorni
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabella Movimenti -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b">
            <h2 class="text-xl font-semibold text-gray-800">
                Movimenti Filtrati ({{ $movimenti->total() }} risultati)
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
                            Articolo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tipo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantità
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
                            Controparte
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
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $movimento->articolo->codice }}
                                </div>
                                <div class="ml-2 text-sm text-gray-500">
                                    {{ Str::limit($movimento->articolo->nome, 30) }}
                                </div>
                            </div>
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
                                {{ number_format($movimento->quantita, 2) }} {{ $movimento->articolo->unita_misura }}
                            </span>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($movimento->fornitore)
                                <span class="text-blue-600">{{ Str::limit($movimento->fornitore->ragione_sociale, 20) }}</span>
                            @elseif($movimento->customer)
                                <span class="text-green-600">{{ Str::limit($movimento->customer->name, 20) }}</span>
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
                Prova a modificare i filtri o crea un nuovo movimento.
            </p>
            <div class="mt-6">
                <a href="{{ route('movimenti-magazzino.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Nuovo Movimento
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Export e Azioni -->
    @if($movimenti->count() > 0)
    <div class="mt-6 flex justify-center space-x-4">
        <button onclick="window.print()" 
                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            📄 Stampa Report
        </button>
        <a href="{{ route('movimenti-magazzino.index') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            📋 Lista Completa
        </a>
    </div>
    @endif
</div>

<style>
@media print {
    .container { max-width: none; }
    .bg-white { background: white !important; }
    .shadow-md { box-shadow: none !important; }
    .bg-gradient-to-r { background: #f8fafc !important; }
    .bg-gray-50 { background: #f9fafb !important; }
    .hover\:bg-gray-50:hover { background: #f9fafb !important; }
}
</style>
@endsection
