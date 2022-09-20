@extends('layouts.app')

@section('title')
    Agregar monedas

@endsection

@section('content')
  
    <div class="centro">

        <div style="width:500px;" id="reader"></div>

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.1/html5-qrcode.min.js" integrity="sha512-cuVnjPNH3GyigomLiyATgpCoCmR9T3kwjf94p0BnSfdtHClzr1kyaMHhUmadydjxzi1pwlXjM5sEWy4Cd4WScA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            const URLQR = {!! json_encode(route('monedas.add', ['usuario' => '__usuario', 'id' => '__id'])) !!}
        </script>
    </div>
    @vite('resources/js/qr.js')
@endsection