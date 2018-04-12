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
            @if (count($errors))
                <div id="message" class="alert alert-danger">
                    <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                </div>
            @endif
            <div class="input-group">
                <span class="input-group-addon">Código</span>
                <input type="number" class="form-control" name="codigo" placeholder="Código" maxlength="10"
                       onfocus="hideError('codigo')"
                       @if(count($errors)) value="{{ old('codigo') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->id }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('codigo','<span id="error_codigo" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Nombre(s)</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" maxlength="75"
                       onfocus="hideError('nombre')"
                       @if(count($errors)) value="{{ old('nombre') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->nombre }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('nombre','<span id="error_nombre" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno" placeholder="Apellido paterno" maxlength="75"
                       onfocus="hideError('apaterno')"
                       @if(count($errors)) value="{{ old('apaterno') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->apaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('apaterno','<span id="error_apaterno" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno" placeholder="Apellido materno" maxlength="75"
                       onfocus="hideError('amaterno')"
                       @if(count($errors)) value="{{ old('amaterno') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->amaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('amaterno','<span id="error_amaterno" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Celular</span>
                <input type="text" class="form-control" name="celular" placeholder='Número de celular' maxlength="12"
                       onfocus="hideError('celular')"
                       @if(count($errors)) value="{{ old('celular') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->celular }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('celular','<span id="error_celular" class="alert-danger">:message</span></br>') !!}<br>
            <h5>Dependencia</h5>
            <div class="form-group col-centered">
                @if(count($errors))  @php $dependence = old('dependencia'); @endphp
                @elseif(!@isset($dependence)) @php $dependence = null; @endphp @endif
                {{ Form::select('dependencia', \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id'),
                $dependence, $select_attribs + ['onfocus' => 'hideError(\'dependencia\')']) }}
            </div>{!! $errors->first('dependencia','<span id="error_dependencia" class="alert-danger">:message</span></br>') !!}<br>
            <h3>Detalles de la licencia</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Licencia</span>
                <input type="text" class="form-control" name="licencia" placeholder="Número de licencia" maxlength="45"
                       onfocus="hideError('licencia')"
                       @if(count($errors)) value="{{ old('licencia') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->licence->numero }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('licencia','<span id="error_licencia" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Fecha de vencimiento</span>
                <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="Fecha de vencimiento"
                       onfocus="hideError('vencimiento')"
                       @if(count($errors)) value="{{ old('vencimiento') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->licence->vencimiento }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('vencimiento','<span id="error_vencimiento" class="alert-danger">:message</span></br>') !!}<br>
            <h5>Tipo de licencia</h5>
            <div class="form-group col-centered">
                @if(count($errors)) @php $licence_type = old('dependencia'); @endphp
                @elseif(!@isset($dependence)) @php $licence_type = null; @endphp @endif
                {{ Form::select('tipo_licencia', \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id'),
                $licence_type, $select_attribs + ['onfocus' => 'hideError(\'tipo_licencia\')']) }}
            </div>{!! $errors->first('tipo_licencia','<span id="error_tipo_licencia" class="alert-danger">:message</span></br>') !!}<br>
            <h3>Contacto para casos de emergencia</h3>
            <div class="input-group">
                <span class="input-group-addon">Contacto</span>
                <input type="text" class="form-control" name="nombre_cont" placeholder="Nombre del contacto" maxlength="75"
                       onfocus="hideError('nombre_cont')"
                       @if(count($errors)) value="{{ old('nombre_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->nombre }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('nombre_cont','<span id="error_nombre_cont" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno_cont" placeholder="Apellido paterno" maxlength="75"
                       onfocus="hideError('apaterno_cont')"
                       @if(count($errors)) value="{{ old('apaterno_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->apaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('apaterno_cont','<span id="error_apaterno_cont" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno_cont" placeholder="Apellido materno" maxlength="75"
                       onfocus="hideError('amaterno_cont')"
                       @if(count($errors)) value="{{ old('amaterno_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->amaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('amaterno_cont','<span id="error_amaterno_cont" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Parentesco</span>
                <input type="text" class="form-control" name="parentesco_cont" placeholder="Parentesco" maxlength="75"
                       onfocus="hideError('parentesco_cont')"
                       @if(count($errors)) value="{{ old('parentesco_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->parentesco }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('parentesco_cont','<span id="error_parentesco_cont" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Domicilio</span>
                <input type="text" class="form-control" name="domicilio_cont" placeholder="Domicilio completo"
                       onfocus="hideError('domicilio_cont')"
                       @if(count($errors)) value="{{ old('domicilio_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->domicilio }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('domicilio_cont','<span id="error_domicilio_cont" class="alert-danger">:message</span></br>') !!}<br>
            <div class="input-group">
                <span class="input-group-addon">Teléfono</span>
                <input type="text" class="form-control" name="telefono_cont" placeholder="Teléfono" maxlength="12"
                       onfocus="hideError('telefono_cont')"
                       @if(count($errors)) value="{{ old('telefono_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->telefono }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>{!! $errors->first('telefono_cont','<span id="error_telefono_cont" class="alert-danger">:message</span></br>') !!}<br>
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