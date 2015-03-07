function validarForm(){
	var continuar=true;
	
	if(isNumero($("input[name='idRemision']").val())){
		$("input[name='idRemision']").parent().removeClass("has-error");
	}else{
		$("input[name='idRemision']").parent().addClass("has-error");
		continuar=false;
	}
	return continuar;
}

	
	//validar si existe la remision
function remisionExists(){
	var continuar=true;
	$.ajax({
		data:'rem_id='+$("input[name='idRemision']").val(),
		url:SERVER_URL_BASE+"reportes/cremisionnote/remisionExists",
		method:'POST',
		async:false,
		success: function(msg){
			if(msg=="EXISTS"){
				$('#alert').removeClass("alert alert-danger").addClass("alert alert-success").attr("role","alert").children("span").html('<strong>Remisión creada correctamente</strong>');;
			}else if(msg=="NOT_EXISTS"){
				$('#alert').removeClass("alert alert-success").addClass("alert alert-danger").attr("role","alert").children("span").html('<strong>La remisión no existe</strong>');
				continuar=false;
			}else{
				alert('Ocurrió un error');
			}
		}
	});
		
	return continuar;
}

$(document).on("click",".enviarButton",function(){	
	if(validarForm()){	
		
		remisionExists()?$("#form_reminote").submit(): '' ;
		
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});
