<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Código qr del usuario {{ $nombre }}</title>
    <style>
        canvas{
            position: absolute;
            padding: 10em;
        }

        svg{
            display: none
        }
    </style>
</head>
<body>
    <svg id="barcode"></svg>
    <img src=""  id="imgBarcode" alt="" >
    <canvas id="img"style="visibility: hidden" hidden></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js" integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script 
    src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        const id = {!! $id !!}

        const idZero = `000000${id}`
        JsBarcode('#barcode', `0000${id}`, {
            displayValue: false
        })

        const imgtmn = 400

        const svg = document.querySelector('#barcode')

        // Creating a img
        const img = document.createElement('img')
        // Converting to jpeg
        const canvas = document.querySelector('#img')
        
        let ctx = canvas.getContext('2d')
        
        const svgString = new XMLSerializer().serializeToString(svg)
        
        const decoded = unescape(encodeURIComponent(svgString))
        
        const barcode = btoa(decoded)
        
        const imgSrc = `data:image/svg+xml;base64,${barcode}`;

        img.setAttribute('src', imgSrc)

        img.onload = () => {

            ctx.drawImage(img, 0,0, 300, 500 )
            
            // Creating barcod
            const imgBarcode = document.querySelector('#imgBarcode')

            const b64Barcode = canvas.toDataURL( "image/jpeg", 1.0 )
            imgBarcode.setAttribute('src', b64Barcode)
            canvas.style.displayValue = 'none'
        }
    </script>    
</body>
</html>