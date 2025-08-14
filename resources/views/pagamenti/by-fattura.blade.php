@extends('layouts.app')

@section('title', 'Pagamenti Fattura ' . $fattura->numero)

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Pagamenti Fattura {{ $fattura->numero }}</h1>
                    <p class="mt-2 text-gray-600">
                        Cliente: {{ $fattura->customer->name }} | 
                        Totale: € {{ number_format($fattura->importo_totale, 2, ',', '.') }}
                    </p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('pagamenti.create', ['fattura_id' => $fattura->id]) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Nuovo Pagamento
                    </a>
                    <a href="{{ route('fatture.show', $fattura) }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Torna alla Fattura
                    </a>
                </div>
            </div>
        </div>

        <!-- Riepilogo Pagamenti -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Riepilogo Pagamenti</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">€ {{ number_format($fattura->getImportoPagato(), 2, ',', '.') }}</div>
                    <div class="text-sm text-gray-600">Totale Pagato</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-orange-600">€ {{ number_format($fattura->getImportoResiduo(), 2, ',', '.') }}</div>
                    <div class="text-sm text-gray-600">Importo Residuo</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $fattura->pagamenti->count() }}</div>
                    <div class="text-sm text-gray-600">Numero Pagamenti</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold {{ $fattura->isCompletamentePagata() ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $fattura->isCompletamentePagata() ? '100%' : number_format(($fattura->getImportoPagato() / $fattura->importo_totale) * 100, 1) . '%' }}
                    </div>
                    <div class="text-sm text-gray-600">Percentuale Pagata</div>
                </div>
            </div>
        </div>

        <!-- Lista Pagamenti -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Pagamenti Registrati</h3>
            </div>
            
            @if($pagamenti->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Importo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Metodo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stato
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Riferimento
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Creato da
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Azioni
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pagamenti as $pagamento)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $pagamento->data_pagamento->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        € {{ number_format($pagamento->importo, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ucfirst($pagamento->metodo_pagamento) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $pagamento->getStatoColor() }}">
                                            {{ ucfirst($pagamento->stato) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $pagamento->riferimento_pagamento ?: '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $pagamento->creator->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('pagamenti.show', $pagamento) }}" 
                                               class="text-blue-600 hover:text-blue-900">Visualizza</a>
                                            <a href="{{ route('pagamenti.edit', $pagamento) }}" 
                                               class="text-green-600 hover:text-green-900">Modifica</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($pagamenti->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $pagamenti->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-12 text-center">
                    <div class="text-4xl mb-4">💳</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nessun pagamento registrato</h3>
                    <p class="text-gray-600 mb-4">Non sono ancora stati registrati pagamenti per questa fattura.</p>
                    <a href="{{ route('pagamenti.create', ['fattura_id' => $fattura->id]) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Registra il primo pagamento
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Stili per le opzioni delle select nel tema scuro */
select option {
    background-color: #ffffff !important;
    color: #374151 !important;
}
/* Stili per le select quando sono aperte */
select:focus option:checked {
    background-color: #3b82f6 !important;
    color: #ffffff !important;
}
select:focus option:hover {
    background-color: #f3f4f6 !important;
    color: #374151 !important;
}
</style>
@endsection
