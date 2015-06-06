$(".addTelefono").click(function(){
	addTelefono();
});

function removeTelefono(btn){
	$(btn).parent().parent().parent().remove();
}

$(".addCorreo").click(function(){
	addCorreo();
});

function removeCorreo(btn){
	$(btn).parent().parent().parent().remove();
}
/*
 * valida el formulario
 */
function validarForm(){
	var continuar=true;
	//valida el nombre
	if(isNombre($("input[name='nombre']").val())){
		$("input[name='nombre']").parent().removeClass("has-error");
	}else{
		$("input[name='nombre']").parent().addClass("has-error");
		continuar=false;
	}
	

	if(!isVacio($("input[name='password']").val())){
		$("input[name='password']").parent().removeClass("has-error");
	}else{
		$("input[name='password']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida dir_calle
	if(!isVacio($("input[name='dir_calle']").val())){
		$("input[name='dir_calle']").parent().removeClass("has-error");
	}else{
		$("input[name='dir_calle']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida dir_num_ext
	if(isNumeroLetraGuion($("input[name='dir_num_ext']").val())){
		$("input[name='dir_num_ext']").parent().removeClass("has-error");
	}else{
		$("input[name='dir_num_ext']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida dir_num_int
	if(isVacio($("input[name='dir_num_int']").val())){
		$("input[name='dir_num_int']").parent().removeClass("has-error");
	}else if(isNumeroLetraGuion($("input[name='dir_num_int']").val())){
		$("input[name='dir_num_int']").parent().removeClass("has-error");
	}else{
		$("input[name='dir_num_int']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida dir_col
	if(isTexto($("input[name='dir_col']").val())){
		$("input[name='dir_col']").parent().removeClass("has-error");
	}else{
		$("input[name='dir_col']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida dir_muni
	if(isTexto($("input[name='dir_muni']").val())){
		$("input[name='dir_muni']").parent().removeClass("has-error");
	}else{
		$("input[name='dir_muni']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida dir_cp
	if(isCodigoPostal($("input[name='dir_cp']").val())){
		$("input[name='dir_cp']").parent().removeClass("has-error");
	}else{
		$("input[name='dir_cp']").parent().addClass("has-error");
		continuar=false;
	}
	
	$(".telefono").each(function (index){
		//valida .telefono
		if(isNumero($(this).val())){
			$(this).parent().removeClass("has-error");
		}else{
			$(this).parent().addClass("has-error");
			continuar=false;
		}
	});

	$(".correo").each(function (index){
		//valida .correo
		if(isEmail($(this).val())){
			$(this).parent().removeClass("has-error");
		}else{
			$(this).parent().addClass("has-error");
			continuar=false;
		}
	});
	
	return continuar;
}

/*
 *Guarda los datos al hacer clic en el boton
 * */
$(document).on("click",".enviarButton",function(){
	if(validarForm()){
		
		var formSer=$("#form_usr").serialize();
		formSer+="&"+$("#form_dir").serialize();
		
		var telSer="&tel_num=";
		$(".telefono").each(function (index){
			telSer+=$(this).val()+"#";
		});
		
		var corrSer="&corr_correo=";
		$(".correo").each(function (index){
			corrSer+=$(this).val()+"#";
		});
		
		formSer+=telSer+corrSer;
			$.ajax({
			data:formSer,
			url:SERVER_URL_BASE+"usuarios/cusuarios/insertUsuarios",
			method:"POST",
			beforesend:function(){alert(formSer);},
			success: function(msg){
				var resp=msg.split(";");
				if(resp[0].trim()=="SUCCESS"){
					$("input").attr("disabled","disabled");	
					$("input[name='usr_id']").val(resp[1]);
					$("button[name='enviar']").html("Editar");
					$("button[name='enviar']").removeClass("enviarButton").addClass("enableButton");
					$("input").attr("disabled","disabled");
					$(".addCorreo").attr("disabled","disabled");
					$(".addTelefono").attr("disabled","disabled");
					$("select").attr("disabled","disabled");
					$("textarea").attr("disabled","disabled");
					alert("El usuario se creo correctamente");
				}else{
					alert("Ocurrio un error: "+msg);
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
	$(this).removeClass("enableButton").addClass("updateButton");
});

//actualiza el registro
$(document).on("click",".updateButton",function(){
	if(validarForm()){
	var formSer=$("#form_usr").serialize();
	formSer+="&"+$("#form_dir").serialize();

	var telSer="&tel_num=";
	$(".telefono").each(function (index){
		telSer+=$(this).val()+"#";
	});

	var corrSer="&corr_correo=";
	$(".correo").each(function (index){
		corrSer+=$(this).val()+"#";
	});

	formSer+=telSer+corrSer;
		$.ajax({
			data:formSer,
			url:SERVER_URL_BASE+"usuarios/cusuarios/updateUsuarios",
			method:"POST",
			beforesend:function(){alert(formSer);},
			success: function(msg){
				var resp=msg.split(";");
				if(resp[0].trim()=="SUCCESS"){
					$(".updateButton").html("Editar");
					$(".updateButton").removeClass("updateButton").addClass("enableButton");
					$("input").attr("disabled","disabled");
					$(".addCorreo").attr("disabled","disabled");
					$(".addTelefono").attr("disabled","disabled");
					$("select").attr("disabled","disabled");
					$("textarea").attr("disabled","disabled");
					alert("El usuario se actualizó correctamente");
				}else{
						alert("Ocurrio un error: "+msg);
				}
			}
		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

function addTelefono(){
	var tel_table="";
	tel_table="<tr><td><div class='form-group'>";
	tel_table=tel_table+"<label for='tel_num' class='control-label'>Teléfono: </label>";
	tel_table=tel_table+"<button class='btn btn-default btn-xs' onClick='removeTelefono(this)' style='float:right'>X</button>";
	tel_table=tel_table+"<input type='text' name='tel_num' value='' class='telefono form-control' placeholder='Teléfono'  />";
	tel_table=tel_table+"</div></tr>";
	
	$("input[name='tel_num']:first").parent().parent().parent().before(tel_table);
}

function addCorreo(){
	var corr_table="";
	corr_table+="<tr><td><div class='form-group'>";
	corr_table+="<button class='btn btn-default btn-xs' onClick='removeCorreo(this)'  style='float:right'>X</button>";
	corr_table+="<label for='corr_correo' class='control-label'>Correo: </label>";
	corr_table+="<input type='text' name='corr_correo' value='' class='correo form-control' placeholder='Correo'  />";
	corr_table+="</div></tr>";
	
	$("input[name='corr_correo']:first").parent().parent().parent().before(corr_table);
}

function insertUsuarios(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}