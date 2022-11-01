<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Código qr del usuario {{ $cliente->nombre }}</title>
    <style>
        canvas{
            position: absolute;
            padding: 10em;
        }

     
    </style>
</head>
<body>
    <svg id="barcode"  style="display: none"></svg>
    <img src=""  id="imgBarcode" alt="" >
    <canvas id="img"style="visibility: hidden" hidden></canvas>
    <script 
    src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>

        JsBarcode('#barcode', {!! json_encode($cliente) !!}, {
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