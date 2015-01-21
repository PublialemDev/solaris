function validarForm(){
	var continuar=true;
	//valida el nombre
	if(isNombre($("input[name='nombre_txt']").val())){
		$("input[name='nombre_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='nombre_txt']").parent().addClass("has-error");
		continuar=false;
	}				
	
	return continuar;
}


$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	if(validarForm()){	
	var formSer=$("#form_catproducto").serialize();
	
	$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"productos/ccategoriaproductos/updateCategoriaProductos",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				$(".updateButton").html("Editar");
				$(".updateButton").removeClass("updateButton").addClass("enableButton");
				$("input").attr("disabled","disabled");
				$("textarea").attr("disabled","disabled");
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

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar esta categoria?")){
		$.ajax({
			data:"idCatProducto="+$("input[name=\'idCatProducto\']").val(),
			url:SERVER_URL_BASE+"productos/ccategoriaproductos/deleteCategoriaProductos",
			method:"POST",
			success: function(msg){
				alert("Categoria eliminada correctamente: "+msg);
				window.location=SERVER_URL_BASE+"productos/ccategoriaproductos/formSelectCategoriaProductos";
			}
		});
	}
});


function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}