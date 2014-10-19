<?php 
/**
 * Header Base
 *
 * Genera el Header base de las vistas, recibe como parametro un String para agregar un titulo a la pestaña.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function getHeader($titulo='Solaris system'){
		return '
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>'.$titulo.'</title>
</head>
<body>
			';
	}
	
/**
 * Footer Base
 *
 * Genera el Footer base para las vistas, recibe un string con los scripts necesarios a importar.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function getFooter($script=''){
		return $script.'
</body>
</html>
			';
	}
?>
