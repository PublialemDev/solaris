//agrega una marca a el cliente seleccionado y muestra el boton de seguimiento
$(document).on("click","#target .datos tbody tr", function(){
	if( ($(this).attr("id")!=null) && ($(this).attr("id")!="")){
		$("tr[class='info']").removeClass("info");
		$(this).addClass("info");
		$(".seguimientoButton").css("display","block");
	}
});

//redirecciona a la vista que contiene el seguimeinto del cliente
function mostrarSeguimiento(){
	var idCliente=$("#target .datos tbody tr[class='info']").attr("id");
	window.location = SERVER_URL_BASE+"clientes/cseguimiento/formSelectSeguimiento?idCliente="+idCliente;
}
//
function selectCliente(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"clientes/cClientes/selectClienteJson",
		method:"POST",
		beforeSend:function(){/*alert("Enviando...");*/},
		success: function(msg){
			var tableStructure;
			if(msg.trim()!="NO_DATA_FOUND"){
				var table=$.parseJSON(msg);
				tableStructure="";
				$.each(table,function(index){
					tableStructure+="<tr id=\'"+table[index].id+"\'>";
					tableStructure+="<td>"+table[index].id+"</td>";
					tableStructure+="<td>"+table[index].nombre+"</td>";
					tableStructure+="<td>"+table[index].rfc+"</td>";
					tableStructure+="</tr>";
				});
				//$("#target").children("table").addClass(".datos");
			}else{
				tableStructure="<tr><td>No se encontraron coincidencias</td></tr>";
				
				//$("#target").children("table").removeClass(".datos");
			}
			$("#target tbody").html(tableStructure);
		}

	});
}
		
$("#target").on("dblclick",".datos tbody tr", function(){
	if( ($(this).attr("id")!=null) && ($(this).attr("id")!="")){
		if (confirm("¿seguro que desea editar el Cliente?")){
			window.location = SERVER_URL_BASE+"clientes/cClientes/formUpdateCliente?id_cliente="+$(this).attr("id");
		}
	}
});