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
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="@if(isset($vehicle)){{route('vehiculo.update', $vehicle->id)}} @else{{route('vehiculo.store')}}@endif" method="post" entype="application/x-www-form-urlencoded">
            @if(isset($vehicle)){!!method_field('PUT')!!} @else{!! method_field('POST')!!}@endif
            <h3>Vehiculo</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Placas</span>
                <input type="text" class="form-control" name='placas' placeholder='Placas' @isset($vehicle) value="{{$vehicle->placas}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Modelo</span>
                <input type="text" class="form-control" name="modelo" placeholder="Modelo" @isset($vehicle) value="{{$vehicle->nombre}}" @endisset required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Capacidad</span>
                <input type="number" class="form-control" name="capacidad" placeholder='Capacidad' @isset($vehicle) value="{{$vehicle->capacidad}}"@endisset required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            {{csrf_field()}} <!--funciona-->
            <hr class="intro-divider">
        </form>
    </div>
@stop