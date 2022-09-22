@extends('layouts.auth')

@section('title', 'Iniciar sesión')
    
@section('content')

    <div class="container">
        <div class="formulario">
        <div class="title">
            Inicia sesión
        </div>
        <div class="description">
            Te damos la bienvenida a nuestro casino
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @method('post')
            @error('message')
                <div class="error">
                    Correo y contraseña inválidos o inexistentes
                </div>
            @enderror
            @error('email')
                <div class="error">
                    Por favor ingrese su correo electrónico
                </div>
            @enderror
             @error('password')
                <div class="error">
                    Por favor ingrese su contraseña
                </div>
            @enderror
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" class="input" placeholder="Correo electrónico" autocomplete="off" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" class="input" placeholder="Contraseña" autocomplete="off" id=password>
            <button type="submit">Iniciar sesión</button>
            @if ($usuarios == 0)
                <a href="{{ route('register') }}">¿No tienes una cuenta?</a>
            @endif
            {{-- <a href="{{ route('register') }}">¿No tienes una cuenta?</a> --}}
        </form>
        </div>
    </div>
@endsection