<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sitio para préstamo de vehículos CUValles">
    <meta name="author" content="UMI CUValles">
    <title>Préstamo de vehículos CUValles</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/landing-page.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/datetimepicker.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script type="text/javascript" src="js/causa.js"></script>
    <script type="text/javascript" src="js/confirmDel.js"></script>
</head>
<body>
<?php
require_once 'secion.php';
require_once 'conexion.php';
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
if ($_SESSION["userType"]!=5) {
    require_once 'php/header.php';
}
switch ($_SESSION["userType"]) {
    case '1':
        require_once 'php/sol.php';
        break;
    case '2':
        require_once 'php/validaJef.php';
        break;
    case '3':
        require_once 'php/validaDetalles.php';
        break;
    case '4':
        require_once 'php/validaDetallesC.php';
        break;
    case '5':
        require_once 'php/header2.php';
        break;
}
?>
<a  name="fujo"></a>
<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Flujo de las solicitudes:</h2>
                <p class="lead">Todas las solicitudes son enviadas a revisión. La primera aprobación estará dada por el <b>jefe inmediato</b> del solicitante, después de su aprobación, la solicitud será enviada al Secretario Administrativo, si la solicitud es aprobada, pasará al Coordinador de Servicios Generales, quien en caso de contar con el vehículo que reúna los requerimientos solicitados dará la respuesta final.</p>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <img class="img-responsive" src="img/dog.png" alt="">
            </div>
        </div>
    </div>
</div>
@yield('container')
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6"><h2></h2></div>
            <div class="col-lg-6">
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/cuvalles" class="btn btn-default btn-lg" target="_blank"><i class="fa fa-twitter fa-fw"></i> <span class="network-name" >Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/cuvalles/" class="btn btn-default btn-lg" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i> <span class="network-name">Facebook</span></a>
                    </li>
                    <li>
                        <a href="http://cuvalles.udg.mx/" class="btn btn-default btn-lg" target="_blank"><i><span class="glyphicon glyphicon-home" aria-hidden="true"></span></i> <span class="network-name">CUValles WEB</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <li>
                        <a href="#">Inicio</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    <li>
                        <a href="#contacto">Contacto</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    <li>
                        <a href="#sol">Flujo de la solicitudes</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    <li>
                        <a href="#sol">Solicitud</a>
                    </li>
                </ul>
                <p class="copyright text-muted small">Derechos reservados 2017. Universidad de Guadalajara. Sitio desarrollado por CUValles</p>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/datetimepicker.full.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>