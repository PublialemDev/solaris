function validarForm(){
	var continuar=true;
	
	if(isNumero($("input[name='cliente_txt']").val())){
		$("input[name='cliente_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='cliente_txt']").parent().addClass("has-error");
		continuar=false;
	}			
	
	if(isVacio($("input[name='fecha_txt']").val())){
		$("input[name='fecha_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='fecha_txt']").parent().addClass("has-error");
		continuar=false;
	}	
	
	return continuar;
}
		
		
$(document).on("click",".enviarButton",function(){
	if(validarForm()){		
		var formSer=$("#form_segui").serialize();
					
		$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"clientes/cseguimiento/getValues",
		method:"POST",
		beforesend:function(){alert(formSer);},
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				$("input").attr("disabled","disabled");	
				$("textarea").attr("disabled","disabled");
				$("select").attr("disabled","disabled");
				$("input[name='idSeguimiento']").val(resp[1]);
				$("button[name='enviar']").html("Editar");
				$("button[name='enviar']").removeClass("enviarButton").addClass("enableButton");
				alert("El seguimiento se creo correctamente.");					
			}else{
				alert(msg);
			}
		}

	});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});
		
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
	var formSer=$("#form_segui").serialize();
	
		$.ajax({
			data:formSer,
			url:SERVER_URL_BASE+"clientes/cseguimiento/updateSeguimiento",
			method:"POST",
			beforesend:function(){alert(formSer);},
			success: function(msg){
				alert(msg);
				$(".updateButton").html("Editar");
				$(".updateButton").removeClass("updateButton").addClass("enableButton");
				$("input").attr("disabled","disabled");
				$("textarea").attr("disabled","disabled");
				$("select").attr("disabled","disabled");
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




 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$( document ).ready(function(){
	$("#fecha_txt").datepicker({ dateFormat: "yy-mm-dd" });
});



//prepara y muestra la ventana modal
function prepararModal(){
	var modal=$('#myModal');
	$(".modal-title").html("Búsqueda de Clientes");
	//-----------
	$.ajax({
		data:'',
		url:SERVER_URL_BASE+"clientes/cseguimiento/modalClientes",
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

