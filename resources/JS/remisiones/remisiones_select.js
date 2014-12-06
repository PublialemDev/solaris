function selectRemisiones(form,evt){
			evt.preventDefault();
			var formSer=$(form).serialize();
			
			$.ajax({
				data:formSer,
				url:SERVER_URL_BASE+"remisiones/cremisiones/selectRemisionesJson",
				method:"POST",
				success: function(msg){
					var tableStructure;
					if(msg.trim()!="NO_DATA_FOUND"){
						var table=$.parseJSON(msg);
						tableStructure="";
						$.each(table,function(index){
							tableStructure+="<tr id='"+table[index].rem_id+"'>";
							tableStructure+="<td>"+table[index].rem_id+"</td>";
							tableStructure+="<td>"+table[index].cli_id+"</td>";
							tableStructure+="<td>"+table[index].suc_id+"</td>";
							tableStructure+="<td>"+table[index].tipopago_id+"</td>";
							tableStructure+="<td>"+table[index].rem_fecha+"</td>";
							tableStructure+="<td>"+table[index].rem_instalacion+"</td>";
							tableStructure+="<td>"+table[index].rem_total+"</td>";
							tableStructure+="<td>"+table[index].rem_iva+"</td>";
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
				if (confirm("¿Seguro que desea editar el tipo de pago?")){
					window.location.href = SERVER_URL_BASE+"remisiones/cremisiones/formUpdateRemision?id_Remision="+$(this).attr("id");
				}
			}
		});