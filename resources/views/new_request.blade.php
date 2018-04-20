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
                                    @if (count($errors))
                                        <div id="message" class="alert alert-danger">
                                            <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                                            <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                                        </div>
                                    @endif
                                <h3>Funcionario que autoriza</h3>
                                <div class="form-group  col-centered">
                                    @if(count($errors))  @php $jefe = old('jefe_id'); @endphp
                                    @elseif(!@isset($jefe)) @php $jefe = null; @endphp @endif
                                    {{ Form::select('jefe_id', ['' => '- Seleccione una opción -'] + \App\User::listaByRol('jefe')->pluck('full_name', 'id')->toArray(),
                                    $jefe, $select_attribs + ['onfocus' => 'hideError(\'jefe_id\')']) }}
                                </div><br>
                                    <div id="error_jefe_id">
                                        {!! $errors->first('jefe_id','<span class="alert-danger">Debe seleccionar un funcionario</span></br>') !!}
                                    </div><br/>
                                <h3>Detalles del evento:</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Evento</span>
                                    <input type="text" class="form-control" name="txt_nombreE" placeholder='Nombre del Evento'
                                           onfocus="hideError('txt_nombreE')"
                                           @if(count($errors)) value="{{ old('nombre_evento') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->nombre_evento }}" @endif/>
                                </div><br>
                                    <div id="error_txt_nombreE">
                                        {!! $errors->first('nombre_evento','<span class="alert-danger">El campo evento es obligatorio</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Domicilio</span>
                                    <input type="text" class="form-control" name="txt_domicilioE" placeholder='Domicilio Completo'
                                           onfocus="hideError('txt_domicilioE')"
                                           @if(count($errors)) value="{{ old('txt_domicilioE') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->domicilio }}" @endif/>
                                </div><br>
                                    <div id="error_txt_domicilioE">
                                        {!! $errors->first('domicilio','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                <h5>Categoría del evento</h5>
                                <div class="form-group  col-centered">

                                    {{ Form::select('categoria_evento', ['' => '- Seleccione una opción -'] + \App\Category::all(['id', 'nombre'])->pluck('nombre','id')->toArray(), null, ['class' => 'form-control', 'onchange' => 'generarSelect()', 'id' => 'categoria_evento']) }}
                                </div><br>
                                <div id="select_tipo" class="form-group col-centered">
                                </div><br>
                                <div id="otro" class="input-group">
                                </div><br>
                                <div class="form-group  col-centered">
                                    <label for="sel3">Escala:</label>
                                    <select class="form-control" id="sel3" name="slc_escala">
                                        <option @if(count($errors)) @elseif(!@empty($solicitud))
                                                @if($solicitud->escala == 'Local') selected @endif @endif>Local</option>
                                        <option @if(count($errors)) @elseif(!@empty($solicitud))
                                                @if($solicitud->escala == 'Guadalajara') selected @endif @endif>Guadalajara</option>
                                        <option @if(count($errors)) @elseif(!@empty($solicitud))
                                                @if($solicitud->escala == 'Estatal') selected @endif @endif>Estatal</option>
                                        <option @if(count($errors)) @elseif(!@empty($solicitud))
                                                @if($solicitud->escala == 'Nacional') selected @endif @endif>Nacional</option>
                                    </select>
                                    <div id="error_escala">
                                        {!! $errors->first('escala','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                </div>
                                <h3>Itinerario</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Personas</span>
                                    <input type="text" class="form-control" name="txt_Personas" id="txt_Personas" placeholder='Numero de personas'
                                           onfocus="hideError('personas')"
                                           @if(count($errors)) value="{{ old('personas') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->personas }}" @endif/>
                                </div><br>
                                    <div id="error_personas">
                                        {!! $errors->first('personas','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Distancia</span>
                                    <input type="text" class="form-control" name="txt_kilometros" id="txt_kilometros" placeholder='Distancia dada en kilometros'
                                           onfocus="hideError('distancia')"
                                           @if(count($errors)) value="{{ old('distancia') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->distancia }}" @endif/>
                                </div><br>
                                    <div id="error_distancia">
                                        {!! $errors->first('distancia','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de salida</span>
                                    <input class="form-control" type="text" id="fecha_txt" name="txt_fecha" placeholder="Fecha y hora de salida"
                                           onfocus="hideError('fecha_evento')"
                                           @if(count($errors)) value="{{ old('fecha_evento') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->fecha_evento }}" @endif/>
                                </div><br>
                                    <div id="error_fecha_evento">
                                        {!! $errors->first('fecha_evento','<span class="alert-danger">El campo fecha de salida es obligatorio</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de regreso</span>
                                    <input class="form-control" type="text" id="fecha1_txt" name="txt_fecha1" placeholder="Fecha y hora de regreso"
                                           onfocus="hideError('fecha_regreso')"
                                           @if(count($errors)) value="{{ old('fecha_regreso') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->fecha_regreso }}" @endif/>
                                </div><br>
                                    <div id="error_fecha_regreso">
                                        {!! $errors->first('fecha_regreso','<span class="alert-danger">El campo fecha de regreso es obligatorio</span></br>') !!}
                                    </div><br/>
                            </div>

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
                                        <input type="text" class="form-control" id="codigoC_txt" name="txt_codigoC" placeholder="Código"
                                               onfocus="hideError('driver_id')"
                                               @if(count($errors)) value="{{ old('driver_id') }}"@endif/>
                                    </div><br>
                                    <div id="error_codigoC">
                                        {!! $errors->first('driver_id','<span class="alert-danger">El campo codigo es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Nombre</span>
                                        <input type="text" class="form-control" id="nombreC_txt" name="txt_nombreC" placeholder="Nombre"
                                               @if(count($errors)) value="{{ old('txt_nombreC') }}"@endif/>
                                    </div><br>
                                    <div id="error_nombreC">
                                        {!! $errors->first('txt_nombreC','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Celular</span>
                                        <input type="text" class="form-control" id="celularC_txt" name="txt_celularC" placeholder='Numero de celular'
                                               @if(count($errors)) value="{{ old('txt_celularC') }}"@endif/>
                                    </div><br>
                                    <div id="error_celularC">
                                        {!! $errors->first('txt_celularC','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                    <h5>Dependencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('dependencia', ['' => '- Seleccione una opción -'] + \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id')->toArray(),
                                        null, ['class' => 'form-control','id' => 'dependencia', 'onfocus' => 'hideError(\'dependencia\')']) }}
                                    </div><br>

                                    <h4>Detalles de la licencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Licencia</span>
                                        <input type="text" class="form-control" id="licencia_txt" name="txt_licencia" placeholder="Numero de licencia"
                                               @if(count($errors)) value="{{ old('txt_licencia') }}"@endif/>
                                    </div><br>
                                    <div id="error_celularC">
                                        {!! $errors->first('txt_licencia','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Fecha de vencimiento</span>
                                        <input type="text" class="form-control" id="venc_txt" name="txt_venc" placeholder="Fecha de vencimiento"/>
                                    </div>
                                    <h5>Tipo de licencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('tipo_licencia', ['' => '- Seleccione una opción -'] + \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id')->toArray(), null, ['class' => 'form-control','id'=>'tipo_licencia']) }}
                                    </div><br>
                                    <h5>Adjuntar archivo</h5>
                                    <div class="form-group  col-centered" align="center">
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
                            <br/>
                            <h3 class="center-text">Vehículo propio</h3>
                            <label class="radio-inline" for="rdio4"><input type="checkbox" id="rdio4" name="rdio_disp" onclick="vehiculopropio();" value="1"/>En caso de no contar con la disponibilidad de un vehículo oficial, está dispuesto a usar un vehículo propio para hacer el viaje</label><br><br>
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

        function vehiculopropio(){
            if (document.getElementById('rdio4').checked === true){
                document.getElementById('rdio5').checked = true;
                enableContent();
                document.getElementById('rdio5').checked = false;
                document.getElementById('rdio5').disabled = true;
            }else{
                document.getElementById('rdio5').disabled = false;
                enableContent();
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
