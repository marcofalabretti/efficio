@extends('layouts.app')

@section('content')
<div class="card" style="display:grid; gap:12px;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <div style="font-size:12px; color:var(--efficio-muted); text-transform:uppercase; letter-spacing:.08em;">Admin</div>
            <h2 style="margin:4px 0 0;">Gestione utenti</h2>
        </div>
    </div>

    <div style="display:grid; grid-template-columns: repeat(12, 1fr); gap:12px;">
        @foreach($users as $u)
            <div class="card" style="grid-column: span 12; display:grid; grid-template-columns: repeat(12, 1fr); align-items:center; gap:12px;">
                <div style="grid-column: span 4; font-weight:600;">{{ $u->name }}</div>
                <div style="grid-column: span 4; color:var(--efficio-muted);">{{ $u->email }}</div>
                <div style="grid-column: span 4;">
                    <form method="post" action="{{ route('admin.users.update', $u) }}" style="display:flex; gap:8px; align-items:center;">
                        @csrf
                        @method('PUT')
                        <select name="role" class="card" style="padding:8px;">
                            @foreach($roles as $r)
                                <option value="{{ $r }}" {{ $u->role === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                            @endforeach
                        </select>
                        <button class="item" style="padding:8px 12px; border:1px solid rgba(255,255,255,.1); border-radius:8px;">Salva</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    {{ $users->links() }}
</div>
@endsection


