<?php  

function obtenerFecha(){
	$script = '<script>';
	$script .= ' 
	$(function(){
		$( "#fecha" ).datepicker({ dateFormat: "yy-mm-dd" });				
	});';

	$script .= '</script>';
	
	return $script;
}

?>