@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br></br>
    <div class="limit">
        <h3 class="center-text">Roles</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Rol (no modificar)</th>
                <th>Nombre mostrado</th>
                <th>Descripción</th>
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($roles as $rol)
                <tr>
                    <td>{{$rol->nombre}}</td>
                    <td>{{$rol->nombre_mostrado}}</td>
                    <td>{{$rol->descripcion}}</td>
                    <td>
                        <form id="delete_form_{{ $rol->id }}" action="{{ route('role.destroy' , $rol->id)}}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='' onclick="event.preventDefault();
                                    document.getElementById('delete_form_{{ $rol->id }}').submit();">
                                <img border='0' alt='Editar' src='img/delete.png' width='30' height='30'>
                            </a>
                        </form>
                    </td>
                    <td>
                        <a href='{{route('role.edit', $rol->id)}}'><img border='0' alt='Modificar' src='img/edit.png' width='30' height='30'></a>
                    </td>
                </tr>
                <tr>
                </tr>
            </tbody>

            @empty
                <h1>No hay roles</h1>
            @endforelse
        </table>
        <br>
        <a href="{{route('role.create')}}" class="btn btn-primary pull-right">Añadir rol</a>
    </div><br><br>
@stop