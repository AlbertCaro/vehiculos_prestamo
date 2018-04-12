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
    if (confirm(message))
        document.getElementById(id).submit();
}