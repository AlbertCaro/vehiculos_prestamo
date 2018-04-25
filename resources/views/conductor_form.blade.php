@extends('layout')

@section('title', $title) {{-- El título de la página, obtenido desde el controlador. --}}

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"
              @if(@empty($driver)) action="{{ route('conductor.store') }}"
              @else action="{{ route('conductor.update',$driver->id) }}" @endif
              method="post" enctype="multipart/form-data">
            <h3>Información sobre el conductor</h3>
            @if(@empty($driver)) {{ method_field('POST') }}
            @else {{ method_field('PUT') }} @endif
            {{ csrf_field() }}
            <hr class="intro-divider">
            @if (count($errors))
                <div id="message" class="alert alert-danger">
                    <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                    <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                </div>
            @endif
            <div class="input-group">
                <span class="input-group-addon">Código</span>
                <input type="number" class="form-control" name="codigo" placeholder="Código" maxlength="10"
                       onfocus="hideError('codigo')"
                       {{-- Si se tiene un error se pone como valor lo que se había introducido en el input anteriormente --}}
                       @if(count($errors)) value="{{ old('codigo') }}"
                       {{-- Cuando se entra en show o edit se crea el objeto driver, de manera que si no hay error y se entró
                       para editar o ver se llena el formulario con los datos del registro de la base de datos. --}}
                       @elseif(!@empty($driver)) value="{{ $driver->id }}" @endif
                       {{-- La variable show determina si se entró para sólo visualizar, de manera que si está seteada
                       se deshabilitan los campos para no editar. --}}
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_codigo">
                {!! $errors->first('codigo','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Nombre(s)</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" maxlength="75"
                       onfocus="hideError('nombre')"
                       @if(count($errors)) value="{{ old('nombre') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->nombre }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            {{-- Los spans que contienen los errores deberán estar dentro de un div para que se oculte correctamente,
             dicho div deberá comenzar siempre con "error_" y terminar con el nombre del input. Como abajo que se
             muestra "error_nombre", esto para que funcione la función de JavaScript "hideError()" --}}
            <div id="error_nombre">
                {!! $errors->first('nombre','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno" placeholder="Apellido paterno" maxlength="75"
                       onfocus="hideError('apaterno')"
                       @if(count($errors)) value="{{ old('apaterno') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->apaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_apaterno">
                {!! $errors->first('apaterno','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno" placeholder="Apellido materno" maxlength="75"
                       onfocus="hideError('amaterno')"
                       @if(count($errors)) value="{{ old('amaterno') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->amaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_amaterno">
                {!! $errors->first('amaterno','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Celular</span>
                <input type="text" class="form-control" name="celular" placeholder='Número de celular' maxlength="12"
                       onfocus="hideError('celular')"
                       @if(count($errors)) value="{{ old('celular') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->celular }}" @endif
                @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_celular">
                {!! $errors->first('celular','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <h5>Dependencia</h5>
            <div class="form-group col-centered">
                {{-- Cuando se entra desde show o update la variable dependence es el id de la dependencia, pero si se entra
                desde create dicha variable no está definida, así que las condicionales de abajo definen el valor que tendrá.

                Cuando se tiene un error, la variable dependence toma el valor de lo que había antes de intentar guardar con el error --}}
                @if(count($errors))  @php $dependence = old('dependencia'); @endphp
                {{-- Si no está seteada, cuando se entraba desde create, se instancia como nula para que se seleccione la
                 primera opción por defecto --}}
                @elseif(!@isset($dependence)) @php $dependence = null; @endphp @endif
                {{-- La función select requiere como parámetros lo siguiente:
                 Una cadena que corresponderá al id del select.
                 Un arreglo dónde la clave es el id y el valor es el nombre, además de que se le añade una opción vacía.
                 La variable dependence que determinará que opción está seleccionada.
                 Otro arreglo correspondiente a los demás atributos que tendrá el select.
                 --}}
                {{ Form::select('dependencia', ['' => '- Seleccione una opción -'] + \App\Dependence::all(['id', 'nombre'])->pluck('nombre', 'id')->toArray(),
                $dependence, $select_attribs + ['onfocus' => 'hideError(\'dependencia\')']) }}
            </div>
            <div id="error_dependencia">
                {!! $errors->first('dependencia','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <h3>Detalles de la licencia</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Licencia</span>
                <input type="text" class="form-control" name="licencia" placeholder="Número de licencia" maxlength="45"
                       onfocus="hideError('licencia')"
                       @if(count($errors)) value="{{ old('licencia') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->licence->numero }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_licencia">
                {!! $errors->first('licencia','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Fecha de vencimiento</span>
                <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="Fecha de vencimiento"
                       onfocus="hideError('vencimiento')"
                       @if(count($errors)) value="{{ old('vencimiento') }}"
                       @elseif(!@empty($driver)) value="{{\Carbon\Carbon::parse( $driver->licence->vencimiento)->format('d-m-Y') }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_vencimiento">
                {!! $errors->first('vencimiento','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <h5>Tipo de licencia</h5>
            <div class="form-group col-centered">
                @if(count($errors)) @php $licence_type = old('tipo_licencia'); @endphp
                @elseif(!@isset($dependence)) @php $licence_type = null; @endphp @endif
                {{ Form::select('tipo_licencia', ['' => '- Seleccione una opción -'] + \App\LicenceType::all(['id', 'tipo'])->pluck('tipo', 'id')->toArray(),
                $licence_type, $select_attribs + ['onfocus' => 'hideError(\'tipo_licencia\')']) }}
            </div>
            <div id="error_tipo_licencia">
                {!! $errors->first('tipo_licencia','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
                @if(@isset($show))
                <h5>Archivo de licencia</h5>
                <div class="form-group col-centered" align="center">
                    <a href="{{ Storage::url($driver->licence->archivo)  }}">Descargar el archivo</a>
                </div>
                @else
                <h5>Adjuntar licencia</h5>
                <div class="form-group col-centered" align="center">
                    <input type="file" name="archivo" id="archivo">
                </div>
                @endif

            <div id="error_tipo_licencia">
                {!! $errors->first('tipo_licencia','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <h3>Contacto para casos de emergencia</h3>
            <div class="input-group">
                <span class="input-group-addon">Contacto</span>
                <input type="text" class="form-control" name="nombre_cont" placeholder="Nombre del contacto" maxlength="75"
                       onfocus="hideError('nombre_cont')"
                       @if(count($errors)) value="{{ old('nombre_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->nombre }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_nombre_cont">
                {!! $errors->first('nombre_cont','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno_cont" placeholder="Apellido paterno" maxlength="75"
                       onfocus="hideError('apaterno_cont')"
                       @if(count($errors)) value="{{ old('apaterno_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->apaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_apaterno_cont">
                {!! $errors->first('apaterno_cont','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno_cont" placeholder="Apellido materno" maxlength="75"
                       onfocus="hideError('amaterno_cont')"
                       @if(count($errors)) value="{{ old('amaterno_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->amaterno }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_amaterno_cont">
                {!! $errors->first('amaterno_cont','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Parentesco</span>
                <input type="text" class="form-control" name="parentesco_cont" placeholder="Parentesco" maxlength="75"
                       onfocus="hideError('parentesco_cont')"
                       @if(count($errors)) value="{{ old('parentesco_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->parentesco }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_parentesco_cont">
                {!! $errors->first('parentesco_cont','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Domicilio</span>
                <input type="text" class="form-control" name="domicilio_cont" placeholder="Domicilio completo"
                       onfocus="hideError('domicilio_cont')"
                       @if(count($errors)) value="{{ old('domicilio_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->domicilio }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_domicilio_cont">
                {!! $errors->first('domicilio_cont','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">Teléfono</span>
                <input type="text" class="form-control" name="telefono_cont" placeholder="Teléfono" maxlength="12"
                       onfocus="hideError('telefono_cont')"
                       @if(count($errors)) value="{{ old('telefono_cont') }}"
                       @elseif(!@empty($driver)) value="{{ $driver->contact->telefono }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_telefono_contt">
                {!! $errors->first('telefono_cont','<span class="alert-danger">:message</span></br>') !!}
            </div><br/>
            {{-- Dependiendo de la variable show se decide si mostrar el botón de editar o el de guardar. --}}
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