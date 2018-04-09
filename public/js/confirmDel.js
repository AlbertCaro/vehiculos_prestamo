function confirmDelete() {
    confirmar = confirm("¿Está seguro que desea eliminar el registro?");
    if (confirmar) {
        return true;
    } else {
        return false;
    }
}

/*
function confirmMod() {
	if (confirm("Realmente deseas cambiar las fechas del evento?\n\nEl proceso para aprobar la solicitud volverá a su estado inicial...")) {
		document.getElementById('solicitud_frm').submit();
	}
}

window.onload= function () {
	document.getElementById('dateHist').onclick=confirmMod;
}
*/