@extends('layout')

@section('title', $title)

@section('content')
    <a name="sol"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>{{$title}}</h1>
                        <br/>
                        <h3>Folio: {{$solicitud->id}}</h3>
                        <h3>Fecha de la solicitud: {{\Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d-m-Y H:i:s')}}</h3>
                        @if($solicitud->estatus !== 5 && (auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles(['asistente_serv_generales'])))
                            @if($solicitud->driver == null)
                                <div class="form_wh formCenter">
                                    <div class="alert alert-warning">
                                        <strong>¡Atención!</strong> El solicitante no cuenta con conductor asignado <a href="{{ route('assign_request',$solicitud->id) }}" class="alert-link">Asignar conductor</a>.
                                    </div>
                                </div>
                            @endif
                            @if($solicitud->vehicles_id == null && $solicitud->vehiculo_propio == null)
                                <div class="form_wh formCenter">
                                    <div class="alert alert-warning">
                                        <strong>¡Atención!</strong> El solicitante no cuenta con vehículo asignado <a href="{{ route('assign_request',$solicitud->id) }}" class="alert-link">Asignar vehículo</a>.
                                    </div>
                                </div>
                            @endif
                        @endif

                            <h3 class="center-text">Observaciones del usuario</h3>
                            <label for="observaciones"><br><textarea id="observaciones" name="observaciones" cols="70" rows="5" placeholder="Observaciones adicionales" style="color: #000;" disabled="disabled">{{$solicitud->observaciones}}</textarea>
                                <div class="form_wh formCenter">
                                    <div class="alert alert-warning">
                                        <strong>¡Atención!</strong> Si desea añadir una nueva observación, puede hacerlo <a href="{{ route('observacion.nueva',$solicitud->id) }}" class="alert-link"> desde aquí</a>.
                                    </div>
                                </div>
                                @if(count($solicitud->observacionesRel)>0)
                                    <div class="form_wh formCenter">
                                        <div class="alert alert-success">
                                            <strong>¡Atención!</strong> Hay observaciones adicionales en esta solicitud <a href="{{ route('observacion.show',$solicitud->id) }}" class="alert-link"> (ver)</a>.
                                        </div>
                                    </div>
                                    @endif
                        <br>
                            <div @if($solicitud->solicita_conductor == null) class="col-lg-5 col-sm-6" @else class="form_wh formCenter"  @endif>
                                
                                <h3>Funcionario que autoriza</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control" name="txt_jefe" placeholder='Jefe'
                                           onfocus="hideError('txt_nombreE')" disabled
                                           @if(!@empty($jefe)) value="{{ $jefe->nombre }} {{$jefe->apaterno}} {{$jefe->amaterno}}" @endif/>
                                </div><br>
                                <h3>Detalles del evento:</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Evento</span>
                                    <input type="text" class="form-control" name="txt_nombreE" placeholder='Nombre del Evento'
                                           onfocus="hideError('txt_nombreE')" disabled
                                           @if(!@empty($solicitud)) value="{{ $solicitud->nombre_evento }}" @endif/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Domicilio</span>
                                    <input type="text" class="form-control" name="txt_domicilioE" id="txt_domicilioE" placeholder='Domicilio Completo' disabled
                                           @if(!@empty($solicitud)) value="{{ $solicitud->domicilio }}" @endif/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Categoría</span>
                                    <input type="text" class="form-control" name="txt_categoria" id="txt_categoria" placeholder='Categoría' disabled
                                           @if(!@empty($solicitud)) value="{{ $solicitud->eventType->category->nombre }}" @endif/>
                                </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Tipo</span>
                                        <input type="text" class="form-control" name="txt_categoria" id="txt_categoria" placeholder='Tipo' disabled
                                               @if(!@empty($tipo)) value="{{ $tipo->nombre }}" @endif/>
                                    </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Escala</span>
                                    <input type="text" class="form-control" name="txt_escala" id="txt_escala" placeholder='Escala'
                                           onfocus="hideError('txt_escala')" disabled
                                           @if(count($errors)) value="{{ old('txt_escala') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->escala }}" @endif>
                                </div>
                                <h3>Itinerario</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Personas</span>
                                    <input type="text" class="form-control" name="txt_Personas" id="txt_Personas" placeholder='Numero de personas'
                                           onfocus="hideError('txt_Personas')" disabled
                                           @if(!@empty($solicitud)) value="{{ $solicitud->personas }}" @endif/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Distancia</span>
                                    <input type="text" class="form-control" name="txt_kilometros" id="txt_kilometros" placeholder='Distancia dada en kilometros'
                                           onfocus="hideError('txt_kilometros')" disabled
                                           @if(!@empty($solicitud)) value="{{ $solicitud->distancia }}" @endif/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de salida</span>
                                    <input class="form-control" type="text" id="fecha_txt" name="txt_fecha" placeholder="Fecha y hora de salida"
                                           onfocus="hideError('txt_fecha')" disabled=""
                                           @if(!@empty($solicitud)) value="{{\Carbon\Carbon::parse($solicitud->fecha_evento )->format('d-m-Y H:i:s')}}" @endif/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de regreso</span>
                                    <input class="form-control" type="text" id="fecha1_txt" name="txt_fecha1" placeholder="Fecha y hora de regreso"
                                           disabled @if(!@empty($solicitud)) value="{{ \Carbon\Carbon::parse($solicitud->fecha_regreso )->format('d-m-Y H:i:s')}}" @endif/>
                                </div><br>

                       @if($solicitud->driver != null)
                            </div> <!-- aqui se hace la division en dos del formulario en caso de que haya datos del conductor -->
                            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                                <div class="form-group  col-centered">
                                    <h3>Información sobre el conductor</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon">Código</span>
                                        <input type="text" class="form-control" id="codigoC_txt" name="txt_codigoC" placeholder="Código"
                                               disabled @if($solicitud->driver!=null) value="{{ $solicitud->driver->id}}" @endif/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Nombre</span>
                                        <input type="text" class="form-control" id="nombreC_txt" name="txt_nombreC" placeholder="Nombre"
                                               disabled @if($solicitud->driver != null) value="{{ $solicitud->driver->nombre." ". $solicitud->driver->apaterno." ".$solicitud->driver->amaterno}}" @endif/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Celular</span>
                                        <input type="text" class="form-control" id="celularC_txt" name="txt_celularC" placeholder='Numero de celular'
                                               disabled @if($solicitud->driver != null) value="{{ $solicitud->driver->celular}}" @endif/>
                                    </div><br>
                                    <h5>Dependencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('dependencia', ['' => '- Seleccione una opción -'] + \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id')->toArray(),
                                        $solicitud->driver->dependencies_id, ['class' => 'form-control','id' => 'dependencia', 'onfocus' => 'hideError(\'dependencia\')', 'disabled'=>'disabled']) }}
                                    </div>
                                    <div id="error_dependencia">
                                        {!! $errors->first('dependencia','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                    @if(isset($solicitud->driver->licence))
                                        <h4>Detalles de la licencia</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">Licencia</span>
                                            <input type="text" class="form-control" id="licencia_txt" name="txt_licencia" placeholder="Numero de licencia"
                                                   disabled @if($solicitud->driver != null) value="{{ $solicitud->driver->licence->numero}}" @endif/>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Fecha de vencimiento</span>
                                            <input type="text" class="form-control" id="venc_txt" name="txt_venc" placeholder="Fecha de vencimiento"
                                                   disabled @if($solicitud->driver != null) value="{{  \Carbon\Carbon::parse($solicitud->driver->licence->vencimiento)->format('d-m-Y')}}" @endif/>
                                        </div><br>
                                        <h5>Tipo de licencia</h5>
                                        <div class="form-group  col-centered">
                                            {{ Form::select('tipo_licencia', ['' => '- Seleccione una opción -'] + \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id')->toArray(), $solicitud->driver->licence->licence_types_id, ['class' => 'form-control','id'=>'tipo_licencia', 'onfocus' => 'hideError(\'tipo_licencia\')','disabled'=>'disabled']) }}
                                        </div>
                                        <div id="error_tipo_licencia">
                                            {!! $errors->first('tipo_licencia','<span class="alert-danger">:message</span></br>') !!}
                                        </div><br/>
                                        <h5>Archivo de licencia</h5>
                                        @if($solicitud->driver->licence->archivo !== null)
                                            <div class="form-group  col-centered">
                                                <a href="{{ Storage::url($solicitud->driver->licence->archivo)  }}">Descargar el archivo</a>
                                            </div><br>
                                        @else
                                            <div class="form_wh formCenter">
                                                <div class="alert alert-info">
                                                    <strong>¡Sin archivo de licencia!</strong>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="form_wh formCenter">
                                            <div class="alert alert-warning">
                                                <strong>¡Atención!</strong> La licencia del conductor se encuentra con datos erroneos <a href="{{ route('conductor.edit',$solicitud->driver->id) }}" class="alert-link">Editar conductor</a>.
                                            </div>
                                        </div>
                                    @endif
                                    <h4>Contacto para casos de emergencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Contacto</span>
                                        <input type="text" class="form-control" id="nombreCont_txt" name="txt_contacto" placeholder="Nombre del contacto"
                                               disabled @if($solicitud->driver != null) value="{{ $solicitud->driver->contact->nombre." ".$solicitud->driver->contact->apaterno." ".$solicitud->driver->contact->amaterno}}" @endif/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Parentesco</span>
                                        <input type="text" class="form-control" id="parentesco_txt" name="txt_parentesco" placeholder="Parentesco"
                                               disabled @if($solicitud->driver != null) value="{{ $solicitud->driver->contact->parentesco}}" @endif/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Domicilio</span>
                                        <input type="text" class="form-control" id="domicilio_txt" name="txt_domicilio" placeholder="Domicilio completo"
                                               disabled @if($solicitud->driver != null) value="{{ $solicitud->driver->contact->domicilio}}" @endif/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Teléfono</span>
                                        <input type=text class="form-control" id="telefono_txt" name="txt_telefono" placeholder="Telefono"
                                               disabled @if($solicitud->driver != null) value="{{ $solicitud->driver->contact->telefono}}" @endif/>
                                    </div><br>
                                </div><br>
                            </div>
                       @else
                           No se ha asignado un conductor <br>
                           @endif

                        @if($solicitud->solicita_conductor != null) </div> @endif
                @if($solicitud->estatus !== 5)
                    @if(auth()->user()->hasRoles(['admin', 'jefe', 'coord_servicios_generales', 'asistente_serv_generales']))
                        <a class="btn btn-success" href="{{ route('aceptar', $solicitud->id) }}">Aceptar</a>
                        <a class="btn btn-danger" href="{{ route('cancelar', $solicitud->id) }}">Rechazar</a>
                    @endif

                    @if(auth()->user()->hasRoles(['coord_servicios_generales']) && ($solicitud->driver_id === null or $solicitud === null))
                        <a class="btn btn-primary" href="{{ route('assign_request', $solicitud->id) }}">Asignar peticiones</a>
                    @endif
                @endif

                <a class="btn btn-info" href="{{ route('solicitud.index') }}">Regresar</a>
                    </div>
            <!--
                En algún momento Jonathan Pérez Uribe andubo por estos códigos
                cuando fue becario del area de generación de contenidos educativos
                jonny.perez.u@gmail.com
             -->
                </div>
            </div>
        </div>
    </div><br>
    <script type="text/javascript">
        function enableContent() {
            if (document.getElementById('rdio5').checked === true) {
                document.getElementById('codigoC_txt').disabled = true;
                document.getElementById('nombreC_txt').disabled = true;
                document.getElementById('celularC_txt').disabled = true;
                document.getElementById('licencia_txt').disabled = true;
                document.getElementById('venc_txt').disabled = true;
                document.getElementById('tipo_licencia').disabled = true;
                document.getElementById('dependencia').disabled = true;
                document.getElementById('archivo').disabled = true;
                document.getElementById('nombreCont_txt').disabled = true;
                document.getElementById('parentesco_txt').disabled = true;
                document.getElementById('domicilio_txt').disabled = true;
                document.getElementById('telefono_txt').disabled = true;

            } else {
                document.getElementById('codigoC_txt').disabled = false;
                document.getElementById('nombreC_txt').disabled = false;
                document.getElementById('celularC_txt').disabled = false;
                document.getElementById('licencia_txt').disabled = false;
                document.getElementById('venc_txt').disabled = false;
                document.getElementById('tipo_licencia').disabled = false;
                document.getElementById('dependencia').disabled = false;
                document.getElementById('archivo').disabled = false;
                document.getElementById('nombreCont_txt').disabled = false;
                document.getElementById('parentesco_txt').disabled = false;
                document.getElementById('domicilio_txt').disabled = false;
                document.getElementById('telefono_txt').disabled = false;
            }
        }

        function generaInput() {
            if (document.getElementById("tipo_evento").value === 'otro') {
                $("#otro").html('<span class="input-group-addon">Especifique el evento</span>' +
                    '<input type="text" class="form-control" id="otro_evento" name="otro_evento" placeholder="Nombre del evento" required/>');
            } else
                $("#otro").html('');
        }

        function generarSelect() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                data:{ "category" : $("#categoria_evento").val() },
                type:'post',
                url: '{{ route('select_event') }}',
                success:function(response) {
                    $("#select_tipo").html(response);
                }
            });
        }

        $(document).ready(function () {
            generarSelect();
            if ($("#otro").val())
                generaInput();
        })

    </script>
@stop