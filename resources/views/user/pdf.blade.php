<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      table{
        width: 5cm;
        height: 10cm;

      }

      *{
        margin: 0;
        left: 0;
        box-sizing: border-box;
      }


    </style>
</head>
<body>
    <table class="carne" style="position: relative; background: #e8e7ed;">
        <div class="top" style="position: absolute; top: 0; left: 0;width: 100%; height: 1.5cm;background: #dd1162;"></div>
        <div class="body" style="z-index: 10; padding-top: 1em;">
            <div class="img m-auto" style="width: 2cm; height: 2cm; overflow: hidden; " center>
                <img src="{{ $usuario->img }}" alt="" style="height: 100%;">
            </div>

            <div class="title" style="width: 100%; text-align:center; font-size: 20px; font-weight: bold;">
                {{ $usuario->name }}
       </div>
            <div class="subtitle" style="width: 100%; text-align:center;">Cliente</div>
        </div>
        <div class="bottom" style="background: #dd1162; position: absolute; bottom: 0; left: 0; width: 100%; height: 1.5cm"></div>
    </table>
</body>
</html>