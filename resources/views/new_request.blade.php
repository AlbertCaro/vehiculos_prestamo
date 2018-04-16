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
                              method="post" entype="application/x-www-form-urlencoded"><br>

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
                                    @if(count($errors))  @php $jefe = old('slc_jefe'); @endphp
                                    @elseif(!@isset($jefe)) @php $jefe = null; @endphp @endif
                                    {{ Form::select('slc_jefe', ['' => '- Seleccione una opción -'] + \App\User::listaByRol('jefe')->pluck('full_name', 'id')->toArray(),
                                    $jefe, $select_attribs + ['onfocus' => 'hideError(\'slc_jefe\')']) }}
                                </div><br>
                                    <div id="error_slc_jefe">
                                        {!! $errors->first('slc_jefe','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                <h3>Detalles del evento:</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Evento</span>
                                    <input type="text" class="form-control" name="txt_nombreE" id="txt_nombreE" placeholder='Nombre del Evento'
                                           onfocus="hideError('txt_nombreE')"
                                           @if(count($errors)) value="{{ old('txt_nombreE') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->nombre_evento }}" @endif/>
                                </div><br>
                                    <div id="txt_nombreE">
                                        {!! $errors->first('txt_nombreE','<span class="alert-danger">:message</span></br>') !!}
                                    </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Domicilio</span>
                                    <input type="text" class="form-control" name="txt_domicilioE" id="txt_domicilioE" placeholder='Domicilio Completo'
                                           onfocus="hideError('txt_domicilioE')"
                                           @if(count($errors)) value="{{ old('txt_domicilioE') }}"
                                           @elseif(!@empty($solicitud)) value="{{ $solicitud->domicilio }}" @endif/>
                                </div><br>
                                    <div id="error_txt_domicilioE">
                                        {!! $errors->first('txt_domicilioE','<span class="alert-danger">:message</span></br>') !!}
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
                                        <option>Local</option>
                                        <option>Guadalajara</option>
                                        <option>Estatal</option>
                                        <option>Nacional</option>
                                    </select>
                                </div>
                                <h3>Itinerario</h3>
                                <div class="input-group">
                                    <span class="input-group-addon">Personas</span>
                                    <input type="text" class="form-control" name="txt_Personas" id="txt_Personas" placeholder='Numero de personas' required/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Distancia</span>
                                    <input type="text" class="form-control" name="txt_kilometros" id="txt_kilometros" placeholder='Distancia dada en kilometros' required/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de salida</span>
                                    <input class="form-control" type="text" id="fecha_txt" name="txt_fecha" placeholder="Fecha y hora de salida" required/>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de regreso</span>
                                    <input class="form-control" type="text" id="fecha1_txt" name="txt_fecha1" placeholder="Fecha y hora de regreso" required/>
                                </div><br>
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
                                        <input type="text" class="form-control" id="codigoC_txt" name="txt_codigoC" placeholder="Código" required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Nombre</span>
                                        <input type="text" class="form-control" id="nombreC_txt" name="txt_nombreC" placeholder="Nombre" required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Celular</span>
                                        <input type="text" class="form-control" id="celularC_txt" name="txt_celularC" placeholder='Numero de celular' required/>
                                    </div><br>
                                    <h5>Dependencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('dependencia', ['' => '- Seleccione una opción -'] + \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id')->toArray(),
                                        null, ['class' => 'form-control','id' => 'dependencia', 'onfocus' => 'hideError(\'dependencia\')']) }}
                                    </div><br>

                                    <h4>Detalles de la licencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Licencia</span>
                                        <input type="text" class="form-control" id="licencia_txt" name="txt_licencia" placeholder="Numero de licencia" required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Fecha de vencimiento</span>
                                        <input type="text" class="form-control" id="venc_txt" name="txt_venc" placeholder="Fecha de vencimiento" required/>
                                    </div>
                                    <h5>Tipo de licencia</h5>
                                    <div class="form-group  col-centered">
                                        {{ Form::select('tipo_licencia', ['' => '- Seleccione una opción -'] + \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id')->toArray(), null, ['class' => 'form-control','id'=>'tipo_licencia']) }}
                                    </div><br>

                                    <h4>Contacto para casos de emergencia</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">Contacto</span>
                                        <input type="text" class="form-control" id="nombreCont_txt" name="txt_contacto" placeholder="Nombre del contacto" required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Parentesco</span>
                                        <input type="text" class="form-control" id="parentesco_txt" name="txt_parentesco" placeholder="Parentesco" required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Domicilio</span>
                                        <input type="text" class="form-control" id="domicilio_txt" name="txt_domicilio" placeholder="Domicilio completo" required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Teléfono</span>
                                        <input type=text class="form-control" id="telefono_txt" name="txt_telefono" placeholder="Telefono" required/>
                                    </div><br>
                                </div>
                            </div>
                            <br/>
                            <h3 class="center-text">Vehículo propio</h3>
                            <label class="radio-inline" for="rdio4"><input type="checkbox" id="rdio4" name="rdio_disp" value="1"/>En caso de no contar con la disponibilidad de un vehículo oficial, está dispuesto a usar un vehículo propio para hacer el viaje</label><br><br>
                            <h1>Términos y condiciones</h1>
                            <p>Al hacer clic en guardar, usted acepta los <a href="{{route('terminos')}}" target="_blank">términos y condiciones</a></p>
                            <input type="submit" class="botones" id="btn_save" name="save_btn" value="Guardar" onclick="return validar()"/>
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
            } else {
                document.getElementById('codigoC_txt').disabled = false;
                document.getElementById('nombreC_txt').disabled = false;
                document.getElementById('celularC_txt').disabled = false;
                document.getElementById('licencia_txt').disabled = false;
                document.getElementById('venc_txt').disabled = false;
                document.getElementById('tipo_licencia').disabled = false;
                document.getElementById('dependencia').disabled = false;
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
