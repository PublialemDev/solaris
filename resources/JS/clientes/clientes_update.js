$(".addTelefono").click(function(){
	addTelefono();
});

$(".addCorreo").click(function(){
	addCorreo();
});

$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	
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