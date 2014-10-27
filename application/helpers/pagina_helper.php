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
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script>var SERVER_URL_BASE="http://localhost/solaris/index.php/"</script>
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
	function getFooter($script =''){
		return $script.'
</body>
</html>
			';
	}
?>
