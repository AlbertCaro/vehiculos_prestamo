@extends('layout')

<!-- TODO: Implementar aquí directiva section para 'title', así se mostrará el nombre corrercto de la vista en el título -->

@section('content')
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li><a href='?sol=MQ=='>Solicitud</a></li><li><a href='?his=MQ=='>Historial</a></li>                <li>
                <a href="#fujo">Flujo de la solicitudes</a>
            </li>
            <li>
                <a href="#contacto">Contacto</a>
            </li>
            <li>
                <a href="salir.php">Cerrar sesión</a>
            </li>
        </ul>
    </div>
    </div>
    </nav><link rel="stylesheet" href="css/tabla.css">
    <a name="sol"></a><br><br>
    <h3 class="center-text">Solicitudes realizadas</h3>
    <div class="limit">
        <table class="table-fill">
            <thead>
            <tr>
                <th>Evento</th>
                <th>Domicilio</th>
                <th>Fecha de la solicitud</th>
                <th>Fecha del evento</th>
                <th>Estado</th>
                <th>Editar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            </tbody>
        </table>
    </div><br>
@stop