
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	
	var formSer=$("#form_catseguimiento").serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"clientes/cCategoriaSeguimiento/updateCategoriaSeguimiento",
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
			data:"idCatSeguimiento="+$("input[name=\'idCatSeguimiento\']").val(),
			url:SERVER_URL_BASE+"clientes/ccategoriaseguimiento/deleteCategoriaSeguimiento",
			method:"POST",
			success: function(msg){
				alert("Categoria eliminada correctamente: "+msg);
				window.location=SERVER_URL_BASE+"clientes/ccategoriaseguimiento/formSelectCategoriaSeguimiento";
			}
		});
	}
});


function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}