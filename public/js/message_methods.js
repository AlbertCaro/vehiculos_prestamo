$(document).ready(function () {
    window.setTimeout("fadeMessage();", 1500);
});

function fadeMessage() {
    $("#message").fadeOut('slow');
}

function hideError(field) {
    $("#error_"+field).fadeOut('fast');
}

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
    }).then(function() {
        document.getElementById(id).submit();
    });
}

$(document).ready(function () {
    window.setTimeout("generarSelect();", 0);
});