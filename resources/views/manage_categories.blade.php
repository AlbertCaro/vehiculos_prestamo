@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Categorias</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($categories as $category)
                <tr>
                    <td>{{$category->nombre}}</td>
                    <td>
                        <form id="delete_form_{{ $category->id }}" action="{{ route('categoria.destroy' , $category->id)}}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <a href='' onclick="event.preventDefault();
                                    document.getElementById('delete_form_{{ $category->id }}').submit();">
                                <img border='0' alt='Editar' src='img/delete.png' width='50' height='50'>
                            </a>
                        </form>
                    </td>
                    <td>
                        <a href='{{route('categoria.edit', $category->id)}}'><img border='0' alt='Modificar' src='img/edit.png' width='30' height='30'></a>
                    </td>
                </tr><tr></tr>		</tbody>
            @empty
                <h1>No hay categorias</h1>
            @endforelse
        </table>
    </div><br>
@stop