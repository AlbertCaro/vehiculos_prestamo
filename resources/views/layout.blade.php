<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sitio para préstamo de vehículos CUValles">
        <meta name="author" content="UMI CUValles">
        <title>@yield('title') - Préstamo de vehículos CUValles</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script type="text/javascript" src="{{ asset('js/causa.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/confirmDel.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/datetimepicker.full.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/calendar.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/message_methods.js') }}"></script>
        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script-->
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
                    <a class="navbar-brand topnav" href="{{ route('index') }}">
                        @if(!auth()->guest()){{ auth()->user()->nombre." ".auth()->user()->apaterno." ".auth()->user()->amaterno }}
                        @else Préstamo de vehículos CUValles @endif</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right
                        @if(!auth()->guest())
                            {{ "despliega" }}
                        @endif">
                        @if(auth()->guest())
                            <li>
                                <a href="#contacto">Contacto</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                            <li>
                                <a href="{{ route('usuario.create') }}">Registrarme</a>
                            </li>
                        @else
                            @if(auth()->user()->hasRoles(['solicitante']))
                            <li>
                                <a href='{{ route('solicitud.create' )}}'>Solicitar</a>
                            </li>
                            @endif
                        @if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']))
                            <li>
                                <a href="{{ route('conductor.index') }}">Conductores</a>
                                <ul>
                                    <li><a href='{{ route('conductor.create') }}'>Agregar</a></li>
                                    <li><a href='{{ route('conductor.index') }}'>Gestionar</a></li>
                                </ul>
                            </li>

                         @endif

                        @if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']))
                            <li>
                                <a href="{{route('tipo_evento.index')}}">Eventos</a>
                                <ul>
                                    <li><a href='{{ route('tipo_evento.create') }}'>Agregar Eventos</a></li>
                                    <li><a href='{{ route('tipo_evento.index') }}'>Gestionar Eventos</a></li>
                                    <li><a href='{{ route('categoria.create') }}'>Agregar Categoría</a></li>
                                    <li><a href='{{ route('categoria.index') }}'>Gestionar Categoría</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{route('jefes.index')}}">Jefes</a>
                                <ul>
                                    <li><a href='{{route('jefes.index')}}'>Gestionar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('solicitud.index') }}">Solicitantes</a>
                                <ul>
                                    <li><a href='{{ route('usuario.create') }}'>Agregar</a></li>
                                    <li><a href='{{ route('solicitantes.index') }}'>Gestionar</a></li>
                                </ul>

                            </li>

                         @endif

                            <li>
                                <a href="{{ route('solicitud.index') }}">Solicitudes</a>
                                <ul>
                                    <li><a href='{{route('solicitud.index')}}'>Gestionar</a></li>
                                    @if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']))
                                    <li><a href='{{route('search_request')}}'>Buscar</a></li>
                                @endif
                                </ul>
                            </li>

                            @if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']))
                            <li>
                                <a href="{{ route('vehiculo.index') }}">Vehículos</a>
                                <ul>
                                    <li><a href='{{route('vehiculo.create')}}'>Agregar</a></li>
                                    <li><a href='{{route('vehiculo.index')}}'>Gestionar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('usuario.index') }}">Usuarios</a>
                                <ul>
                                    <li><a href='{{ route('usuario.create') }}'>Agregar</a></li>
                                    <li><a href='{{ route('usuario.index') }}'>Gestionar</a></li>
                                    @if(auth()->user()->email==='erickg@valles.udg.mx')
                                    <li><a href='{{ route('role.index') }}'>Roles</a></li>
                                        @endif
                                </ul>
                            </li>
                                @endif
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
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
                        <p class="copyright text-muted small">Derechos reservados {{\Carbon\Carbon::now()->format('Y')}}. Universidad de Guadalajara. Sitio desarrollado por CUValles</p>
                    </div>
                </div>
            </div>
        </footer>
        @include('sweet::alert')
    </body>
</html>