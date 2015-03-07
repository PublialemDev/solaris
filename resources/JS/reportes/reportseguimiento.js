//prepara y muestra la ventana modal
function prepararModal(source){
	if(source=="CLIENTES"){
		var modal=$('#myModal');
		$(".modal-title").html("Búsqueda de Clientes");
		//-----------
		$.ajax({
			data:'',
			url:SERVER_URL_BASE+"remisiones/cremisiones/modalClientes",
			method:"POST",
			success: function(msg){
					$(".modal-dialog").removeClass('modal-lg');
					$(".modal-body").html(msg);
				}
			});
		//-----------
		$(".modal-footer .modalSave").removeClass("addProductos").addClass("addClientes");
		modal.modal("show");
	}else if(source=="PRODUCTOS"){
		if(validarForm()){
		var modal=$('#myModal');
		$(".modal-title").html("Búsqueda de Productos");
		//-----------
		$.ajax({
			data:'cli_id='+$("input[name='cliente_txt']").val(),
			url:SERVER_URL_BASE+"remisiones/cremisiones/modalProductos",
			method:"POST",
			success: function(msg){
					$(".modal-dialog").addClass('modal-lg');
					$(".modal-body").html(msg);
				}
			});
		//-----------
		$(".modal-footer .modalSave").removeClass("addClientes").addClass("addProductos");
		modal.modal("show");
		}else{
			alert("Los datos deben estar completos.");
		}
	}
	
}

//carga el resultado de la busqueda
function selectClienteModal(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	
	$.ajax({
		data:formSer,
		url:SERVER_URL_BASE+"clientes/cClientes/selectClienteJson",
		method:"POST",
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
			}else{
				tableStructure="<tr><td>No se encontraron coincidencias</td></tr>";
				
			}
			$("#target tbody").html(tableStructure);
		}

	});
	
}

//agrega una marca a el cliente seleccionado
$(document).on("click"," #target .datos tbody tr", function(){
	if( ($(this).attr("id")!=null) && ($(this).attr("id")!="")){
		$("tr[class='info']").removeClass("info");
		$(this).addClass("info");
	}
});

//toma los datos del cliente o Producto seleccionado y los agrega en el formulario
$(document).on("click",".modalSave", function(){
	if($(this).hasClass("addClientes")){
		var seleccionado=$("tr[class='info']").attr("id");
		$("input[name='cliente_txt']").val(seleccionado);
		$("input[name='cliente_name']").val($("tr[class='info']").children("td:nth-child(2)").text());
		$('#myModal').modal('hide');
		
	}
});


function validarForm(){
	var continuar=true;
	
	if(isTexto($("input[name='cliente_name']").val())){
		$("input[name='cliente_name']").parent().removeClass("has-error");
	}else{
		$("input[name='cliente_name']").parent().addClass("has-error");
		continuar=false;
	}	
		
	
	return continuar;
}

//validar si existen valores para el reporte
function reporteVacio(){
	var continuar=true;
	$.ajax({
		data:'cliente_txt='+$("input[name='cliente_txt']").val(),
		url:SERVER_URL_BASE+"reportes/creportseguimiento/reporteVacio",
		method:'POST',
		async:false,
		success: function(msg){
			if(msg=='FALSE'){
				continuar=false;
			}
		}
	});
	return continuar;
}

$(document).on("click",".enviarButton",function(){

	if(validarForm()){
		if(!reporteVacio()){
			//var formSer=$("#form_mensual").serialize();
			//window.location.href = SERVER_URL_BASE+"reportes/cmensual/reporteMensual?"+formSer;
			$("#form_segui").submit();
			$('#alert').removeClass("alert alert-danger").addClass("alert alert-success").attr("role","alert").children("span").html('<strong>Reporte creado correctamente</strong>');
		}else{
			$('#alert').removeClass("alert alert-success").addClass("alert alert-danger").attr("role","alert").children("span").html('<strong>El reporte no contiene información</strong>');
		}		
		//var formSer=$("#form_segui").serialize();
		//window.location.href = SERVER_URL_BASE+"reportes/creportseguimiento/reporteSeguimiento?"+formSer;
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});