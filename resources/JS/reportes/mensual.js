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

$(document).on("click",".enviarButton",function(){
	$("#fecha_ini").datepicker("option", "dateFormat", "yy-mm-dd" );
	$("#fecha_fin").datepicker("option", "dateFormat", "yy-mm-dd" );
	if(validarForm()){		
		var formSer=$("#form_mensual").serialize();
		window.location.href = SERVER_URL_BASE+"reportes/cmensual/reporteMensual?"+formSer;
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
}

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
		
