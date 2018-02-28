@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Usuarios</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Tipo</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            <tr><td>2933896</td><td>Francisco Guerrero Contreras</td><td>franciscogc@valles.udg.mx</td><td>Coordinador de Servicios Generales</td><td></td><td><a href='?in=dXNlcg==&ap=Mg==&ind=MjkzMzg5Ng==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>8901236</td><td>María Isabel Arreola Caro </td><td>isabela@valles.udg.mx</td><td>Secretario Administrativo</td><td></td><td><a href='?in=dXNlcg==&ap=Mg==&ind=ODkwMTIzNg==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>2951593</td><td>Aldo Jovany Ramírez Herrera</td><td>aldo.ramirez@valles.udg.mx</td><td>Súper Usuario</td><td><a href='#' onclick="confirmDel('index.php?in=dXNlcg==&ap=Mg==&ind=Mjk1MTU5Mw==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=dXNlcg==&ap=Mg==&ind=Mjk1MTU5Mw==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>2961513</td><td>Victoria Mariscal Romero</td><td>victoria.mariscal@valles.udg.mx</td><td>Súper Usuario</td><td><a href='#' onclick="confirmDel('index.php?in=dXNlcg==&ap=Mg==&ind=Mjk2MTUxMw==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=dXNlcg==&ap=Mg==&ind=Mjk2MTUxMw==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr>		</tbody>
        </table>
    </div><br>
@stop