/*
 * valida el formulario
 */
function validarForm(){
	var continuar=true;
	
	//valida el prod_nombre
	if(isNombre($("input[name='prod_nombre']").val())){
		$("input[name='prod_nombre']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_nombre']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida el prod_precio_nor
	if(isNumeroFlotante($("input[name='prod_precio_nor']").val())){
		$("input[name='prod_precio_nor']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_precio_nor']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida el prod_precio_adv
	if(isNumeroFlotante($("input[name='prod_precio_adv']").val())){
		$("input[name='prod_precio_adv']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_precio_adv']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida el prod_precio_pre
	if(isNumeroFlotante($("input[name='prod_precio_pre']").val())){
		$("input[name='prod_precio_pre']").parent().removeClass("has-error");
	}else{
		$("input[name='prod_precio_pre']").parent().addClass("has-error");
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
				$("input[name='prod_id']").val(resp[1]);
				$("button[name='enviar']").html("Editar");
				$("button[name='enviar']").removeClass("enviarButton").addClass("enableButton");
				$("input").attr("disabled","disabled");
				$("textarea").attr("disabled","disabled");
				$("select").attr("disabled","disabled");
				alert("El producto se creo correctamente");
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
	$("[disabled='disabled']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

//actualiza el registro
$(document).on("click",".updateButton",function(){
	if(validarForm()){
		var formSer=$("#form_producto").serialize();
	
		$.ajax({
			data:formSer.toUpperCase(),
			url:SERVER_URL_BASE+"productos/cproductos/updateProducto",
			method:"POST",
			beforesend:function(){alert(formSer);},
			success: function(msg){
				var resp=msg.split(";");
				if(resp[0].trim()=="SUCCESS"){
					$(".updateButton").html("Editar");
					$(".updateButton").removeClass("updateButton").addClass("enableButton");
					$("input").attr("disabled","disabled");
					$("textarea").attr("disabled","disabled");
					$("select").attr("disabled","disabled");
					alert("El producto se actualizó correctamente");
				}else{
						alert("Ocurrio un error: "+msg);
				}
			}
		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});