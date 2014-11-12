function selectTipoUsuarios(form,evt){
			evt.preventDefault();
			var formSer=$(form).serialize();
			
			$.ajax({
				data:formSer,
				url:SERVER_URL_BASE+"usuarios/ctipousuarios/selectTipoUsuarios",
				method:"POST",
				beforeSend:function(){/*alert("Enviando...");*/},
				success: function(msg){
					var tableStructure;
					if(msg.trim()!="NO_DATA_FOUND"){
						var table=$.parseJSON(msg);
						tableStructure="";
						$.each(table,function(index){
							tableStructure+="<tr id=\'"+table[index].id+"\'>";
							tableStructure+="<td>"+table[index].nombre+"</td>";
							tableStructure+="<td>"+table[index].descripcion+"</td>";
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
				if (confirm("¿Seguro que desea editar el tipo de usuario?")){
					window.location.href = SERVER_URL_BASE+"usuarios/ctipousuarios/formUpdateTipoUsuarios?id_tipoUsuario="+$(this).attr("id");
				}
			}
		});