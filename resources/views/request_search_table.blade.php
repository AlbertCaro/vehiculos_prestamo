    @forelse($solicitudes as $solicitud)
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
                    @if($solicitud->driver_id !== null)
                        @php $conductor = \App\Driver::findOrFail($solicitud->driver_id) @endphp

                        {{$conductor->nombre.' '.$conductor->apaterno.' '.$conductor->amaterno}} ({{$conductor->dependencia->nombre}})
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
                    @php $vehicle = \App\Vehicle::findOrFail($solicitud->vehicles_id) @endphp
                    {{ $vehicle->nombre." ".$vehicle->placas }}
                @else
                    {{ \App\Solicitud::vehiculoPropio($solicitud->vehiculo_propio) }}
                @endif

            </td>
            @if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']))
                <td>
                    <form id="delete_form_{{ $solicitud->id }}" action="{{ route('solicitud.destroy' , $solicitud->id)}}" method="POST">
                        <a href='{{ route('solicitud.show', $solicitud->id) }}'>
                            <button type="button" class="btn btn-info">Detalles</button>
                        </a>
                        <a href='{{ route('solicitud.edit', $solicitud->id) }}'>
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
                            @if(auth()->user()->hasRoles(['coord_servicios_generales']) &&
                            ($solicitud->driver_id === null || $solicitud->vehicles_id === null) &&
                             is_null($solicitud->vehiculo_propio))
                                <a href="{{ route('assign_request', $solicitud->id) }}" class="btn btn-default">Asignar peticiones</a>
                            @endif
                        </a>
                            <button class="btn btn-danger"
                                    onclick="return deleteElement('¿Está seguro que desea eliminar la solicitud {{ $solicitud->nombre_evento }}?',
                                            'delete_form_{{ $solicitud->id }}', event)">Eliminar</button>
                    </form>
                </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="7">No hay solicitudes que coincidan con el patrón de la búsqueda.</td>
        </tr>
    @endforelse