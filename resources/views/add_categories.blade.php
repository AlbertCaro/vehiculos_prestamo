@extends('layout')

@section('title', $title)

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <br/>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"  action="@if(@empty($category)){{route('categoria.store')}} @else {{route('categoria.update', $category->id)}} @endif" method="post"   entype="application/x-www-form-urlencoded">
            @if(@empty($category))
            @else
                {{method_field('PUT')}}
            @endif
            <hr class="intro-divider">
                @if (count($errors))
                    <div id="message" class="alert alert-danger">
                        <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                    </div>
                @endif
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoria..."
                       onfocus="hideError('nombre')"
                       @if(count($errors)) value="{{ old('nombre') }}"
                       @elseif(!@empty($category)) value="{{ $category->nombre }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div><br>
                <div id="error_nombre">
                    {!! $errors->first('nombre','<span class="alert-danger">:message</span></br>') !!}
                </div><br/>
                @if(@isset($show))
                    <a href='{{ route('categoria.edit', $category->id) }}'>
                        <button type="button" class="botones">Editar</button>
                    </a>
                    <br><br>
                @else
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
                @endif
            {{csrf_field()}}
        </form>
    </div>
@stop