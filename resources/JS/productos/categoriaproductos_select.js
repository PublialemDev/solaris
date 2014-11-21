function selectCategoriaProductos(form,evt){
			evt.preventDefault();
			var formSer=$(form).serialize();
			
			$.ajax({
				data:formSer,
				url:SERVER_URL_BASE+"productos/ccategoriaproductos/selectCategoriaProductos",
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
				if (confirm("¿Seguro que desea editar la Categoria de Productos?")){
					window.location = SERVER_URL_BASE+"productos/ccategoriaproductos/formUpdateCategoriaProductos?id_categoriaProducto="+$(this).attr("id");
				}
			}
		});