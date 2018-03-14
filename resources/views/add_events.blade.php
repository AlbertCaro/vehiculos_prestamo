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
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="{{route('tipo_evento.store')}}" method="post" entype="application/x-www-form-urlencoded">
            <h3>Tipo de evento</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Tipo</span>
                <input type="text" class="form-control" name="nombre" placeholder="Tipo de evento" required/>
            </div><br>
            <h6>Categoría a la que pertenece</h6>
            <div class="form-group  col-centered">
                <select class="form-control" id="categories_id" name="categories_id">
                    <option value='1'>Académico</option>
                    <option value='2'>Gestión </option>
                    <option value='3'>Vinculación </option>
                </select>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            {{csrf_field()}}
        </form>
    </div>
@stop