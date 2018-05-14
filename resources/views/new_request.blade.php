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
                        <br/>
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
                                </div>
                                    <div id="error_jefe_id">
                                        {!! $errors->first('jefe_id','<span class="alert-danger">Debe seleccionar un funcionario</span></br>') !!}
                                    </div><br/>
                                <h3>Detalles del evento:</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Evento</span>
                                    <input type="text" class="form-control" name="txt_nombreE" placeholder='Nombre del Evento'
                                           onfocus="hideError('txt_nombreE')"
                                           @if(count($errors)) value="{{ old('txt_nombreE') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->nombre_evento }}" @endif/>
                                </div>
                                    <div id="error_txt_nombreE">
                                        {!! $errors->first('txt_nombreE','<span class="alert-danger">El campo evento es obligatorio</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Domicilio</span>
                                    <input type="text" class="form-control" name="txt_domicilioE" placeholder='Domicilio Completo'
                                           onfocus="hideError('txt_domicilioE')"
                                           @if(count($errors)) value="{{ old('txt_domicilioE') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->domicilio }}" @endif/>
                                </div>
                                    <div id="error_txt_domicilioE">
                                        {!! $errors->first('txt_domicilioE','<span class="alert-danger">El campo domicilio es obligatorio</span></br>') !!}
                                    </div><br/>
                                <h5>Categoría del evento</h5>
                                <div class="form-group  col-centered">
                                    {{ Form::select('categoria_evento', ['' => '- Seleccione una opción -'] + \App\Category::all(['id', 'nombre'])->pluck('nombre','id')->toArray(), null, ['class' => 'form-control', 'onchange' => 'generarSelect()', 'id' => 'categoria_evento']) }}
                                </div><br>
                                    <input type="hidden" id="type_value" name="type_value" value="@if(count($errors)) {{ old('tipo_evento') }} @else {{ $tipo_evento }} @endif">
                                <div id="select_tipo" class="form-group col-centered">
                                </div><br>
                                    <div id="error_tipo_evento">
                                        {!! $errors->first('tipo_evento','<span class="alert-danger">los campos categoría y tipo de eventos son obligatorios</span></br>') !!}
                                    </div><br/>
                                <div id="otro" class="input-group">
                                </div>
                                    <div id="error_otro_evento">
                                        {!! $errors->first('otro_evento','<span class="alert-danger">El campo nombre del evento es obligatorio</span></br>') !!}
                                    </div><br/>
                                <div class="form-group  col-centered">
                                    <label for="sel3">Escala:</label>
                                    <select class="form-control" id="sel3" name="slc_escala" onfocus="hideError('slc_escala')">
                                        <option value="">- Seleccione una opción -</option>
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
                                        {!! $errors->first('slc_escala','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                </div>
                                <h3>Itinerario</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Personas</span>
                                    <input type="text" class="form-control" name="txt_Personas" id="txt_Personas" placeholder='Numero de personas'
                                           onfocus="hideError('txt_Personas')"
                                           @if(count($errors)) value="{{ old('txt_Personas') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->personas }}" @endif/>
                                </div>
                                    <div id="error_txt_Personas">
                                        {!! $errors->first('txt_Personas','<span class="alert-danger">El campo personas es obligatorio</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Distancia</span>
                                    <input type="text" class="form-control" name="txt_kilometros" id="txt_kilometros" placeholder='Distancia dada en kilometros'
                                           onfocus="hideError('txt_kilometros')"
                                           @if(count($errors)) value="{{ old('txt_kilometros') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->distancia }}" @endif/>
                                </div>
                                    <div id="error_txt_kilometros">
                                        {!! $errors->first('txt_kilometros','<span class="alert-danger">El campo distancia es obligatorio</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de salida</span>
                                    <input class="form-control" type="text" id="fecha_txt" name="txt_fecha" placeholder="Fecha y hora de salida"
                                           onfocus="hideError('txt_fecha')"
                                           @if(count($errors)) value="{{ old('txt_fecha') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->fecha_evento }}" @endif/>
                                </div>
                                    <div id="error_txt_fecha">
                                        {!! $errors->first('txt_fecha','<span class="alert-danger">El campo fecha de salida es obligatorio</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de regreso</span>
                                    <input class="form-control" type="text" id="fecha1_txt" name="txt_fecha1" placeholder="Fecha y hora de regreso"
                                           onfocus="hideError('txt_fecha1')"
                                           @if(count($errors)) value="{{ old('txt_fecha1') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->fecha_regreso }}" @endif/>
                                </div>
                                    <div id="error_txt_fecha1">
                                        {!! $errors->first('txt_fecha1','<span class="alert-danger">El campo fecha de regreso es obligatorio</span></br>') !!}
                                    </div><br/>
                            </div>

                            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                                <div class="form-group  col-centered">
                                    <h3>Información sobre el conductor</h3>
                                    <!--div class="input-group">
                                        <label class="radio-inline" for="rdio5">
                                            <input type="checkbox" id="rdio5" name="solicito_conduc" value="1"
                                                   onclick="enableContent();"/>Solicito conductor</label><br><br>
                                    </div-->
                                    <div class="input-group">
                                        <span class="input-group-addon">Código</span>
                                        <input type="text" class="form-control" id="codigoC_txt" name="txt_codigoC" placeholder="Código"
                                               onfocus="hideError('txt_codigoC')"
                                               @if(count($errors)) value="{{ old('txt_codigoC') }}"@endif/>
                                    </div>
                                    <div id="error_txt_codigoC">
                                        {!! $errors->first('txt_codigoC','<span class="alert-danger">El campo codigo es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Nombre</span>
                                        <input type="text" class="form-control" id="nombreC_txt" name="txt_nombreC" placeholder="Nombre"
                                               onfocus="hideError('txt_nombreC')"
                                               @if(count($errors)) value="{{ old('txt_nombreC') }}"@endif/>
                                    </div>
                                    <div id="error_txt_nombreC">
                                        {!! $errors->first('txt_nombreC','<span class="alert-danger">El campo nombre es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Celular</span>
                                        <input type="text" class="form-control" id="celularC_txt" name="txt_celularC" placeholder='Numero de celular'
                                               onfocus="hideError('txt_celularC')"
                                               @if(count($errors)) value="{{ old('txt_celularC') }}"@endif/>
                                    </div>
                                    <div id="error_txt_celularC">
                                        {!! $errors->first('txt_celularC','<span class="alert-danger">El campo celular es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <h5>Dependencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('dependencia', ['' => '- Seleccione una opción -'] + \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id')->toArray(),
                                        null, ['class' => 'form-control','id' => 'dependencia', 'onfocus' => 'hideError(\'dependencia\')']) }}
                                    </div>
                                    <div id="error_dependencia">
                                        {!! $errors->first('dependencia','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                    <h4>Detalles de la licencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Licencia</span>
                                        <input type="text" class="form-control" id="licencia_txt" name="txt_licencia" placeholder="Numero de licencia"
                                               onfocus="hideError('txt_licencia')"
                                               @if(count($errors)) value="{{ old('txt_licencia') }}"@endif/>
                                    </div>
                                    <div id="error_txt_licencia">
                                        {!! $errors->first('txt_licencia','<span class="alert-danger">El campo licencia es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Fecha de vencimiento</span>
                                        <input type="text" class="form-control" id="venc_txt" name="txt_venc" placeholder="Fecha de vencimiento"
                                               onfocus="hideError('txt_venc')"
                                               @if(count($errors)) value="{{ old('txt_venc') }}"@endif/>
                                    </div>
                                    <div id="error_txt_venc">
                                        {!! $errors->first('txt_venc','<span class="alert-danger">El campo fecha de vencimiento es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <h5>Tipo de licencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('tipo_licencia', ['' => '- Seleccione una opción -'] + \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id')->toArray(), null, ['class' => 'form-control','id'=>'tipo_licencia', 'onfocus' => 'hideError(\'tipo_licencia\')']) }}
                                    </div>
                                    <div id="error_tipo_licencia">
                                        {!! $errors->first('tipo_licencia','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                    <h5>Adjuntar archivo (licencia de conducir)</h5>
                                    <div class="form-group  col-centered" align="center">
                                        <input type="file" id="archivo" name="archivo" onfocus="hideError('archivo')" />
                                    </div>
                                    <div id="error_archivo">
                                        {!! $errors->first('archivo','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                    <h4>Contacto para casos de emergencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Contacto</span>
                                        <input type="text" class="form-control" id="nombreCont_txt" name="txt_contacto" placeholder="Nombre del contacto"
                                               onfocus="hideError('txt_contacto')"
                                               @if(count($errors)) value="{{ old('txt_contacto') }}"@endif/>
                                    </div>
                                    <div id="error_txt_contacto">
                                        {!! $errors->first('txt_contacto','<span class="alert-danger">El campo contacto es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Parentesco</span>
                                        <input type="text" class="form-control" id="parentesco_txt" name="txt_parentesco" placeholder="Parentesco"
                                               onfocus="hideError('txt_parentesco')"
                                               @if(count($errors)) value="{{ old('txt_parentesco') }}"@endif/>
                                    </div>
                                    <div id="error_txt_parentesco">
                                        {!! $errors->first('txt_parentesco','<span class="alert-danger">El campo parentesco es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Domicilio</span>
                                        <input type="text" class="form-control" id="domicilio_txt" name="txt_domicilio" placeholder="Domicilio completo"
                                               onfocus="hideError('txt_domicilio')"
                                               @if(count($errors)) value="{{ old('txt_domicilio') }}"@endif/>
                                    </div>
                                    <div id="error_txt_domicilio">
                                        {!! $errors->first('txt_domicilio','<span class="alert-danger">El campo domicilio es obligatorio</span></br>') !!}
                                    </div><br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">Teléfono</span>
                                        <input type=text class="form-control" id="telefono_txt" name="txt_telefono" placeholder="Telefono"
                                               onfocus="hideError('txt_telefono')"
                                               @if(count($errors)) value="{{ old('txt_telefono') }}"@endif/>
                                    </div>
                                    <div id="error_txt_telefono">
                                        {!! $errors->first('txt_telefono','<span class="alert-danger">El campo telefono es obligatorio</span></br>') !!}
                                    </div><br/>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <h4 class="center-text">Vehículo propio</h4>
                            <label class="radio-inline" for="rdio4"><input type="checkbox" id="rdio4" name="rdio_disp" onclick="vehiculopropio();" value="1"/>En caso de no contar con la disponibilidad de un vehículo oficial, está dispuesto a usar un vehículo propio para hacer el viaje</label><br><br>
                            <h4 class="center-text">Observaciones</h4>
                            <label for="observaciones"><br><textarea id="observaciones" name="observaciones" cols="70" rows="5" placeholder="Observaciones adicionales" style="color: #000;"></textarea><br><br>
                            <h1>Términos y condiciones</h1>
                            <p>Al hacer clic en guardar, usted acepta los <a href="{{ route('terminos') }}" target="_blank">términos y condiciones</a></p>
                            <input type="submit" class="botones" id="btn_save" name="save_btn" value="Guardar" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <script type="text/javascript">


        function vehiculopropio(){
            if (document.getElementById('rdio4').checked === true){
                document.getElementById('rdio5').checked = false;
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
                    '<input type="text" class="form-control" id="otro_evento" name="otro_evento" ' +
                    'onfocus="hideError(\'otro_evento\')" placeholder="Nombre del evento" @if(count($errors)) {{ 'value='.old('otro_evento') }} @endif/>');
            } else
                $("#otro").html('');
        }

        function generarSelect() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });

            $.ajax({
                data:{
                    "category" : $("#categoria_evento").val(),
                    "event_type" : $("#type_value").val()
                },
                type: 'post',
                url: '{{ route('select_event') }}',
                success:function(response) {
                    $("#select_tipo").html(response);
                    generaInput();
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
