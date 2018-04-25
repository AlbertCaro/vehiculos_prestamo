@extends('layout')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <br>
        <h1 class="center-text">{{$title}}</h1>
        <br>
        @if (session('alert'))
            <div id="message" class="alert alert-success">
                <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                {{ session('alert') }}
            </div>
        @endif
        <table class="table-fill">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Tipo</th>
                <th >Acciones</th>
            </tr>
            </thead>
            <tbody class="table-hover">



            @forelse($users as $user)

            <tr>

                <td>{{$user->nombre}} {{$user->apaterno}} {{$user->amaterno}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @foreach($user->roles as $role)
                        {{$role->nombre_mostrado}}
                        @endforeach
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
                <tr>
                    <td colspan="6">No hay usuario</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div><br>
@stop