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
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($drivers as $driver)
                <tr>
                    <td>{{$driver->id}}</td>
                    <td>{{$driver->nombre }} {{$driver->apaterno}} {{$driver->amaterno}}</td>
                    <td>{{$driver->celular}}</td>
                    <td>
                        <form id="delete_form_{{ $driver->id }}" action="{{ route('conductor.destroy' , $driver->id)}}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='' onclick="event.preventDefault();
                                    document.getElementById('delete_form_{{ $driver->id }}').submit();">
                                <img border='0' alt='Editar' src='img/delete.png' width='50' height='50'>
                            </a>
                        </form>
                    </td>
                    <td>
                        <a href='{{ route('conductor.edit', $driver->id) }}'><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a>
                    </td>
                </tr>
            @empty
                <h1>No hay conductores</h1>
            @endforelse
            </tbody>
        </table>
    </div><br>
@stop