<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
</style>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    div{
        width: 100%;
        text-align: center;
    }
</style>
<body >
    <div class="recibo" style="width: 10cm; border: 1px solid black; padding: .5cm 0;">
        <div style="width: 100%; text-align: center; font-size: 20px">
            Golden Room
        </div>
        <div style="">
            Retiro de monedas
        </div>
        <div>
            Cajero - {{ $tsc->cajero_nm }}
        </div>
        <div style="padding-top: .3cm">
            <div style="background: rgba(0,0,0,.5);height: 1px; width: 90%; margin: auto;"></div>
        </div>
        <div style="padding-top: .5cm">
            Nombre: {{ $tsc->name . ' ' . $tsc->lname}} 
        </div>
        <div style="padding-top: .1cm">
            Fecha: {{ 
                    date_format(
                        new DateTime($tsc->fecha), 
                        'H:i d/m/y'
                    )
                    }}
        </div>
        <div style="display: inline-block; width: 100%; padding-top: .5cm">
            <div style=" display: inline-block;text-align: center;">
                @if($tsc->cantidad < 0)
                    Monedas debitadas........................{{ $tsc->cantidad * -1 }}
                @else
                    Monedas acreditadas......................{{ $tsc->cantidad }}
                @endif
                
            </div>
       
        </div>

        <div style="padding-top: .5cm">
            Golden Room &copy;
        </div>
        <div style="padding-top: .1cm">
            Todos los derechos reservados
        </div>
    </div>
</body>
</html>