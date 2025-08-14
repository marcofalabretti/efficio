@extends('layouts.app')

@section('title', 'Nuova Categoria Articoli')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('categoria-articoli.index') }}" 
               class="text-gray-400 hover:text-white transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-white">Nuova Categoria Articoli</h1>
                <p class="text-gray-400">Crea una nuova categoria per organizzare il tuo inventario</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-2xl">
        <form action="{{ route('categoria-articoli.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Informazioni Base -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Informazioni Base
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-300 mb-2">
                            Nome Categoria <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required
                               class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nome') border-red-500 @enderror"
                               placeholder="Es. Elettronica, Abbigliamento, etc.">
                        @error('nome')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="codice" class="block text-sm font-medium text-gray-300 mb-2">
                            Codice <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="codice" name="codice" value="{{ old('codice') }}" required
                               class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('codice') border-red-500 @enderror"
                               placeholder="Es. ELETT, ABBIG, etc.">
                        @error('codice')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="descrizione" class="block text-sm font-medium text-gray-300 mb-2">
                        Descrizione
                    </label>
                    <textarea id="descrizione" name="descrizione" rows="3"
                              class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('descrizione') border-red-500 @enderror"
                              placeholder="Descrizione opzionale della categoria">{{ old('descrizione') }}</textarea>
                    @error('descrizione')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Categoria Padre e Colore -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Organizzazione e Stile
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="categoria_padre_id" class="block text-sm font-medium text-gray-300 mb-2">
                            Categoria Padre
                        </label>
                        <select id="categoria_padre_id" name="categoria_padre_id"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('categoria_padre_id') border-red-500 @enderror">
                            <option value="">Nessuna (categoria principale)</option>
                            @foreach($categoriePrincipali as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_padre_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                            @endforeach
                        </select>
                        @error('categoria_padre_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-400">Lascia vuoto per creare una categoria principale</p>
                    </div>
                    
                    <div>
                        <label for="colore" class="block text-sm font-medium text-gray-300 mb-2">
                            Colore Identificativo
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="colore" name="colore" value="{{ old('colore', '#3b82f6') }}"
                                   class="w-16 h-10 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer">
                            <input type="text" id="colore-hex" value="{{ old('colore', '#3b82f6') }}"
                                   class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="#3b82f6">
                        </div>
                        @error('colore')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-400">Scegli un colore per identificare facilmente la categoria</p>
                    </div>
                </div>
            </div>

            <!-- Impostazioni Avanzate -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Impostazioni Avanzate
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="ordinamento" class="block text-sm font-medium text-gray-300 mb-2">
                            Ordinamento
                        </label>
                        <input type="number" id="ordinamento" name="ordinamento" value="{{ old('ordinamento', 0) }}" min="0"
                               class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('ordinamento') border-red-500 @enderror">
                        @error('ordinamento')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-400">Numero per ordinare le categorie (0 = primo)</p>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="flex items-center h-5">
                            <input id="attiva" name="attiva" type="checkbox" value="1" {{ old('attiva', true) ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                        </div>
                        <label for="attiva" class="ml-2 text-sm font-medium text-gray-300">
                            Categoria Attiva
                        </label>
                    </div>
                </div>
            </div>

            <!-- Anteprima -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Anteprima
                </h3>
                
                <div class="bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div id="anteprima-colore" class="w-6 h-6 rounded-full" style="background-color: {{ old('colore', '#3b82f6') }}"></div>
                        <div>
                            <h4 id="anteprima-nome" class="text-lg font-semibold text-white">{{ old('nome', 'Nome Categoria') }}</h4>
                            <p id="anteprima-codice" class="text-sm text-gray-400">{{ old('codice', 'CODICE') }}</p>
                        </div>
                    </div>
                    @if(old('descrizione'))
                    <p id="anteprima-descrizione" class="text-gray-300 text-sm mt-2">{{ old('descrizione') }}</p>
                    @endif
                </div>
            </div>

            <!-- Azioni -->
            <div class="flex items-center gap-4">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Crea Categoria
                </button>
                
                <a href="{{ route('categoria-articoli.index') }}" 
                   class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Annulla
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Sincronizza colore e anteprima
document.getElementById('colore').addEventListener('input', function() {
    document.getElementById('colore-hex').value = this.value;
    document.getElementById('anteprima-colore').style.backgroundColor = this.value;
});

document.getElementById('colore-hex').addEventListener('input', function() {
    const color = this.value;
    if (/^#[0-9A-F]{6}$/i.test(color)) {
        document.getElementById('colore').value = color;
        document.getElementById('anteprima-colore').style.backgroundColor = color;
    }
});

// Aggiorna anteprima nome e codice
document.getElementById('nome').addEventListener('input', function() {
    document.getElementById('anteprima-nome').textContent = this.value || 'Nome Categoria';
});

document.getElementById('codice').addEventListener('input', function() {
    document.getElementById('anteprima-codice').textContent = this.value || 'CODICE';
});

document.getElementById('descrizione').addEventListener('input', function() {
    const anteprima = document.getElementById('anteprima-descrizione');
    if (this.value) {
        if (!anteprima) {
            const p = document.createElement('p');
            p.id = 'anteprima-descrizione';
            p.className = 'text-gray-300 text-sm mt-2';
            p.textContent = this.value;
            document.querySelector('#anteprima-colore').parentElement.parentElement.appendChild(p);
        } else {
            anteprima.textContent = this.value;
        }
    } else if (anteprima) {
        anteprima.remove();
    }
});

// Genera codice automatico dal nome
document.getElementById('nome').addEventListener('blur', function() {
    const nome = this.value.trim();
    const codice = document.getElementById('codice');
    
    if (nome && !codice.value) {
        // Genera codice automatico (prime 5 lettere maiuscole)
        const codiceAuto = nome.substring(0, 5).toUpperCase().replace(/[^A-Z]/g, '');
        if (codiceAuto) {
            codice.value = codiceAuto;
            document.getElementById('anteprima-codice').textContent = codiceAuto;
        }
    }
});
</script>
@endsection
