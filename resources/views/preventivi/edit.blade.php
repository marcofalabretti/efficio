@extends('layouts.app')

@section('title', 'Modifica Preventivo ' . $preventivo->numero)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Modifica Preventivo</h1>
            <p class="text-lg text-gray-600 mt-2">
                {{ $preventivo->numero }} - {{ $preventivo->customer->name }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('preventivi.show', $preventivo) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                Visualizza
            </a>
            <a href="{{ route('preventivi.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                Lista Preventivi
            </a>
        </div>
    </div>

    <!-- Informazioni Principali -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informazioni Principali</h2>
        <form action="{{ route('preventivi.update', $preventivo) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Numero -->
                <div>
                    <label for="numero" class="block text-sm font-medium text-gray-700 mb-2">
                        Numero <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="numero" name="numero" 
                           value="{{ old('numero', $preventivo->numero) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('numero')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data -->
                <div>
                    <label for="data" class="block text-sm font-medium text-gray-700 mb-2">
                        Data <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="data" name="data" 
                           value="{{ old('data', $preventivo->data->format('Y-m-d')) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('data')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data Scadenza -->
                <div>
                    <label for="data_scadenza" class="block text-sm font-medium text-gray-700 mb-2">
                        Data Scadenza
                    </label>
                    <input type="date" id="data_scadenza" name="data_scadenza" 
                           value="{{ old('data_scadenza', $preventivo->data_scadenza ? $preventivo->data_scadenza->format('Y-m-d') : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('data_scadenza')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cliente -->
                <div>
                    <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Cliente <span class="text-red-500">*</span>
                    </label>
                    <select id="customer_id" name="customer_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleziona cliente...</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $preventivo->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Commessa -->
                <div>
                    <label for="commessa_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Commessa
                    </label>
                    <select id="commessa_id" name="commessa_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleziona commessa...</option>
                        @foreach($commesse as $commessa)
                            <option value="{{ $commessa->id }}" {{ $preventivo->commessa_id == $commessa->id ? 'selected' : '' }}>
                                {{ $commessa->codice }} - {{ $commessa->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('commessa_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Progetto -->
                <div>
                    <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Progetto
                    </label>
                    <select id="project_id" name="project_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleziona progetto...</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $preventivo->project_id == $project->id ? 'selected' : '' }}>
                                {{ $project->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Note -->
            <div>
                <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                    Note
                </label>
                <textarea id="note" name="note" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Note aggiuntive sul preventivo...">{{ old('note', $preventivo->note) }}</textarea>
                @error('note')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pulsanti -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('preventivi.show', $preventivo) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Annulla
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Aggiorna Preventivo
                </button>
            </div>
        </form>
    </div>

    <!-- Gestione Righe -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Righe Preventivo</h2>
            <button type="button" id="btn-nuova-riga" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nuova Riga
            </button>
        </div>

        <!-- Tabella Righe -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrizione</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantità</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prezzo</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sconto</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Totale</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Azioni</th>
                    </tr>
                </thead>
                <tbody id="righe-container" class="bg-white divide-y divide-gray-200">
                    @foreach($preventivo->righe as $riga)
                        @include('preventivi.partials.riga', ['riga' => $riga, 'index' => $loop->index])
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totale -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex justify-end space-x-8">
                <div class="text-right">
                    <span class="text-sm text-gray-600">Totale Netto:</span>
                    <div class="text-lg font-bold text-gray-800">€ {{ number_format($preventivo->importo_netto, 2) }}</div>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-600">IVA (22%):</span>
                    <div class="text-lg font-bold text-gray-800">€ {{ number_format($preventivo->importo_iva, 2) }}</div>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-600">Totale:</span>
                    <div class="text-xl font-bold text-blue-600">€ {{ number_format($preventivo->importo_totale, 2) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuova Riga -->
<div id="modal-nuova-riga" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Nuova Riga Preventivo</h3>
            </div>
            
            <form id="form-nuova-riga" class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tipo Riga -->
                    <div>
                        <label for="tipo_riga" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo Riga <span class="text-red-500">*</span>
                        </label>
                        <select id="tipo_riga" name="tipo_riga" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="manuale">Manuale</option>
                            <option value="articolo">Articolo</option>
                            <option value="manodopera">Manodopera</option>
                        </select>
                    </div>

                    <!-- Articolo (condizionale) -->
                    <div id="articolo-field" class="hidden">
                        <label for="articolo_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Articolo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="articolo_search" name="articolo_search" 
                               placeholder="Cerca articolo..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <input type="hidden" id="articolo_id" name="articolo_id">
                        <div id="articolo-results" class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Descrizione -->
                    <div class="md:col-span-2">
                        <label for="descrizione" class="block text-sm font-medium text-gray-700 mb-2">
                            Descrizione <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="descrizione" name="descrizione" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Descrizione della riga...">
                    </div>

                    <!-- Quantità -->
                    <div>
                        <label for="quantita" class="block text-sm font-medium text-gray-700 mb-2">
                            Quantità <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="quantita" name="quantita" required step="0.01" min="0.01"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Prezzo Unitario -->
                    <div>
                        <label for="prezzo_unitario" class="block text-sm font-medium text-gray-700 mb-2">
                            Prezzo Unitario <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                            <input type="number" id="prezzo_unitario" name="prezzo_unitario" required step="0.01" min="0"
                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Sconto -->
                    <div>
                        <label for="sconto_percentuale" class="block text-sm font-medium text-gray-700 mb-2">
                            Sconto (%)
                        </label>
                        <input type="number" id="sconto_percentuale" name="sconto_percentuale" step="0.01" min="0" max="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               placeholder="0.00">
                    </div>

                    <!-- Unità Misura -->
                    <div>
                        <label for="unita_misura" class="block text-sm font-medium text-gray-700 mb-2">
                            Unità Misura
                        </label>
                        <input type="text" id="unita_misura" name="unita_misura" maxlength="20"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               placeholder="pz, kg, ore...">
                    </div>
                </div>

                <!-- Note -->
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                        Note
                    </label>
                    <textarea id="note" name="note" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Note aggiuntive..."></textarea>
                </div>
            </form>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" id="btn-annulla-riga" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Annulla
                </button>
                <button type="button" id="btn-salva-riga" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Salva Riga
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Template per nuova riga -->
<template id="template-riga">
    <tr class="riga-row" data-index="">
        <td class="px-3 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium tipo-riga"></span>
        </td>
        <td class="px-3 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900 descrizione-riga"></div>
            <div class="text-sm text-gray-500 note-riga"></div>
        </td>
        <td class="px-3 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900 quantita-riga"></div>
            <div class="text-sm text-gray-500 unita-misura-riga"></div>
        </td>
        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 prezzo-riga"></td>
        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 sconto-riga"></td>
        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900 totale-riga"></td>
        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex space-x-2">
                <button type="button" class="btn-modifica text-blue-600 hover:text-blue-900">Modifica</button>
                <button type="button" class="btn-duplica text-green-600 hover:text-green-900">Duplica</button>
                <button type="button" class="btn-elimina text-red-600 hover:text-red-900">Elimina</button>
            </div>
        </td>
    </tr>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-nuova-riga');
    const btnNuovaRiga = document.getElementById('btn-nuova-riga');
    const btnAnnullaRiga = document.getElementById('btn-annulla-riga');
    const btnSalvaRiga = document.getElementById('btn-salva-riga');
    const form = document.getElementById('form-nuova-riga');
    const tipoRigaSelect = document.getElementById('tipo_riga');
    const articoloField = document.getElementById('articolo-field');
    const articoloSearch = document.getElementById('articolo_search');
    const articoloResults = document.getElementById('articolo-results');
    const righeContainer = document.getElementById('righe-container');
    
    let currentRigaIndex = null;
    let isEditing = false;

    // Mostra modal nuova riga
    btnNuovaRiga.addEventListener('click', function() {
        modal.classList.remove('hidden');
        resetForm();
        isEditing = false;
    });

    // Nascondi modal
    btnAnnullaRiga.addEventListener('click', function() {
        modal.classList.add('hidden');
        resetForm();
    });

    // Gestione tipo riga
    tipoRigaSelect.addEventListener('change', function() {
        if (this.value === 'articolo') {
            articoloField.classList.remove('hidden');
        } else {
            articoloField.classList.add('hidden');
        }
    });

    // Ricerca articoli
    articoloSearch.addEventListener('input', function() {
        const query = this.value.trim();
        if (query.length < 2) {
            articoloResults.classList.add('hidden');
            return;
        }

        fetch(`{{ route('preventivo-righe.search-articoli') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.articoli.length > 0) {
                    showArticoloResults(data.articoli);
                } else {
                    articoloResults.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Errore nella ricerca:', error);
            });
    });

    // Mostra risultati ricerca articoli
    function showArticoloResults(articoli) {
        articoloResults.innerHTML = '';
        articoli.forEach(articolo => {
            const div = document.createElement('div');
            div.className = 'px-3 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-200';
            div.textContent = `${articolo.codice} - ${articolo.nome}`;
            div.addEventListener('click', function() {
                selectArticolo(articolo);
            });
            articoloResults.appendChild(div);
        });
        articoloResults.classList.remove('hidden');
    }

    // Seleziona articolo
    function selectArticolo(articolo) {
        document.getElementById('articolo_id').value = articolo.id;
        articoloSearch.value = `${articolo.codice} - ${articolo.nome}`;
        document.getElementById('descrizione').value = articolo.descrizione || articolo.nome;
        document.getElementById('prezzo_unitario').value = articolo.prezzo_vendita;
        document.getElementById('unita_misura').value = articolo.unita_misura;
        articoloResults.classList.add('hidden');
    }

    // Salva riga
    btnSalvaRiga.addEventListener('click', function() {
        const formData = new FormData(form);
        formData.append('preventivo_id', '{{ $preventivo->id }}');
        
        const url = isEditing 
            ? `{{ url('/preventivo-righe') }}/${currentRigaIndex}`
            : '{{ route('preventivo-righe.store') }}';
        
        const method = isEditing ? 'PUT' : 'POST';
        
        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (isEditing) {
                    updateRigaInTable(data.riga, currentRigaIndex);
                } else {
                    addRigaToTable(data.riga);
                }
                modal.classList.add('hidden');
                resetForm();
                updateTotali();
            } else {
                alert('Errore: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Errore:', error);
            alert('Errore durante il salvataggio');
        });
    });

    // Aggiungi riga alla tabella
    function addRigaToTable(riga) {
        const template = document.getElementById('template-riga');
        const clone = template.content.cloneNode(true);
        const row = clone.querySelector('.riga-row');
        
        row.dataset.index = riga.id;
        populateRigaRow(row, riga);
        
        righeContainer.appendChild(clone);
    }

    // Aggiorna riga nella tabella
    function updateRigaInTable(riga, index) {
        const row = document.querySelector(`[data-index="${index}"]`);
        if (row) {
            populateRigaRow(row, riga);
        }
    }

    // Popola riga con dati
    function populateRigaRow(row, riga) {
        row.querySelector('.tipo-riga').textContent = getTipoRigaLabel(riga.tipo_riga);
        row.querySelector('.tipo-riga').className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getTipoRigaClass(riga.tipo_riga)}`;
        row.querySelector('.descrizione-riga').textContent = riga.descrizione;
        row.querySelector('.note-riga').textContent = riga.note || '';
        row.querySelector('.quantita-riga').textContent = riga.quantita;
        row.querySelector('.unita-misura-riga').textContent = riga.unita_misura || '';
        row.querySelector('.prezzo-riga').textContent = `€ ${parseFloat(riga.prezzo_unitario).toFixed(2)}`;
        row.querySelector('.sconto-riga').textContent = riga.sconto_percentuale ? `${riga.sconto_percentuale}%` : '-';
        row.querySelector('.totale-riga').textContent = `€ ${parseFloat(riga.importo_totale).toFixed(2)}`;
        
        // Aggiungi eventi ai pulsanti
        row.querySelector('.btn-modifica').addEventListener('click', () => editRiga(riga));
        row.querySelector('.btn-duplica').addEventListener('click', () => duplicateRiga(riga));
        row.querySelector('.btn-elimina').addEventListener('click', () => deleteRiga(riga.id));
    }

    // Modifica riga
    function editRiga(riga) {
        currentRigaIndex = riga.id;
        isEditing = true;
        
        document.getElementById('tipo_riga').value = riga.tipo_riga;
        document.getElementById('descrizione').value = riga.descrizione;
        document.getElementById('quantita').value = riga.quantita;
        document.getElementById('prezzo_unitario').value = riga.prezzo_unitario;
        document.getElementById('sconto_percentuale').value = riga.sconto_percentuale || '';
        document.getElementById('unita_misura').value = riga.unita_misura || '';
        document.getElementById('note').value = riga.note || '';
        
        if (riga.tipo_riga === 'articolo') {
            articoloField.classList.remove('hidden');
            if (riga.articolo) {
                document.getElementById('articolo_id').value = riga.articolo.id;
                articoloSearch.value = `${riga.articolo.codice} - ${riga.articolo.nome}`;
            }
        }
        
        modal.classList.remove('hidden');
    }

    // Duplica riga
    function duplicateRiga(riga) {
        fetch(`{{ url('/preventivo-righe') }}/${riga.id}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addRigaToTable(data.riga);
                updateTotali();
            }
        })
        .catch(error => {
            console.error('Errore:', error);
        });
    }

    // Elimina riga
    function deleteRiga(rigaId) {
        if (!confirm('Sei sicuro di voler eliminare questa riga?')) {
            return;
        }

        fetch(`{{ url('/preventivo-righe') }}/${rigaId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = document.querySelector(`[data-index="${rigaId}"]`);
                if (row) {
                    row.remove();
                    updateTotali();
                }
            }
        })
        .catch(error => {
            console.error('Errore:', error);
        });
    }

    // Aggiorna totali
    function updateTotali() {
        // I totali vengono aggiornati automaticamente dal server
        // Ricarica la pagina per vedere i nuovi totali
        location.reload();
    }

    // Reset form
    function resetForm() {
        form.reset();
        currentRigaIndex = null;
        isEditing = false;
        articoloField.classList.add('hidden');
        articoloResults.classList.add('hidden');
    }

    // Utility functions
    function getTipoRigaLabel(tipo) {
        const labels = {
            'manuale': 'Manuale',
            'articolo': 'Articolo',
            'manodopera': 'Manodopera'
        };
        return labels[tipo] || tipo;
    }

    function getTipoRigaClass(tipo) {
        const classes = {
            'manuale': 'bg-blue-100 text-blue-800',
            'articolo': 'bg-green-100 text-green-800',
            'manodopera': 'bg-purple-100 text-purple-800'
        };
        return classes[tipo] || 'bg-gray-100 text-gray-800';
    }

    // Chiudi modal cliccando fuori
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            resetForm();
        }
    });
});
</script>
@endsection
