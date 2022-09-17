@extends('layouts.auth')

@section('title', 'Iniciar sesión')
    
@section('content')
Login
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="email" name="email">
        <input type="password" name="password">
        <button type="submit">Iniciar sesión</button>
    </form>
@endsection