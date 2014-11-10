function validarForm(){
	var continuar=true;
	//valida el nombre
	if(isTexto($("input[name='nombre_txt']").val())){
		$("input[name='nombre_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='nombre_txt']").parent().addClass("has-error");
		continuar=false;
	}				
	
	return continuar;
}
		
		
$(document).on("click",".enviarButton",function(){
<<<<<<< HEAD
	if(validarForm()){
				
=======
	if(validarForm()){		
>>>>>>> 92028022148f3277e7c76151aa78da52242f98ac
		var formSer=$("#form_catseguimiento").serialize();
					
		$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"clientes/ccategoriaseguimiento/getValues",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				$("input").attr("disabled","disabled");	
				$("textarea").attr("disabled","disabled");
				$("input[name='idCatSeguimiento']").val(resp[1]);
				$("button[name='enviar']").html("Editar");
				$("button[name='enviar']").removeClass("enviarButton").addClass("enableButton");
				alert("La categoria se creo correctamente.");					
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
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton");
	$(this).addClass("updateButton");
});

//actualiza el registro
$(document).on("click",".updateButton",function(){
	if(validarForm()){
	var formSer=$("#form_catseguimiento").serialize();
	
		$.ajax({
			data:formSer,
			url:SERVER_URL_BASE+"clientes/ccategoriaseguimiento/updateCategoriaSeguimiento",
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

function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}