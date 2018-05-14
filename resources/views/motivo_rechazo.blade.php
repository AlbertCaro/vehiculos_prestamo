@extends('layout')

@if(auth()->user()->id == $id_solicitante)
    @section('title', 'Cancelar solicitud')
@else
    @section('title', 'Rechazar solicitud')
@endif


@section('content')
    <div class="container" style="margin-top: 5%;margin-bottom: 20%">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(auth()->user()->id == $id_solicitante)
                            {{ "Por favor, describa el motivo del cancelación" }}
                        @else
                            {{ "Por favor, describa el motivo de la rechazo" }}
                        @endif</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('rechazar') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('motivo_rechazo') ? ' has-error' : '' }}">
                                <div class="col-md-offset-0">

                                    <textarea name="motivo_rechazo" id="motivo_rechazo" class="form-control" cols="10" rows="5" style="width: 100%"></textarea>

                                    @if ($errors->has('motivo_rechazo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('motivo_rechazo') }}</strong>
                                    </span>
                                    @endif
                                    <input type="hidden" name="id_solicitud" value="{{$id}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-10">
                                    <button type="submit" class="btn btn-primary">
                                        @if(auth()->user()->id == $id_solicitante)
                                            {{ "Cancelar solicitud" }}
                                        @else
                                            {{ "Rechazar" }}
                                        @endif
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection