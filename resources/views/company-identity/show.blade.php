@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px;">
        <div>
            <h1 style="margin: 0; font-size: 28px; font-weight: 700; color: var(--efficio-text);">{{ $companyIdentity->company_name }}</h1>
            <p style="margin: 8px 0 0 0; color: var(--efficio-muted); font-size: 16px;">
                @if($companyIdentity->branch_code)
                    Filiale: {{ $companyIdentity->branch_code }} - {{ $companyIdentity->branch_name }}
                @else
                    Sede Principale
                @endif
            </p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('company-identity.edit', $companyIdentity->id) }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Modifica
            </a>
            <a href="{{ route('company-identity.index') }}" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Torna alla Lista
            </a>
        </div>
    </div>

    <!-- Status Badge -->
    <div style="margin-bottom: 24px;">
        @if($companyIdentity->is_active)
            <span class="badge-success" style="font-size: 16px; padding: 8px 16px;">✓ Identità Attiva</span>
        @else
            <span class="badge-danger" style="font-size: 16px; padding: 8px 16px;">✗ Identità Inattiva</span>
        @endif
    </div>

    <!-- Grid Layout -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        
        <!-- Colonna Principale -->
        <div>
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
                    
                    <div style="display: grid; gap: 16px;">
                        @if($companyIdentity->commercial_name)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Nome Commerciale</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->commercial_name }}</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->slogan)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Slogan</div>
                            <div style="color: var(--efficio-text); font-style: italic;">"{{ $companyIdentity->slogan }}"</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->website)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Sito Web</div>
                            <a href="{{ $companyIdentity->website }}" target="_blank" style="color: var(--efficio-accent); text-decoration: none;">{{ $companyIdentity->website }}</a>
                        </div>
                        @endif
                        
                        @if($companyIdentity->email)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Email</div>
                            <a href="mailto:{{ $companyIdentity->email }}" style="color: var(--efficio-accent); text-decoration: none;">{{ $companyIdentity->email }}</a>
                        </div>
                        @endif
                        
                        @if($companyIdentity->phone)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Telefono</div>
                            <div style="color: var(--efficio-text);">{{ $companyIdentity->phone }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contenuti Aziendali -->
            @if($companyIdentity->mission || $companyIdentity->vision || $companyIdentity->values)
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
                        @if($companyIdentity->mission)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px; font-weight: 500;">Mission</div>
                            <div style="color: var(--efficio-text); line-height: 1.6;">{{ $companyIdentity->mission }}</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->vision)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px; font-weight: 500;">Vision</div>
                            <div style="color: var(--efficio-text); line-height: 1.6;">{{ $companyIdentity->vision }}</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->values && is_array($companyIdentity->values))
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px; font-weight: 500;">Valori</div>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                @foreach($companyIdentity->values as $value)
                                    <span class="badge-blue">{{ trim($value) }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Informazioni Legali -->
            @if($companyIdentity->partita_iva || $companyIdentity->codice_fiscale || $companyIdentity->rea || $companyIdentity->legal_address)
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
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                        @if($companyIdentity->partita_iva)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Partita IVA</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->partita_iva }}</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->codice_fiscale)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Codice Fiscale</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->codice_fiscale }}</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->rea)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">REA</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->rea }}</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->pec)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">PEC</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->pec }}</div>
                        </div>
                        @endif
                        
                        @if($companyIdentity->sdi)
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Sistema di Interscambio</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->sdi }}</div>
                        </div>
                        @endif
                    </div>
                    
                    @if($companyIdentity->legal_address)
                    <div style="margin-top: 20px;">
                        <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px; font-weight: 500;">Indirizzo Legale</div>
                        <div style="color: var(--efficio-text); line-height: 1.6;">{{ $companyIdentity->legal_address }}</div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Colonna Laterale -->
        <div>
            <!-- Logo Preview -->
            <div class="card" style="margin-bottom: 24px;">
                <div style="padding: 24px; border-bottom: var(--border);">
                    <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Logo</h3>
                    
                    @if($companyIdentity->logo_large)
                        <div style="text-align: center; margin-bottom: 20px;">
                            <div style="width: 100%; max-width: 200px; height: 100px; border-radius: 12px; overflow: hidden; border: var(--border); margin: 0 auto;">
                                <img src="{{ Storage::url($companyIdentity->logo_large) }}" alt="Logo Grande" style="width: 100%; height: 100%; object-fit: contain;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                <div style="display: none; color: var(--efficio-error); font-size: 12px; padding: 20px;">❌ Errore caricamento logo</div>
                            </div>
                            <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 8px;">Logo Grande</div>
                            @if(config('app.debug'))
                            <div style="color: var(--efficio-muted); font-size: 10px; margin-top: 4px; font-family: monospace;">Path: {{ $companyIdentity->logo_large }}</div>
                            <div style="color: var(--efficio-muted); font-size: 10px; font-family: monospace;">URL: {{ Storage::url($companyIdentity->logo_large) }}</div>
                            @endif
                        </div>
                    @endif
                    
                    @if($companyIdentity->logo_horizontal)
                        <div style="text-align: center; margin-bottom: 20px;">
                            <div style="width: 100%; max-width: 150px; height: 60px; border-radius: 8px; overflow: hidden; border: var(--border); margin: 0 auto;">
                                <img src="{{ Storage::url($companyIdentity->logo_horizontal) }}" alt="Logo Orizzontale" style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                            <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 8px;">Logo Orizzontale</div>
                        </div>
                    @endif
                    
                    @if($companyIdentity->logo_vertical)
                        <div style="text-align: center; margin-bottom: 20px;">
                            <div style="width: 100%; max-width: 80px; height: 120px; border-radius: 8px; overflow: hidden; border: var(--border); margin: 0 auto;">
                                <img src="{{ Storage::url($companyIdentity->logo_vertical) }}" alt="Logo Verticale" style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                            <div style="color: var(--efficio-muted); font-size: 12px; margin-top: 8px;">Logo Verticale</div>
                        </div>
                    @endif
                    
                    @if(!$companyIdentity->logo_large && !$companyIdentity->logo_horizontal && !$companyIdentity->logo_vertical)
                        <div style="text-align: center; padding: 40px 20px; color: var(--efficio-muted);">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-bottom: 16px; opacity: 0.5;">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <path d="M21 15l-5-5L5 21"/>
                            </svg>
                            <div>Nessun logo caricato</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Colori Brand -->
            <div class="card" style="margin-bottom: 24px;">
                <div style="padding: 24px;">
                    <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Colori Brand</h3>
                    
                    <div style="display: grid; gap: 16px;">
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px;">Primario</div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $companyIdentity->primary_color }}; border: 2px solid rgba(255,255,255,0.2);"></div>
                                <div style="color: var(--efficio-text); font-family: monospace;">{{ $companyIdentity->primary_color }}</div>
                            </div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px;">Secondario</div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $companyIdentity->secondary_color }}; border: 2px solid rgba(255,255,255,0.2);"></div>
                                <div style="color: var(--efficio-text); font-family: monospace;">{{ $companyIdentity->secondary_color }}</div>
                            </div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px;">Neutro</div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $companyIdentity->neutral_color }}; border: 2px solid rgba(255,255,255,0.2);"></div>
                                <div style="color: var(--efficio-text); font-family: monospace;">{{ $companyIdentity->neutral_color }}</div>
                            </div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px;">Successo</div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $companyIdentity->success_color }}; border: 2px solid rgba(255,255,255,0.2);"></div>
                                <div style="color: var(--efficio-text); font-family: monospace;">{{ $companyIdentity->success_color }}</div>
                            </div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 8px;">Errore</div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $companyIdentity->error_color }}; border: 2px solid rgba(255,255,255,0.2);"></div>
                                <div style="color: var(--efficio-text); font-family: monospace;">{{ $companyIdentity->error_color }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Font e Stile -->
            <div class="card" style="margin-bottom: 24px;">
                <div style="padding: 24px;">
                    <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Font e Stile</h3>
                    
                    <div style="display: grid; gap: 16px;">
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Font Principale</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->primary_font }}</div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Font Secondario</div>
                            <div style="color: var(--efficio-text); font-weight: 500;">{{ $companyIdentity->secondary_font }}</div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Tipo di Stile</div>
                            <div style="color: var(--efficio-text); font-weight: 500; text-transform: capitalize;">{{ $companyIdentity->style_type }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metadati -->
            <div class="card">
                <div style="padding: 24px;">
                    <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: var(--efficio-text);">Metadati</h3>
                    
                    <div style="display: grid; gap: 12px;">
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">ID</div>
                            <div style="color: var(--efficio-text); font-family: monospace;">{{ $companyIdentity->id }}</div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Creato il</div>
                            <div style="color: var(--efficio-text);">{{ $companyIdentity->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        
                        <div>
                            <div style="color: var(--efficio-muted); font-size: 14px; margin-bottom: 4px;">Ultimo aggiornamento</div>
                            <div style="color: var(--efficio-text);">{{ $companyIdentity->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
