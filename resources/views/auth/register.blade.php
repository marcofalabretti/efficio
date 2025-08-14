@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('register.perform') }}">
        @csrf
        
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Conferma Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <button type="submit" class="btn">Crea Account</button>
        
        <div class="links">
            <p>Hai già un account? <a href="{{ route('login.show') }}">Accedi</a></p>
        </div>
    </form>
@endsection


