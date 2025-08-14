@extends('layouts.app')

@section('title', 'Modifica Fornitore - ' . $fornitore->ragione_sociale)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    <svg class="inline w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifica Fornitore
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Modifica le informazioni per {{ $fornitore->ragione_sociale }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('fornitori.show', $fornitore) }}" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Visualizza
                </a>
                <a href="{{ route('fornitori.index') }}" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                    Torna ai Fornitori
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('fornitori.update', $fornitore) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <!-- Informazioni Principali -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informazioni Principali
                    </h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Ragione Sociale -->
                        <div class="md:col-span-2">
                            <label for="ragione_sociale" class="form-label required">Ragione Sociale</label>
                            <input type="text" 
                                   id="ragione_sociale" 
                                   name="ragione_sociale" 
                                   value="{{ old('ragione_sociale', $fornitore->ragione_sociale) }}"
                                   class="form-input @error('ragione_sociale') border-red-500 @enderror"
                                   required>
                            @error('ragione_sociale')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Partita IVA -->
                        <div>
                            <label for="partita_iva" class="form-label">Partita IVA</label>
                            <input type="text" 
                                   id="partita_iva" 
                                   name="partita_iva" 
                                   value="{{ old('partita_iva', $fornitore->partita_iva) }}"
                                   class="form-input @error('partita_iva') border-red-500 @enderror"
                                   placeholder="12345678901"
                                   pattern="[0-9]{11,13}">
                            @error('partita_iva')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Codice Fiscale -->
                        <div>
                            <label for="codice_fiscale" class="form-label">Codice Fiscale</label>
                            <input type="text" 
                                   id="codice_fiscale" 
                                   name="codice_fiscale" 
                                   value="{{ old('codice_fiscale', $fornitore->codice_fiscale) }}"
                                   class="form-input @error('codice_fiscale') border-red-500 @enderror"
                                   placeholder="RSSMRA80A01H501U"
                                   pattern="[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]">
                            @error('codice_fiscale')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Codice SDI -->
                        <div>
                            <label for="sdi" class="form-label">Codice SDI</label>
                            <input type="text" 
                                   id="sdi" 
                                   name="sdi" 
                                   value="{{ old('sdi', $fornitore->sdi) }}"
                                   class="form-input @error('sdi') border-red-500 @enderror"
                                   placeholder="0000000"
                                   pattern="[0-9]{7}">
                            <p class="form-help">Codice destinatario per fatturazione elettronica</p>
                            @error('sdi')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stato -->
                        <div>
                            <label for="attivo" class="form-label">Stato</label>
                            <select id="attivo" name="attivo" class="form-select @error('attivo') border-red-500 @enderror">
                                <option value="1" {{ old('attivo', $fornitore->attivo) ? 'selected' : '' }}>Attivo</option>
                                <option value="0" {{ old('attivo', $fornitore->attivo) ? '' : 'selected' }}>Inattivo</option>
                            </select>
                            @error('attivo')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Indirizzo -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Indirizzo
                    </h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Indirizzo -->
                        <div class="md:col-span-2">
                            <label for="indirizzo" class="form-label">Indirizzo</label>
                            <input type="text" 
                                   id="indirizzo" 
                                   name="indirizzo" 
                                   value="{{ old('indirizzo', $fornitore->indirizzo) }}"
                                   class="form-input @error('indirizzo') border-red-500 @enderror"
                                   placeholder="Via Roma 123">
                            @error('indirizzo')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CAP -->
                        <div>
                            <label for="cap" class="form-label">CAP</label>
                            <input type="text" 
                                   id="cap" 
                                   name="cap" 
                                   value="{{ old('cap', $fornitore->cap) }}"
                                   class="form-input @error('cap') border-red-500 @enderror"
                                   placeholder="12345"
                                   pattern="[0-9]{5}">
                            @error('cap')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Città -->
                        <div>
                            <label for="citta" class="form-label">Città</label>
                            <input type="text" 
                                   id="citta" 
                                   name="citta" 
                                   value="{{ old('citta', $fornitore->citta) }}"
                                   class="form-input @error('citta') border-red-500 @enderror"
                                   placeholder="Milano">
                            @error('citta')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provincia -->
                        <div>
                            <label for="provincia" class="form-label">Provincia</label>
                            <input type="text" 
                                   id="provincia" 
                                   name="provincia" 
                                   value="{{ old('provincia', $fornitore->provincia) }}"
                                   class="form-input @error('provincia') border-red-500 @enderror"
                                   placeholder="MI"
                                   maxlength="2"
                                   style="text-transform: uppercase;">
                            @error('provincia')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contatti -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Contatti
                    </h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Telefono -->
                        <div>
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="tel" 
                                   id="telefono" 
                                   name="telefono" 
                                   value="{{ old('telefono', $fornitore->telefono) }}"
                                   class="form-input @error('telefono') border-red-500 @enderror"
                                   placeholder="+39 02 1234567">
                            @error('telefono')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $fornitore->email) }}"
                                   class="form-input @error('email') border-red-500 @enderror"
                                   placeholder="info@fornitore.it">
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PEC -->
                        <div>
                            <label for="pec" class="form-label">PEC</label>
                            <input type="email" 
                                   id="pec" 
                                   name="pec" 
                                   value="{{ old('pec', $fornitore->pec) }}"
                                   class="form-input @error('pec') border-red-500 @enderror"
                                   placeholder="fornitore@pec.it">
                            <p class="form-help">Posta Elettronica Certificata</p>
                            @error('pec')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Note e Impostazioni -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Note e Impostazioni
                    </h3>
                </div>
                <div class="card-body">
                    <div class="space-y-6">
                        <!-- Note -->
                        <div>
                            <label for="note" class="form-label">Note</label>
                            <textarea id="note" 
                                      name="note" 
                                      rows="4"
                                      class="form-textarea @error('note') border-red-500 @enderror"
                                      placeholder="Note aggiuntive sul fornitore...">{{ old('note', $fornitore->note) }}</textarea>
                            @error('note')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Azioni -->
            <div class="flex items-center justify-between pt-6">
                <a href="{{ route('fornitori.show', $fornitore) }}" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Annulla
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Aggiorna Fornitore
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto-uppercase per provincia
document.getElementById('provincia').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

// Validazione form
document.querySelector('form').addEventListener('submit', function(e) {
    const partitaIva = document.getElementById('partita_iva').value;
    const codiceFiscale = document.getElementById('codice_fiscale').value;
    
    if (partitaIva && !/^[0-9]{11,13}$/.test(partitaIva)) {
        e.preventDefault();
        alert('La Partita IVA deve contenere 11-13 cifre numeriche');
        document.getElementById('partita_iva').focus();
        return;
    }
    
    if (codiceFiscale && !/^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$/.test(codiceFiscale)) {
        e.preventDefault();
        alert('Il Codice Fiscale deve essere nel formato corretto (es: RSSMRA80A01H501U)');
        document.getElementById('codice_fiscale').focus();
        return;
    }
    
    const provincia = document.getElementById('provincia').value;
    if (provincia && provincia.length !== 2) {
        e.preventDefault();
        alert('La Provincia deve essere di 2 caratteri');
        document.getElementById('provincia').focus();
        return;
    }
});
</script>
@endpush
