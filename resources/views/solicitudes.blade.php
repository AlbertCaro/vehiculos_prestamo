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
                <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                {{ session('alert') }}
            </div>
        @endif
        <table class="table-fill">
            <thead>
            <tr>
                <th>Nombre del solicitante</th>
                <th>Nombre del evento</th>
                <th>Fechas de solicitud</th>
                <th>Conductor</th>
                <th>Estado</th>
                <th>Disponibilidad de Vehículo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody class="table-hover">

            @forelse($solicitudes as $solicitud)
                {{--dd($solicitud->user)--}}
            @php
                $solicitante = \App\User::findOrFail($solicitud->solicitante_id);
            @endphp
            <tr>
                <td>{{$solicitante->nombre}} {{$solicitante->apaterno}} {{$solicitante->amaterno}}</td>
                <td>{{$solicitud->nombre_evento}}</td>
                <td>
                    <strong>Salida:</strong> {{\Carbon\Carbon::parse($solicitud->fecha_evento)->format('d-m-Y H:i:s')}} <br>
                    <strong>Regreso:</strong> {{\Carbon\Carbon::parse($solicitud->fecha_regreso)->format('d-m-Y H:i:s')}}</td>
                <td>
                    @if($solicitud->solicita_conductor !== null)
                        {{\App\Solicitud::SolicitaConductor($solicitud->solicita_conductor)}}
                    @else
                        @if(@isset($solicitud->driver))
                            {{$solicitud->driver->nombre.' '.$solicitud->driver->apaterno.' '.$solicitud->driver->amaterno}} ({{$solicitud->driver->dependencia->nombre}})
                        @else
                            {{ "No asignado" }}
                        @endif
                    @endif
                </td>
                <td>{{ \App\Solicitud::status($solicitud->estatus )}}</td>
                <td>
                    @if($solicitud->vehicles_id !== null)
                        {{ $solicitud->vehicle->nombre." ".$solicitud->vehicle->placas }}
                    @else
                        {{ \App\Solicitud::vehiculoPropio($solicitud->vehiculo_propio) }}
                    @endif
                </td>
                @if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles(['asistente_serv_generales']) )
                <td>
                    <form id="delete_form_{{ $solicitud->id }}" action="{{ route('solicitud.destroy' , $solicitud->id)}}" method="POST">
                        <a href='{{ route('solicitud.show', $solicitud->id) }}'>
                            <button type="button" class="btn btn-info">Detalles</button>
                        </a>
                        <a href='{{route('solicitud.edit', $solicitud->id)}}'>
                            <button type="button" class="btn btn-success">Editar</button>
                        </a>
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}
                        <a href='' onclick="cancelElement(
                                '¿Está seguro de querer cancelar a la solicitud {{$solicitud->nombre_evento}}?',
                                '{{route('cancelar',$solicitud->id) }}', event);
                                ">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                            @if(auth()->user()->hasRoles(['coord_servicios_generales']) &&
                            ($solicitud->driver_id === null || $solicitud->vehicles_id === null) &&
                             is_null($solicitud->vehiculo_propio))
                                <a href="{{ route('assign_request', $solicitud->id) }}" class="btn btn-default">Asignar peticiones</a>
                            @endif
                        </a>
                    </form>
                </td>
                @elseif(auth()->user()->hasRoles(['jefe']) || auth()->user()->hasRoles(['asistente_jefe']))
                <td>
                    <a href="{{route('aceptar',$solicitud->id)}}">
                        <button type="button" class="btn btn-success">Aceptar</button>
                    </a>
                    <a href="" onclick="cancelElement(
                            '¿Está seguro de querer cancelar a la solicitud {{$solicitud->nombre_evento}}?',
                            '{{route('cancelar',$solicitud->id) }}', event);
                            ">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                    </a>
                </td>
                @elseif(auth()->user()->hasRoles(['solicitante']))
                    <td>
                        <a href="">
                            <button type="button" class="btn btn-warning">Editar</button>
                        </a>

                    </td>
                @endif
            </tr>
            @empty
                <tr>
                    <td colspan="6">No hay solicitudes</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div><br>
@stop