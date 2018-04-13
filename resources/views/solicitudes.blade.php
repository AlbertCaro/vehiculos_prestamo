@extends('layout')

@section('title', $title)

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Solicitudes</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Solicitante</th>
                <th>Funcionario</th>
                <th>Conductor</th>
                <th>Estado</th>
                <th>Disponibilidad de Vehículo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($solicitudes as $solicitud)
            <tr><td>{{$solicitud->nombre_evento}}</td><td>{{$solicitud->jefe_id}}</td><td>{{$solicitud->driver_id}}</td><td>{{$solicitud->status}}</td><td>{{$solicitud->personas}}</td><td>{{$solicitud->escala}}</td></tr>
            @empty
                <tr>
                    <td colspan="6">No hay solicitudes</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div><br>
@stop