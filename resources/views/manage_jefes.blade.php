@extends('layout')

@section('content')

    @if(Session('respuesta') !== null)
        <div class="alert alert-success" role="alert">
            {{Session::get('respuesta')}}
        </div>

    @endif

    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">{{$titulo}}</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Tipo</th>
                <th>Acciones</th>

            </tr>
            </thead>
            <tbody class="table-hover">

            <!--
            Aquí se ve claramente cómo acceder a una relación de 1:1
            -->


            @forelse($users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{ucwords($user->nombre)}} {{ucwords($user->apaterno)}} {{ucwords($user->amaterno)}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        {{ucwords($user->cargo)}}
                    </td>
                    <td style="width: 280px">
                        <form class="form-inline" id="delete_form_{{ $user->id }}" action="{{ route('usuario.destroy' , $user->id)}}" method="POST">
                            <a href='{{ route('usuario.show', $user->id) }}'>
                                <button type="button" class="btn btn-info">Detalles</button>
                            </a>
                            <a href='{{route('usuario.edit', $user->id)}}'>
                                <button type="button" class="btn btn-success">Editar</button>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='' onclick="deleteElement(
                                    '¿Está seguro de querer eliminar el usuario {{$user->nombre}}?',
                                    'delete_form_{{ $user->id }}', event);
                                    ">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </a>
                        </form>
                    </td>
                </tr>

            @empty
                <h1>No hay usuarios</h1>
            @endforelse
            </tbody>
        </table>
    </div><br>
@stop