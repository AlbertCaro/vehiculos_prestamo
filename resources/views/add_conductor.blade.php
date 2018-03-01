<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 14:56
 */ ?>
@extends('layout2')

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="" method="post" entype="application/x-www-form-urlencoded">
            <h3>Información sobre el conductor</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Código</span>
                <input type="number" class="form-control" name="txt_codigoC" placeholder="Código" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="txt_nombreCon" placeholder="Nombre" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Celular</span>
                <input type="number" class="form-control" name="txt_celularC" placeholder='Número de celular' required/>
            </div><br>
            <h3>Detalles de la licencia</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Licencia</span>
                <input type="number" class="form-control" name="txt_licencia" placeholder="Número de licencia"required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Fecha de vencimiento</span>
                <input type="text" class="form-control" id="venc_txt" name="txt_venc" placeholder="Fecha de vencimiento" required/>
            </div><br>
            <h5>Tipo de licencia</h5>
            <div class="form-group  col-centered">
                <select class="form-control" id="tipoL_txt" name="txt_tipoL">
                    <option>Automovilista</option><option>Motociclista</option><option>Servicio particular</option><option>Permiso provisional de práctica B</option><option>Permiso provisional de práctica A</option><option>Duplicado</option><option>Constancia de licencia</option>		  	</select>
            </div><br>
            <h3>Contacto para casos de emergencia</h3>
            <div class="input-group">
                <span class="input-group-addon">Contacto</span>
                <input type="text" class="form-control" name="txt_nombreC" placeholder="Nombre del contacto" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Parentesco</span>
                <input type="text" class="form-control" name="txt_parentesco" placeholder="Parentesco" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Domicilio</span>
                <input type="text" class="form-control" name="txt_domicilio" placeholder="Domicilio completo" required/>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Teléfono</span>
                <input type="number" class="form-control" name="txt_telefono" placeholder="Teléfono" required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop