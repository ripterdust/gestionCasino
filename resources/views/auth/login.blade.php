@extends('layouts.auth')

@section('title', 'Iniciar sesión')
    
@section('content')
Login
    <form action="/show" method="POST">
        <input type="email" name="mail">
        <input type="password" name="password">
    </form>
@endsection