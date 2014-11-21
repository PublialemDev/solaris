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
	if(isNumeroFlotante($("input[name='prod_precio']").val())){
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

$(document).on("click",".enableButton",function(e){
	$("[disabled='disabled']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

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
	
$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar el producto?")){
		$.ajax({
			data:"PROD_ID="+$("input[name='prod_id']").val(),
			url:SERVER_URL_BASE+"productos/cproductos/deleteProducto",
			method:"POST",
			success: function(msg){
				var resp=msg.split(";");
				if(resp[0].trim()=="SUCCESS"){
					alert("Producto eliminado correctamente");
					window.location=SERVER_URL_BASE+"productos/cproductos/selectProductosForm";
				}else{
					alert("Ocurrio un error: "+msg);
				}
			}
		});
	}
});