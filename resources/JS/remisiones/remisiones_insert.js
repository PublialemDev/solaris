$(document).ready(function(){
	$( "#fecha" ).datepicker({ dateFormat: "yy-mm-dd" });				
});

//prepara y muestra la ventana modal
function prepararModal(){
	var modal=$('#myModal');
	$(".modal-title").html("Búsqueda de Clientes");
	//-----------
	$.ajax({
		data:'',
		url:SERVER_URL_BASE+"remisiones/cremisiones/modalClientes",
		method:"POST",
		success: function(msg){
				$(".modal-body").html(msg);
			}
		});
	//-----------
	modal.modal("show");
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

//toma los datos del cliente seleccionado y los pone en el formulario
$(document).on("click",".modalSave", function(){
	var seleccionado=$("tr[class='info']").attr("id");
	$("input[name='cliente_txt']").val(seleccionado);
	$('#myModal').modal('hide');
});

function validarForm(){
	var continuar=true;
	/*
	//valida el nombre
	if(isTexto($("input[name='nombre_txt']").val())){
		$("input[name='nombre_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='nombre_txt']").parent().addClass("has-error");
		continuar=false;
	}				
	*/
	return continuar;
}

	/*	
$(document).on("click",".enviarButton",function(){
	if(validarForm()){		
		/*var formSer=$("#form_tipopago").serialize();
					
		$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"remisiones/ctipopago/getValues",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				$("input").attr("disabled","disabled");	
				$("textarea").attr("disabled","disabled");
				$("input[name='idTipoPago']").val(resp[1]);
				$("button[name='enviar']").html("Editar");
				$("button[name='enviar']").removeClass("enviarButton").addClass("enableButton");
				alert("La categoria se creo correctamente.");					
			}else{
				alert(msg);
			}
		}

		});
		
	alert("Algo");
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});*/
/*		
//habilitara el formulario
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton");
	$(this).addClass("updateButton");
});

//actualiza el registro
$(document).on("click",".updateButton",function(){
	if(validarForm()){
	var formSer=$("#form_tipopago").serialize();
	
		$.ajax({
			data:formSer,
			url:SERVER_URL_BASE+"remisiones/ctipopago/updateTipoPago",
			method:"POST",
			beforesend:function(){alert(formSer);},
			success: function(msg){
				alert(msg);
				$(".updateButton").html("Editar");
				$(".updateButton").removeClass("updateButton").addClass("enableButton");
				$("input").attr("disabled","disabled");
				$("textarea").attr("disabled","disabled");
			}

		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	alert(formSer);
}
*/
