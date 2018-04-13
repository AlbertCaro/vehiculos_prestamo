@extends('layout')

@section('title', $title) {{-- Aquí se recibe el título determinado desde cada método en el controlador.  --}}

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <br/>
        {{--
        Si enviaste la alerta con with, cuando se realizó un cambio, se muestra el div con la alerta.
        Dicho div se oculta con AJAX, cosa que no necesitas hacer siempre y cuando el div tenga "message" como id.
        --}}
        @if (session('alert'))
            <div id="message" class="alert alert-success">
                <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                {{ session('alert') }}
            </div>
        @endif
        {{-- Uso count para determinar si drivers está vacío o no --}}
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
                                <button type="button" class="btn btn-success">Editar</button>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='' onclick="
                                    deleteElement( //Ir a /public/js/messages_methods.js para saber como funciona esta función
                                        '¿Está seguro de querer eliminar al conductor {{$driver->nombre}} {{$driver->apaterno}} {{$driver->amaterno}}?',
                                        'delete_form_{{ $driver->id }}');
                                    ">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </a>
                        </form>
                    </td>
                </tr>
            @empty
                <h3 class="center-text">No hay conductores</h3>
                <br/>
            @endforelse
        @if(count($drivers))
            </tbody>
        </table>
        @endif
    </div><br>
@stop