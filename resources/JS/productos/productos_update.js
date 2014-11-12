
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});
/*
$(document).on("click",".updateButton",function(){
	
	var formSer=$("#form_cliente").serialize();
	
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
});

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar el usuario?")){
		$.ajax({
			data:"cli_id="+$("input[name=\'cli_id\']").val(),
			url:SERVER_URL_BASE+"clientes/cClientes/deleteCliente",
			method:"POST",
			success: function(msg){
				alert("Usuario eliminado correctamente: "+msg);
				window.locationf=SERVER_URL_BASE+"clientes/cClientes/formSelectCliente";
			}
		});
	}
});*/
