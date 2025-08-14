@extends('layouts.guest')

@section('content')
    <div class="welcome-content">
        <h1 class="welcome-title">EFFICIO</h1>
        <p class="welcome-subtitle">successi integrati</p>
        
        <div class="welcome-features">
            <div class="welcome-feature">
                <h3>Gestione Clienti</h3>
                <p>Organizza e gestisci i tuoi clienti in modo efficiente</p>
            </div>
            <div class="welcome-feature">
                <h3>Preventivi e Fatture</h3>
                <p>Crea e gestisci preventivi e fatture professionali</p>
            </div>
            <div class="welcome-feature">
                <h3>Dashboard Completa</h3>
                <p>Monitora le tue attività e performance in tempo reale</p>
            </div>
        </div>
        
        <div class="welcome-cta">
            @auth
                <a href="{{ route('dashboard') }}">Vai alla Dashboard</a>
            @else
                <a href="{{ route('register.show') }}">Inizia con EFFICIO</a>
            @endauth
        </div>
    </div>
@endsection
