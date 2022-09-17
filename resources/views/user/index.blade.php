@extends('layouts.app')

@section('title')
    Usuario
@endsection


@section('content')
    <div class="metrics">
        <div class="metric">
            <div class="text">
                <div class="title">Monedas totales</div>
                <div class="subtitle">{{ $usuario->coins }}</div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-coins"></i>
            </div>
        </div>
        <div></div>
        <div></div>
        <div class="metric">
            <div class="text">
                <div class="title">Registrado desde</div>
                <div class="subtitle">            
                    {{ explode(' ', $usuario->created_at)[0] }}
                </div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </div>
@endsection