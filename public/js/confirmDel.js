function confirmDel(url) {
	if (!confirm("Estas seguro de que deseas eliminar el registro?")) {
		return false;
	}else{
		document.location=url;
		return true;
	}
}
function confirmMod() {
	if (confirm("Realmente deseas cambiar las fechas del evento?\n\nEl proceso para aprobar la solicitud volverá a su estado inicial...")) {
		document.getElementById('solicitud_frm').submit();
	}
}
window.onload= function () {
	document.getElementById('dateHist').onclick=confirmMod;
}