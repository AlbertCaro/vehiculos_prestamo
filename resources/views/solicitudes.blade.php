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
            @if(auth()->user()->hasRoles(['vehiculos']))
            <tr>
                <th>Nombre del conductor</th>
                <th>Archivo de licencia</th>
                <th>Fecha de salida</th>
                <th>Fecha de regreso</th>
                <th>Destino</th>
                <th>Kilómetros</th>
                <th>Vehiculo</th>
            </tr>
                @else
                <tr>
                    <th>Nombre del solicitante</th>
                    <th>Nombre del evento</th>
                    <th>Fechas de solicitud</th>
                    <th>Conductor</th>
                    <th>Estado</th>
                    <th>Disponibilidad de Vehículo</th>
                    @if(!auth()->user()->hasRoles(['asistente_jefe']))
                    <th>Acciones</th>
                    @endif
                </tr>
                @endif
            </thead>
            <tbody class="table-hover">

            @forelse($solicitudes as $solicitud)
                {{--dd($solicitud->user)--}}

            @php
                $solicitante = \App\User::findOrFail($solicitud->solicitante_id);
           // dd($solicitud);

            @endphp
                @if(auth()->user()->hasRoles(['vehiculos']))
            <tr>
                <td>{{$solicitud->driver->nombre}} {{$solicitud->driver->apaterno}} {{$solicitud->driver->amaterno}}</td>
                <td><a href="{{ Storage::url($driver->licence->archivo)  }}">Descargar</a></td>
                <td>
                    <strong>Salida:</strong> {{\Carbon\Carbon::parse($solicitud->fecha_evento)->format('d-m-Y H:i:s')}} <br>

                <td>
                    <strong>Regreso:</strong> {{\Carbon\Carbon::parse($solicitud->fecha_regreso)->format('d-m-Y H:i:s')}}</td>
                </td>
                <td>
                    {{$solicitud->escala}} {{$solicitud->domicilio}}
                </td>
                <td>
                        {{$solicitud->distancia}} kilómetros
                </td>

                <td>{{$solicitud->vehicle->nombre." ".$solicitud->vehicle->placas}}</td>

            </tr>
                    {{-- Si no son el role vehículos se verán aquí--}}
                @else
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
                        <td>
                            @if($solicitud->estatus === 5)
                                {{ \App\Solicitud::status($solicitud->estatus).": ".$solicitud->motivo_rechazo }}
                            @else
                                {{ \App\Solicitud::status($solicitud->estatus) }}
                            @endif
                        </td>
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
                                    @if($solicitud->estatus !== 5)
                                    <a href='{{route('solicitud.edit', $solicitud->id)}}'>
                                        <button type="button" class="btn btn-success">Editar</button>
                                    </a>
                                    <input name="_method" type="hidden" value="DELETE">
                                    {{ csrf_field() }}
                                    @if($solicitud->estatus === 1)
                                        <a href='' onclick="cancelElement(
                                                '¿Está seguro de querer cancelar a la solicitud {{$solicitud->nombre_evento}}?',
                                                '{{route('cancelar',$solicitud->id) }}', event);
                                                ">
                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                            @endif
                                            @if(auth()->user()->hasRoles(['asistente_serv_generales']) || auth()->user()->hasRoles(['coord_servicios_generales']))
                                                <a href="{{ route('assign_request', $solicitud->id) }}" class="btn btn-default">Asignar peticiones</a>
                                            @else
                                                <a href="{{ route('assign_request', $solicitud->id) }}" class="btn btn-default">Cambiar vehiculo</a>
                                            @endif
                                        </a>
                                        @endif
                                        <button class="btn btn-danger"
                                               onclick="return deleteElement('¿Está seguro que desea eliminar la solicitud {{ $solicitud->nombre_evento }}?',
                                                       'delete_form_{{ $solicitud->id }}', event)">Eliminar</button>
                                </form>

                            </td>
                        @elseif(auth()->user()->hasRoles(['jefe']))
                            <td>
                                @if($solicitud->estatus !== 5)
                                    <a href="{{route('aceptar',$solicitud->id)}}">
                                        <button type="button" class="btn btn-success">Aceptar</button>
                                    </a>
                                    <a href='{{ route('solicitud.show', $solicitud->id) }}'>
                                        <button type="button" class="btn btn-info">Detalles</button>
                                    </a>
                                    @if($solicitud->estatus === 1)
                                        <a href="" onclick="cancelElement(
                                                '¿Está seguro de querer cancelar a la solicitud {{$solicitud->nombre_evento}}?',
                                                '{{route('cancelar',$solicitud->id) }}', event);
                                                ">
                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                        </a>
                                    @endif
                                @endif
                            </td>
                        @elseif(auth()->user()->hasRoles(['administrativo']))
                            <td>
                                @if($solicitud->estatus !== 5)
                                    <a href="{{route('aceptar',$solicitud->id)}}">
                                        <button type="button" class="btn btn-success">Aceptar</button>
                                    </a>
                                    <a href='{{ route('solicitud.show', $solicitud->id) }}'>
                                        <button type="button" class="btn btn-info">Detalles</button>
                                    </a>
                                    @if($solicitud->estatus === 2)
                                        <a href="" onclick="cancelElement(
                                                '¿Está seguro de querer cancelar a la solicitud {{$solicitud->nombre_evento}}?',
                                                '{{route('cancelar',$solicitud->id) }}', event);
                                                ">
                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                        </a>
                                    @endif
                                @endif
                            </td>
                        @elseif(auth()->user()->hasRoles(['solicitante']))
                            <td>
                                @if($solicitud->estatus !== 5)
                                <a href='{{ route('solicitud.edit', $solicitud->id) }}'>
                                    <button type="button" class="btn btn-success">Editar</button>
                                </a>
                                <a href='{{ route('cancelar', $solicitud->id) }}'>
                                    <button type="button" class="btn btn-danger">Cancelar</button>
                                </a>
                                @endif
                            </td>
                        @endif
                    </tr>

                    @endif
            @empty
                <tr>
                    <td colspan="7">No hay solicitudes</td>
                </tr>
            @endforelse
            </tbody>
        </table>


        {{--  De aquí en adelante será terreno de las solicitudes ya aprobadas --}}

        <br/>
        <h1 class="center-text">Solcitudes ya aprobadas</h1>
        <table class="table-fill">
            <thead>
            @if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles(['asistente_serv_generales']) )
                <tr>
                    <th>Nombre del solicitante</th>
                    <th>Nombre del evento</th>
                    <th>Fechas de solicitud</th>
                    <th>Conductor</th>
                    <th>Estado</th>
                    <th>Disponibilidad de Vehículo</th>
                    @if(!auth()->user()->hasRoles(['asistente_jefe']))
                        <th>Acciones</th>
                    @endif
                </tr>
            @endif
            </thead>
            <tbody class="table-hover">

            @forelse($aprobadas as $solicitud)
                {{--dd($solicitud->user)--}}

                @php
                    $solicitante = \App\User::findOrFail($solicitud->solicitante_id);
               // dd($solicitud);

                @endphp
                @if(auth()->user()->hasRoles(['vehiculos']))
                    <tr>
                        <td>{{$solicitud->driver->nombre}} {{$solicitud->driver->apaterno}} {{$solicitud->driver->amaterno}}</td>
                        <td><a href="{{env('APP_URL')}}{{ Storage::url($driver->licence->archivo)  }}">Descargar</a></td>
                        <td>
                            <strong>Salida:</strong> {{\Carbon\Carbon::parse($solicitud->fecha_evento)->format('d-m-Y H:i:s')}} <br>

                        <td>
                            <strong>Regreso:</strong> {{\Carbon\Carbon::parse($solicitud->fecha_regreso)->format('d-m-Y H:i:s')}}</td>
                        </td>
                        <td>
                            {{$solicitud->escala}} {{$solicitud->domicilio}}
                        </td>
                        <td>
                            {{$solicitud->distancia}} kilómetros
                        </td>

                        <td>{{$solicitud->vehicle->nombre." ".$solicitud->vehicle->placas}}</td>

                    </tr>
                    {{-- Si no son el role vehículos se verán aquí--}}
                @else
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
                        <td>
                            @if($solicitud->estatus === 5)
                                {{ \App\Solicitud::status($solicitud->estatus).": ".$solicitud->motivo_rechazo }}
                            @else
                                {{ \App\Solicitud::status($solicitud->estatus) }}
                            @endif
                        </td>
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
                                    @if($solicitud->estatus !== 5)
                                        <a href='{{route('solicitud.edit', $solicitud->id)}}'>
                                            <button type="button" class="btn btn-success">Editar</button>
                                        </a>
                                        <input name="_method" type="hidden" value="DELETE">
                                        {{ csrf_field() }}
                                        @if($solicitud->estatus === 1)
                                            <a href='' onclick="cancelElement(
                                                    '¿Está seguro de querer cancelar a la solicitud {{$solicitud->nombre_evento}}?',
                                                    '{{route('cancelar',$solicitud->id) }}', event);
                                                    ">
                                                <button type="button" class="btn btn-danger">Cancelar</button>
                                                @endif
                                                @if(auth()->user()->hasRoles(['asistente_serv_generales']) || auth()->user()->hasRoles(['coord_servicios_generales']))
                                                    <a href="{{ route('assign_request', $solicitud->id) }}" class="btn btn-default">Asignar peticiones</a>
                                                @else
                                                    <a href="{{ route('assign_request', $solicitud->id) }}" class="btn btn-default">Cambiar vehiculo</a>
                                                @endif
                                            </a>
                                        @endif
                                        <button class="btn btn-danger"
                                                onclick="return deleteElement('¿Está seguro que desea eliminar la solicitud {{ $solicitud->nombre_evento }}?',
                                                        'delete_form_{{ $solicitud->id }}', event)">Eliminar</button>
                                </form>

                            </td>


                        @endif
                    </tr>

                @endif
            @empty
                <tr>
                    <td colspan="7">No hay solicitudes</td>
                </tr>
            @endforelse
            </tbody>
        </table>


    </div><br>
@stop