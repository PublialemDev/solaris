
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	
	var formSer=$("#form_tipousuarios").serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"usuarios/ctipousuarios/updateTipoUsuarios",
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
	if(confirm("seguro que deseas eliminar este tipo de usuario ?")){
		$.ajax({
			data:"idTipoUsuario="+$("input[name=\'idTipoUsuario\']").val(),
			url:SERVER_URL_BASE+"usuarios/ctipousuarios/deleteTipoUsuarios",
			method:"POST",
			success: function(msg){
				alert("Categoria eliminada correctamente: "+msg);
				window.locationf=SERVER_URL_BASE+"usuarios/ctipousuarios/formSelectTipoUsuarios";
			}
		});
	}
});


function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}