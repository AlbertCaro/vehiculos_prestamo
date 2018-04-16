<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:43
 */ ?>
@extends('layout')

@section('title', $title)

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"
              @if(@empty($user))action="{{ route('usuario.store') }}"
              @else action="{{ route('usuario.update',$user->id) }}" @endif
              method="post" entype="application/x-www-form-urlencoded">
            <h3>Información del usuario</h3>
            @if(@empty($user))
                {{ method_field('POST') }}
            @else
                {{ method_field('PATCH') }}
            @endif
            {{csrf_field()}}
            <hr class="intro-divider">
            @if (count($errors))
                <div id="message" class="alert alert-danger">
                    <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                    <span>Ha dejado campos vacíos o introdujo datos erróneos</span>
                </div>
            @endif
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                       onfocus="hideError('nombre')"
                       @if(count($errors)) value="{{ old('nombre') }}"
                       @elseif(!@empty($user)) value="{{$user->nombre}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_nombre">
                {!! $errors->first('nombre','<span i class="alert-danger">:message</span></br>') !!}
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" name="apaterno" placeholder="Apellido paterno"
                       onfocus="hideError('apaterno')"
                       @if(count($errors)) value="{{ old('apaterno') }}"
                       @elseif(!@empty($user)) value="{{$user->apaterno}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_apaterno">
                {!! $errors->first('apaterno','<span i class="alert-danger">:message</span></br>') !!}
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" name="amaterno" placeholder="Apellido materno"
                       onfocus="hideError('amaterno')"
                       @if(count($errors)) value="{{ old('amaterno') }}"
                       @elseif(!@empty($user)) value="{{$user->amaterno}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_amaterno">
                {!! $errors->first('amaterno','<span i class="alert-danger">:message</span></br>') !!}
            </div><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name='cargo' placeholder='Cargo'
                       onfocus="hideError('cargo')"
                       @if(count($errors)) value="{{ old('cargo') }}"
                       @elseif(!@empty($user)) value="{{$user->cargo}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_cargo">
                {!! $errors->first('cargo','<span i class="alert-danger">:message</span></br>') !!}
            </div><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input type="text" class="form-control" name='celular' placeholder='Celular'
                       onfocus="hideError('celular')"
                       @if(count($errors)) value="{{ old('celular') }}"
                       @elseif(!@empty($user)) value="{{$user->celular}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_celular">
                {!! $errors->first('celular','<span i class="alert-danger">:message</span></br>') !!}
            </div><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
                <input type="text" class="form-control" name='email' placeholder='email'
                       onfocus="hideError('email')"
                       @if(count($errors)) value="{{ old('email') }}"
                       @elseif(!@empty($user)) value="{{$user->email}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_email">
                {!! $errors->first('email','<span i class="alert-danger">:message</span></br>') !!}
            </div><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" name='password' placeholder='Contraseña'
                       onfocus="hideError('password')"
                       @if(count($errors)) value="{{ old('password') }}"
                       @elseif(!@empty($user)) value="{{$user->passwordl}}" @endif
                       @if(@isset($show)) disabled @endif/>
            </div>
            <div id="error_password">
                {!! $errors->first('password','<span i class="alert-danger">:message</span></br>') !!}
            </div><br>
            @if(!@empty($user)) <label>
                <input type="checkbox" name="cambiar_pw" > Cambiar contraseña
            </label>@endif<br>
            @isset($user->roles)
                <div class="modal-title "><h2>Roles para el usuario: </h2></div>
                <div class="form-check form-check-inline">


                        @foreach($roles as $rol)

                            <input type="checkbox"
                                   name="role_id[]"
                                   id="{{$rol->id}}"
                                   value="{{$rol->id}}"
                                    {{$user->roles->pluck('id')->contains($rol->id) ? 'checked' : '' }}
                            />

                             <label for="{{$rol->id}}">{{$rol->nombre_mostrado}}</label><br>

                    @endforeach

                </div>
                <br>
                @endisset

            @if(@isset($show))
                <a href='{{ route('usuario.edit', $user->id) }}'>
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
