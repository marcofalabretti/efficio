@extends('layouts.app')

@section('title', 'Nuovo Articolo')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header Section -->
    <div class="card" style="margin-bottom: 24px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, var(--efficio-accent) 0%, #a3e635 100%); display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #000;">
                            <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; margin-bottom: 4px;">Articolo</div>
                        <h1 style="margin: 0; font-size: 28px; font-weight: 600; color: var(--efficio-text);">Nuovo Articolo</h1>
                        <p style="margin: 4px 0 0 0; color: var(--efficio-muted); font-size: 16px;">Crea un nuovo articolo, servizio o manodopera</p>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('articoli.index') }}" class="item" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Lista Articoli
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('articoli.store') }}" method="POST">
        @csrf
        
        <!-- Informazioni Principali -->
        <div class="card" style="margin-bottom: 24px; padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #6366f1;">
                        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Informazioni Principali</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <!-- Codice -->
                <div>
                    <label for="codice" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Codice *</label>
                    <input type="text" 
                           id="codice" 
                           name="codice" 
                           value="{{ old('codice') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('codice') border-color: #ef4444; @enderror"
                           required
                           placeholder="ART001">
                    @error('codice')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nome -->
                <div>
                    <label for="nome" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Nome *</label>
                    <input type="text" 
                           id="nome" 
                           name="nome" 
                           value="{{ old('nome') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('nome') border-color: #ef4444; @enderror"
                           required
                           placeholder="Nome articolo">
                    @error('nome')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipo -->
                <div>
                    <label for="tipo" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Tipo *</label>
                    <select id="tipo" name="tipo" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('tipo') border-color: #ef4444; @enderror" required>
                        <option value="">Seleziona tipo</option>
                        <option value="prodotto" {{ old('tipo') == 'prodotto' ? 'selected' : '' }}>Prodotto</option>
                        <option value="servizio" {{ old('tipo') == 'servizio' ? 'selected' : '' }}>Servizio</option>
                        <option value="manodopera" {{ old('tipo') == 'manodopera' ? 'selected' : '' }}>Manodopera</option>
                    </select>
                    @error('tipo')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoria -->
                <div>
                    <label for="categoria_id" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Categoria</label>
                    <select id="categoria_id" name="categoria_id" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('categoria_id') border-color: #ef4444; @enderror">
                        <option value="">Nessuna categoria</option>
                        @foreach($categorie as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fornitore -->
                <div>
                    <label for="fornitore_id" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Fornitore</label>
                    <select id="fornitore_id" name="fornitore_id" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('fornitore_id') border-color: #ef4444; @enderror">
                        <option value="">Nessun fornitore</option>
                        @foreach($fornitori as $fornitore)
                            <option value="{{ $fornitore->id }}" {{ old('fornitore_id') == $fornitore->id ? 'selected' : '' }}>
                                {{ $fornitore->ragione_sociale }}
                            </option>
                        @endforeach
                    </select>
                    @error('fornitore_id')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unità di Misura -->
                <div>
                    <label for="unita_misura" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Unità di Misura</label>
                    <input type="text" 
                           id="unita_misura" 
                           name="unita_misura" 
                           value="{{ old('unita_misura', 'pz') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('unita_misura') border-color: #ef4444; @enderror"
                           placeholder="pz, kg, m, h...">
                    @error('unita_misura')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Descrizione -->
            <div>
                <label for="descrizione" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Descrizione</label>
                <textarea id="descrizione" 
                          name="descrizione" 
                          rows="3"
                          style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; resize: vertical; @error('descrizione') border-color: #ef4444; @enderror"
                          placeholder="Descrizione dettagliata dell'articolo...">{{ old('descrizione') }}</textarea>
                @error('descrizione')
                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                @enderror
            </div>
        </div>

                    <!-- Prezzi -->
        <div class="card" style="margin-bottom: 24px; padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Prezzi e Costi</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <!-- Prezzo Vendita -->
                <div>
                    <label for="prezzo_vendita" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Prezzo Vendita *</label>
                    <div style="position: relative;">
                        <span style="position: absolute; top: 50%; left: 12px; transform: translateY(-50%); color: var(--efficio-muted); font-weight: 500;">€</span>
                        <input type="number" 
                               id="prezzo_vendita" 
                               name="prezzo_vendita" 
                               value="{{ old('prezzo_vendita') }}"
                               style="width: 100%; padding: 12px 12px 12px 32px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('prezzo_vendita') border-color: #ef4444; @enderror"
                               step="0.01"
                               min="0"
                               required
                               placeholder="0.00">
                    </div>
                    @error('prezzo_vendita')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prezzo Acquisto -->
                <div>
                    <label for="prezzo_acquisto" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Prezzo Acquisto</label>
                    <div style="position: relative;">
                        <span style="position: absolute; top: 50%; left: 12px; transform: translateY(-50%); color: var(--efficio-muted); font-weight: 500;">€</span>
                        <input type="number" 
                               id="prezzo_acquisto" 
                               name="prezzo_acquisto" 
                               value="{{ old('prezzo_acquisto') }}"
                               style="width: 100%; padding: 12px 12px 12px 32px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('prezzo_acquisto') border-color: #ef4444; @enderror"
                               step="0.01"
                               min="0"
                               placeholder="0.00">
                    </div>
                    @error('prezzo_acquisto')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prezzo Vendita Minimo -->
                <div>
                    <label for="prezzo_vendita_minimo" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Prezzo Vendita Minimo</label>
                    <div style="position: relative;">
                        <span style="position: absolute; top: 50%; left: 12px; transform: translateY(-50%); color: var(--efficio-muted); font-weight: 500;">€</span>
                        <input type="number" 
                               id="prezzo_vendita_minimo" 
                               name="prezzo_vendita_minimo" 
                               value="{{ old('prezzo_vendita_minimo') }}"
                               style="width: 100%; padding: 12px 12px 12px 32px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('prezzo_vendita_minimo') border-color: #ef4444; @enderror"
                               step="0.01"
                               min="0"
                               placeholder="0.00">
                    </div>
                    @error('prezzo_vendita_minimo')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Margine (calcolato) -->
            <div style="padding: 16px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 14px; color: var(--efficio-muted);">
                    <span id="margine-label">Margine: </span>
                    <span id="margine-value" style="font-weight: 600; color: var(--efficio-text);">--</span>
                </div>
            </div>
        </div>

                    <!-- Gestione Magazzino (solo per prodotti) -->
        <div id="sezione-magazzino" class="card" style="margin-bottom: 24px; padding: 24px; display: none;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #f59e0b;">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Gestione Magazzino</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <!-- Giacenza Attuale -->
                <div>
                    <label for="giacenza_attuale" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Giacenza Attuale</label>
                    <input type="number" 
                           id="giacenza_attuale" 
                           name="giacenza_attuale" 
                           value="{{ old('giacenza_attuale', 0) }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('giacenza_attuale') border-color: #ef4444; @enderror"
                           step="0.01"
                           min="0"
                           placeholder="0">
                    @error('giacenza_attuale')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Giacenza Minima -->
                <div>
                    <label for="giacenza_minima" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Giacenza Minima</label>
                    <input type="number" 
                           id="giacenza_minima" 
                           name="giacenza_minima" 
                           value="{{ old('giacenza_minima') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('giacenza_minima') border-color: #ef4444; @enderror"
                           step="0.01"
                           min="0"
                           placeholder="0">
                    @error('giacenza_minima')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ordinamento -->
                <div>
                    <label for="ordinamento" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Ordinamento</label>
                    <input type="number" 
                           id="ordinamento" 
                           name="ordinamento" 
                           value="{{ old('ordinamento', 0) }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('ordinamento') border-color: #ef4444; @enderror"
                           placeholder="0">
                    @error('ordinamento')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

                    <!-- Informazioni Tecniche -->
        <div class="card" style="margin-bottom: 24px; padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                        <path d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Informazioni Tecniche</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Marca -->
                <div>
                    <label for="marca" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Marca</label>
                    <input type="text" 
                           id="marca" 
                           name="marca" 
                           value="{{ old('marca') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('marca') border-color: #ef4444; @enderror"
                           placeholder="Marca">
                    @error('marca')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modello -->
                <div>
                    <label for="modello" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Modello</label>
                    <input type="text" 
                           id="modello" 
                           name="modello" 
                           value="{{ old('modello') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('modello') border-color: #ef4444; @enderror"
                           placeholder="Modello">
                    @error('modello')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Codice EAN -->
                <div>
                    <label for="codice_ean" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Codice EAN</label>
                    <input type="text" 
                           id="codice_ean" 
                           name="codice_ean" 
                           value="{{ old('codice_ean') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('codice_ean') border-color: #ef4444; @enderror"
                           placeholder="1234567890123">
                    @error('codice_ean')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Codice Fornitore -->
                <div>
                    <label for="codice_fornitore" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Codice Fornitore</label>
                    <input type="text" 
                           id="codice_fornitore" 
                           name="codice_fornitore" 
                           value="{{ old('codice_fornitore') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('codice_fornitore') border-color: #ef4444; @enderror"
                           placeholder="Codice fornitore">
                    @error('codice_fornitore')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Peso -->
                <div>
                    <label for="peso" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Peso (kg)</label>
                    <input type="number" 
                           id="peso" 
                           name="peso" 
                           value="{{ old('peso') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('peso') border-color: #ef4444; @enderror"
                           step="0.01"
                           min="0"
                           placeholder="0.00">
                    @error('peso')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dimensioni -->
                <div>
                    <label for="dimensioni" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Dimensioni</label>
                    <input type="text" 
                           id="dimensioni" 
                           name="dimensioni" 
                           value="{{ old('dimensioni') }}"
                           style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('dimensioni') border-color: #ef4444; @enderror"
                           placeholder="L x W x H cm">
                    @error('dimensioni')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

                    <!-- Impostazioni -->
        <div class="card" style="margin-bottom: 24px; padding: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Impostazioni</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <!-- Attivo -->
                <div>
                    <label for="attivo" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Stato</label>
                    <select id="attivo" name="attivo" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('attivo') border-color: #ef4444; @enderror">
                        <option value="1" {{ old('attivo', '1') == '1' ? 'selected' : '' }}>Attivo</option>
                        <option value="0" {{ old('attivo', '1') == '0' ? 'selected' : '' }}>Inattivo</option>
                    </select>
                    @error('attivo')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Vendibile -->
                <div>
                    <label for="vendibile" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Vendibile</label>
                    <select id="vendibile" name="vendibile" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('vendibile') border-color: #ef4444; @enderror">
                        <option value="1" {{ old('vendibile', '1') == '1' ? 'selected' : '' }}>Sì</option>
                        <option value="0" {{ old('vendibile', '1') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('vendibile')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Acquistabile -->
                <div>
                    <label for="acquistabile" style="display: block; font-size: 12px; color: var(--efficio-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; font-weight: 500;">Acquistabile</label>
                    <select id="acquistabile" name="acquistabile" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px; transition: all 0.2s ease; @error('acquistabile') border-color: #ef4444; @enderror">
                        <option value="1" {{ old('acquistabile', '1') == '1' ? 'selected' : '' }}>Sì</option>
                        <option value="0" {{ old('acquistabile', '1') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('acquistabile')
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #ef4444;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

            <!-- Azioni -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.1);">
                <a href="{{ route('articoli.index') }}" style="padding: 12px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease; color: var(--efficio-text);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Annulla
                </a>
                <button type="submit" style="padding: 12px 24px; border: none; border-radius: 10px; background: linear-gradient(135deg, var(--efficio-accent) 0%, #a3e635 100%); display: flex; align-items: center; gap: 8px; font-weight: 600; transition: all 0.2s ease; color: #000; cursor: pointer; font-family: inherit;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Crea Articolo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Gestione sezione magazzino in base al tipo
document.getElementById('tipo').addEventListener('change', function() {
    const sezioneMagazzino = document.getElementById('sezione-magazzino');
    if (this.value === 'prodotto') {
        sezioneMagazzino.style.display = 'block';
    } else {
        sezioneMagazzino.style.display = 'none';
    }
});

// Calcolo margine in tempo reale
function calcolaMargine() {
    const prezzoVendita = parseFloat(document.getElementById('prezzo_vendita').value) || 0;
    const prezzoAcquisto = parseFloat(document.getElementById('prezzo_acquisto').value) || 0;
    
    if (prezzoAcquisto > 0) {
        const margine = prezzoVendita - prezzoAcquisto;
        const percentuale = (margine / prezzoAcquisto) * 100;
        
        const margineElement = document.getElementById('margine-value');
        margineElement.textContent = `€ ${margine.toFixed(2)} (${percentuale.toFixed(1)}%)`;
        
        if (margine < 0) {
            margineElement.style.color = '#ef4444';
        } else {
            margineElement.style.color = 'var(--efficio-text)';
        }
    } else {
        document.getElementById('margine-value').textContent = '--';
    }
}

document.getElementById('prezzo_vendita').addEventListener('input', calcolaMargine);
document.getElementById('prezzo_acquisto').addEventListener('input', calcolaMargine);

// Generazione automatica codice se vuoto
document.getElementById('nome').addEventListener('input', function() {
    const codice = document.getElementById('codice');
    if (!codice.value && this.value) {
        const codiceGenerato = this.value.substring(0, 3).toUpperCase() + 
                              Math.floor(Math.random() * 1000).toString().padStart(3, '0');
        codice.value = codiceGenerato;
    }
});

// Inizializzazione
document.addEventListener('DOMContentLoaded', function() {
    // Trigger change event per tipo
    document.getElementById('tipo').dispatchEvent(new Event('change'));
    
    // Calcola margine iniziale
    calcolaMargine();
});
</script>
@endpush
