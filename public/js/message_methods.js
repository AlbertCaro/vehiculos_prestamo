/**
 * Función para comenzar a ocultar el div de mensaje cuando la página esté lista

$(document).ready(function () {
    window.setTimeout("fadeMessage();", 3000);
});
*/
function fadeMessage() {
    $("#message").fadeOut('slow');
}

/**
 * Recibe el id del input, para así determinar el div que se ocultará al hacer focus en el input
 * @param field El id
 */
function hideError(field) {
    $("#error_"+field).fadeOut('fast');
}

/**
 * Función para mostrar el mensaje de confirmación de eliminación.
 * @param message Texto del mensaje
 * @param id Id del form del metodo destroy del controlador, dado que se requiere dicho formulario para eliminar
 */

function deleteElement(message, id, event) {
    event.preventDefault();

    swal({
        title: 'Atención',
        text: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33333',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }, function() {
        document.getElementById(id).submit();
    });
}

function cancelElement(message, url, event) {
    event.preventDefault();

    swal({
        title: 'Atención',
        text: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33333',
        confirmButtonText: 'Sí, cancelarla',
        cancelButtonText: 'Regresar'
    }, function() {
        window.location.href=url;
    });
}