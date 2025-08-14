@extends('layouts.app')

@section('title', 'Nuovo Fornitore')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    <svg class="inline w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuovo Fornitore
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Inserisci i dati del nuovo fornitore</p>
            </div>
            <a href="{{ route('fornitori.index') }}" class="btn-secondary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 19l-7-7 7-7"></path>
                </svg>
                Torna ai Fornitori
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('fornitori.store') }}" method="POST" class="max-w-4xl">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Colonna Sinistra -->
            <div class="space-y-6">
                <!-- Informazioni Principali -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Informazioni Principali
                        </h3>
                    </div>
                    <div class="card-body space-y-4">
                        <!-- Ragione Sociale -->
                        <div>
                            <label for="ragione_sociale" class="form-label required">Ragione Sociale</label>
                            <input type="text" id="ragione_sociale" name="ragione_sociale" value="{{ old('ragione_sociale') }}" 
                                   class="form-input @error('ragione_sociale') border-red-500 @enderror" 
                                   placeholder="Nome azienda o ditta individuale" required>
                            @error('ragione_sociale')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Partita IVA -->
                        <div>
                            <label for="partita_iva" class="form-label">Partita IVA</label>
                            <input type="text" id="partita_iva" name="partita_iva" value="{{ old('partita_iva') }}" 
                                   class="form-input @error('partita_iva') border-red-500 @enderror" 
                                   placeholder="IT12345678901">
                            @error('partita_iva')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Codice Fiscale -->
                        <div>
                            <label for="codice_fiscale" class="form-label">Codice Fiscale</label>
                            <input type="text" id="codice_fiscale" name="codice_fiscale" value="{{ old('codice_fiscale') }}" 
                                   class="form-input @error('codice_fiscale') border-red-500 @enderror" 
                                   placeholder="RSSMRA80A01H501U">
                            @error('codice_fiscale')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SDI -->
                        <div>
                            <label for="sdi" class="form-label">Codice SDI</label>
                            <input type="text" id="sdi" name="sdi" value="{{ old('sdi') }}" 
                                   class="form-input @error('sdi') border-red-500 @enderror" 
                                   placeholder="0000000">
                            @error('sdi')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
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
                    <div class="card-body space-y-4">
                        <!-- Indirizzo -->
                        <div>
                            <label for="indirizzo" class="form-label">Indirizzo</label>
                            <input type="text" id="indirizzo" name="indirizzo" value="{{ old('indirizzo') }}" 
                                   class="form-input @error('indirizzo') border-red-500 @enderror" 
                                   placeholder="Via/Piazza, numero">
                            @error('indirizzo')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CAP e Città -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="cap" class="form-label">CAP</label>
                                <input type="text" id="cap" name="cap" value="{{ old('cap') }}" 
                                       class="form-input @error('cap') border-red-500 @enderror" 
                                       placeholder="12345">
                                @error('cap')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="citta" class="form-label">Città</label>
                                <input type="text" id="citta" name="citta" value="{{ old('citta') }}" 
                                       class="form-input @error('citta') border-red-500 @enderror" 
                                       placeholder="Milano">
                                @error('citta')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Provincia -->
                        <div>
                            <label for="provincia" class="form-label">Provincia</label>
                            <input type="text" id="provincia" name="provincia" value="{{ old('provincia') }}" 
                                   class="form-input @error('provincia') border-red-500 @enderror" 
                                   placeholder="MI" maxlength="2">
                            @error('provincia')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonna Destra -->
            <div class="space-y-6">
                <!-- Contatti -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Contatti
                        </h3>
                    </div>
                    <div class="card-body space-y-4">
                        <!-- Telefono -->
                        <div>
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                   class="form-input @error('telefono') border-red-500 @enderror" 
                                   placeholder="+39 02 1234567">
                            @error('telefono')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" 
                                   class="form-input @error('email') border-red-500 @enderror" 
                                   placeholder="info@fornitore.it">
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PEC -->
                        <div>
                            <label for="pec" class="form-label">PEC</label>
                            <input type="email" id="pec" name="pec" value="{{ old('pec') }}" 
                                   class="form-input @error('pec') border-red-500 @enderror" 
                                   placeholder="fornitore@pec.it">
                            @error('pec')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
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
                    <div class="card-body space-y-4">
                        <!-- Note -->
                        <div>
                            <label for="note" class="form-label">Note</label>
                            <textarea id="note" name="note" rows="3" 
                                      class="form-textarea @error('note') border-red-500 @enderror" 
                                      placeholder="Note aggiuntive sul fornitore...">{{ old('note') }}</textarea>
                            @error('note')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stato -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="attivo" value="1" {{ old('attivo', '1') == '1' ? 'checked' : '' }} 
                                       class="form-checkbox">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Fornitore attivo</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Azioni -->
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('fornitori.index') }}" class="btn-secondary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Annulla
            </a>
            <button type="submit" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Crea Fornitore
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Validazione client-side per la provincia
document.getElementById('provincia').addEventListener('input', function(e) {
    this.value = this.value.toUpperCase();
});

// Validazione per la partita IVA (formato italiano)
document.getElementById('partita_iva').addEventListener('input', function(e) {
    let value = this.value.toUpperCase();
    // Rimuovi spazi e caratteri non validi
    value = value.replace(/[^A-Z0-9]/g, '');
    this.value = value;
});

// Validazione per il codice fiscale
document.getElementById('codice_fiscale').addEventListener('input', function(e) {
    let value = this.value.toUpperCase();
    // Rimuovi spazi e caratteri non validi
    value = value.replace(/[^A-Z0-9]/g, '');
    this.value = value;
});

// Validazione per il CAP
document.getElementById('cap').addEventListener('input', function(e) {
    let value = this.value.replace(/\D/g, '');
    this.value = value;
});
</script>
@endpush
