@extends('layouts.auth')

@section('title', 'Registrarse')
    
@section('content')
    <div class="container">
        <div class="formulario">
        <div class="title">
            Regístrate
        </div>
        <div class="description">
            Bienvenido, inserta tus datos para continuar
        </div>
        <form action="{{ route('register') }}" method="POST">
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
            <label for="name">Nombre</label>
            <input type="text" name="name" class="input" placeholder="Nombre completo" autocomplete="off" id="name">

            <label for="email">Correo electrónico</label>
            <input type="email" name="email" class="input" placeholder="Correo electrónico" autocomplete="off" id="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password" class="input" placeholder="Contraseña" autocomplete="off" id=password>

            <label for="password_con">Confirma tu contraseña</label>
            <input type="password" name="password_confirm" class="input" placeholder="Confirmar contraseña" autocomplete="off" id=password_con>

            <button type="submit">Unirme</button>
            <a href="{{ route('login') }}">¿Ya tienes una cuenta?</a>
        </form>
        </div>
    </div>
@endsection