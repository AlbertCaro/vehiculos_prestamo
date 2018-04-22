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
                <th>Acciones</th>

            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($roles as $rol)
                <tr>
                    <td>{{$rol->nombre}}</td>
                    <td>{{$rol->nombre_mostrado}}</td>
                    <td>{{$rol->descripcion}}</td>

                    <td>
                        <a href='{{route('role.edit', $rol->id)}}'>
                        <button class="btn btn-info">Editar</button>
                        </a>
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