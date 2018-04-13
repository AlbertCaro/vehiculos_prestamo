$(document).ready(function () {
    window.setTimeout("fadeMessage();", 1500);
});

function fadeMessage() {
    $("#message").fadeOut('slow');
}

function hideError(field) {
    $("#error_"+field).fadeOut('fast');
}

/**
 * Función para mostrar el mensaje de confirmación de eliminación.
 * @param message Texto del mensaje
 * @param id Id del form del metodo destroy del controlador, dado que se requiere dicho formulario para eliminar
 */
function deleteElement(message, id) {
    event.preventDefault();

    swal({
        title: 'Atención',
        text: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33333',
        confirmButtonText: 'Eliminar'
    }, function() {
        document.getElementById(id).submit();
    });
}

$(document).ready(function () {
    window.setTimeout("generarSelect();", 0);
});