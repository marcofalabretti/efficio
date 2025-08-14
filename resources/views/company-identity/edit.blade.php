@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 0 auto;">
    <!-- Header -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px;">
        <div>
            <h1 style="margin: 0; font-size: 28px; font-weight: 700; color: var(--efficio-text);">Modifica Identità Aziendale</h1>
            <p style="margin: 8px 0 0 0; color: var(--efficio-muted); font-size: 16px;">{{ $companyIdentity->company_name }}</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('company-identity.show', $companyIdentity->id) }}" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                Visualizza
            </a>
            <a href="{{ route('company-identity.index') }}" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Torna alla Lista
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('company-identity.update', $companyIdentity->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Informazioni Base -->
        <div class="card" style="margin-bottom: 24px;">
            <div style="padding: 24px; border-bottom: var(--border);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #6366f1;">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Informazioni Base</h3>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <div>
                        <label for="company_name" class="form-label">Nome Azienda *</label>
                        <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $companyIdentity->company_name) }}" class="form-input" required>
                        @error('company_name')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="commercial_name" class="form-label">Nome Commerciale</label>
                        <input type="text" id="commercial_name" name="commercial_name" value="{{ old('commercial_name', $companyIdentity->commercial_name) }}" class="form-input">
                        @error('commercial_name')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="slogan" class="form-label">Slogan/Tagline</label>
                        <input type="text" id="slogan" name="slogan" value="{{ old('slogan', $companyIdentity->slogan) }}" class="form-input">
                        @error('slogan')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="website" class="form-label">Sito Web</label>
                        <input type="url" id="website" name="website" value="{{ old('website', $companyIdentity->website) }}" class="form-input" placeholder="https://www.esempio.it">
                        @error('website')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="form-label">Email di Contatto</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $companyIdentity->email) }}" class="form-input">
                        @error('email')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="phone" class="form-label">Telefono</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $companyIdentity->phone) }}" class="form-input">
                        @error('phone')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenuti Aziendali -->
        <div class="card" style="margin-bottom: 24px;">
            <div style="padding: 24px; border-bottom: var(--border);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #22c55e;">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Contenuti Aziendali</h3>
                </div>
                
                <div style="display: grid; gap: 20px;">
                    <div>
                        <label for="mission" class="form-label">Mission Aziendale</label>
                        <textarea id="mission" name="mission" rows="3" class="form-input" placeholder="Descrivi la missione della tua azienda...">{{ old('mission', $companyIdentity->mission) }}</textarea>
                        @error('mission')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="vision" class="form-label">Vision Aziendale</label>
                        <textarea id="vision" name="vision" rows="3" class="form-input" placeholder="Descrivi la visione della tua azienda...">{{ old('vision', $companyIdentity->vision) }}</textarea>
                        @error('vision')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="values" class="form-label">Valori Aziendali</label>
                        <textarea id="values" name="values" rows="3" class="form-input" placeholder="Inserisci i valori aziendali separati da virgole...">{{ old('values', is_array($companyIdentity->values) ? implode(', ', $companyIdentity->values) : $companyIdentity->values) }}</textarea>
                        <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Es: Professionalità, Innovazione, Qualità, Trasparenza</div>
                        @error('values')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Informazioni Legali -->
        <div class="card" style="margin-bottom: 24px;">
            <div style="padding: 24px; border-bottom: var(--border);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #ef4444;">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Informazioni Legali</h3>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <div>
                        <label for="partita_iva" class="form-label">Partita IVA</label>
                        <input type="text" id="partita_iva" name="partita_iva" value="{{ old('partita_iva', $companyIdentity->partita_iva) }}" class="form-input">
                        @error('partita_iva')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="codice_fiscale" class="form-label">Codice Fiscale</label>
                        <input type="text" id="codice_fiscale" name="codice_fiscale" value="{{ old('codice_fiscale', $companyIdentity->codice_fiscale) }}" class="form-input">
                        @error('codice_fiscale')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="rea" class="form-label">REA</label>
                        <input type="text" id="rea" name="rea" value="{{ old('rea', $companyIdentity->rea) }}" class="form-input">
                        @error('rea')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="pec" class="form-label">PEC</label>
                        <input type="email" id="pec" name="pec" value="{{ old('pec', $companyIdentity->pec) }}" class="form-input">
                        @error('pec')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="sdi" class="form-label">Sistema di Interscambio</label>
                        <input type="text" id="sdi" name="sdi" value="{{ old('sdi', $companyIdentity->sdi) }}" class="form-input">
                        @error('sdi')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <label for="legal_address" class="form-label">Indirizzo Legale Completo</label>
                    <textarea id="legal_address" name="legal_address" rows="3" class="form-input" placeholder="Via, numero, CAP, città, provincia...">{{ old('legal_address', $companyIdentity->legal_address) }}</textarea>
                    @error('legal_address')
                        <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Elementi Visivi -->
        <div class="card" style="margin-bottom: 24px;">
            <div style="padding: 24px; border-bottom: var(--border);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                            <path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Elementi Visivi</h3>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <div>
                        <label for="logo_large" class="form-label">Logo Grande (per documenti)</label>
                        @if($companyIdentity->logo_large)
                            <div style="margin-bottom: 12px;">
                                <div style="width: 120px; height: 60px; border-radius: 8px; overflow: hidden; border: var(--border);">
                                    <img src="{{ Storage::url($companyIdentity->logo_large) }}" alt="Logo attuale" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Logo attuale</div>
                            </div>
                        @endif
                        <input type="file" id="logo_large" name="logo_large" accept="image/*" class="form-input">
                        <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Formato: PNG, JPG. Dimensione consigliata: 300x150px</div>
                        @error('logo_large')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="logo_horizontal" class="form-label">Logo Orizzontale</label>
                        @if($companyIdentity->logo_horizontal)
                            <div style="margin-bottom: 12px;">
                                <div style="width: 100px; height: 40px; border-radius: 8px; overflow: hidden; border: var(--border);">
                                    <img src="{{ Storage::url($companyIdentity->logo_horizontal) }}" alt="Logo attuale" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Logo attuale</div>
                            </div>
                        @endif
                        <input type="file" id="logo_horizontal" name="logo_horizontal" accept="image/*" class="form-input">
                        <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Formato: PNG, JPG. Dimensione consigliata: 200x80px</div>
                        @error('logo_horizontal')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="logo_vertical" class="form-label">Logo Verticale</label>
                        @if($companyIdentity->logo_vertical)
                            <div style="margin-bottom: 12px;">
                                <div style="width: 60px; height: 100px; border-radius: 8px; overflow: hidden; border: var(--border);">
                                    <img src="{{ Storage::url($companyIdentity->logo_vertical) }}" alt="Logo attuale" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Logo attuale</div>
                            </div>
                        @endif
                        <input type="file" id="logo_vertical" name="logo_vertical" accept="image/*" class="form-input">
                        <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Formato: PNG, JPG. Dimensione consigliata: 150x200px</div>
                        @error('logo_vertical')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="logo_icon" class="form-label">Logo Icona</label>
                        @if($companyIdentity->logo_icon)
                            <div style="margin-bottom: 12px;">
                                <div style="width: 48px; height: 48px; border-radius: 8px; overflow: hidden; border: var(--border);">
                                    <img src="{{ Storage::url($companyIdentity->logo_icon) }}" alt="Logo attuale" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Logo attuale</div>
                            </div>
                        @endif
                        <input type="file" id="logo_icon" name="logo_icon" accept="image/*" class="form-input">
                        <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Formato: PNG, ICO. Dimensione consigliata: 64x64px</div>
                        @error('logo_icon')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="favicon" class="form-label">Favicon</label>
                        @if($companyIdentity->favicon)
                            <div style="margin-bottom: 12px;">
                                <div style="width: 32px; height: 32px; border-radius: 8px; overflow: hidden; border: var(--border);">
                                    <img src="{{ Storage::url($companyIdentity->favicon) }}" alt="Favicon attuale" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Favicon attuale</div>
                            </div>
                        @endif
                        <input type="file" id="favicon" name="favicon" accept="image/*" class="form-input">
                        <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Formato: ICO, PNG. Dimensione consigliata: 32x32px</div>
                        @error('favicon')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Colori Brand -->
        <div class="card" style="margin-bottom: 24px;">
            <div style="padding: 24px; border-bottom: var(--border);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(201, 255, 46, 0.1); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #c9ff2e;">
                            <circle cx="13.5" cy="6.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                            <path d="M7 2h14v5l-7 4-7-4V2z" stroke="currentColor" stroke-width="2"/>
                            <path d="M7 7v10l7 4 7-4V7" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Colori Brand</h3>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div>
                        <label for="primary_color" class="form-label">Colore Primario</label>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <input type="color" id="primary_color" name="primary_color" value="{{ old('primary_color', $companyIdentity->primary_color) }}" style="width: 50px; height: 40px; border: none; border-radius: 8px; cursor: pointer;">
                            <input type="text" value="{{ old('primary_color', $companyIdentity->primary_color) }}" class="form-input" style="flex: 1;" readonly>
                        </div>
                        @error('primary_color')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="secondary_color" class="form-label">Colore Secondario</label>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <input type="color" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $companyIdentity->secondary_color) }}" style="width: 50px; height: 40px; border: none; border-radius: 8px; cursor: pointer;">
                            <input type="text" value="{{ old('secondary_color', $companyIdentity->secondary_color) }}" class="form-input" style="flex: 1;" readonly>
                        </div>
                        @error('secondary_color')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="neutral_color" class="form-label">Colore Neutro</label>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <input type="color" id="neutral_color" name="neutral_color" value="{{ old('neutral_color', $companyIdentity->neutral_color) }}" style="width: 50px; height: 40px; border: none; border-radius: 8px; cursor: pointer;">
                            <input type="text" value="{{ old('neutral_color', $companyIdentity->neutral_color) }}" class="form-input" style="flex: 1;" readonly>
                        </div>
                        @error('neutral_color')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="success_color" class="form-label">Colore Successo</label>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <input type="color" id="success_color" name="success_color" value="{{ old('success_color', $companyIdentity->success_color) }}" style="width: 50px; height: 40px; border: none; border-radius: 8px; cursor: pointer;">
                            <input type="text" value="{{ old('success_color', $companyIdentity->success_color) }}" class="form-input" style="flex: 1;" readonly>
                        </div>
                        @error('success_color')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="error_color" class="form-label">Colore Errore</label>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <input type="color" id="error_color" name="error_color" value="{{ old('error_color', $companyIdentity->error_color) }}" style="width: 50px; height: 40px; border: none; border-radius: 8px; cursor: pointer;">
                            <input type="text" value="{{ old('error_color', $companyIdentity->error_color) }}" class="form-input" style="flex: 1;" readonly>
                        </div>
                        @error('error_color')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Font e Stile -->
        <div class="card" style="margin-bottom: 24px;">
            <div style="padding: 24px; border-bottom: var(--border);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #3b82f6;">
                            <path d="M4 7V4a2 2 0 012-2h2M4 7h16M4 7v10a2 2 0 002 2h12a2 2 0 002-2V7M4 7V4a2 2 0 012-2h2" stroke="currentColor" stroke-width="2"/>
                            <path d="M9 14h6M9 18h6" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Font e Stile</h3>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <div>
                        <label for="primary_font" class="form-label">Font Principale</label>
                        <select id="primary_font" name="primary_font" class="form-select">
                            <option value="Inter" {{ old('primary_font', $companyIdentity->primary_font) == 'Inter' ? 'selected' : '' }}>Inter</option>
                            <option value="Roboto" {{ old('primary_font', $companyIdentity->primary_font) == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                            <option value="Open Sans" {{ old('primary_font', $companyIdentity->primary_font) == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                            <option value="Lato" {{ old('primary_font', $companyIdentity->primary_font) == 'Lato' ? 'selected' : '' }}>Lato</option>
                            <option value="Poppins" {{ old('primary_font', $companyIdentity->primary_font) == 'Poppins' ? 'selected' : '' }}>Poppins</option>
                            <option value="system-ui" {{ old('primary_font', $companyIdentity->primary_font) == 'system-ui' ? 'selected' : '' }}>System UI</option>
                        </select>
                        @error('primary_font')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="secondary_font" class="form-label">Font Secondario</label>
                        <select id="secondary_font" name="secondary_font" class="form-select">
                            <option value="system-ui" {{ old('secondary_font', $companyIdentity->secondary_font) == 'system-ui' ? 'selected' : '' }}>System UI</option>
                            <option value="Georgia" {{ old('secondary_font', $companyIdentity->secondary_font) == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                            <option value="Times New Roman" {{ old('secondary_font', $companyIdentity->secondary_font) == 'Times New Roman' ? 'selected' : '' }}>Times New Roman</option>
                            <option value="serif" {{ old('secondary_font', $companyIdentity->secondary_font) == 'serif' ? 'selected' : '' }}>Serif</option>
                        </select>
                        @error('secondary_font')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="style_type" class="form-label">Tipo di Stile</label>
                        <select id="style_type" name="style_type" class="form-select">
                            <option value="corporate" {{ old('style_type', $companyIdentity->style_type) == 'corporate' ? 'selected' : '' }}>Corporate</option>
                            <option value="creative" {{ old('style_type', $companyIdentity->style_type) == 'creative' ? 'selected' : '' }}>Creativo</option>
                            <option value="minimal" {{ old('style_type', $companyIdentity->style_type) == 'minimal' ? 'selected' : '' }}>Minimal</option>
                            <option value="modern" {{ old('style_type', $companyIdentity->style_type) == 'modern' ? 'selected' : '' }}>Moderno</option>
                        </select>
                        @error('style_type')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Impostazioni Multi-Sede -->
        <div class="card" style="margin-bottom: 24px;">
            <div style="padding: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #a855f7;">
                            <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Impostazioni Multi-Sede</h3>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <div>
                        <label for="branch_code" class="form-label">Codice Sede/Filiale</label>
                        <input type="text" id="branch_code" name="branch_code" value="{{ old('branch_code', $companyIdentity->branch_code) }}" class="form-input" placeholder="Es: RM, MI, TO">
                        <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 4px;">Lascia vuoto per la sede principale</div>
                        @error('branch_code')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="branch_name" class="form-label">Nome Sede/Filiale</label>
                        <input type="text" id="branch_name" name="branch_name" value="{{ old('branch_name', $companyIdentity->branch_name) }}" class="form-input" placeholder="Es: Roma, Milano, Torino">
                        @error('branch_name')
                            <div style="color: #f87171; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Azioni -->
        <div style="display: flex; gap: 16px; justify-content: flex-end; padding: 24px 0;">
            <a href="{{ route('company-identity.show', $companyIdentity->id) }}" class="btn-secondary">
                Annulla
            </a>
            <button type="submit" class="btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Aggiorna Identità
            </button>
        </div>
    </form>
</div>

<script>
// Sincronizza i color picker con i campi di testo
document.querySelectorAll('input[type="color"]').forEach(colorInput => {
    const textInput = colorInput.nextElementSibling;
    
    colorInput.addEventListener('input', function() {
        textInput.value = this.value;
    });
    
    textInput.addEventListener('input', function() {
        colorInput.value = this.value;
    });
});
</script>
@endsection
