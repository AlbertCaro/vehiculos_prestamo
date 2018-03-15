@extends('layout')

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" @if (@isset($category)) action="{{'categoria.update}}" @endisset @elseif action="{{route('categoria.store')}}" @endif method="post" entype="application/x-www-form-urlencoded">
            <h3>Categorias</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoria..."@isset($category) value="{{$category->nombre}}"@endisset required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            {{csrf_field()}}
        </form>
    </div>
@stop