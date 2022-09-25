@extends('layouts.app')

@section('title')
    Transacciones
@endsection

@section('content')
<div class="bg-table">
    <table class="table">
        <tr>
            <th>id</th>
            <th>Nombre cliente</th>
            <th>Cantidad</th>
            <th>Fecha</th>
        </tr>

        @foreach($transacciones as $trs)
            <tr>
                <td>{{ $trs->id }}</td>
                <td>{{ $trs->name }}</td>

                 @if ($trs->cantidad > 0)
                    <td class="verde">
                            
                @else
                    <td class="rojo">
                            
                @endif
                   <span> {{ $trs->cantidad }}</span>
                </td>
                
                <td> {{ 
                    date_format(
                        new DateTime($trs->created_at), 
                        'H:i d/m/y'
                    )
                    }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
    

@endsection