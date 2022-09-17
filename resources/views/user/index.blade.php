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
                    {{ $fecha }}
                </div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </div>

    <div class="container g-2 mt-2">
        <div class="card g-2">
            <div class="text">
                <div class="nombre">
                    {{ $usuario->name }}
    
                </div>
                <div>
                    {{ $usuario->email }}
                </div>
            </div>
            <div class="photo">
                @if ($usuario->photo)
                    <img src="{{ $usuario->photo }}" alt="">
                @else
                    <div class="tomarFoto">

                        <div class="btn">Tomar foto</div>
                    </div>                    
                @endif
            </div>
        </div>
        <div class="card">Tarjeta dos</div>
    </div>
@endsection