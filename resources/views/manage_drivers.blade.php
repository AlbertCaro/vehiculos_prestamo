@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Conductores</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($drivers as $driver)
                <tr>
                    <td>{{$driver->id}}</td>
                    <td>{{$driver->nombre }} {{$driver->apaterno}} {{$driver->amaterno}}</td>
                    <td>{{$driver->celular}}</td>
                    <td>
                        <form class="form-inline" id="delete_form_{{ $driver->id }}" action="{{ route('conductor.destroy' , $driver->id)}}" method="POST">
                            <a href='{{ route('conductor.show', $driver->id) }}'>
                                <button type="button" class="btn btn-info">Detalles</button>
                            </a>
                            <a href='{{ route('conductor.edit', $driver->id) }}'>
                                <button type="button" class="btn btn-success">Editar</button>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='' onclick="event.preventDefault();
                                    document.getElementById('delete_form_{{ $driver->id }}').submit();">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </a>
                        </form>
                    </td>
                </tr>
            @empty
                <h1>No hay conductores</h1>
            @endforelse
            </tbody>
        </table>
    </div><br>
@stop