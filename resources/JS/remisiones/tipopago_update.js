function validarForm(){
	var continuar=true;
	//valida el nombre
	if(isNombre($("input[name='nombre_txt']").val())){
		$("input[name='nombre_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='nombre_txt']").parent().addClass("has-error");
		continuar=false;
	}				
	
	return continuar;
}

$(document).on("click",".enableButton",function(e){
	$("[disabled='disabled']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	if(validarForm()){	
	var formSer=$("#form_tipopago").serialize();
	
	$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"remisiones/ctipopago/updateTipoPago",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			alert(msg);
			$(".updateButton").html("Editar");
			$(".updateButton").removeClass("updateButton").addClass("enableButton");
			$("input").attr("disabled","disabled");
			$("textarea").attr("disabled","disabled");
		}
	});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar este tipo de pago ?")){
		$.ajax({
			data:"idTipoPago="+$("input[name='idTipoPago']").val(),
			url:SERVER_URL_BASE+"remisiones/ctipopago/deleteTipoPago",
			method:"POST",
			success: function(msg){
				alert("Categoria eliminada correctamente: "+msg);
				window.location=SERVER_URL_BASE+"remisiones/ctipopago/formSelectTipoPago";
			}
		});
	}
});


function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}