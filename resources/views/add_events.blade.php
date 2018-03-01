<?php
/**
 * Created by PhpStorm.
 * User: ignac
 * Date: 28/02/2018
 * Time: 15:19
 */ ?>
@extends('layout2')

@section('content')
    <br><br>
    <div class="form_wh formCenter">
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="" method="post" entype="application/x-www-form-urlencoded">
            <h3>Tipo de evento</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Tipo</span>
                <input type="text" class="form-control" name="txt_evento" placeholder="Tipo de evento" required/>
            </div><br>
            <h6>Categoría a la que pertenece</h6>
            <div class="form-group  col-centered">
                <select class="form-control" id="sel1" name="slc_categoria">
                    <option value='1'>Académico</option><option value='2'>Gestión </option><option value='3'>Vinculación </option>		  </select>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
        </form>
        <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="" method="post" entype="application/x-www-form-urlencoded">
            <h3>Categoría</h3>
            <hr class="intro-divider">
            <div class="input-group">
                <span class="input-group-addon">Nombre</span>
                <input type="text" class="form-control" name="txt_categoria" placeholder="Nombre de la categoría" required/>
            </div><br>
            <input type="submit" class="botones" name="save_btn" value="Guardar"/><br><br>
            <hr class="intro-divider">
        </form>
    </div>
@stop