@extends('layouts.app')

@section('content')
<div class="card" style="display:grid; gap:16px;">
    <!-- Header con azioni -->
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
        <div>
            <h1 style="margin:0; font-size:20px; font-weight:600;">{{ $project->name }}</h1>
            <p style="margin:6px 0 0; color:var(--efficio-muted)">Dettagli progetto</p>
        </div>
        <div style="display:flex; gap:8px;">
            <a href="{{ route('projects.edit', $project) }}" class="icon-btn" style="display:inline-flex; align-items:center; gap:8px; text-decoration:none; padding:8px 16px; background:var(--efficio-accent); color:var(--efficio-bg); font-weight:500;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2"/></svg>
                Modifica
            </a>
            <form method="POST" action="{{ route('projects.destroy', $project) }}" style="display:inline;" onsubmit="return confirm('Sei sicuro di voler eliminare questo progetto?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="icon-btn" style="padding:8px 16px; background:rgba(239,68,68,0.1); color:#f87171; border:none; font-weight:500;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6" stroke="currentColor" stroke-width="2"/></svg>
                    Elimina
                </button>
            </form>
        </div>
    </div>

    <!-- Informazioni principali -->
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:16px;">
        <!-- Dettagli progetto -->
        <div class="card" style="display:grid; gap:12px;">
            <h3 style="margin:0; font-size:16px; font-weight:600;">Informazioni Progetto</h3>
            
            <div style="display:grid; gap:8px;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Stato:</span>
                    <span class="badge" style="background:{{ $project->getStatusColor() === 'blue' ? 'rgba(59,130,246,0.2)' : ($project->getStatusColor() === 'green' ? 'rgba(34,197,94,0.2)' : ($project->getStatusColor() === 'yellow' ? 'rgba(234,179,8,0.2)' : 'rgba(239,68,68,0.2)')); }} color:{{ $project->getStatusColor() === 'blue' ? '#60a5fa' : ($project->getStatusColor() === 'green' ? '#4ade80' : ($project->getStatusColor() === 'yellow' ? '#fbbf24' : '#f87171')); }};">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>
                
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Priorità:</span>
                    <span class="badge" style="background:{{ $project->getPriorityColor() === 'green' ? 'rgba(34,197,94,0.2)' : ($project->getPriorityColor() === 'blue' ? 'rgba(59,130,246,0.2)' : ($project->getPriorityColor() === 'orange' ? 'rgba(249,115,22,0.2)' : 'rgba(239,68,68,0.2)')); }} color:{{ $project->getPriorityColor() === 'green' ? '#4ade80' : ($project->getPriorityColor() === 'blue' ? '#60a5fa' : ($project->getPriorityColor() === 'orange' ? '#fb923c' : '#f87171')); }};">
                        {{ ucfirst($project->priority) }}
                    </span>
                </div>

                @if($project->start_date)
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Data inizio:</span>
                    <span>{{ $project->start_date->format('d/m/Y') }}</span>
                </div>
                @endif

                @if($project->due_date)
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Data scadenza:</span>
                    <span style="color: {{ $project->isOverdue() ? '#f87171' : 'inherit' }};">
                        {{ $project->due_date->format('d/m/Y') }}
                        @if($project->isOverdue())
                            <span class="badge" style="background:rgba(239,68,68,0.2); color:#f87171; margin-left:8px;">Scaduto</span>
                        @endif
                    </span>
                </div>
                @endif

                @if($project->budget)
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Budget:</span>
                    <span style="font-weight:600;">€{{ number_format($project->budget, 2, ',', '.') }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Progresso e metriche -->
        <div class="card" style="display:grid; gap:12px;">
            <h3 style="margin:0; font-size:16px; font-weight:600;">Progresso</h3>
            
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:700; color:var(--efficio-accent); margin-bottom:8px;">{{ $project->progress }}%</div>
                <div style="width:100%; height:8px; background:rgba(255,255,255,0.1); border-radius:4px; overflow:hidden;">
                    <div style="width:{{ $project->progress }}%; height:100%; background:var(--efficio-accent); border-radius:4px; transition:width 0.3s ease;"></div>
                </div>
            </div>

            <div style="display:grid; gap:8px; margin-top:16px;">
                @if($project->customer)
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Cliente:</span>
                    <a href="{{ route('customers.show', $project->customer) }}" style="color:var(--efficio-accent); text-decoration:none;">{{ $project->customer->name }}</a>
                </div>
                @endif

                @if($project->manager)
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Responsabile:</span>
                    <span>{{ $project->manager->name }}</span>
                </div>
                @endif

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Creato da:</span>
                    <span>{{ $project->creator->name }}</span>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Creato il:</span>
                    <span>{{ $project->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--efficio-muted);">Ultimo aggiornamento:</span>
                    <span>{{ $project->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Descrizione -->
    @if($project->description)
    <div class="card">
        <h3 style="margin:0 0 12px 0; font-size:16px; font-weight:600;">Descrizione</h3>
        <p style="margin:0; line-height:1.6; color:var(--efficio-text);">{{ $project->description }}</p>
    </div>
    @endif

    <!-- Azioni rapide -->
    <div class="card" style="display:grid; gap:12px;">
        <h3 style="margin:0; font-size:16px; font-weight:600;">Azioni Rapide</h3>
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <a href="{{ route('projects.edit', $project) }}" class="icon-btn" style="display:inline-flex; align-items:center; gap:8px; text-decoration:none; padding:8px 16px; background:rgba(34,197,94,0.1); color:#4ade80;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2"/></svg>
                Modifica Progetto
            </a>
            <a href="{{ route('projects.index') }}" class="icon-btn" style="display:inline-flex; align-items:center; gap:8px; text-decoration:none; padding:8px 16px; background:rgba(59,130,246,0.1); color:#60a5fa;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Torna alla Lista
            </a>
        </div>
    </div>
</div>
@endsection
