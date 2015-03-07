/*
 *
 * 
 * */

/*
 evalua si la cadena es solo texto y regresa true si es numero y false si no 
 @param string
 @return boolean
 * */
function isTexto(string){
	if(isVacio(string)){
		return false;
	}
	var patt=new RegExp('[^ÁÉÍÓÚáéíóúA-Za-z ]');
	return !patt.test(string.trim());
}

/*
 evalua si la cadena es un nombre y regresa true si es nombre y false si no 
 @param string
 @return boolean
 * */
function isNombre(string){
	if(isVacio(string)){
		return false;
	}
	var patt=new RegExp('[^ÁÉÍÓÚáéíóúA-Za-z 0-9.,]');
	return !patt.test(string.trim());
}

/*
 evalua si la cadena es un numero, regresa true si es numero y false si no 
 @param string
 @return boolean
 * */
function isNumero(string){
	if(isVacio(string)){
		return false;
	}
	var patt=new RegExp('[^0-9]');
	return !patt.test(string.trim());
}

/*
 evalua si la cadena es un numero flotante, regresa true si es numero y false si no 
 @param string
 @return boolean
 * */
function isNumeroFlotante(string){
	if(isVacio(string)){
		return false;
	}
	var patt=new RegExp('[^0-9.]');
	return !patt.test(string.trim());
}

/*
 evalua si la cadena contiene numeros, letras o - , regresa true si comple y false si no 
 @param string
 @return boolean
 * */
function isNumeroLetraGuion(string){
	if(isVacio(string)){
		return false;
	}
	var patt=new RegExp('[^0-9\-a-zA-Z]');
	return !patt.test(string.trim());
}

/*
 recibe la cadena a evaluar, regresa true si es numero y false si no 
 @param string
 @return boolean
 * */
function isCodigoPostal(string){
	if(isVacio(string)||!isNumero(string)||string.length>5){
		return false;
	}
	var patt=new RegExp('[0-9]{5,5}');
	return patt.test(string);
}

/*
 valida que tenga la estructura de un email,regresa true si es numero y false si no
 @param string
 @return boolean
 * */
function isEmail(string) { 
	if(isVacio(string)){
		return false;
	}
    var patt = new RegExp('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/');
    //alert(patt.match(string));
    return true;//patt.test(string);
} 

/*
 valida que tenga la estructura de un email,regresa true si es numero y false si no
 @param string
 @return boolean
 * */
function isRfc(string) { 
	if(isVacio(string)){
		return false;
	}
	
    if (string.length == 12){
	var patt = new RegExp('^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))');
	}else{
	var patt = new RegExp('^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))');
	}
    
    return patt.test(string);
}

/*
 valida que tenga la estructura de un email,regresa true si es numero y false si no
 @param string
 @return boolean
 * */
function isVacio(string) { 
    if(string.trim()==""||string.trim()==null ){
    	return true;
    }else{
    	return false;
    }
}

