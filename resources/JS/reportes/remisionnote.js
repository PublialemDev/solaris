function validarForm(){
	var continuar=true;
	
	if(isNumero($("input[name='num_remision']").val())){
		$("input[name='num_remision']").parent().removeClass("has-error");
	}else{
		$("input[name='num_remision']").parent().addClass("has-error");
		continuar=false;
	}	

	return continuar;
}

$(document).on("click",".enviarButton",function(){	
	if(validarForm()){		
		var formSer=$("#form_reminote").serialize();
		window.location.href = SERVER_URL_BASE+"reportes/cremisionnote/generarPDF?"+formSer;
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
}