@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <h3 class="center-text">Solicitudes</h3>
    <div class="limit">
        <table class="table-fill">
            <thead>
            <tr>
                <th>Solicitante</th>
                <th>Funcionario que autoriza</th>
                <th>Conductor</th>
                <th>Estado</th>
                <th>Disponibilidad de Vehículo</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            </tbody>
        </table>
    </div><br>
@stop