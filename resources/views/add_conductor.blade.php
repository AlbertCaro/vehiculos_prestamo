@extends('layout')

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"
              @if(@empty($driver)) action="{{ route('conductor.store') }}" @else action="{{ route('conductor.update',$driver->id) }}" @endif
               method="post" entype="application/x-www-form-urlencoded">
            <h3>Información sobre el conductor</h3>
            @if(@empty($driver)) {{ method_field('POST') }} @else {{ method_field('PUT') }} @endif
            {{ csrf_field() }}
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Código</span>
                <input type="number" class="form-control" name="codigo" placeholder="Código" maxlength="10"
                       @if(!@empty($driver)) value="{{ $driver->id }}" @elseif(!@empty($error)) value="{{ old('codigo') }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('codigo','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Nombre(s)</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" maxlength="75"
                       @if(!@empty($driver)) value="{{ $driver->nombre }}" @elseif(!@empty($error)) value="{{ old('nombre') }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('nombre','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno" placeholder="Apellido paterno" maxlength="75"
                       @if(!@empty($driver)) value="{{ $driver->apaterno }}" @elseif(!@empty($error)) value="{{ old('apaterno') }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('apaterno','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno" placeholder="Apellido materno" maxlength="75"
                       @if(!@empty($driver)) value="{{ $driver->amaterno }}" @elseif(!@empty($error)) value="{{ old('amaterno') }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('amaterno','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Celular</span>
                <input type="text" class="form-control" name="celular" placeholder='Número de celular' maxlength="12"
                       @if(!@empty($driver)) value="{{ $driver->celular }}" @elseif(!@empty($error)) value="{{ old('celular') }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('celular','<span class="alert-danger">:message</span></br>') !!}<br>
            <h5>Dependencia</h5>
            <div class="form-group col-centered">
                @if(!@isset($dependence)) {{ $dependence = null }} @endif
                {{ Form::select('dependencia', \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id'),
                $dependence, $select_attribs) }}
            </div>{!! $errors->first('dependencia','<span class="alert-danger">:message</span></br>') !!}<br>
            <h3>Detalles de la licencia</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Licencia</span>
                <input type="text" class="form-control" name="licencia" placeholder="Número de licencia" maxlength="45"
                       @isset($driver) value="{{ $driver->licence->numero }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('licencia','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Fecha de vencimiento</span>
                <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="Fecha de vencimiento"
                       @isset($driver) value="{{ $driver->licence->vencimiento }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('vencimiento','<span class="alert-danger">:message</span></br>') !!}<br>
            <h5>Tipo de licencia</h5>
            <div class="form-group col-centered">
                @if(!@isset($licence_type)) {{ $licence_type = null }} @endif
                {{ Form::select('tipo_licencia', \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id'),
                $licence_type, $select_attribs) }}
            </div>{!! $errors->first('tipo_licencia','<span class="alert-danger">:message</span></br>') !!}<br>
            <h3>Contacto para casos de emergencia</h3>
            <div class="input-group">
                <span class="input-group-addon">Contacto</span>
                <input type="text" class="form-control" name="nombre_cont" placeholder="Nombre del contacto" maxlength="75"
                       @isset($driver) value="{{ $driver->contact->nombre }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('nombre_cont','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno_cont" placeholder="Apellido paterno" maxlength="75"
                       @isset($driver) value="{{ $driver->contact->apaterno }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('apaterno_cont','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno_cont" placeholder="Apellido materno" maxlength="75"
                       @isset($driver) value="{{ $driver->contact->amaterno }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('amaterno_cont','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Parentesco</span>
                <input type="text" class="form-control" name="parentesco_cont" placeholder="Parentesco" maxlength="75"
                       @isset($driver) value="{{ $driver->contact->parentesco }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('parentesco_cont','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Domicilio</span>
                <input type="text" class="form-control" name="domicilio_cont" placeholder="Domicilio completo"
                       @isset($driver) value="{{ $driver->contact->domicilio }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('domicilio_cont','<span class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Teléfono</span>
                <input type="text" class="form-control" name="telefono_cont" placeholder="Teléfono" maxlength="12"
                       @isset($driver) value="{{ $driver->contact->telefono }}" @endisset
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('telefono_cont','<span class="alert-danger">:message</span></br>') !!}<br>

            @if(@isset($show))
                <a href='{{ route('conductor.edit', $driver->id) }}'>
                    <button type="button" class="botones">Editar</button>
                </a>
            @else
                <input type="submit" class="botones" name="save_btn" value="Guardar"/>
            @endif
            <br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop