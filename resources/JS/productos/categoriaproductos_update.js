
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	
	var formSer=$("#form_catproducto").serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"productos/cCategoriaProductos/updateCategoriaProductos",
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
});

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar esta categoria?")){
		$.ajax({
			data:"idCatProducto="+$("input[name=\'idCatProducto\']").val(),
			url:SERVER_URL_BASE+"productos/ccategoriaproductos/deleteCategoriaProductos",
			method:"POST",
			success: function(msg){
				alert("Categoria eliminada correctamente: "+msg);
				window.locationf=SERVER_URL_BASE+"productos/ccategoriaproductos/formSelectCategoriaProductos";
			}
		});
	}
});


function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}