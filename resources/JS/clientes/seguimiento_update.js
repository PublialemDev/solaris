
$(document).on("click",".enableButton",function(e){
	$("[disabled=\'disabled\']").removeAttr("disabled");
	$("input[name='cliente_txt']").attr("disabled","disabled");
	$(this).html("Guardar");
	$(this).removeClass("enableButton").addClass("updateButton");
});

$(document).on("click",".updateButton",function(){
	
	var formSer=$("#form_segui").serialize();
	
	$.ajax({
		data:formSer.toUpperCase(),
		url:SERVER_URL_BASE+"clientes/cseguimiento/updateSeguimiento",
		method:"POST",
		success: function(msg){
			var resp=msg.split(";");
			if(resp[0].trim()=="SUCCESS"){
			$(".updateButton").html("Editar");
			$(".updateButton").removeClass("updateButton").addClass("enableButton");
			$("input").attr("disabled","disabled");
			$("textarea").attr("disabled","disabled");
			$("select").attr("disabled","disabled");
			alert("El seguimiento se actualizó correctamente.");					
			}else{
				alert(msg);
			}
		}
	});
});

$(".deleteButton").click(function(){
	if(confirm("seguro que deseas eliminar este seguimiento?")){
		$.ajax({
			data:"idSeguimiento="+$("input[name=\'idSeguimiento\']").val(),
			url:SERVER_URL_BASE+"clientes/cseguimiento/deleteSeguimiento",
			method:"POST",
			success: function(msg){
				alert("Seguimiento eliminado correctamente: "+msg);
				window.location=SERVER_URL_BASE+"clientes/cseguimiento/formSelectSeguimiento";
			}
		});
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