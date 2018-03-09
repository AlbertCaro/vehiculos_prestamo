@extends('layout')

@section('content')
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
            @forelse($users as $user)
            <tr><td>{{$user->id}}</td><td>{{$user->nombre}} {{$user->apaterno}} {{$user->amaterno}}</td><td>{{$user->email}}</td><td>EL rol</td><td></td><td><a href=''><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr></tr>		</tbody>
            @empty
                <h1>No hay usuarios</h1>
            @endforelse
        </table>
    </div><br>
@stop