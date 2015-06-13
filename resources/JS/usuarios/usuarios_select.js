function selectUsuarios(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"usuarios/cusuarios/selectUsuariosJson",
		method:"POST",
		beforeSend:function(){/*alert("Enviando...");*/},
		success: function(msg){
			var tableStructure;
			if(msg.trim()!="NO_DATA_FOUND"){
				var table=$.parseJSON(msg);
				tableStructure="";
				$.each(table,function(index){
					tableStructure+="<tr id=\'"+table[index].id+"\'>";
					//tableStructure+="<td>"+table[index].id+"</td>";
					tableStructure+="<td>"+table[index].nombre+"</td>";
					tableStructure+="<td>"+table[index].tipousuario+"</td>";
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
	if( ($(this).attr("id")!=null) && ($(this).attr("id")!="") && ($(this).attr("id")>=1)){
		if (confirm("¿seguro que desea editar el usuario?")){
			window.location.href = SERVER_URL_BASE+"usuarios/cusuarios/formUpdateUsuarios?id_usuario="+$(this).attr("id");
		}
	}
});