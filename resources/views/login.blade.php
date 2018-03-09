@extends('layout')

@section('content')
    <a name="log"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Inicia sesión</h1>
                        <h3>Debes registrarte para iniciar sesión</h3>
                        <div class="form_wh">
                            <form id="login" class="form-horizontal" name='login' action='' method='post'>
                                <div class="input-group col-xs-4 col-centered">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="number" class="form-control" id = "user" name='usuarioL' placeholder='Código' required/>
                                </div><br><br>
                                <div class="input-group col-xs-4 col-centered">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" id ="pass" name='passL' placeholder='Contraseña' required/>
                                </div><br><br>
                                {{ csrf_field() }}
                                <input type='submit' class="botones" name='login' value='Entrar' onclick=""/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop