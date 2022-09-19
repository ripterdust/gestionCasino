@extends('layouts.app')

@section('title')
    Usuario
@endsection


@section('content')
    <div class="modal hidden" id="fotoModal">
        <video class="camara" id="camara" src="" autoplay=true></video>
        <div class="btn btn-fill" id="capturar">Tomar foto</div>
        <canvas id="canvasFoto"></canvas>
    </div>
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
            <div class="text flex">
                <div class="nombre">
                    <label for="">Nombre</label>
                    {{ $usuario->name }}
    
                </div>
                <div class="mail">
                    <label for="">Correo</label>
                    {{ $usuario->email }}
                </div>
                <a href="{{ route('carnet') }}" class="btn btn-fill">Descargar carnet</a>
            </div>
            <div class="photo" id="">
                @if ($usuario->img)
                    <img src="{{ $usuario->img }}" alt="" class="imagen">
                       <div class="overlay" id="tomarFoto">
                            <div class="btn btn-fill" id="nuevaFOto">Tomar nueva foto</div>
                        </div>
                @else
                    <div class="tomarFoto" id="tomarFoto">

                        <div class="btn" id="">Tomar foto</div>
                     
                    </div>                    
                @endif
            </div>
        </div>
        <div class="card">Tarjeta dos</div>
    </div>

    <script>
        const URLGuardar = {!! json_encode(route('img')) !!} || ''
        const id = {!! json_encode($id) !!}
    </script>
    
    @vite('resources/js/user/tomarFoto.js')

@endsection