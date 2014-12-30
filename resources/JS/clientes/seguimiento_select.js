
function selectSeguimiento(form,evt){
			evt.preventDefault();
			var formSer=$(form).serialize();
			
			$.ajax({
				data:formSer,
				url:SERVER_URL_BASE+"clientes/cseguimiento/selectSeguimiento",
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
							tableStructure+="<td>"+table[index].cliente+"</td>";
							tableStructure+="<td>"+table[index].categoria+"</td>";
							tableStructure+="</tr>";
						});				
					}else{
						tableStructure="<tr><td>No se encontraron coincidencias</td></tr>";																
					}
					$("#target tbody").html(tableStructure);
				}

			});
		}
		
		$("#target").on("dblclick",".datos tbody tr", function(){
			if( ($(this).attr("id")!=null) && ($(this).attr("id")!="")){
				if (confirm("¿Seguro que desea editar el Seguimiento?")){
					window.location.href = SERVER_URL_BASE+"clientes/cseguimiento/formUpdateSeguimiento?id_seguimiento="+$(this).attr("id");
				}
			}
		});
		
function insertSeguimiento(){
	window.location.href = SERVER_URL_BASE+"clientes/cseguimiento/insertSeguimiento?cli_id="+$("span[name='cli_id']").text().trim()+"&cli_name="+$("span[name='cli_name']").text().trim();
}
