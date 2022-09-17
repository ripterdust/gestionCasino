@extends('layouts.auth')

@section('title', 'Registrarse')
    
@section('content')
    Registro
    <form action="/auth/register" method="POST">
        @csrf
        <input type="text" name="name" id="">
        <input type="email" name="mail">
        <input type="password" name="password">
        <button type="submit">Iniciar sesión</button>
    </form>
@endsection