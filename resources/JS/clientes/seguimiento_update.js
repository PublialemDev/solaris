
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	
	var formSer=$("#form_segui").serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"clientes/cseguimiento/updateSeguimiento",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			alert(msg);
			$(".updateButton").html("Editar");
			$(".updateButton").removeClass("updateButton").addClass("enableButton");
			$("input").attr("disabled","disabled");
			$("textarea").attr("disabled","disabled");
			$("select").attr("disabled","disabled");
		}
	});
});

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar este seguimiento?")){
		$.ajax({
			data:"idSeguimiento="+$("input[name=\'idSeguimiento\']").val(),
			url:SERVER_URL_BASE+"clientes/cseguimiento/deleteSeguimiento",
			method:"POST",
			success: function(msg){
				alert("Seguimiento eliminado correctamente: "+msg);
				window.location=SERVER_URL_BASE+"clientes/cseguimiento/formSelectSeguimiento";
			}
		});
	}
});


function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}