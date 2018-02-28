@extends('layout')

@section('content')
    <a name="sol"></a>
        <div class="intro-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-message">
                            <h1 id="pivoteRadios">Haz una nueva solicitud</h1>
                            <form id="busqueda_form" class="form-horizontal" name="form_busqueda" action="" method="post" entype="application/x-www-form-urlencoded">
                                <h3>Tipo de evento</h3>
                                <label class='radio-inline'><input type='radio' id='rdio1' name='rdio_evt' value='1'/>Académico</label><label class='radio-inline'><input type='radio' id='rdio2' name='rdio_evt' value='2'/>Gestión </label><label class='radio-inline'><input type='radio' id='rdio3' name='rdio_evt' value='3'/>Vinculación </label>					</form>
                            <form class="form-horizontal" type="submit" id="solicitud_frm" name="frm_solicitud" action="" method="post" entype="application/x-www-form-urlencoded"><br>
                                <div class="col-lg-5 col-sm-6">
                                    <h3>Funcionario que autoriza</h3>
                                    <div class="form-group  col-centered">
                                        <select class="form-control" id="sel1" name="slc_jefe">
                                            <option value='8718288'> Víctor Manuel Castillo Girón ( Secretario Académico )</option><option value='2300087'>Francisco Guerrero Muñoz  ( Jefe de Departamento de Ciencias Sociales y Humanidades)</option><option value='2702223'>José Guadalupe Macias Barragán  ( Jefe de Departamento de Ciencias de la Salud )</option><option value='9001638'>José Guadalupe Rosas Elguera ( Director de División de Estudios Científicos y Tecnológicos )</option><option value='7816898'>José Guadalupe Salazar Estrada ( Director de División de Estudios de la Salud)</option><option value='9221425'>José Luis Ramos Quirarte  ( Jefe de Departamento de Ciencias Naturales y Exactas )</option><option value='7813406'>Luz Elena Ramírez Flores  ( Jefe de Departamento de Ciencias del Comportamiento )</option><option value='2216752'>Manuel Bernal Zepeda  ( Jefe de Departamento de Ciencias Económicas y Administrativas )</option><option value='8705631'>María Alicia Peredo Merlo ( Directora de la División de Estudios Económicos y Sociales)</option><option value='8901236'>María Isabel Arreola Caro  ( Secretario Administrativo )</option><option value='2134578'>Mario Martínez García  ( Jefe de Departamento de Ciencias Computacionales e Ingenierías )</option>							  </select>
                                    </div><br>
                                    <h3>Detalles del evento</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon">Evento</span>
                                        <input type="text" class="form-control" name="txt_nombreE" id="txt_nombreE" placeholder='Nombre del Evento' required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Domicilio</span>
                                        <input type="text" class="form-control" name="txt_domicilioE" id="txt_domicilioE" placeholder='Domicilio Completo' required/>
                                    </div><br>
                                    <div id="resultados" class="form-group  col-centered">

                                    </div><br>
                                    <div id="otro" class="form-group  col-centered">

                                    </div><br>
                                    <div id="categoria_evento" class="form-group  col-centered">

                                    </div><br>
                                    <div class="form-group  col-centered">
                                        <label for="sel3">Escala:</label>
                                        <select class="form-control" id="sel3" name="slc_escala">
                                            <option>Local</option>
                                            <option>Guadalajara</option>
                                            <option>Estatal</option>
                                            <option>Nacional</option>
                                        </select>
                                    </div>
                                    <h3>Itinerario</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon">Personas</span>
                                        <input type="text" class="form-control" name="txt_Personas" id="txt_Personas" placeholder='Numero de personas' required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Distancia</span>
                                        <input type="text" class="form-control" name="txt_kilometros" id="txt_kilometros" placeholder='Distancia dada en kilometros' required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Fecha y hora del evento</span>
                                        <input class="form-control" type="text" id="fecha_txt" name="txt_fecha" placeholder="Fecha y hora del evento" required/>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Fecha y hora de regreso</span>
                                        <input class="form-control" type="text" id="fecha1_txt" name="txt_fecha1" placeholder="Fecha y hora de regreso" required/>
                                    </div><br>
                                </div>
                                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                                    <div class="form-group  col-centered">
                                        <h3>Información sobre el conductor</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon">Código</span>
                                            <input type="text" class="form-control" id="codigoC_txt" name="txt_codigoC" placeholder="Código" required/>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Nombre</span>
                                            <input type="text" class="form-control" id="nombreC_txt" name="txt_nombreC" placeholder="Nombre" required/>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Celular</span>
                                            <input type="text" class="form-control" id="celularC_txt" name="txt_celularC" placeholder='Numero de celular' required/>
                                        </div><br>
                                        <h4>Detalles de la licencia</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">Licencia</span>
                                            <input type="text" class="form-control" id="licencia_txt" name="txt_licencia" placeholder="Numero de licencia"required/>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Fecha de vencimiento</span>
                                            <input type="text" class="form-control" id="venc_txt" name="txt_venc" placeholder="Fecha de vencimiento" required/>
                                        </div>
                                        <h5>Tipo de licencia</h5>
                                        <div class="form-group  col-centered">
                                            <select class="form-control" id="tipoL_txt" name="txt_tipoL">
                                                <option>Automovilista</option><option>Motociclista</option><option>Servicio particular</option><option>Permiso provisional de práctica B</option><option>Permiso provisional de práctica A</option><option>Duplicado</option><option>Constancia de licencia</option>								  	</select>
                                        </div><br>
                                        <h4>Contacto para casos de emergencia</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">Contacto</span>
                                            <input type="text" class="form-control" id="nombreCont_txt" name="txt_contacto" placeholder="Nombre del contacto" required/>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Parentesco</span>
                                            <input type="text" class="form-control" id="parentesco_txt" name="txt_parentesco" placeholder="Parentesco" required/>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Domicilio</span>
                                            <input type="text" class="form-control" id="domicilio_txt" name="txt_domicilio" placeholder="Domicilio completo" required/>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Teléfono</span>
                                            <input type=text class="form-control" id="telefono_txt" name="txt_telefono" placeholder="Telefono" required/>
                                        </div><br>
                                    </div>
                                </div>
                                <h3>Vehículo propio</h3>
                                <label class="radio-inline" for="rdio4"><input type="checkbox" id="rdio4" name="rdio_disp" value="1"/>En caso de no contar con la disponibilidad de un vehículo oficial, esta dispuesto a usar un vehículo propio para hacer el viaje</label><br><br>
                                <input type="submit" class="botones" id="btn_save" name="save_btn" value="Guardar" onclick="return validar()"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
@stop