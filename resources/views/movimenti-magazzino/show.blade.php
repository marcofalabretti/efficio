@extends('layouts.app')

@section('title', 'Dettagli Movimento Magazzino')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Movimento Magazzino</h1>
        <div class="flex space-x-3">
            <a href="{{ route('movimenti-magazzino.edit', $movimento) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                Modifica
            </a>
            <a href="{{ route('movimenti-magazzino.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                Torna alla Lista
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header con informazioni principali -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ ucfirst($movimento->tipo_movimento) }} - {{ $movimento->articolo->nome }}
                    </h2>
                    <p class="text-gray-600 mt-1">
                        Codice: {{ $movimento->articolo->codice }} | 
                        Data: {{ $movimento->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($movimento->tipo_movimento === 'carico') bg-green-100 text-green-800
                        @elseif($movimento->tipo_movimento === 'scarico') bg-red-100 text-red-800
                        @elseif($movimento->tipo_movimento === 'trasferimento') bg-blue-100 text-blue-800
                        @elseif($movimento->tipo_movimento === 'inventario') bg-purple-100 text-purple-800
                        @elseif($movimento->tipo_movimento === 'reso') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($movimento->tipo_movimento) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Dettagli principali -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informazioni Articolo -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informazioni Articolo</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nome:</span>
                            <span class="font-medium">{{ $movimento->articolo->nome }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Codice:</span>
                            <span class="font-medium">{{ $movimento->articolo->codice }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Categoria:</span>
                            <span class="font-medium">
                                {{ $movimento->articolo->categoria ? $movimento->articolo->categoria->nome : 'N/A' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Unità di Misura:</span>
                            <span class="font-medium">{{ $movimento->articolo->unita_misura }}</span>
                        </div>
                    </div>
                </div>

                <!-- Dettagli Movimento -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Dettagli Movimento</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Quantità:</span>
                            <span class="font-medium text-lg
                                @if($movimento->tipo_movimento === 'carico') text-green-600
                                @elseif($movimento->tipo_movimento === 'scarico') text-red-600
                                @else text-blue-600
                                @endif">
                                {{ number_format($movimento->quantita, 2) }} {{ $movimento->articolo->unita_misura }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Giacenza Precedente:</span>
                            <span class="font-medium">{{ number_format($movimento->quantita_precedente, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Giacenza Successiva:</span>
                            <span class="font-medium font-bold">{{ number_format($movimento->quantita_successiva, 2) }}</span>
                        </div>
                        @if($movimento->prezzo_unitario)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Prezzo Unitario:</span>
                            <span class="font-medium">€ {{ number_format($movimento->prezzo_unitario, 2) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informazioni Documento e Note -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Documento di Riferimento -->
                @if($movimento->documento_tipo || $movimento->numero_documento)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Documento di Riferimento</h3>
                    <div class="space-y-2">
                        @if($movimento->documento_tipo)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tipo:</span>
                            <span class="font-medium">{{ ucfirst($movimento->documento_tipo) }}</span>
                        </div>
                        @endif
                        @if($movimento->numero_documento)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Numero:</span>
                            <span class="font-medium">{{ $movimento->numero_documento }}</span>
                        </div>
                        @endif
                        @if($movimento->documento_id)
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID:</span>
                            <span class="font-medium">#{{ $movimento->documento_id }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Fornitore/Customer -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Controparte</h3>
                    <div class="space-y-2">
                        @if($movimento->fornitore)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Fornitore:</span>
                            <span class="font-medium">{{ $movimento->fornitore->ragione_sociale }}</span>
                        </div>
                        @endif
                        @if($movimento->customer)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Cliente:</span>
                            <span class="font-medium">{{ $movimento->customer->name }}</span>
                        </div>
                        @endif
                        @if(!$movimento->fornitore && !$movimento->customer)
                        <span class="text-gray-500 italic">Nessuna controparte specificata</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Causale e Note -->
            @if($movimento->causale || $movimento->note)
            <div class="mt-6">
                @if($movimento->causale)
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Causale</h3>
                    <p class="text-gray-700">{{ $movimento->causale }}</p>
                </div>
                @endif

                @if($movimento->note)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Note</h3>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $movimento->note }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Informazioni Sistema -->
            <div class="mt-6 bg-blue-50 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Informazioni Sistema</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Creato da:</span>
                        <span class="font-medium ml-2">{{ $movimento->creator->name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Data creazione:</span>
                        <span class="font-medium ml-2">{{ $movimento->created_at->format('d/m/Y H:i:s') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Ultima modifica:</span>
                        <span class="font-medium ml-2">{{ $movimento->updated_at->format('d/m/Y H:i:s') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Azioni -->
    <div class="mt-6 flex justify-center space-x-4">
        <a href="{{ route('movimenti-magazzino.edit', $movimento) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            Modifica Movimento
        </a>
        <a href="{{ route('articoli.show', $movimento->articolo) }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            Vedi Articolo
        </a>
        <a href="{{ route('movimenti-magazzino.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
            Torna alla Lista
        </a>
    </div>
</div>
@endsection
