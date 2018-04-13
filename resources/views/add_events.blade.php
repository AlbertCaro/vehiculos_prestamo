<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:19
 */ ?>
@extends('layout')

@section('title', $title)

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <h1 class="center-text">{{ $title }}</h1>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="@if(@empty($event)){{route('tipo_evento.store')}} @else {{route('tipo_evento.update', $event->id)}} @endif"  method="post" entype="application/x-www-form-urlencoded">
            @if(@empty($event))
            @else
                {{method_field('PUT')}}
            @endif
            <h3>Tipo de evento</h3>
            <hr class="intro-divider">
                @if (count($errors))
                    <div id="message" class="alert alert-danger">
                        <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                    </div>
                @endif
            <div class="input-group">
                <span class="input-group-addon">Tipo</span>
                <input type="text" class="form-control" name="nombre" placeholder="Tipo de evento"
                       onfocus="hideError('nombre')"
                       @if(count($errors)) value="{{ old('nombre') }}"
                       @elseif(!@empty($event)) value="{{ $event->nombre }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div><br>
                <div id="error_nombre">
                    {!! $errors->first('nombre','<span class="alert-danger">:message</span></br>') !!}
                </div><br/>
            <h6>Categoría a la que pertenece</h6>
            <div class="form-group  col-centered">
                <select class="form-control" id="categories_id" name="categories_id" @if(@isset($show)) disabled @endif>
                    <option value="0">Seleccione una categoría...</option>
                    @foreach($categories as $category)
                    <option value='{{$category->id}}' @if(!@empty($event)) @if($event->categories_id == $category->id) selected @endif @endif>{{$category->nombre}}</option>
                    @endforeach
                </select>
                <div id="error_categories">
                    {!! $errors->first('categories_id','<span class="alert-danger">:message</span></br>') !!}
                </div><br/>
            </div><br>
                @if(@isset($show))
                    <a href='{{ route('tipo_evento.edit', $event->id) }}'>
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