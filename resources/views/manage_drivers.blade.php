@extends('layout')

@section('title', $title)

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <br/>
        @if (session('alert'))
            <div id="message" class="alert alert-success">
                {{ session('alert') }}
            </div>
        @endif
        @if(count($drivers))
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
        @endif
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
                                <button id="delete_button" type="button" class="btn btn-success">Editar</button>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='' onclick="deleteElement(
                                '¿Está seguro de querer eliminar al conductor {{$driver->nombre}} {{$driver->apaterno}} {{$driver->amaterno}}?',
                                    'delete_form_{{ $driver->id }}');">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </a>
                        </form>
                    </td>
                </tr>
            @empty
                <h1>No hay conductores</h1>
            @endforelse
        @if(count($drivers))
            </tbody>
        </table>
        @endif
    </div><br>
@stop