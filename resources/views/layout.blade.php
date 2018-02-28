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
        <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
            <div class="container topnav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand topnav" href="#">Préstamo de vehículos CUValles</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#reg">Registrarme</a>
                        </li>
                        <li>
                            <a href="#log">Iniciar sesión</a>
                        </li>
                        <li>
                            <a href="#contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

@yield('content')

        <a  name="contacto"></a>
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