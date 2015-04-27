var cantidad_productos_agregados=0;

$(document).ready(function(){
	$( "#fecha" ).datepicker({ defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      dateFormat:'yy/mm/dd',
      monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec" ],
       });				
});

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
					tableStructure+="<td>"+table[index].id;
					tableStructure+="<input type='hidden' name='cli_nivel' value='"+table[index].nivel+"'></td>";
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
		
	}else if($(this).hasClass("addProductos")){
		var id,nombre,desc,precio;//almacenan los valores a agregar
		var table='';
		$("tr[class='info']").each(function(){
			id=$(this).attr("id");
			nombre=$(this).children("td:nth-child(3)").text();
			desc=$(this).children("td:nth-child(4)").text();
			precio=$(this).children("td:nth-child(5)").text();
			
			table+='<tr id="'+id+'">';
			table+='<td>'+nombre+'</td>';
			table+='<td>'+desc+'</td>';
			table+='<td><input name="prod_precio" type="hidden" value="'+precio+'">';
			table+='<input name="prod_cant" type="text" value="0"></td>';
			table+='</tr>';
			cantidad_productos_agregados++;//aumenta el contador de productos agregados
			
			$(".form-control").attr("disabled","disabled");
			$("button[class='buscarButton']").attr("disabled","disabled");
		});
		$("#tableTarget tbody").append(table);
		$('#myModal').modal('hide');
	}
});


function selectProductosModal(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
	
	$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"productos/cproductos/selectProductoJson",
		method:"POST",
		success: function(msg){
			var tableStructure;
			if(msg.trim()!="NO_DATA_FOUND"){
				var table=$.parseJSON(msg);
				tableStructure="";
				$.each(table,function(index){
					tableStructure+="<tr id=\'"+table[index].prod_id+"\'>";
					tableStructure+="<td>"+table[index].prod_codigo+"</td>";
					tableStructure+="<td>"+table[index].prod_cat+"</td>";
					tableStructure+="<td>"+table[index].prod_nombre+"</td>";
					tableStructure+="<td>"+(table[index].prod_desc).replace(/&enter/g,"<br/>")+"</td>";
					tableStructure+="<td>"+table[index].prod_precio_cli+"</td>";
					tableStructure+="<td>"+table[index].prod_estatus+"</td>";
					tableStructure+="</tr>";
				});
			}else{
				tableStructure="<tr><td>No se encontraron coincidencias</td></tr>";
				
			}
			$("#targetProductos tbody").html(tableStructure);
		}
	});
}

$(document).on("click","#targetProductos .datos tbody tr", function(){
	if( ($(this).attr("id")!=null) && ($(this).attr("id")!="")){
		if($(this).hasClass("info")){
			$(this).removeClass("info");
		}else{
			$(this).addClass("info");
		}
		
	}
});

function eliminarProducto(){
	var prod_nombre=$("tr[class='danger']").children("td:nth-child(1)").text();
	if(confirm("¿Seguro que deseas eliminar el producto "+prod_nombre+"?")){
		$("tr[class='danger']").remove();
		//actualiza el total
		calcularTotal();
		
		cantidad_productos_agregados--;
		if(cantidad_productos_agregados==0){
			$(".form-control:not(input[name='total_txt'])").removeAttr("disabled");
			$("button[class='buscarButton']").removeAttr("disabled");
			$("button[name='eliminarProductos']").attr("disabled","disabled");
		}
	}
}

//calcula el total y se lo agrega a el campo total_txt
function calcularTotal(){
	var subtotal=0;
	var iva=0;
	$("input[name='prod_cant']").each(function(){
		var precio=0, cantidad=0;
		precio=$(this).siblings("input[name='prod_precio']").val();
		cantidad=$(this).val();
		subtotal=parseInt(subtotal)+parseInt((precio*cantidad));
	});
	/*if($("input[name='iva_check']:checked").length==1){
		iva=subtotal * $("input[name='iva_check']:checked").val();
	}
	$("input[name='total_txt']").val(subtotal);
	$("input[name='iva_txt']").val(iva);
	$("#total_general").text(parseInt(subtotal+iva));*/
	$("input[name='total_txt']").val(subtotal);
}

//si se habilita el iva lo aplica
/*$("input[name='iva_check']").change(function(){
	var iva=0;
	if($("input[name='iva_check']:checked").length==1){
		iva=$("input[name='total_txt']").val() * $("input[name='iva_check']:checked").val();
	}else{
		iva=0;
	}
	$("input[name='iva_txt']").val(iva);
	$("#total_general").text(parseInt($("input[name='total_txt']").val())+parseInt(iva));
});*/

//agrega el total cuando se agrega una cantidad de productos
$(document).on("blur","input[name='prod_cant']",function(){
	calcularTotal();
});


//marca el registro a eliminar de la tabla de productos
$(document).on("click","#tableTarget table tbody tr", function(){
	if( ($(this).attr("id")!=null) && ($(this).attr("id")!="")){
		if(!$("button[name='saveButton']").hasClass("enableButton")){
			if($(this).hasClass("danger")){
				$(".danger").removeClass("danger");
				$("button[name='eliminarProductos']").attr("disabled","disabled");
			}else{
				$(".danger").removeClass("danger");
				$(this).addClass("danger");
				$("button[name='eliminarProductos']").removeAttr("disabled");
			}
		}
		
	}
});



