@extends('layout')

@section('content')
    <a name="log"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Inicia Sesión</h1>
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
    <a  name="reg"></a>
    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <div class="intro-message">
                        <h1>Registrarme</h1>
                        <h3>Los campos son obligatorios</h3>
                    </div>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <br><br><br><br>
                    <img class="img-responsive" src="../img/user.png" alt="">
                </div>
            </div>
            <div class="row">
                <form id="form_reg" class="form-horizontal" name='reg_form' action='' method='post'>
                    <div class="col-lg-5 col-sm-6">
                        <div class="form-group  col-centered">
                            <label for="sel1">Dependencia:</label>
                            <select class="form-control" id="sel1" name="slc_depen">
                                <option value='14'>Departamento de Ciencias Computacionales e Ingenierías </option><option value='18'>Departamento de Ciencias de la Salud </option><option value='19'>Departamento de Ciencias del Comportamiento </option><option value='16'>Departamento de Ciencias Económicas y Administrativas </option><option value='15'>Departamento de Ciencias Naturales y Exactas </option><option value='17'>Departamento de Ciencias Sociales y Humanidades </option><option value='11'>División de Estudios Científicos y Tecnológicos </option><option value='12'>División de Estudios de la Salud </option><option value='13'>División de Estudios Económicos y Sociales </option><option value='4'>Rectoría </option><option value='2'>Secretaria Académica </option><option value='3'>Secretaria Administrativa </option>                        </select>
                        </div><br>
                        <div class="input-group col-centered">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="number" class="form-control" id="txt_codigo" name='usuario' placeholder='Código'/>
                        </div><br>
                        <div class="input-group col-centered">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" id="txt_pass" class="form-control" name='pass' placeholder='Contraseña'/>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Nombre</span>
                            <input type="text" class="form-control" id="txt_nombre" name='nombre' placeholder='Nombre completo'/>
                        </div><br>
                    </div><br>
                    <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                        <div class="form-group  col-centered">
                            <div class="input-group">
                                <span class="input-group-addon">Cargo</span>
                                <input type="text" class="form-control" id="txt_cargo" name='cargo' placeholder='Cargo que desempeña'/>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Celular</span>
                                <input type="number" class="form-control" id="txt_celular" name="celular" placeholder='Número de celular'/>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Correo electrónico</span>
                                <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder='Correo electrónico'/>
                            </div><br>
                        </div>
                        {{ csrf_field() }}
                        <input type="submit" id="btn_login" class="botones" name="login_btn" value="Registrarme" onclick=""/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop