@extends('layout')

@section('title', $title)

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <br/>
        @if (session('alert'))
            <div id="message" class="alert alert-success">
                <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                {{ session('alert') }}
            </div>
        @endif
        @if(count($events))
        <table class="table-fill">
            <thead>
            <tr>
                <th>Categoría</th>
                <th>Tipo de evento</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @endif
            @forelse($events as $event)

            <tr>
                <td>{{ucfirst($event->categoria)}}</td>
                <td>{{ucfirst($event->nombre)}}</td>
                <td>
                    <form id="delete_form_{{ $event->id }}" action="{{ route('tipo_evento.destroy' , $event->id)}}" method="POST">
                        <a href='{{ route('tipo_evento.show', $event->id) }}'>
                            <button type="button" class="btn btn-info">Detalles</button>
                        </a>
                        <a href='{{route('tipo_evento.edit', $event->id)}}'>
                            <button type="button" class="btn btn-success">Editar</button>
                        </a>
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}
                        <a href='' onclick="deleteElement(
                                '¿Está seguro de querer eliminar al evento {{$event->nombre}}?',
                                'delete_form_{{ $event->id }}', event);
                                ">
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </a>
                    </form>
                </td>
            </tbody>
            @empty
                <h1>No hay eventos</h1>
            @endforelse
        </table>
    </div><br>
@stop