@extends('layout')

@section('title', 'Buscar solicitud')

@section('content')
    <br/><br/>
    <link rel="stylesheet" href="css/tabla.css">
    <div class="limit" align="center">
        <br/>
        <h1 class="center-text">Buscar solicitud</h1>
        <br/>
        <form id="busqueda_form" class="form-inline">
            <div class="input-group">
                <span class="input-group-addon">Entre</span>
                <input type="text" class="form-control" id="fecha" placeholder="Primera fecha..." onkeyup=""/>
            </div>
            <div class="input-group">
                <span class="input-group-addon">Y</span>
                <input type="text" class="form-control" id="fecha2" placeholder="Segunda fecha..." onkeyup=""/>
            </div>
            <div class="input-group">
                <span class="input-group-addon">Estatus</span>
                <select class="form-control" id="estatus">
                    <option value="">- Seleccione una opción -</option>
                    <option value="0">Todos</option>
                    <option value="1">No aprobado</option>
                    <option value="2">Aprobado por el jefe inmediato</option>
                    <option value="3">Aprobado por la Secretaría Administrativa</option>
                    <option value="4">Aprobado por el Coordinador de Servicios Generales</option>
                    <option value="5">Rechazada por alguna instancia</option>
                </select>
            </div>
            <div class="input-group center-text">
                <a class="btn btn-default" href="#" id="submit">Buscar</a>
            </div>
        </form>
    </div>
    <br/>
    <div class="limit">
        <table class="table-fill" id="tabla">
            <thead>
            <tr>
                <th>Nombre del solicitante</th>
                <th>Nombre del evento</th>
                <th>Fechas de solicitud</th>
                <th>Conductor</th>
                <th>Estado</th>
                <th>Disponibilidad de Vehículo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="table" class="table-hover">

            </tbody>
        </table>
    </div>
    <br/>
    <br/>
    <script type="text/javascript">
        function valida_select() {
            var estatus = document.getElementById('estatus');
            if (estatus.value !== "" && estatus.value.length !== 0)
                generaTabla();
            else
                swal("Oops!", "Debe seleccionar el estatus.", "error");
        }

        $("#fecha").datepicker({ dateFormat: "dd-mm-yy" });
        $("#fecha2").datepicker({ dateFormat: "dd-mm-yy" });

        $(document).ready(generaTabla());
        $("#submit").click(function (event) {
            event.preventDefault();
            valida_select();
        });

        function generaTabla() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });

            $.ajax({
                data: {
                    "fecha" : $("#fecha").val(),
                    "fecha2" : $("#fecha2").val(),
                    "estatus" : $("#estatus").val()
                },
                type: 'post',
                url: '{{ route('searching_request') }}',
                success:function (response) {
                    $('#table').html(response);
                }
            });
        }
    </script>
@stop