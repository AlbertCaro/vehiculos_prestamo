@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Jefes</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Correo electrónico</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            <tr><td>2134578</td><td>Mario Martínez García </td><td>Jefe de Departamento de Ciencias Computacionales e Ingenierías </td><td>mariom@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=MjEzNDU3OA==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=MjEzNDU3OA==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>2216752</td><td>Manuel Bernal Zepeda </td><td>Jefe de Departamento de Ciencias Económicas y Administrativas </td><td>manuel@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=MjIxNjc1Mg==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=MjIxNjc1Mg==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>2300087</td><td>Francisco Guerrero Muñoz </td><td>Jefe de Departamento de Ciencias Sociales y Humanidades</td><td>fguerrerom@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=MjMwMDA4Nw==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=MjMwMDA4Nw==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>2702223</td><td>José Guadalupe Macias Barragán </td><td>Jefe de Departamento de Ciencias de la Salud </td><td>josemacias@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=MjcwMjIyMw==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=MjcwMjIyMw==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>7813406</td><td>Luz Elena Ramírez Flores </td><td>Jefe de Departamento de Ciencias del Comportamiento </td><td>luzeramirezpsicologia@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=NzgxMzQwNg==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=NzgxMzQwNg==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>7816898</td><td>José Guadalupe Salazar Estrada</td><td>Director de División de Estudios de la Salud</td><td>jsalazar@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=NzgxNjg5OA==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=NzgxNjg5OA==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>8705631</td><td>María Alicia Peredo Merlo</td><td>Directora de la División de Estudios Económicos y Sociales</td><td>alicia.peredo@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=ODcwNTYzMQ==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=ODcwNTYzMQ==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>8718288</td><td> Víctor Manuel Castillo Girón</td><td>Secretario Académico </td><td>victorm.castillog@gmail.com</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=ODcxODI4OA==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=ODcxODI4OA==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>8901236</td><td>María Isabel Arreola Caro </td><td>Secretario Administrativo </td><td>isabela@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=ODkwMTIzNg==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=ODkwMTIzNg==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>9001638</td><td>José Guadalupe Rosas Elguera</td><td>Director de División de Estudios Científicos y Tecnológicos </td><td>jgrosas@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=OTAwMTYzOA==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=OTAwMTYzOA==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>9221425</td><td>José Luis Ramos Quirarte </td><td>Jefe de Departamento de Ciencias Naturales y Exactas </td><td>luis.ramos@valles.udg.mx</td><td><a href='#' onclick="confirmDel('index.php?in=Ym9zcw==&ap=Mg==&ind=OTIyMTQyNQ==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=Ym9zcw==&ap=Mg==&ind=OTIyMTQyNQ==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr>		</tbody>
        </table>
    </div><br>
@stop