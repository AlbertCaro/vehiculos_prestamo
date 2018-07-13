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
                        <form class="form-horizontal" type="submit" id="solicitud_frm" name="frm_solicitud"
                              action="{{route('solicitud.update', $solicitud->id)}}"
                              method="post" enctype="multipart/form-data"><br>
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                            <div class="form_wh formCenter">
                            @if (count($errors))
                                <div id="message" class="alert alert-danger">
                                    <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                                    <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                                </div>
                            @endif
                                                                
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de salida</span>
                                    <input class="form-control" type="text" id="fecha_txt" name="txt_fecha" placeholder="Fecha y hora de salida"
                                           onfocus="hideError('txt_fecha')"
                                           @if(count($errors)) value="{{ old('txt_fecha') }}"
                                           @elseif(!@empty($solicitud)) value="{{\Carbon\Carbon::parse($solicitud->fecha_evento )->format('d-m-Y H:i:s')}}" @endif/>
                                </div><br>
                                <div id="error_fecha_evento">
                                    {!! $errors->first('txt_fecha','<span class="alert-danger">El campo fecha de salida es obligatorio</span></br>') !!}
                                </div><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha y hora de regreso</span>
                                    <input class="form-control" type="text" id="fecha1_txt" name="txt_fecha1" placeholder="Fecha y hora de regreso"
                                           onfocus="hideError('txt_fecha1')"
                                           @if(count($errors)) value="{{ old('txt_fecha1') }}"
                                           @elseif(!@empty($solicitud)) value="{{ \Carbon\Carbon::parse($solicitud->fecha_regreso )->format('d-m-Y H:i:s')}}" @endif/>
                                </div><br>
                                <div id="error_fecha_regreso">
                                    {!! $errors->first('txt_fecha1','<span class="alert-danger">El campo fecha de regreso es obligatorio</span></br>') !!}
                                </div><br/>
                            </div>
                            <input type="submit" class="botones" id="btn_save" name="save_btn" value="Guardar" /><br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop