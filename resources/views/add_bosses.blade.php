<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:25
 */ ?>
@extends('layout2')

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="" method="post" entype="application/x-www-form-urlencoded">
            <h3>Información del Jefe</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="number" class="form-control" name='txt_codigo' placeholder='Código' required/>
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
                <span class="input-group-addon">Correo electrónico</span>
                <input type="email" class="form-control" name="txt_email" placeholder="Correo electrónico" required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop
