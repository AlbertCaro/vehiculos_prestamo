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
        <h3 class="center-text">Usuarios</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Tipo</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">

            <!--
            Aquí se ve claramente cómo acceder a una relación de 1:1
            -->


            @forelse($users as $user)

            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->nombre}} {{$user->apaterno}} {{$user->amaterno}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @foreach($user->roles as $role)
                        {{$role->nombre_mostrado}}
                        @endforeach
                </td>
                <td>
                <form id="delete_form_{{ $user->id }}" action="{{ route('usuario.destroy' , $user->id)}}" method="POST">

                    {{method_field('DELETE')}}
                    {{ csrf_field() }}
                    <a href='' onclick="event.preventDefault();
                            document.getElementById('delete_form_{{ $user->id }}').submit();">
                        <img border='0' alt='Editar' src='img/delete.png' width='50' height='50'>
                    </a>
                </form></td>
                <td>
                    <a href='{{route('usuario.edit',$user->id)}}'><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td>
            </tr>

            @empty
                <h1>No hay usuarios</h1>
            @endforelse
            </tbody>
        </table>
    </div><br>
@stop