@extends('layouts.home')
@section('title', 'Bienvenido')


@section('content')

<style>

    body{
        max-height: 100vh;
        overflow: hidden;
    }
    .inputQr {
        width: 25%;
        padding: 1em;
        border: 1px solid white;
        margin-bottom: 1em;
        background: transparent;
    }

    #reader{
        width: 100%;
        max-height: 500px;
    }

    video {
        width: 100%;
    }
    .drawingBuffer{
        visibility: hidden;
    }
</style>

    <input type="text" placeholder="Número del qr" class="inputQr" id="inputBarcode" autofocus>

    <div class="centro">
        <div style="width:500px;" id="reader"></div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js" integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </div>
    <script src="{{ asset('js/barcode.js') }}"></script>
@endsection