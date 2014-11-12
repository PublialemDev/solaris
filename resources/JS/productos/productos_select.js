function selectProductos(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"productos/cproductos/selectProductoJson",
		method:"POST",
		beforeSend:function(){/*alert("Enviando...");*/},
		success: function(msg){
			var tableStructure;
			if(msg.trim()!="NO_DATA_FOUND"){
				var table=$.parseJSON(msg);
				tableStructure="";
				$.each(table,function(index){
					tableStructure+="<tr id=\'"+table[index].prod_id+"\'>";
					tableStructure+="<td>"+table[index].prod_id+"</td>";
					tableStructure+="<td>"+table[index].prod_cat+"</td>";
					tableStructure+="<td>"+table[index].prod_nombre+"</td>";
					tableStructure+="<td>"+table[index].prod_desc+"</td>";
					tableStructure+="<td>"+table[index].prod_precio+"</td>";
					tableStructure+="<td>"+table[index].prod_proveedor+"</td>";
					tableStructure+="<td>"+table[index].prod_estatus+"</td>";
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
		if (confirm("¿seguro que desea editar el Cliente?")){
			//window.location.href = SERVER_URL_BASE+"clientes/cClientes/formUpdateCliente?id_cliente="+$(this).attr("id");
		}
	}
});