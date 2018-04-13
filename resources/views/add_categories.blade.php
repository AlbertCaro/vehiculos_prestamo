@extends('layout')

<!-- TODO: Implementar aquí directiva section para 'title', así se mostrará el nombre corrercto de la vista en el título -->

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda"  action="@if(@empty($category)){{route('categoria.store')}} @else {{route('categoria.update', $category->id)}} @endif" method="post"   entype="application/x-www-form-urlencoded">
            @if(@empty($category))

            @else
                {{method_field('PUT')}}
            @endif
            <h3>Categorias</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoria..." @isset($category) value="{{$category->nombre}}" @endisset />
                {{$errors->first('nombre')}}
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            {{csrf_field()}}
        </form>
    </div>
@stop