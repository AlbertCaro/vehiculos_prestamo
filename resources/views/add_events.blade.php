<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:19
 */ ?>
@extends('layout')

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="@if(@empty($event)){{route('tipo_evento.store')}} @else {{route('tipo_evento.update', $event->id)}} @endif"  method="post" entype="application/x-www-form-urlencoded">
            @if(@empty($event))

            @else
                {{method_field('PUT')}}
            @endif
            <h3>Tipo de evento</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Tipo</span>
                <input type="text" class="form-control" name="nombre" placeholder="Tipo de evento" @isset($event) value="{{$event->nombre}}" @endisset/>
                {{$errors->first('nombre')}}
            </div><br>
            <h6>Categoría a la que pertenece</h6>
            <div class="form-group  col-centered">
                <select class="form-control" id="categories_id" name="categories_id">
                    <option value="0">Seleccionar categoria...</option>
                    @foreach($categories as $category)
                    <option value='{{$category->id}}' @isset($event) @if($event->categories_id == $category->id) selected @endif @endisset>{{$category->nombre}}</option>
                    @endforeach
                </select>
                {{$errors->first('categories_id')}}
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            {{csrf_field()}}
        </form>
    </div>
@stop