<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:19
 */ ?>
@extends('layout')

@section('content')
    {{ dd($categoria) }}
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="{{route('categoria.store')}}" method="post" entype="application/x-www-form-urlencoded">
            <h3>Categorias</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoria..." value="{{$categoria}}" required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            {{csrf_field()}}
        </form>
    </div>
@stop