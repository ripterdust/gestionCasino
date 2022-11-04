@extends('layouts.app')

@section('title')
    Agregar monedas

@endsection

@section('content')
    <style>
        .inputQr{
            width: 450px;
            background: transparent;
            padding: 1em;
            border: 1px solid white;
            background: transparent;
            max-width: 90%;
        }
        .codabar{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }


        #reader{
            margin-top: 1em;
            width: 100%;
            display: flex;
        }

        .drawingBuffer{
            display: none;
        }

        video{
            width: 450px;
            margin: auto;
            max-width: 90%;
        }
    </style>

<div class="codabar">
    <input type="text" placeholder="Número código de barras" class="inputQr" id="inputBarcode" autofocus>
    
</div>

<div id="reader"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js" integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const URLQR = {!! json_encode(route('monedas.add', ['id' => '__id'])) !!}
    </script>
    <script>
        const changePage = (value) => {
            const newUrl = URLQR.replace('__id', value)
            window.location = newUrl
        };
        console.log(URLQR)
        const barcodeInput = document.querySelector("#inputBarcode");

        barcodeInput.addEventListener("keyup", (e) => {
            if (e.key === "Enter" || e.keyCode === 13) changePage(e.target.value);
        });

        const detectBarcode = (data) => {
            changePage(data.codeResult.code);
        };
        Quagga.init(
            {
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector("#reader"), // Or '#yourElement' (optional)
                },
                decoder: {
                    readers: ["code_128_reader", "upc_reader", "upc_e_reader"],
                },
            },
            (err) => {
                if (err) {
                    return console.log(err);
                }

                Quagga.start();
                Quagga.onDetected(detectBarcode);
            },
            Quagga.onDetected(detectBarcode)
        );

    </script>

@endsection

