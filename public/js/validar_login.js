function valida_Registro_usuario() {
    var Codigo = document.getElementById("txt_codigo").value;
    var Password = document.getElementById("txt_pass").value;
    var Nombre = document.getElementById("txt_nombre").value;
    var Cargo = document.getElementById("txt_cargo").value;
    var Celular = document.getElementById("txt_celular").value;
    var Correo = document.getElementById("txt_email").value;

    if (Codigo == null || Codigo.length === 0 || /^\s+$/.test(Codigo)){
        alert("Favor de ingresar su código");
        document.getElementById("txt_codigo").focus();
        return false;
    }else if (Password == null || Password.length === 0 || /^\s+$/.test(Password)){
        alert("Favor de ingresar su contraseña");
        document.getElementById("txt_pass").focus();
        return false;
    }else if (Nombre == null || Nombre.length === 0 || /^\s+$/.test(Nombre)) {
        alert("Favor de ingresar su nombre completo");
        document.getElementById("txt_nombre").focus();
        return false;
    }else if (Cargo == null || Cargo.length === 0 || /^\s+$/.test(Cargo)) {
        alert("Favor de ingresar el cargo que desempeña");
        document.getElementById("txt_cargo").focus();
        return false;
    }else if (Celular == null || Celular.length === 0 || /^\s+$/.test(Celular)) {
        alert("Favor de ingresar su número de celular");
        document.getElementById("txt_celular").focus();
        return false;
    }else if (Correo == null || Correo.length === 0 || /^\s+$/.test(Correo)) {
        alert("Favor de ingresar su correo electrónico");
        document.getElementById("txt_pass").focus();
        return false;
    }
    return true;
}
function validaLogin() {
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;

    if (user == null || user.length ===0 || /^\s+$/.test(user)){
        alert("Favor de ingresar su código");
        document.getElementById("user").focus();
        return false;
    }else if (pass == null || pass.length === 0 || /^\s+$/.test(pass)){
        alert("Favor de ingresar su contraseña");
        document.getElementById("pass").focus();
        return false;
    }
    return true;
}

function validaSoloNumeros(e){

    key = (document.all) ? e.keyCode : e.which;
    if (key === 8) {
        return true;
    }
    var patron =/[0-9]/;
    var key_final = String.fromCharCode(key);
    return patron.test(key_final);
}

