function validarForm(){
	var continuar=true;
	
	/*if(isNumero($("input[name='cliente_txt']").val())){
		$("input[name='cliente_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='cliente_txt']").parent().addClass("has-error");
		continuar=false;
	}	*/		
	
	if(!isVacio($("input[name='fecha_txt']").val())){
		$("input[name='fecha_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='fecha_txt']").parent().addClass("has-error");
		continuar=false;
	}	
	
	return continuar;
}
		
		
$(document).on("click",".enviarButton",function(){
	if(validarForm()){		
		var formSer=$("#form_segui").serialize();
					
		$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"clientes/cseguimiento/getValues",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				$("input").attr("disabled","disabled");	
				$("textarea").attr("disabled","disabled");
				$("select").attr("disabled","disabled");
				$("input[name='idSeguimiento']").val(resp[1]);
				$("button[name='enviar']").html("Editar");
				$("button[name='enviar']").removeClass("enviarButton").addClass("enableButton");
				alert("El seguimiento se creo correctamente.");					
			}else{
				alert(msg);
			}
		}

	});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});
		
//habilitara el formulario
$(document).on("click",".enableButton",function(){
	$("[disabled='disabled']").removeAttr("disabled");
	$("input[name='cliente_txt']").attr("disabled","disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton");
	$(this).addClass("updateButton");
});

//actualiza el registro
$(document).on("click",".updateButton",function(){
	if(validarForm()){
	var formSer=$("#form_segui").serialize();
	
		$.ajax({
			data:formSer.toUpperCase(),
			url:SERVER_URL_BASE+"clientes/cseguimiento/updateSeguimiento",
			method:"POST",
			success: function(msg){
				var resp=msg.split(";");
				if(resp[0].trim()=="SUCCESS"){
				$(".updateButton").html("Editar");
				$(".updateButton").removeClass("updateButton").addClass("enableButton");
				$("input").attr("disabled","disabled");
				$("textarea").attr("disabled","disabled");
				$("select").attr("disabled","disabled");
				alert("El seguimiento se actualizó correctamente.");					
				}else{
					alert(msg);
				}
			}

		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

/*function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}*/

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
 $.datepicker.setDefaults($.datepicker.regional['es']);
$( document ).ready(function(){
	$("#fecha_txt").datepicker({ dateFormat: "yy-mm-dd" });
});
