@extends('layouts.app')

@section('content')
<div class="card" style="display:grid; gap:16px;">
    <div>
        <h1 style="margin:0; font-size:20px; font-weight:600;">Modifica Progetto</h1>
        <p style="margin:6px 0 0; color:var(--efficio-muted)">Modifica i dettagli del progetto "{{ $project->name }}"</p>
    </div>

    <form method="POST" action="{{ route('projects.update', $project) }}" class="card" style="display:grid; gap:16px;">
        @csrf
        @method('PUT')
        
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:16px;">
            <!-- Nome e Descrizione -->
            <div style="display:grid; gap:12px;">
                <div>
                    <label for="name" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Nome Progetto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" required 
                           style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                    @error('name')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Descrizione</label>
                    <textarea id="description" name="description" rows="4" 
                              style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px; resize:vertical;">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Stato e Priorità -->
            <div style="display:grid; gap:12px;">
                <div>
                    <label for="status" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Stato *</label>
                    <select id="status" name="status" required 
                            style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                        <option value="{{ App\Models\Project::STATUS_ACTIVE }}" {{ old('status', $project->status) === App\Models\Project::STATUS_ACTIVE ? 'selected' : '' }}>Attivo</option>
                        <option value="{{ App\Models\Project::STATUS_COMPLETED }}" {{ old('status', $project->status) === App\Models\Project::STATUS_COMPLETED ? 'selected' : '' }}>Completato</option>
                        <option value="{{ App\Models\Project::STATUS_SUSPENDED }}" {{ old('status', $project->status) === App\Models\Project::STATUS_SUSPENDED ? 'selected' : '' }}>Sospeso</option>
                        <option value="{{ App\Models\Project::STATUS_CANCELLED }}" {{ old('status', $project->status) === App\Models\Project::STATUS_CANCELLED ? 'selected' : '' }}>Cancellato</option>
                    </select>
                    @error('status')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Priorità *</label>
                    <select id="priority" name="priority" required 
                            style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                        <option value="{{ App\Models\Project::PRIORITY_LOW }}" {{ old('priority', $project->priority) === App\Models\Project::PRIORITY_LOW ? 'selected' : '' }}>Bassa</option>
                        <option value="{{ App\Models\Project::PRIORITY_MEDIUM }}" {{ old('priority', $project->priority) === App\Models\Project::PRIORITY_MEDIUM ? 'selected' : '' }}>Media</option>
                        <option value="{{ App\Models\Project::PRIORITY_HIGH }}" {{ old('priority', $project->priority) === App\Models\Project::PRIORITY_HIGH ? 'selected' : '' }}>Alta</option>
                        <option value="{{ App\Models\Project::PRIORITY_CRITICAL }}" {{ old('priority', $project->priority) === App\Models\Project::PRIORITY_CRITICAL ? 'selected' : '' }}>Critica</option>
                    </select>
                    @error('priority')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:16px;">
            <!-- Date -->
            <div style="display:grid; gap:12px;">
                <div>
                    <label for="start_date" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Data di Inizio</label>
                    <input type="date" id="start_date" name="start_date" 
                           value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" 
                           style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                    @error('start_date')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Data di Scadenza</label>
                    <input type="date" id="due_date" name="due_date" 
                           value="{{ old('due_date', $project->due_date?->format('Y-m-d')) }}" 
                           style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                    @error('due_date')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Budget e Progresso -->
            <div style="display:grid; gap:12px;">
                <div>
                    <label for="budget" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Budget (€)</label>
                    <input type="number" id="budget" name="budget" 
                           value="{{ old('budget', $project->budget) }}" step="0.01" min="0" 
                           placeholder="0.00" 
                           style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                    @error('budget')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="progress" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Progresso (%)</label>
                    <input type="number" id="progress" name="progress" 
                           value="{{ old('progress', $project->progress) }}" min="0" max="100" 
                           style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                    @error('progress')
                        <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:16px;">
            <!-- Cliente e Responsabile -->
            <div>
                <label for="customer_id" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Cliente</label>
                <select id="customer_id" name="customer_id" 
                        style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                    <option value="">Seleziona un cliente</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $project->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="manager_id" style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Responsabile Progetto</label>
                <select id="manager_id" name="manager_id" 
                        style="width:100%; padding:10px 12px; border-radius:8px; border:var(--border); background:var(--efficio-bg); color:var(--efficio-text); font-size:14px;">
                    <option value="">Seleziona un responsabile</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('manager_id', $project->manager_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('manager_id')
                    <p style="margin:4px 0 0; font-size:12px; color:#f87171;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Azioni -->
        <div style="display:flex; gap:12px; justify-content:flex-end; padding-top:16px; border-top:var(--border);">
            <a href="{{ route('projects.show', $project) }}" class="icon-btn" style="padding:10px 20px; text-decoration:none; color:var(--efficio-text);">
                Annulla
            </a>
            <button type="submit" class="icon-btn" style="padding:10px 20px; background:var(--efficio-accent); color:var(--efficio-bg); font-weight:500; border:none;">
                Aggiorna Progetto
            </button>
        </div>
    </form>
</div>

<style>
/* Stili per le opzioni delle select nel tema scuro */
select option {
    background-color: var(--efficio-surface) !important;
    color: var(--efficio-text) !important;
}

/* Stili per le select quando sono aperte */
select:focus option:checked {
    background-color: var(--efficio-accent) !important;
    color: #000 !important;
}

select:focus option:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: var(--efficio-text) !important;
}
</style>
@endsection
