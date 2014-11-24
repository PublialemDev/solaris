<?php  

function obtenerFecha(){
	$script = '<script>';
	$script .= ' 
	$(document).ready(function(){
		$( "#fecha" ).datepicker({ dateFormat: "yy-mm-dd" });				
	});';

	$script .= '</script>';
	
	return $script;
}

?>