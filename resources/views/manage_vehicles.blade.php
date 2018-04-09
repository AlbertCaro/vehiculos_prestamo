@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Vehículos</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Placas</th>
                <th>Modelo</th>
                <th>Capacidad</th>
                <th>Detalles</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->placas}}</td>
                    <td>{{$vehicle->nombre}}</td>
                    <td>{{$vehicle->capacidad}} personas</td>
                    <td>
                        <a href='?in=Y2Fy&ap=Mg==&ind=MDAwMjUy&apd=Mg=='>
                            <img border='0' alt='Detalles' src='{{asset('img/detalle.png')}}' width='50' height='50'>
                        </a>
                    </td>
                        <td>
                            <form id="delete_form_{{$vehicle->id}}" action="{{route('vehiculo.destroy', $vehicle->id)}}" method="post">
                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}
                                <a href='#' onclick="event.preventDefault(); document.getElementById('delete_form_{{$vehicle->id}}').submit();">
                                    <img border='0' alt='Eliminar' src='{{asset('img/delete.png')}}' width='50' height='50'>
                                </a>
                            </form>
                        </td>
                    <td>
                        <a href='{{route('vehiculo.edit', $vehicle->id)}}'><img border='0' alt='Modificar' src='{{asset('img/edit.png')}}' width='50' height='50'></a>
                    </td>
                </tr>
                @empty
                <h1>No hay vehiculos</h1>
                @endforelse
            </tbody>
        </table>
    </div><br>
@stop