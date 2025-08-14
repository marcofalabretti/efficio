@extends('layouts.app')

@section('content')
<style>
/* Stili per le opzioni delle select nel tema scuro */
select option {
    background-color: #ffffff !important;
    color: #374151 !important;
}
/* Stili per le select quando sono aperte */
select:focus option:checked {
    background-color: #3b82f6 !important;
    color: #ffffff !important;
}
select:focus option:hover {
    background-color: #f3f4f6 !important;
    color: #374151 !important;
}
</style>
<div class="card" style="display:grid; gap:16px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
        <div>
            <h1 style="margin:0; font-size:20px; font-weight:600;">Progetti</h1>
            <p style="margin:6px 0 0; color:var(--efficio-muted)">Gestione progetti aziendali</p>
        </div>
        <a href="{{ route('projects.create') }}" class="icon-btn" style="display:inline-flex; align-items:center; gap:8px; text-decoration:none; padding:8px 16px; border-radius:8px; background:var(--efficio-accent); color:var(--efficio-bg); font-weight:500;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            Nuovo Progetto
        </a>
    </div>

    <!-- Filtri -->
    <div class="card" style="display:grid; gap:12px;">
        <form method="GET" action="{{ route('projects.index') }}" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:12px; align-items:end;">
            <div>
                <label style="display:block; font-size:12px; color:var(--efficio-muted); margin-bottom:4px;">Cerca</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nome progetto..." style="width:100%; padding:8px 12px; border-radius:6px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text);">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--efficio-muted); margin-bottom:4px;">Stato</label>
                <select name="status" style="width:100%; padding:8px 12px; border-radius:6px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text);">
                    <option value="">Tutti gli stati</option>
                    <option value="{{ App\Models\Project::STATUS_ACTIVE }}" {{ request('status') === App\Models\Project::STATUS_ACTIVE ? 'selected' : '' }}>Attivo</option>
                    <option value="{{ App\Models\Project::STATUS_COMPLETED }}" {{ request('status') === App\Models\Project::STATUS_COMPLETED ? 'selected' : '' }}>Completato</option>
                    <option value="{{ App\Models\Project::STATUS_SUSPENDED }}" {{ request('status') === App\Models\Project::STATUS_SUSPENDED ? 'selected' : '' }}>Sospeso</option>
                    <option value="{{ App\Models\Project::STATUS_CANCELLED }}" {{ request('status') === App\Models\Project::STATUS_CANCELLED ? 'selected' : '' }}>Cancellato</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--efficio-muted); margin-bottom:4px;">Priorità</label>
                <select name="priority" style="width:100%; padding:8px 12px; border-radius:6px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text);">
                    <option value="">Tutte le priorità</option>
                    <option value="{{ App\Models\Project::PRIORITY_LOW }}" {{ request('priority') === App\Models\Project::PRIORITY_LOW ? 'selected' : '' }}>Bassa</option>
                    <option value="{{ App\Models\Project::PRIORITY_MEDIUM }}" {{ request('priority') === App\Models\Project::PRIORITY_MEDIUM ? 'selected' : '' }}>Media</option>
                    <option value="{{ App\Models\Project::PRIORITY_HIGH }}" {{ request('priority') === App\Models\Project::PRIORITY_HIGH ? 'selected' : '' }}>Alta</option>
                    <option value="{{ App\Models\Project::PRIORITY_CRITICAL }}" {{ request('priority') === App\Models\Project::PRIORITY_CRITICAL ? 'selected' : '' }}>Critica</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--efficio-muted); margin-bottom:4px;">Cliente</label>
                <select name="customer_id" style="width:100%; padding:8px 12px; border-radius:6px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text);">
                    <option value="">Tutti i clienti</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="icon-btn" style="padding:8px 16px; background:var(--efficio-accent); color:var(--efficio-bg); font-weight:500;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                Filtra
            </button>
        </form>
    </div>

    <!-- Lista progetti -->
    <div class="card" style="display:grid; gap:12px;">
        @if($projects->count() > 0)
            <div style="display:grid; gap:8px;">
                @foreach($projects as $project)
                    <div class="card" style="display:grid; grid-template-columns: 1fr auto; gap:12px; align-items:center; padding:16px;">
                        <div style="display:grid; gap:8px;">
                            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                <h3 style="margin:0; font-size:16px; font-weight:600;">
                                    <a href="{{ route('projects.show', $project) }}" style="color:inherit; text-decoration:none;">{{ $project->name }}</a>
                                </h3>
                                <span class="badge" style="background:{{ $project->getStatusColor() === 'blue' ? 'rgba(59,130,246,0.2)' : ($project->getStatusColor() === 'green' ? 'rgba(34,197,94,0.2)' : ($project->getStatusColor() === 'yellow' ? 'rgba(234,179,8,0.2)' : 'rgba(239,68,68,0.2)')); }} color:{{ $project->getStatusColor() === 'blue' ? '#60a5fa' : ($project->getStatusColor() === 'green' ? '#4ade80' : ($project->getStatusColor() === 'yellow' ? '#fbbf24' : '#f87171')); }};">
                                    {{ ucfirst($project->status) }}
                                </span>
                                <span class="badge" style="background:{{ $project->getPriorityColor() === 'green' ? 'rgba(34,197,94,0.2)' : ($project->getPriorityColor() === 'blue' ? 'rgba(59,130,246,0.2)' : ($project->getPriorityColor() === 'orange' ? 'rgba(249,115,22,0.2)' : 'rgba(239,68,68,0.2)')); }} color:{{ $project->getPriorityColor() === 'green' ? '#4ade80' : ($project->getPriorityColor() === 'blue' ? '#60a5fa' : ($project->getPriorityColor() === 'orange' ? '#fb923c' : '#f87171')); }};">
                                    {{ ucfirst($project->priority) }}
                                </span>
                                @if($project->isOverdue())
                                    <span class="badge" style="background:rgba(239,68,68,0.2); color:#f87171;">Scaduto</span>
                                @endif
                            </div>
                            <div style="display:flex; align-items:center; gap:16px; flex-wrap:wrap; font-size:14px; color:var(--efficio-muted);">
                                @if($project->customer)
                                    <span>Cliente: {{ $project->customer->name }}</span>
                                @endif
                                @if($project->manager)
                                    <span>Responsabile: {{ $project->manager->name }}</span>
                                @endif
                                @if($project->due_date)
                                    <span>Scadenza: {{ $project->due_date->format('d/m/Y') }}</span>
                                @endif
                                @if($project->budget)
                                    <span>Budget: €{{ number_format($project->budget, 2, ',', '.') }}</span>
                                @endif
                            </div>
                            @if($project->description)
                                <p style="margin:0; font-size:14px; color:var(--efficio-text); opacity:0.8;">{{ Str::limit($project->description, 100) }}</p>
                            @endif
                        </div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div style="text-align:center;">
                                <div style="font-size:14px; color:var(--efficio-muted); margin-bottom:4px;">Progresso</div>
                                <div style="font-size:18px; font-weight:600; color:var(--efficio-accent);">{{ $project->progress }}%</div>
                            </div>
                            <div style="display:flex; gap:4px;">
                                <a href="{{ route('projects.show', $project) }}" class="icon-btn" title="Visualizza" style="background:rgba(59,130,246,0.1); color:#60a5fa;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>
                                </a>
                                <a href="{{ route('projects.edit', $project) }}" class="icon-btn" title="Modifica" style="background:rgba(34,197,94,0.1); color:#4ade80;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginazione -->
            <div style="display:flex; justify-content:center; margin-top:16px;">
                {{ $projects->links() }}
            </div>
        @else
            <div style="text-align:center; padding:32px; color:var(--efficio-muted);">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin:0 auto 16px; opacity:0.5;"><path d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <p style="margin:0; font-size:16px;">Nessun progetto trovato</p>
                <p style="margin:8px 0 0; font-size:14px;">Crea il tuo primo progetto per iniziare</p>
                <a href="{{ route('projects.create') }}" class="icon-btn" style="display:inline-flex; align-items:center; gap:8px; margin-top:16px; padding:8px 16px; background:var(--efficio-accent); color:var(--efficio-bg); font-weight:500; text-decoration:none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Crea Progetto
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
