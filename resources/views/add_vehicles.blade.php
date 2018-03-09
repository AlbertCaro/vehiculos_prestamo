<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:39
 */ ?>
@extends('layout')
@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="{{route('vehiculo.store')}}" method="post" entype="application/x-www-form-urlencoded">
            <h3>Vehiculo</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Placas</span>
                <input type="text" class="form-control" name='txt_placas' placeholder='Placas' required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Modelo</span>
                <input type="text" class="form-control" name="txt_modelo" placeholder="Modelo" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Capacidad</span>
                <input type="number" class="form-control" name="txt_capacidad" placeholder='Capacidad' required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            {{csrf_field()}}
            <hr class="intro-divider">
        </form>
    </div>
@stop