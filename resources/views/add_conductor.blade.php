@extends('layout')

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"
              @if(@empty($driver)) action="{{route('conductor.store')}}" @else action="{{route('conductor.update',$driver->id)}}" @endif
               method="post" entype="application/x-www-form-urlencoded">1
            <h3>Información sobre el conductor</h3>
            @if(@empty($driver)){{method_field('POST')}}@else{{method_field('PUT')}}@endif
            {{ csrf_field() }}
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Código</span>
                <input type="number" class="form-control" name="codigo" placeholder="Código" @isset($driver) value="{{$driver->id}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Nombre(s)</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" @isset($driver) value="{{$driver->nombre}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno" placeholder="Apellido paterno" @isset($driver) value="{{$driver->apaterno}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno" placeholder="Apellido materno" @isset($driver) value="{{$driver->amaterno}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Celular</span>
                <input type="number" class="form-control" name="celular" placeholder='Número de celular' @isset($driver) value="{{$driver->celular}}" @endisset required/>
            </div><br>
            <input type="hidden" name="dependencia" value="1">
            <h3>Detalles de la licencia</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Licencia</span>
                <input type="text" class="form-control" name="licencia" placeholder="Número de licencia" @isset($driver) value="{{$driver->licence->numero}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Fecha de vencimiento</span>
                <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="Fecha de vencimiento" @isset($driver) value="{{$driver->licence->vencimiento}}" @endisset required/>
            </div><br>
            <h5>Tipo de licencia</h5>
            <div class="form-group  col-centered">
                {{ Form::select('tipo_licencia', [
                   '' => '',
                   '0' => 'Automovilista',
                   '1' => 'Motociclista',
                   'adult2' => 'Servicio particular',
                   '2' => 'Permiso provisional de práctica B',
                   '3' => 'Permiso provisional de práctica A',
                   '4' => 'Constancia de licencia'
                   ], 0, ['class' => 'form-control']
                ) }}
                <!--select class="form-control" id="tipo_licencia" name="tipo_licencia">
                    <option>Automovilista</option>
                    <option>Motociclista</option>
                    <option>Servicio particular</option>
                    <option>Permiso provisional de práctica B</option>
                    <option>Permiso provisional de práctica A</option>
                    <option>Duplicado</option>
                    <option>Constancia de licencia</option>
                </select-->
            </div><br>
            <h3>Contacto para casos de emergencia</h3>
            <div class="input-group">
                <span class="input-group-addon">Contacto</span>
                <input type="text" class="form-control" name="nombre_cont" placeholder="Nombre del contacto" @isset($driver) value="{{$driver->contact->nombre}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno_cont" placeholder="Apellido paterno" @isset($driver) value="{{$driver->contact->apaterno}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno_cont" placeholder="Apellido materno" @isset($driver) value="{{$driver->contact->amaterno}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Parentesco</span>
                <input type="text" class="form-control" name="parentesco_cont" placeholder="Parentesco" @isset($driver) value="{{$driver->contact->nombre}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Domicilio</span>
                <input type="text" class="form-control" name="domicilio_cont" placeholder="Domicilio completo" @isset($driver) value="{{$driver->contact->domicilio}}" @endisset  required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Teléfono</span>
                <input type="number" class="form-control" name="telefono_cont" placeholder="Teléfono" @isset($driver) value="{{$driver->contact->telefono}}" @endisset required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop