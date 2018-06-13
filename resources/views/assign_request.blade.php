@extends('layout')

@section('title', $title)

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <br/>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"
              action="@if(is_null($vehiculo)) {{ route('save_request') }} @else {{ route('edit_request') }} @endif"
              method="post" enctype="multipart/form-data">
            <h3>{{ $subtitle }}</h3>
            {{ method_field('POST') }}
            {{ csrf_field() }}
            <input type="hidden" id="solicitud" name="solicitud" value="{{ $id }}">
            <hr class="intro-divider">
            @if (count($errors))
                <div id="message" class="alert alert-danger">
                    <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                    <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                </div>
            @endif
                <h5>Vehículo</h5>
                <div class="form-group col-centered">
                    @if(count($errors)) @php $vehiculo = old('vehiculo'); @endphp @endif
                    {{ Form::select('vehiculo', $vehiculos, $vehiculo,
                    $select_attribs + ['onfocus' => 'hideError(\'conductor\')']) }}
                </div>
                <div id="error_conductor">
                    {!! $errors->first('conductor','<span class="alert-danger">:message</span></br>') !!}
                </div><br/>
            @if(@isset($conductores))
                <h5>Conductor</h5>
                <div class="form-group col-centered">
                    @if(count($errors)) @php $conductor = old('conductor'); @endphp @endif
                    {{ Form::select('conductor', $conductores, $conductor,
                    $select_attribs + ['onfocus' => 'hideError(\'vehiculo\')']) }}
                </div>
                <div id="error_vehiculo">
                    {!! $errors->first('vehiculo','<span class="alert-danger">:message</span></br>') !!}
                </div><br/>
            @endif
            <br/>
            <input type="submit" class="botones" name="save_btn" value="{{ $boton }}"/>
            <br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop