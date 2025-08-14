@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('login.perform') }}">
        @csrf
        
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn">Accedi</button>
        
        <div class="links">
            <p>Non hai un account? <a href="{{ route('register.show') }}">Registrati</a></p>
        </div>
    </form>
@endsection


