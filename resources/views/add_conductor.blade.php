@extends('layout')

@section('content')
    {{ dd($driver) }}
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"
              action="@if($driver !== null) {{ route('conductor.store') }} @else {{ route('conductor.update') }} @endif"
              method="post" entype="application/x-www-form-urlencoded">
            <h3>Información sobre el conductor</h3>
            {{ csrf_field() }}
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Código</span>
                <input type="number" class="form-control" name="codigo" placeholder="Código" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Nombre(s)</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno" placeholder="Apellido paterno" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno" placeholder="Apellido materno" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Celular</span>
                <input type="number" class="form-control" name="celular" placeholder='Número de celular' required/>
            </div><br>
            <input type="hidden" name="dependencia" value="1">
            <h3>Detalles de la licencia</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Licencia</span>
                <input type="text" class="form-control" name="licencia" placeholder="Número de licencia"required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Fecha de vencimiento</span>
                <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="Fecha de vencimiento" required/>
            </div><br>
            <h5>Tipo de licencia</h5>
            <div class="form-group  col-centered">
                <select class="form-control" id="tipo_licencia" name="tipo_licencia">
                    <option>Automovilista</option>
                    <option>Motociclista</option>
                    <option>Servicio particular</option>
                    <option>Permiso provisional de práctica B</option>
                    <option>Permiso provisional de práctica A</option>
                    <option>Duplicado</option><option>Constancia de licencia</option>
                </select>
            </div><br>
            <h3>Contacto para casos de emergencia</h3>
            <div class="input-group">
                <span class="input-group-addon">Contacto</span>
                <input type="text" class="form-control" name="nombre_cont" placeholder="Nombre del contacto" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno_cont" placeholder="Apellido paterno" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno_cont" placeholder="Apellido materno" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Parentesco</span>
                <input type="text" class="form-control" name="parentesco_cont" placeholder="Parentesco" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Domicilio</span>
                <input type="text" class="form-control" name="domicilio_cont" placeholder="Domicilio completo" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Teléfono</span>
                <input type="number" class="form-control" name="telefono_cont" placeholder="Teléfono" required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop