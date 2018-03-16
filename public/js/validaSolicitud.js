function validar() {
    var confEvent = document.getElementsByName("rdio_evt");
    var radioEvent = false;
    for (var i = 0; i<confEvent.length; i++) {
        if (confEvent[i].checked) {
            radioEvent = true;
            var categoria = document.getElementById("eventoT_slc").value;
            break;
        }
    }
    var nombreE = document.getElementById("txt_nombreE").value;
    var domicilioE = document.getElementById("txt_domicilioE").value;

    if (!radioEvent){
        alert("por favor seleccione el tipo de evento");
        document.getElementById("rdio1").focus();
        return false;
    }else if (nombreE.length == 0 || nombreE == null || /^\s+$/.test(nombreE)) {
        alert("Favor de escribir el nombre del evento");
        document.getElementById("txt_nombreE").focus();
        return false;
    }else if (domicilioE.length == 0 || domicilioE == null || /^\s+$/.test(domicilioE)){
        alert("Favor de escribir el domicilio del evento");
        document.getElementById("txt_domicilioE").focus();
        return false;
    }else if (categoria == 14 || categoria == 22 || categoria == 29){
        var otroEvento = document.getElementById("otro_evento").value; //otro_evento es el campo oculto
        if(otroEvento.length == 0 || otroEvento == null || /^\s+$/.test(otroEvento)){
            alert("Favor de escribir el otro tipo de evento");
            document.getElementById("otro_evento").focus();
            return false;
        }else return continuacion();
    }else return continuacion();
}
function continuacion() {
    var personas = document.getElementById("txt_Personas").value;
    var km = document.getElementById("txt_kilometros").value;
    var fechaE = document.getElementById("fecha_txt").value;
    var fechaR = document.getElementById("fecha1_txt").value;
    var nombreCont = document.getElementById("nombreCont_txt").value;
    var parentesco = document.getElementById("parentesco_txt").value;
    var domicilioCont = document.getElementById("domicilio_txt").value;
    var telCont = document.getElementById("telefono_txt").value;
    var codigoC = document.getElementById("codigoC_txt").value;
    var nombreC = document.getElementById("nombreC_txt").value;
    var celC = document.getElementById("celularC_txt").value;
    var licC = document.getElementById("licencia_txt").value;
    var fechaV = document.getElementById("venc_txt").value;
    if (personas <= 0|| personas == null || personas.length == 0 || !/^\d*$/.test(personas)){
        alert("Favor de escribir un número correcto de personas");
        document.getElementById("txt_Personas").focus();
        return false;
    }else if (!/^(\d)+((\.)(\d){1,2})?$/.test(km) || km <= 0|| km == null || km.length == 0){
        alert("Favor de escribir el número de kilometros a trasladarse");
        document.getElementById("txt_kilometros").focus();
        return false;
    }else if (fechaE.length == 0 || fechaE == null || /^\s+$/.test(fechaE)){
        alert("Favor de escribir la fecha del evento");
        document.getElementById("fecha_txt").focus();
        return false;
    }else if (fechaR.length == 0 || fechaR == null || /^\s+$/.test(fechaR)){
        alert("Favor de escribir la fecha de regreso");
        document.getElementById("fecha1_txt").focus();
        return false;
    }else if (codigoC <= 0|| codigoC == null || codigoC.length == 0 || !/^\d*$/.test(codigoC)) {
        alert("Favor de escribir el código del chofer \"solo números (sin espacios ni guiones)\"");
        document.getElementById("codigoC_txt").focus();
        return false;
    }else if (nombreC.length == 0 || nombreC == null || /^\s+$/.test(nombreC)){
        alert("Favor de escribir el domicilio del chofer");
        document.getElementById("nombreC_txt").focus();
        return false;
    }else if (celC <= 0|| celC == null || celC.length == 0 || !/^\d*$/.test(celC)) {
        alert("Favor de escribir el número celular del chofer \"solo números (sin espacios ni guiones)\"");
        document.getElementById("celularC_txt").focus();
        return false;
    }else if (licC.length == 0 || licC == null || /^\s+$/.test(licC)){
        alert("Favor de escribir la licencia del chofer");
        document.getElementById("licencia_txt").focus();
        return false;
    }else if (fechaV.length == 0 || fechaV == null || /^\s+$/.test(fechaV)){
        alert("Favor de escribir la licencia del chofer");
        document.getElementById("venc_txt").focus();
        return false;
    }else if (nombreCont.length == 0 || nombreCont == null || /^\s+$/.test(nombreCont)){
        alert("Favor de escribir el nombre del contacto de emergencia");
        document.getElementById("nombreCont_txt").focus();
        return false;
    }else if (parentesco.length == 0 || parentesco == null || /^\s+$/.test(parentesco)){
        alert("Favor de escribir el parentesco con el contacto de emergancia");
        document.getElementById("parentesco_txt").focus();
        return false;
    }else if (domicilioCont.length == 0 || domicilioCont == null || /^\s+$/.test(domicilioCont)){
        alert("Favor de escribir el domicilio del contacto de emergancia");
        document.getElementById("domicilio_txt").focus();
        return false;
    }else if (telCont <= 0|| telCont == null || telCont.length == 0 || !/^\d*$/.test(telCont)) {
        alert("Favor de escribir el telefono del contacto de emergancia \"solo números (sin espacios ni guiones)\"");
        document.getElementById("telefono_txt").focus();
        return false;
    }else{
        return true;
    }
}