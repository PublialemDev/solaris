function validarForm(){
	var continuar=true;
	
	if(!isVacio($("input[name='fecha_ini']").val())){
		$("input[name='fecha_ini']").parent().removeClass("has-error");
	}else{
		$("input[name='fecha_ini']").parent().addClass("has-error");
		continuar=false;
	}	
	
	if(!isVacio($("input[name='fecha_fin']").val())){
		$("input[name='fecha_fin']").parent().removeClass("has-error");
	}else{
		$("input[name='fecha_fin']").parent().addClass("has-error");
		continuar=false;
	}	
	
	return continuar;
}

//validar si existen valores para el reporte
function reporteVacio(){
	var continuar=true;
	$.ajax({
		data:'fecha_ini='+$("input[name='fecha_ini']").val()+'&fecha_fin='+$("input[name='fecha_fin']").val(),
		url:SERVER_URL_BASE+"reportes/cmensual/reporteVacio",
		method:'POST',
		async:false,
		success: function(msg){
			if(msg=='FALSE'){
				continuar=false;
			}
		}
	});
	return continuar;
}

$(document).on("click",".enviarButton",function(){
	$("#fecha_ini").datepicker("option", "dateFormat", "yy-mm-dd" );
	$("#fecha_fin").datepicker("option", "dateFormat", "yy-mm-dd" );
	if(validarForm()){	
		if(!reporteVacio()){
			//var formSer=$("#form_mensual").serialize();
			//window.location.href = SERVER_URL_BASE+"reportes/cmensual/reporteMensual?"+formSer;
			$("#form_mensual").submit();
			$('#alert').removeClass("alert alert-danger").addClass("alert alert-success").attr("role","alert").children("span").html('<strong>Reporte creado correctamente</strong>');
		}else{
			$('#alert').removeClass("alert alert-success").addClass("alert alert-danger").attr("role","alert").children("span").html('<strong>La remision no existe</strong>');
		}
		
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});


//agrega la propiedad datepicker a el campo de fecha
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };


$(function () {
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$("#fecha_ini").datepicker({	
		onClose: function (selectedDate) {
		$("#fecha_fin").datepicker("option", "minDate", selectedDate);
		}
		
	});
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$("#fecha_fin").datepicker({
	onClose: function (selectedDate) {
	$("#fecha_ini").datepicker("option", "maxDate", selectedDate);
	}
	});
});
		
