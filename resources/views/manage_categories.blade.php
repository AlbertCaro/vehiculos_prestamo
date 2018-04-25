@extends('layout')

@section('title', $title)

@section('content')

    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <br>
        <h1 class="center-text">{{ $title }}</h1>
        <br>
        @if (session('alert'))
            <div id="message" class="alert alert-success">
                <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                {{ session('alert') }}
            </div>
        @endif
        @if(count($categories))
        <table class="table-fill">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @endif
            @forelse($categories as $category)
                <tr>
                    <td>{{$category->nombre}}</td>
                    <td>
                        <form id="delete_form_{{ $category->id }}" action="{{ route('categoria.destroy' , $category->id)}}" method="POST">
                            <a href='{{ route('categoria.show', $category->id) }}'>
                                <button type="button" class="btn btn-info">Detalles</button>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='{{route('categoria.edit', $category->id)}}'><button type="button" class="btn btn-success">Editar</button></a>
                            <a href='' onclick="deleteElement( //Ir a /public/js/messages_methods.js para saber como funciona esta función
                                    '¿Está seguro de querer eliminar a la categoría {{$category->nombre}}?',
                                    'delete_form_{{ $category->id }}', event);
                                    ">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </a>

                        </form>
                    </td>
                </tr><tr></tr>
            @empty
                <h1>No hay categorías</h1>
            @endforelse
            @if(count($categories))
            </tbody>
        </table>
        @endif
    </div><br>
@stop