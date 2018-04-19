@extends('layout')

@section('title', $title)

@section('content')
    <a name="sol"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1 id="pivoteRadios">{{$title}}</h1>
                        <h3>Folio: {{$solicitud->id}}</h3>
                        <form class="form-horizontal" type="submit" id="solicitud_frm" name="frm_solicitud"
                              @if(@empty($solicitud)) action="{{route('solicitud.store')}}"
                              @else action="{{route('solicitud.update', $solicitud->id)}}" @endif
                              method="post" enctype="multipart/form-data"><br>
                            <div class="col-lg-5 col-sm-6">
                                @if(@empty($solicitud))
                                    {{method_field('POST')}}
                                @else
                                    {{method_field('PATCH')}}
                                @endif
                                {{csrf_field()}}
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
                                           @if(!@empty($solicitud)) value="{{ $solicitud->domicilio }}" @endif/>
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
                                           @if(!@empty($solicitud)) value="{{ $solicitud->fecha_evento }}" @endif/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de regreso</span>
                                    <input class="form-control" type="text" id="fecha1_txt" name="txt_fecha1" placeholder="Fecha y hora de regreso"
                                           onfocus="hideError('txt_fecha1')" disabled
                                           @if(!@empty($solicitud)) value="{{ $solicitud->fecha_regreso }}" @endif/>
                                </div><br>
                            </div>
                            @if($solicitud->solicita_conductor == null)
                            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                                <div class="form-group  col-centered">
                                    <h3>Información sobre el conductor</h3>
                                    <div class="input-group">
                                        <label class="radio-inline" for="rdio5">
                                            <input type="checkbox" id="rdio5" name="solicito_conduc" value="1"
                                                   onclick="enableContent();"/>Solicito conductor</label><br><br>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">Código</span>
                                        <input type="text" class="form-control" id="codigoC_txt" name="txt_codigoC" placeholder="Código"/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Nombre</span>
                                        <input type="text" class="form-control" id="nombreC_txt" name="txt_nombreC" placeholder="Nombre"/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Celular</span>
                                        <input type="text" class="form-control" id="celularC_txt" name="txt_celularC" placeholder='Numero de celular'/>
                                    </div><br>
                                    <h5>Dependencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('dependencia', ['' => '- Seleccione una opción -'] + \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id')->toArray(),
                                        null, ['class' => 'form-control','id' => 'dependencia', 'onfocus' => 'hideError(\'dependencia\')']) }}
                                    </div><br>

                                    <h4>Detalles de la licencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Licencia</span>
                                        <input type="text" class="form-control" id="licencia_txt" name="txt_licencia" placeholder="Numero de licencia"/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Fecha de vencimiento</span>
                                        <input type="text" class="form-control" id="venc_txt" name="txt_venc" placeholder="Fecha de vencimiento"/>
                                    </div>
                                    <h5>Tipo de licencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('tipo_licencia', ['' => '- Seleccione una opción -'] + \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id')->toArray(), null, ['class' => 'form-control','id'=>'tipo_licencia']) }}
                                    </div><br>
                                    <h5>Adjuntar archivo</h5>
                                    <div class="form-group  col-centered">
                                        <input type="file" id="archivo" name="archivo">
                                    </div><br>

                                    <h4>Contacto para casos de emergencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Contacto</span>
                                        <input type="text" class="form-control" id="nombreCont_txt" name="txt_contacto" placeholder="Nombre del contacto"/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Parentesco</span>
                                        <input type="text" class="form-control" id="parentesco_txt" name="txt_parentesco" placeholder="Parentesco"/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Domicilio</span>
                                        <input type="text" class="form-control" id="domicilio_txt" name="txt_domicilio" placeholder="Domicilio completo"/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Teléfono</span>
                                        <input type=text class="form-control" id="telefono_txt" name="txt_telefono" placeholder="Telefono"/>
                                    </div><br>
                                </div>
                            </div>
                            @endif
                            <br/>
                            <h3 class="center-text">Vehículo propio</h3>
                            <label class="radio-inline" for="rdio4"><input type="checkbox" id="rdio4" name="rdio_disp" value="1"/>En caso de no contar con la disponibilidad de un vehículo oficial, está dispuesto a usar un vehículo propio para hacer el viaje</label><br><br>
                            <h1>Términos y condiciones</h1>
                            <p>Al hacer clic en guardar, usted acepta los <a href="{{route('terminos')}}" target="_blank">términos y condiciones</a></p>
                            <input type="submit" class="botones" id="btn_save" name="save_btn" value="Guardar" />
                        </form>
                    </div>
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