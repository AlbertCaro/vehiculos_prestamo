@extends('layout')


@section('content')


    <form action="{{route('dependencia.store')}}" method="post" >
    {{csrf_field()}}

    <input type="text" name="nombre" id="nombre">

        <input type="submit" value="Guardar">
    </form>


@stop