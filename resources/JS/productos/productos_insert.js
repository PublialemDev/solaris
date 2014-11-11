/*
 * valida el formulario
 */
function validarForm(){
	var continuar=true;
	//valida el prod_nombre
	if(isTexto($("input[name='prod_nombre']").val())){
		$("input[name='prod_nombre']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_nombre']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida el prod_precio
	if(isNumero($("input[name='prod_precio']").val())){
		$("input[name='prod_precio']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_precio']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida prod_proveedor
	if(isTexto($("input[name='prod_proveedor']").val())){
		$("input[name='prod_proveedor']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_proveedor']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida prod_categoria
	if($("input[name='prod_categoria']").val()!='0'){
		$("input[name='prod_categoria']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_categoria']").parent().addClass("has-error");
		continuar=false;
	}
	
	return continuar;
}


/*
 *Guarda los datos al hacer clic en el boton
 * */
$(document).on("click",".enviarButton",function(){
	if(validarForm()){
		
		var formSer=$("#form_producto").serialize();
		$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"productos/cproductos/insertProducto",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				$("input").attr("disabled","disabled");	
				$("input[name='cli_id']").val(resp[1]);
				$("button[name='enviar']").html("Editar");
				$("button[name='enviar']").removeClass("enviarButton").addClass("enableButton");
				$("input").attr("disabled","disabled");
				$(".addCorreo").attr("disabled","disabled");
				$(".addTelefono").attr("disabled","disabled");
				$("select").attr("disabled","disabled");
				alert("El cliente se creo correctamente");
			}else{
				alert("Ocurrio un error: "+msg);
			}
		}

	});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

/*
//habilitara el formulario
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

//actualiza el registro
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
					alert("El cliente se actualizó correctamente");
				}else{
						alert("Ocurrio un error: "+msg);
				}
			}
		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});*/