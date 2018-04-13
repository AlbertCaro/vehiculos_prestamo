<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:39
 */ ?>
@extends('layout')
@section('title', $title)
@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"
              @if(@empty($vehicle))action="{{ route('vehiculo.store') }}"
              @else action="{{ route('vehiculo.update',$vehicle->id) }}" @endif
              method="post" entype="application/x-www-form-urlencoded">
            <h3>Información del vehiculo</h3>
            @if(@empty($vehicle))
                {{ method_field('POST') }}
            @else
                {{ method_field('PUT') }}
            @endif
            {{ csrf_field() }}
            <hr class="intro-divider">
            @if (count($errors))
                <div id="message" class="alert alert-danger">
                    <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                    <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                </div>
            @endif
            <div class="input-group">
                <span class="input-group-addon">Placas</span>
                <input type="text" class="form-control" name='placas' placeholder='Placas'
                       onfocus="hideError('placas')"
                       @if(count($errors)) value="{{ old('placas') }}"
                       @elseif(!@empty($vehicle)) value="{{$vehicle->placas }}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
                <div id="error_placas">
                    {!!$errors->first('placas','<span i class="alert-danger">:message</span></br>')!!}
                </div>
                <br>
            <div class="input-group">
                <span class="input-group-addon">Modelo</span>
                <input type="text" class="form-control" name="modelo" placeholder="Modelo"
                       onfocus="hideError('modelo')"
                       @if(count($errors)) value="{{ old('modelo') }}"
                       @elseif(!@empty($vehicle)) value="{{$vehicle->nombre}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
                <div id="error_modelo">
                    {!!$errors->first('modelo','<span i class="alert-danger">:message</span></br>')!!}
                </div>
                <br>
            <div class="input-group">
                <span class="input-group-addon">Capacidad</span>
                <input type="number" class="form-control" name="capacidad" placeholder='Capacidad'
                       onfocus="hideError('capacidad')"
                       @if(count($errors)) value="{{ old('capacidad') }}"
                       @elseif(!@empty($vehicle)) value="{{$vehicle->capacidad}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
                <div id="error_capacidad">
                    {!!$errors->first('capacidad','<span i class="alert-danger">:message</span></br>')!!}
                </div><br>
            @if(@isset($show))
                <a href='{{ route('vehiculo.edit', $vehicle->id) }}'>
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