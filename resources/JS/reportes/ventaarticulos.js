$(document).on("click",".enviarButton",function(){	
		$("#form_ventaarticulos").submit();	
});


function getValues(form,evt){
	evt.preventDefault();
	var formSer=$(form).serialize();
}