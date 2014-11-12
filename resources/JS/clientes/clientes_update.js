$(".addTelefono").click(function(){
	addTelefono();
});

$(".addCorreo").click(function(){
	addCorreo();
});

$(document).on("click",".enableButton",function(e){
	$("[disabled='disabled']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});
/*
 * valida el formulario
 */
function validarForm(){
	var continuar=true;
	//valida el nombre
	if(isTexto($("input[name='nombre']").val())){
		$("input[name='nombre']").parent().removeClass("has-error");
	}else{
		$("input[name='nombre']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida el rfc
	if(isVacio($("input[name='rfc']").val())){
		$("input[name='rfc']").parent().removeClass("has-error");
	}else if(isRfc($("input[name='rfc']").val())){
		$("input[name='rfc']").parent().removeClass("has-error");
	}else{
		$("input[name='rfc']").parent().addClass("has-error");
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
	if(isNumero($("input[name='dir_num_ext']").val())){
		$("input[name='dir_num_ext']").parent().removeClass("has-error");
	}else{
		$("input[name='dir_num_ext']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida dir_num_int
	if(isVacio($("input[name='dir_num_int']").val())){
		$("input[name='dir_num_int']").parent().removeClass("has-error");
	}else if(isNumero($("input[name='dir_num_int']").val())){
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
$(document).on("click",".updateButton",function(){
	if(validarForm()){
		
	var formSer=$("#form_cliente").serialize();
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
			data:formSer.toUpperCase(),
			url:SERVER_URL_BASE+"clientes/cClientes/updateCliente",
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
					alert("El cliente se actializó correctamente");
				}else{
					alert("Ocurrio un error: "+msg);
				}
			}

		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar el usuario?")){
		$.ajax({
			data:"CLI_ID="+$("input[name='cli_id']").val(),
			url:SERVER_URL_BASE+"clientes/cClientes/deleteCliente",
			method:"POST",
			success: function(msg){
				var resp=msg.split(";");
				if(resp[0].trim()=="SUCCESS"){
				alert("Cliente eliminado correctamente");
				window.location=SERVER_URL_BASE+"clientes/cClientes/formSelectCliente";
				}else{
					alert("Ocurrio un error: "+msg);
				}
			}
		});
	}
});

function addTelefono(){
	var tel_table="";
	tel_table="<tr><td>";
	tel_table=tel_table+"<label for=\'tel_num\'>Teléfono: </label>";
	tel_table=tel_table+"</td><td><input type=\'text\' name=\'tel_num\' value=\'\' class=\'telefono\' placeholder=\'Teléfono\'  />";
	tel_table=tel_table+"</td></tr>";
	
	$("input[name=\'tel_num\']:last").parent().parent().before(tel_table);
}

function addCorreo(){
	var corr_table="";
	corr_table+="<tr><td>";
	corr_table+="<label for=\'corr_correo\'>Correo: </label>";
	corr_table+="</td><td><input type=\'text\' name=\'corr_correo\' value=\'\' class=\'correo\' placeholder=\'Correo\'  />";
	corr_table+="</td></tr>";
	
	$("input[name=\'corr_correo\']:last").parent().parent().before(corr_table);
}

function insertCliente(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}