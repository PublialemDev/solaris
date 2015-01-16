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

$(document).on("click",".enviarButton",function(){	
	if(validarForm()){		
		$("#form_reminote").submit();
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});
