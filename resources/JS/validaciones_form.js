/*
 *
 * 
 * */

/*
 recibe la cadena a evaluar y regresa true si es numero y false si no 
 @param string
 @return boolean
 * */
function isTexto(string){
	var patt=new RegExp('[^A-Za-z ]');
	return !patt.test(string.trim());
}
/*
 recibe la cadena a evaluar y regresa true si es numero y false si no 
 @param string
 @return boolean
 * */
function isNumero(string){
	var patt=new RegExp('[^0-9]');
	return !patt.test(string.trim());
}

/*
 recibe la cadena a evaluar y regresa true si es numero y false si no 
 @param string
 @return boolean
 * */
function isCodigoPostal(string){
	var patt=new RegExp('[0-9]{5,5}');
	return !patt.test(string.trim());
}
