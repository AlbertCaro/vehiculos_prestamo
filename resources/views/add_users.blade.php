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
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="@if(@empty($user)) {{route('usuario.store')}}@else {{route('usuario.update',$user)}}@endif" method="post" entype="application/x-www-form-urlencoded">
            <h3>Alta de un nuevo usuario</h3>
            {{csrf_field()}}
            @if(@empty($user))
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
                <input type="password" class="form-control" name='password' placeholder='Contraseña' />
                @if(!@empty($user)) <label>
                    <input type="checkbox" name="cambiar_pw" > Cambiar contraseña
                </label>@endif
            </div><br>



            @isset($roles)
                <div class="input-group">
                    <span class="input-group-addon">Rol:</span>
                    <select name="role_id" id="" class="form-control">

                        @foreach($roles as $rol)
                            <option value="{{$rol->id}}" @if($rol->id === $user->role->id) selected @endif>{{$rol->nombre_mostrado}}</option>
                        @endforeach
                    </select>

                </div>
                <br>
                @endisset

            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop
