@extends('layouts.app')

@section('title')
    Caja - {{ $cliente->name }}

@endsection

@section('content')
    <script>
        let data = '';
    </script>

    <div class="frm-body">
       
        <form action="{{ route('monedas.store') }}" method="POST">
            @csrf
            @method('post')
     
            <div class="title"><i class="fa-solid fa-coins"></i></div>
            <input type="hidden" name="id" value="{{ $cliente->id }}">
            <label for="">Cantidad total | {{ $cliente->coins }} monedas</label>
            @error('message')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
            @error('coins')
                <div class="error">
                    Cantidad no válida
                </div>
            @enderror
            @error('scs')
                <div class="ok">{{ $message }}</div>

            @enderror
            @error('pdf')
                <script>
                    data = {!! json_encode($message) !!}
                    
                </script>
             
            @enderror
            <div class="frm">
                
                <label for="">Transaccion</label>
                <input type="text" value="0" name="coins">
            </div>

            <input type="submit" value="Guardar" class="btn btn-fill">
        </form>
    </div>
    <embed
        type="application/pdf"
        src=""
        id="pdfDocument"
        style="visibility: hidden"
        width="100%"
        height="100%" />
    <div id="pspdfkit" style="width: 100%; height: 100vh"></div>
    <script src="https://cdn.jsdelivr.net/npm/pspdfkit@2022.4.2/dist/pspdfkit.min.js"></script>
    <script>
        function printDocument(data) {
          
        const openPdf = (basePdf) => {
            let byteCharacters = atob(basePdf);
            let byteNumbers = new Array(byteCharacters.length);
            for (let i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            let byteArray = new Uint8Array(byteNumbers);
            let file = new Blob([byteArray], {type: 'application/pdf;base64'});
            let fileURL = URL.createObjectURL(file);
            document.querySelector('#pdfDocument').setAttribute('src', fileURL);
        }
        if(data){
            openPdf(data)
        }
    </script>
    
@endsection