@extends('layouts.app')

@section('title', 'Nuovo Movimento Magazzino')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Nuovo Movimento Magazzino</h1>
            <a href="{{ route('movimenti-magazzino.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                ← Torna alla lista
            </a>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('movimenti-magazzino.store') }}" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Articolo -->
                    <div class="md:col-span-2">
                        <label for="articolo_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Articolo <span class="text-red-500">*</span>
                        </label>
                        <select name="articolo_id" id="articolo_id" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleziona un articolo</option>
                            @foreach($articoli as $articolo)
                                <option value="{{ $articolo->id }}" 
                                        data-giacenza="{{ $articolo->giacenza_attuale }}"
                                        data-unita="{{ $articolo->unita_misura }}">
                                    {{ $articolo->codice }} - {{ $articolo->nome }} 
                                    (Giacenza: {{ $articolo->giacenza_attuale }} {{ $articolo->unita_misura }})
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Seleziona l'articolo per cui registrare il movimento</p>
                    </div>

                    <!-- Tipo Movimento -->
                    <div>
                        <label for="tipo_movimento" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo Movimento <span class="text-red-500">*</span>
                        </label>
                        <select name="tipo_movimento" id="tipo_movimento" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleziona tipo</option>
                            <option value="carico">Carico (entrata)</option>
                            <option value="scarico">Scarico (uscita)</option>
                            <option value="trasferimento">Trasferimento</option>
                            <option value="inventario">Inventario</option>
                            <option value="reso">Reso</option>
                            <option value="altro">Altro</option>
                        </select>
                    </div>

                    <!-- Quantità -->
                    <div>
                        <label for="quantita" class="block text-sm font-medium text-gray-700 mb-2">
                            Quantità <span class="text-red-500">*</span>
                        </label>
                        <div class="flex">
                            <input type="number" name="quantita" id="quantita" step="0.01" min="0.01" required
                                   class="flex-1 border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm rounded-r-md" id="unita_misura_display">
                                pz
                            </span>
                        </div>
                    </div>

                    <!-- Prezzo Unitario -->
                    <div>
                        <label for="prezzo_unitario" class="block text-sm font-medium text-gray-700 mb-2">
                            Prezzo Unitario
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                            <input type="number" name="prezzo_unitario" id="prezzo_unitario" step="0.01" min="0"
                                   class="w-full border border-gray-300 rounded-md pl-8 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Prezzo per unità (opzionale)</p>
                    </div>

                    <!-- Causale -->
                    <div>
                        <label for="causale" class="block text-sm font-medium text-gray-700 mb-2">
                            Causale
                        </label>
                        <input type="text" name="causale" id="causale" maxlength="200"
                               placeholder="es. Acquisto, Vendita, Inventario..."
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Fornitore -->
                    <div>
                        <label for="fornitore_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Fornitore
                        </label>
                        <select name="fornitore_id" id="fornitore_id"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Nessun fornitore</option>
                            @foreach($fornitori as $fornitore)
                                <option value="{{ $fornitore->id }}">{{ $fornitore->ragione_sociale }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cliente -->
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Cliente
                        </label>
                        <select name="customer_id" id="customer_id"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Nessun cliente</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tipo Documento -->
                    <div>
                        <label for="documento_tipo" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo Documento
                        </label>
                        <select name="documento_tipo" id="documento_tipo"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Nessun documento</option>
                            <option value="preventivo">Preventivo</option>
                            <option value="fattura">Fattura</option>
                            <option value="ordine">Ordine</option>
                            <option value="inventario">Inventario</option>
                            <option value="altro">Altro</option>
                        </select>
                    </div>

                    <!-- Numero Documento -->
                    <div>
                        <label for="numero_documento" class="block text-sm font-medium text-gray-700 mb-2">
                            Numero Documento
                        </label>
                        <input type="text" name="numero_documento" id="numero_documento" maxlength="50"
                               placeholder="es. F001, P001..."
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Note -->
                    <div class="md:col-span-2">
                        <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                            Note
                        </label>
                        <textarea name="note" id="note" rows="3"
                                  placeholder="Note aggiuntive sul movimento..."
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>

                <!-- Informazioni Giacenza -->
                <div id="giacenza_info" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-blue-900 mb-2">Informazioni Giacenza</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-blue-700">Giacenza Attuale:</span>
                            <span id="giacenza_attuale" class="ml-2 text-blue-900">-</span>
                        </div>
                        <div>
                            <span class="font-medium text-blue-700">Nuova Giacenza:</span>
                            <span id="nuova_giacenza" class="ml-2 text-blue-900">-</span>
                        </div>
                        <div>
                            <span class="font-medium text-blue-700">Unità di Misura:</span>
                            <span id="unita_misura" class="ml-2 text-blue-900">-</span>
                        </div>
                    </div>
                </div>

                <!-- Pulsanti -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('movimenti-magazzino.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                        Annulla
                    </a>
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition-colors">
                        💾 Salva Movimento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const articoloSelect = document.getElementById('articolo_id');
    const tipoMovimentoSelect = document.getElementById('tipo_movimento');
    const quantitaInput = document.getElementById('quantita');
    const giacenzaInfo = document.getElementById('giacenza_info');
    const giacenzaAttuale = document.getElementById('giacenza_attuale');
    const nuovaGiacenza = document.getElementById('nuova_giacenza');
    const unitaMisura = document.getElementById('unita_misura');
    const unitaMisuraDisplay = document.getElementById('unita_misura_display');

    function updateGiacenzaInfo() {
        const selectedOption = articoloSelect.options[articoloSelect.selectedIndex];
        const tipoMovimento = tipoMovimentoSelect.value;
        const quantita = parseFloat(quantitaInput.value) || 0;

        if (selectedOption.value && tipoMovimento && quantita > 0) {
            const giacenzaCorrente = parseFloat(selectedOption.dataset.giacenza);
            const unita = selectedOption.dataset.unita;
            
            giacenzaAttuale.textContent = giacenzaCorrente + ' ' + unita;
            unitaMisura.textContent = unita;
            unitaMisuraDisplay.textContent = unita;

            let nuovaGiacenzaValue;
            if (tipoMovimento === 'carico') {
                nuovaGiacenzaValue = giacenzaCorrente + quantita;
            } else {
                nuovaGiacenzaValue = Math.max(0, giacenzaCorrente - quantita);
            }
            
            nuovaGiacenza.textContent = nuovaGiacenzaValue + ' ' + unita;
            giacenzaInfo.classList.remove('hidden');
        } else {
            giacenzaInfo.classList.add('hidden');
        }
    }

    articoloSelect.addEventListener('change', updateGiacenzaInfo);
    tipoMovimentoSelect.addEventListener('change', updateGiacenzaInfo);
    quantitaInput.addEventListener('input', updateGiacenzaInfo);

    // Validazione form
    document.querySelector('form').addEventListener('submit', function(e) {
        const articolo = articoloSelect.value;
        const tipoMovimento = tipoMovimentoSelect.value;
        const quantita = parseFloat(quantitaInput.value);

        if (!articolo || !tipoMovimento || !quantita || quantita <= 0) {
            e.preventDefault();
            alert('Compila tutti i campi obbligatori con valori validi');
            return false;
        }

        // Controllo giacenza per scarichi
        if (tipoMovimento === 'scarico') {
            const selectedOption = articoloSelect.options[articoloSelect.selectedIndex];
            const giacenzaCorrente = parseFloat(selectedOption.dataset.giacenza);
            
            if (quantita > giacenzaCorrente) {
                e.preventDefault();
                if (!confirm(`Attenzione: stai scaricando ${quantita} unità ma la giacenza attuale è ${giacenzaCorrente}. Vuoi continuare?`)) {
                    return false;
                }
            }
        }
    });
});
</script>
@endsection
