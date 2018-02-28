@extends('layout')

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <h3 class="center-text">Solicitantes</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Celular</th>
                <th>Correo Electrónico</th>
                <th>Dependencia</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            <tr><td>2601672</td><td>Juan Manuel González Villa </td><td>Coordinador de Finanzas </td><td>3334486868</td><td>manuelg@valles.udg.mx</td><td>Secretaria Administrativa </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&ind=MjYwMTY3Mg==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&ind=MjYwMTY3Mg==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>8718288</td><td>Víctor Manuel Castillo Girón</td><td>Secretario Académico </td><td>3331377522</td><td>victorm.castillog@gmail.com</td><td>Secretaria Académica </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&ind=ODcxODI4OA==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&ind=ODcxODI4OA==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>206639038</td><td>Erick Guerrero</td><td>Trabajador CTA</td><td>3861008714</td><td>erick.g@valles.udg.mx</td><td>Secretaria Académica </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&ind=MjA2NjM5MDM4&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&ind=MjA2NjM5MDM4&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr>		</tbody>
        </table>
        <h3 class="center-text">Dependencia</h3>
        <table class="table-fill">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            <tr><td>Secretaria Académica </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=Mg==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=Mg==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Secretaria Administrativa </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=Mw==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=Mw==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Rectoría </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=NA==&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=NA==&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>División de Estudios Científicos y Tecnológicos </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTE=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTE=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>División de Estudios de la Salud </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTI=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTI=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>División de Estudios Económicos y Sociales </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTM=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTM=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Departamento de Ciencias Computacionales e Ingenierías </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTQ=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTQ=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Departamento de Ciencias Naturales y Exactas </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTU=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTU=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Departamento de Ciencias Económicas y Administrativas </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTY=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTY=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Departamento de Ciencias Sociales y Humanidades </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTc=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTc=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Departamento de Ciencias de la Salud </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTg=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTg=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr><tr><td>Departamento de Ciencias del Comportamiento </td><td><a href='#' onclick="confirmDel('index.php?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTk=&apd=MQ==');return false;"><img border='0' alt='Eliminar' src='img/delete.png' width='50' height='50'></a></td><td><a href='?in=c29saQ==&ap=Mg==&deep=MQ==&ind=MTk=&apd=MA=='><img border='0' alt='Modificar' src='img/edit.png' width='50' height='50'></a></td></tr>		</tbody>
        </table>
    </div><br>
@stop