<tr class="riga-row" data-index="{{ $riga->id }}">
    <td class="px-3 py-4 whitespace-nowrap">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
            @if($riga->tipo_riga === 'manuale') bg-blue-100 text-blue-800
            @elseif($riga->tipo_riga === 'articolo') bg-green-100 text-green-800
            @elseif($riga->tipo_riga === 'manodopera') bg-purple-100 text-purple-800
            @else bg-gray-100 text-gray-800
            @endif">
            @if($riga->tipo_riga === 'manuale')
                Manuale
            @elseif($riga->tipo_riga === 'articolo')
                Articolo
            @elseif($riga->tipo_riga === 'manodopera')
                Manodopera
            @else
                {{ ucfirst($riga->tipo_riga) }}
            @endif
        </span>
    </td>
    
    <td class="px-3 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{ $riga->descrizione }}</div>
        @if($riga->note)
            <div class="text-sm text-gray-500">{{ $riga->note }}</div>
        @endif
        @if($riga->tipo_riga === 'articolo' && $riga->articolo)
            <div class="text-xs text-gray-400">Codice: {{ $riga->articolo->codice }}</div>
        @endif
    </td>
    
    <td class="px-3 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{ number_format($riga->quantita, 2) }}</div>
        @if($riga->unita_misura)
            <div class="text-sm text-gray-500">{{ $riga->unita_misura }}</div>
        @endif
    </td>
    
    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
        € {{ number_format($riga->prezzo_unitario, 2) }}
        @if($riga->prezzo_originale && $riga->prezzo_originale != $riga->prezzo_unitario)
            <div class="text-xs text-gray-400 line-through">€ {{ number_format($riga->prezzo_originale, 2) }}</div>
        @endif
    </td>
    
    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
        @if($riga->sconto_percentuale)
            {{ number_format($riga->sconto_percentuale, 2) }}%
        @else
                            -
        @endif
    </td>
    
    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        € {{ number_format($riga->importo_totale, 2) }}
    </td>
    
    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex space-x-2">
            <button type="button" class="btn-modifica text-blue-600 hover:text-blue-900 transition-colors">
                Modifica
            </button>
            <button type="button" class="btn-duplica text-green-600 hover:text-green-900 transition-colors">
                Duplica
            </button>
            <button type="button" class="btn-elimina text-red-600 hover:text-red-900 transition-colors">
                Elimina
            </button>
        </div>
    </td>
</tr>
