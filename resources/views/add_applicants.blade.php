<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:28
 */ ?>
@extends('layout')

<!-- TODO: Implementar aquí directiva section para 'title', así se mostrará el nombre corrercto de la vista en el título -->

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="" method="post" entype="application/x-www-form-urlencoded">
            <h3>Información del solicitante</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="number" class="form-control" name='txt_codigo' placeholder='Código' required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" name='txt_pass' placeholder='Contraseña' required/>
            </div><br>
            <div class="form-group  col-centered">
                <label for="sel1">Dependencia:</label>
                <select class="form-control" id="sel1" name="slc_depen">
                    <option value='14'>Departamento de Ciencias Computacionales e Ingenierías </option><option value='18'>Departamento de Ciencias de la Salud </option><option value='19'>Departamento de Ciencias del Comportamiento </option><option value='16'>Departamento de Ciencias Económicas y Administrativas </option><option value='15'>Departamento de Ciencias Naturales y Exactas </option><option value='17'>Departamento de Ciencias Sociales y Humanidades </option><option value='11'>División de Estudios Científicos y Tecnológicos </option><option value='12'>División de Estudios de la Salud </option><option value='13'>División de Estudios Económicos y Sociales </option><option value='4'>Rectoría </option><option value='2'>Secretaria Académica </option><option value='3'>Secretaria Administrativa </option>		  </select>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="txt_nombre" placeholder="Nombre" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Puesto</span>
                <input type="text" class="form-control" name="txt_puesto" placeholder='Puesto' required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Celular</span>
                <input type="number" class="form-control" name="txt_celular" placeholder="Celular" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Correo electrónico</span>
                <input type="email" class="form-control" name="txt_email" placeholder='Correo electrónico' required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
        </form>
        <form class="form-horizontal" name="form_busqueda" action="" method="post" entype="application/x-www-form-urlencoded">
            <h3>Dependencia</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Dependencia</span>
                <input type="text" class="form-control" name="txt_dependencia" placeholder='Dependencia' required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop