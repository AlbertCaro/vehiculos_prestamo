<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:43
 */ ?>
@extends('layout')
@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="@if($user===null) {{route('usuario.store')}}@else {{route('usuario.update',$user)}}@endif" method="post" entype="application/x-www-form-urlencoded">
            <h3>Información del SuperUsuario</h3>
            {{csrf_field()}}
            @if($user === null)
                {{method_field('POST')}}
            @else
                {{method_field('PATCH')}}
            @endif
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="@isset($user) {{$user->nombre}}@endisset" required/>
            </div><br>

            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno" placeholder="Apellido paterno" value="@isset($user) {{$user->apaterno}}@endisset" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno" placeholder="Apellido materno" value="@isset($user) {{$user->amaterno}}@endisset" required/>
            </div><br>

            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name='cargo' placeholder='Cargo' value="@isset($user) {{$user->cargo}}@endisset" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="text" class="form-control" name='celular' placeholder='Celular' value="@isset($user) {{$user->celular}}@endisset" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="text" class="form-control" name='email' placeholder='email' value="@isset($user) {{$user->email}}@endisset" required/>
            </div><br>


            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" name='password' placeholder='Contraseña' value="@isset($user) {{$user->password}}@endisset" required/>
            </div><br>


            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop
