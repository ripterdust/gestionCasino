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
  
        color: white

      }

      *{
        margin: 0;
        left: 0;
        box-sizing: border-box;
        color: white;
        text-transform: uppercase
      }


    </style>
</head>
<body>
  
  <table style="position: relative; background: #010409; width: 12cm; height: 5cm; padding: .5em">
    <table>
      <tr>
        <td style="width: 2cm; ">
          <img src='{{ public_path('/img/logo.png')}}' alt="" style="width: 2cm;">
        </td>
        <td >
          <span style="text-transform: uppercase; ">Golden <br> Room</span>
          <span style="display: block; font-size: .5em">Una nueva experiencia</span>
        </td>
      </tr>
    </table>
    <table>
      <tr style="color: white">
        <td style="padding-top: 1.5cm; padding-left: .5cm; text-transfrom: uppercase; max-with: 5cm; font-size: 13px">{{ $usuario->name }} {{ $usuario->lname }}<br> {{ $usuario->id }}</td>
        <td style="padding-left: 2cm">
           <img src="data:image/svg+xml;base64, {!! $qr !!}" style="width: 3cm"/>
        </td>
      </tr>
      
    </table>
  </table>

  <br>

</body>
</html>