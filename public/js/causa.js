function causa() {
	var reason = prompt('Causa de rechazo');
	var cod = btoa(reason);
	var varurl = document.URL;
	var urlCompl=varurl+'&rech='+cod;
	window.location.href=urlCompl;
}