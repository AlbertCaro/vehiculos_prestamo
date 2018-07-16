@extends('layout')


    @section('title', 'Nueva observación')



@section('content')
    <div class="container" style="margin-top: 5%;margin-bottom: 20%">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
Aquí, podrá añadir observaciones, el usuario será notificado automáticamente
                        </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('observacion.store',$id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('motivo_rechazo') ? ' has-error' : '' }}">
                                <div class="col-md-offset-0">

                                    <textarea name="observacion" id="observacion" class="form-control" cols="10" rows="5" style="width: 100%"></textarea>

                                    @if ($errors->has('observacion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('observacion') }}</strong>
                                    </span>
                                    @endif
                                    <input type="hidden" name="id_solicitud" value="{{$id}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-10">
                                    <button type="submit" class="btn btn-primary">
                                            Guardar observación
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