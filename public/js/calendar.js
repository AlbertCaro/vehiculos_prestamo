$(document).ready(function(){
    $('#venc_txt').datepicker({dateFormat: "dd-mm-yy"});
    $('#fecha_txt').datetimepicker({dateFormat:"dd-mm-yy H:i:s"});
    $('#fecha1_txt').datetimepicker({dateFormat:"dd-mm-yy H:i:s"});
    $('#vencimiento').datepicker({dateFormat: "dd-mm-yy"});
    
	$('#id').autocomplete({
		source: "/completa_solicitud",
        minLength:1,
		autoFocus:true,
        select : function(event, ui){
        	$("#codigoC_txt").val(ui.item.id);
            $("#nombreC_txt").val(ui.item.nombre);
            $("#celularC_txt").val(ui.item.celular);
            $("#licencia_txt").val(ui.item.num_licencia);
            $("#venc_txt").val(ui.item.vencimiento);
            $("#tipo_licencia").val(ui.item.tipo);
            $("#nombreCont_txt").val(ui.item.nombre_contacto);
            $("#parentesco_txt").val(ui.item.parentesco);
            $("#domicilio_txt").val(ui.item.domicilio);
            $("#telefono_txt").val(ui.item.tel_cont);
            $("#dependencia").val(ui.item.dependencia);
        }
	});
	$(function() {
		$('#busqueda_frm').submit(function(e) {
			e.preventDefault();
		})
		$("input[name='rdio_evt']").click(function(){
			var envio = $('input[name=rdio_evt]:checked').val();
			$.ajax({
				type: 'POST',
				url: 'php/buscador.php',
				data: ('rdio_buscar='+envio),
				success: function(resp){
					if (resp!="") {
						$('#resultados').html(resp);
						$('#otro').html("");
						$('#categoria_evento').html('<input type="hidden" name="categoria" value="'+envio+'"/>');
					};
				}
			})
		})
	})
});
function goBack() {
	window.history.back();
}

function otro(ultimo,element){
	if(element.selectedIndex==ultimo-1){
        console.log("Se llama a la función otro");
        document.getElementById("otro").innerHTML='<div class="input-group"><span class="input-group-addon">Especifique evento</span><input type="text" class="form-control" id="otro_evento" name="otro_evento" placeholder="Nombre del Evento" required/></div>';
	}else{
		document.getElementById("otro").innerHTML="";
	}

}