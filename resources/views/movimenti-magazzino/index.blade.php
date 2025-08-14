@extends('layouts.app')

@section('title', 'Movimenti Magazzino')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Movimenti Magazzino</h1>
        <div class="flex space-x-3">
            <a href="{{ route('movimenti-magazzino.report') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                📊 Report
            </a>
            <a href="{{ route('movimenti-magazzino.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                ➕ Nuovo Movimento
            </a>
        </div>
    </div>

    <!-- Filtri -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" action="{{ route('movimenti-magazzino.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Articolo</label>
                <select name="articolo_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tutti gli articoli</option>
                    @foreach($articoli as $articolo)
                        <option value="{{ $articolo->id }}" {{ request('articolo_id') == $articolo->id ? 'selected' : '' }}>
                            {{ $articolo->codice }} - {{ $articolo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo Movimento</label>
                <select name="tipo_movimento" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tutti i tipi</option>
                    <option value="carico" {{ request('tipo_movimento') == 'carico' ? 'selected' : '' }}>Carico</option>
                    <option value="scarico" {{ request('tipo_movimento') == 'scarico' ? 'selected' : '' }}>Scarico</option>
                    <option value="trasferimento" {{ request('tipo_movimento') == 'trasferimento' ? 'selected' : '' }}>Trasferimento</option>
                    <option value="inventario" {{ request('tipo_movimento') == 'inventario' ? 'selected' : '' }}>Inventario</option>
                    <option value="reso" {{ request('tipo_movimento') == 'reso' ? 'selected' : '' }}>Reso</option>
                    <option value="altro" {{ request('tipo_movimento') == 'altro' ? 'selected' : '' }}>Altro</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fornitore</label>
                <select name="fornitore_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tutti i fornitori</option>
                    @foreach($fornitori as $fornitore)
                        <option value="{{ $fornitore->id }}" {{ request('fornitore_id') == $fornitore->id ? 'selected' : '' }}>
                            {{ $fornitore->ragione_sociale }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cliente</label>
                <select name="customer_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tutti i clienti</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Ricerca</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cerca per codice articolo, nome, numero documento..."
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data da</label>
                <input type="date" name="data_da" value="{{ request('data_da') }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data a</label>
                <input type="date" name="data_a" value="{{ request('data_a') }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="md:col-span-2 flex space-x-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    🔍 Filtra
                </button>
                <a href="{{ route('movimenti-magazzino.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                    🗑️ Pulisci
                </a>
            </div>
        </form>
    </div>

    <!-- Tabella Movimenti -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Articolo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantità</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giacenza</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prezzo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Azioni</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($movimenti as $movimento)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $movimento->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $movimento->articolo->codice }}</div>
                                    <div class="text-sm text-gray-500">{{ $movimento->articolo->nome }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $movimento->tipo_movimento === 'carico' ? 'bg-green-100 text-green-800' : 
                                   ($movimento->tipo_movimento === 'scarico' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($movimento->tipo_movimento) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="font-medium {{ $movimento->tipo_movimento === 'carico' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $movimento->tipo_movimento === 'carico' ? '+' : '-' }}{{ $movimento->quantita }}
                            </span>
                            <span class="text-gray-500 text-xs">{{ $movimento->articolo->unita_misura }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div class="text-sm text-gray-900">{{ $movimento->quantita_successiva }}</div>
                            <div class="text-xs text-gray-500">da {{ $movimento->quantita_precedente }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($movimento->prezzo_unitario)
                                € {{ number_format($movimento->prezzo_unitario, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($movimento->numero_documento)
                                <div class="text-sm text-gray-900">{{ $movimento->numero_documento }}</div>
                                <div class="text-xs text-gray-500">{{ $movimento->documento_tipo ?? 'Documento' }}</div>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('movimenti-magazzino.show', $movimento) }}" 
                                   class="text-blue-600 hover:text-blue-900">👁️</a>
                                <a href="{{ route('movimenti-magazzino.edit', $movimento) }}" 
                                   class="text-indigo-600 hover:text-indigo-900">✏️</a>
                                <form method="POST" action="{{ route('movimenti-magazzino.destroy', $movimento) }}" 
                                      class="inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo movimento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            Nessun movimento trovato
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginazione -->
    <div class="mt-6">
        {{ $movimenti->links() }}
    </div>
</div>
@endsection
