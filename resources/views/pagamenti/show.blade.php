@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dettagli Pagamento</h1>
                    <p class="text-gray-600">Informazioni complete sul pagamento</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('pagamenti.edit', $pagamento->id) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        Modifica
                    </a>
                    <a href="{{ route('pagamenti.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        Torna alla Lista
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-white">
                        <h2 class="text-xl font-semibold">Pagamento #{{ $pagamento->id }}</h2>
                        <p class="text-blue-100">Creato il {{ $pagamento->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-right text-white">
                        <div class="text-2xl font-bold">€{{ number_format($pagamento->importo, 2, ',', '.') }}</div>
                        <div class="text-sm text-blue-100">{{ ucfirst($pagamento->stato) }}</div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informazioni Principali -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                            Informazioni Principali
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fattura</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <div class="font-medium text-gray-900">
                                    {{ $pagamento->fattura->numero }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ $pagamento->fattura->customer->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    Totale: €{{ number_format($pagamento->fattura->importo_totale, 2, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Importo</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <span class="text-2xl font-bold text-gray-900">
                                    €{{ number_format($pagamento->importo, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Data Pagamento</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <span class="text-gray-900">
                                    {{ $pagamento->data_pagamento->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Dettagli Aggiuntivi -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                            Dettagli Aggiuntivi
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Metodo Pagamento</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $pagamento->metodo_pagamento === 'bonifico' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $pagamento->metodo_pagamento === 'assegno' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $pagamento->metodo_pagamento === 'carta' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $pagamento->metodo_pagamento === 'contanti' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ ucfirst($pagamento->metodo_pagamento) }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stato</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $pagamento->getStatoColor() }}">
                                    {{ ucfirst($pagamento->stato) }}
                                </span>
                            </div>
                        </div>

                        @if($pagamento->riferimento_pagamento)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Riferimento</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <span class="text-gray-900">{{ $pagamento->riferimento_pagamento }}</span>
                            </div>
                        </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Creato da</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <span class="text-gray-900">{{ $pagamento->creator->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Note -->
                @if($pagamento->note)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Note</h3>
                    <div class="p-4 bg-gray-50 rounded-md">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $pagamento->note }}</p>
                    </div>
                </div>
                @endif

                <!-- Riepilogo Fattura -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Riepilogo Fattura</h3>
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div>
                                <div class="text-sm text-blue-600">Totale Fattura</div>
                                <div class="text-lg font-semibold text-blue-900">
                                    €{{ number_format($pagamento->fattura->importo_totale, 2, ',', '.') }}
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-blue-600">Pagato</div>
                                <div class="text-lg font-semibold text-green-600">
                                    €{{ number_format($pagamento->fattura->getImportoPagato(), 2, ',', '.') }}
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-blue-600">Residuo</div>
                                <div class="text-lg font-semibold text-orange-600">
                                    €{{ number_format($pagamento->fattura->getImportoResiduo(), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Footer -->
        <div class="mt-6 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Ultimo aggiornamento: {{ $pagamento->updated_at->format('d/m/Y H:i') }}
            </div>
            <div class="flex space-x-3">
                <form action="{{ route('pagamenti.destroy', $pagamento->id) }}" method="POST" 
                      onsubmit="return confirm('Sei sicuro di voler eliminare questo pagamento?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        Elimina
                    </button>
                </form>
            </div>
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

@media (max-width: 768px) {
    .container {
        padding-left: 16px !important;
        padding-right: 16px !important;
    }
    
    .flex.items-center.justify-between {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    .flex.space-x-3 {
        margin-top: 16px !important;
        justify-content: center !important;
    }
    
    .grid-cols-1.md\:grid-cols-2 {
        grid-template-columns: 1fr !important;
    }
    
    .grid-cols-1.md\:grid-cols-3 {
        grid-template-columns: 1fr !important;
    }
    
    .flex.justify-between.items-center {
        flex-direction: column !important;
        align-items: center !important;
        gap: 16px !important;
    }
}
</style>
@endsection
