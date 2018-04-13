@extends('layout')

@section('title', $title)

@section('content')
    <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
    <br><br>
    <div class="limit">
        <h1 class="center-text">{{$title}}</h1>
        <br/>
        @if (session('alert'))
            <div id="message" class="alert alert-success">
                {{ session('alert') }}
            </div>
        @endif
         <table class="table-fill">
             <thead>
             <tr>
                 <th>Placas</th>
                 <th>Modelo</th>
                 <th>Capacidad</th>
                 <th>Acciones</th>
             </tr>
             </thead>
             <tbody class="table-hover">
            @forelse($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->placas}}</td>
                    <td>{{$vehicle->nombre}}</td>
                    <td>{{$vehicle->capacidad}} personas</td>
                    <td>
                        <form  class="form-inline" id="delete_form_{{$vehicle->id}}" action="{{route('vehiculo.destroy', $vehicle->id)}}" method="post">

                            <a href='{{ route('vehiculo.show', $vehicle->id) }}'>
                                <button type="button" class="btn btn-info">Detalles</button>
                            </a>
                            <a href='{{ route('vehiculo.edit', $vehicle->id) }}'>
                                <button type="button" class="btn btn-success">Editar</button>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                            <a href='' onclick="
                                    deleteElement( //Ir a /public/js/messages_methods.js para saber como funciona esta función
                                    '¿Está seguro de querer eliminar el vehiculo {{$vehicle->id}} con las placas {{$vehicle->placas}}?',
                                    'delete_form_{{ $vehicle->id }}');
                                    ">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </a>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No hay solicitudes</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div><br>
@stop