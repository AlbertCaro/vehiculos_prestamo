@extends('layout')

@section('title', $title)

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="@if(@empty($role)){{route('role.store')}} @else {{route('role.update', $role->id)}} @endif" method="post" entype="application/x-www-form-urlencoded">
            @if(@empty($role))
            @else
                {{method_field('PUT')}}
            @endif
            <h3>Información del rol</h3>
            {{csrf_field()}}
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre del rol" required @isset($role) value="{{$role->nombre}}" @endisset/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Nombre a mostrar</span>
                <input type="text" class="form-control" name="nombre_mostrado" placeholder="Nombre a mostrar" required @isset($role) value="{{$role->nombre_mostrado}}" @endisset/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Descripción</span>
                <input type="text" class="form-control" name="descripcion" placeholder="Descripción del rol" required @isset($role) value="{{$role->descripcion}}" @endisset/>
            </div><br>

            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">

        </form>
    </div>
@stop