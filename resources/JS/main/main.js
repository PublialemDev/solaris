function validarForm(){
	var continuar=true;
	//valida el usuario
	if(!isVacio($("input[name='usr_nombre']").val())){
		$("input[name='usr_nombre']").parent().removeClass("has-error");
	}else{
		$("input[name='usr_nombre']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida el password
	if(!isVacio($("input[name='usr_passw']").val())){
		$("input[name='usr_passw']").parent().removeClass("has-error");
	}else{
		$("input[name='usr_passw']").parent().addClass("has-error");
		continuar=false;
	}
	
	
	return continuar;
}


/*
 *Guarda los datos al hacer clic en el boton
 * */
$(document).on("click",".enviarButton",function(){
	if(validarForm()){
		
		var formSer=$("#form_login").serialize();
		$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"main/cLogin/login",
		method:"POST",
		beforesend:function(){/*alert(formSer);*/},
		success: function(msg){
			if(msg.trim()=="SUCCESS"){
				window.location=SERVER_URL_BASE+"main/cMain/main";
			}else{
				alert("El usuario o la contraseña no son correctos.");
			}
		}

	});
	}else{
		alert("Todos los campos son obligatorios.");
	}
});
