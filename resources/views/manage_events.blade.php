@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Tipo de evento</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Categoría</th>
                <th>Tipo de evento</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($events as $event)
            <tr>
                <td>{{ucfirst($event->categoria)}}</td>
                <td>{{ucfirst($event->nombre)}}</td>
                <td>
                    <form id="delete_form_{{ $event->id }}" action="{{ route('tipo_evento.destroy' , $event->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}
                        <a href='' onclick="event.preventDefault();
                                document.getElementById('delete_form_{{ $event->id }}').submit();">
                            <img border='0' alt='Editar' src='img/delete.png' width='30' height='30'>
                        </a>
                    </form>
                </td>
                <td>
                    <a href='{{route('tipo_evento.edit', $event->id)}}'>
                        <img border='0' alt='Modificar' src='img/edit.png' width='30' height='30'>
                    </a>
                </td>
            </tbody>
            @empty
                <h1>No hay eventos</h1>
            @endforelse
        </table>
    </div><br>
@stop