function validarForm(){
	var continuar=true;
	
	//valida el cliente
	if(!isVacio($("input[name='cliente_txt']").val())){
		$("input[name='cliente_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='cliente_txt']").parent().addClass("has-error");
		continuar=false;
	}				
	
	//valida la fecha
	if(!isVacio($("input[name='fecha_txt']").val())){
		$("input[name='fecha_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='fecha_txt']").parent().addClass("has-error");
		continuar=false;
	}				
	
	//valida el total
	if(!isVacio($("input[name='total_txt']").val())){
		$("input[name='total_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='total_txt']").parent().addClass("has-error");
		continuar=false;
	}
	
	//valida el iva
	/*if(isVacio($("input[name='iva_txt']").val())){
		$("input[name='iva_txt']").parent().removeClass("has-error");
	}else if(isNumeroFlotante($("input[name='iva_txt']").val())){
		$("input[name='iva_txt']").parent().removeClass("has-error");
	}else{
		$("input[name='iva_txt']").parent().addClass("has-error");
		continuar=false;
	}
	*/
	return continuar;
}

function guardarProductos(){
	if(validarForm()){		
		
		$(".form-control").removeAttr("disabled");	
		var formSer=$("#form_remision").serialize();
		$(".form-control").attr("disabled","disabled");
		
		formSer+="&idSucursal="+$("select[name='sucursal']").val()+
		"&idTipoPago="+$("select[name='tipopago']").val()+"&instalacion="+$("select[name='instalacion']").val();
		formSer+="&productos=";
		$("#tableProductos tbody tr").each(function(){
			$id=$(this).attr("id");
			$cant=$(this).children("td:nth-child(3)").children("input[name='prod_cant']").val();
			$precio=$(this).children("td:nth-child(3)").children("input[name='prod_precio']").val();
			$desc=0;
			formSer+=$id+";"+$cant+";"+$precio+";"+$desc+"#";
		});
		$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"remisiones/cremisiones/insertRemision",
		method:"POST",
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				
				$("input[name='idRemision']").val(resp[1]);
				$("button[name='saveButton']").html("Editar");
				$("button[name='saveButton']").removeAttr("onclick");
				$("button[name='saveButton']").removeClass("enviarButton").addClass("enableButton");
				
				$(".form-control").attr("disabled","disabled");
				$("input").attr("disabled","disabled");
				$("button[name='agregarProductos']").attr("disabled","disabled");
				$("button[name='eliminarProductos']").attr("disabled","disabled");
				$(".buscarButton").attr("disabled","disabled");
				$("input[name='iva_check']").attr("disabled","disabled");
				alert("La remision se creo correctamente.");					
			}else{
				alert(msg);
			}
		}

		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
}

//habilitara el formulario
$(document).on("click",".enableButton",function(e){
	$("input[name='iva_check']").removeAttr("disabled");
	$(".buscarButton").removeAttr("disabled");
	$("button[name='agregarProductos']").removeAttr("disabled");
	$("input[name='prod_cant']").removeAttr("disabled");
	$(".form-control:not([name='total_txt'],[name='iva_txt'])").removeAttr("disabled");
	$(this).removeClass("enableButton").addClass("updateButton");
	
	$(this).html("Guardar");
});

//actualiza el registro
$(document).on("click",".updateButton",function(){
	if(validarForm()){
		$("input[type='hidden']").removeAttr("disabled");	
		$(".form-control").removeAttr("disabled");	
		var formSer=$("#form_remision").serialize();
		$(".form-control").attr("disabled","disabled");
		
		formSer+="&idSucursal="+$("select[name='sucursal']").val()+
		"&idTipoPago="+$("select[name='tipopago']").val()+"&instalacion="+$("select[name='instalacion']").val();
		formSer+="&productos=";
		$("#tableProductos tbody tr").each(function(){
			$id=$(this).attr("id");
			$cant=$(this).children("td:nth-child(3)").children("input[name='prod_cant']").val();
			$precio=$(this).children("td:nth-child(3)").children("input[name='prod_precio']").val();
			$desc=0;
			$nivel=$("input[name='cliente_nivel']").val();
			formSer+=$id+";"+$cant+";"+$precio+";"+$desc+";"+$nivel+"#";
		});
		$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"remisiones/cremisiones/updateRemision",
		method:"POST",
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
				
				$("input[name='idRemision']").val(resp[1]);
				$("button[name='saveButton']").html("Editar");
				$("button[name='saveButton']").removeClass("updateButton").addClass("enableButton");
				
				$(".form-control").attr("disabled","disabled");
				$("input").attr("disabled","disabled");
				$("button[name='agregarProductos']").attr("disabled","disabled");
				$("button[name='eliminarProductos']").attr("disabled","disabled");
				$(".buscarButton").attr("disabled","disabled");
				$("input[name='iva_check']").attr("disabled","disabled");
				 
				alert("La remision se actualizó correctamente.");					
			}else{
				alert(msg);
			}
		}

		});
	}else{
		alert("Hay un error en los datos, Favor de validarlos");
	}
});

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar esta remision ?")){
		$.ajax({
			data:"idRemision="+$("input[name='idRemision']").val(),
			url:SERVER_URL_BASE+"remisiones/cremisiones/deleteRemision",
			method:"POST",
			success: function(msg){
				alert("Remision eliminada correctamente: "+msg);
				//window.location=SERVER_URL_BASE+"remisiones/cremisiones/selectRemisionesForm";
			}
		});
	}
});

