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
	<!-- JQuery-->
	<script src="http://localhost/solaris/resources/JS/jquery-2.1.1.min.js"></script>
	<!-- Boostrap-->
	<script src="http://localhost/solaris/resources/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://localhost/solaris/resources/bootstrap-3.2.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
	<!-- JS basicos-->
	<script src="http://localhost/solaris/resources/JS/clientes.js"></script>
	<!-- CSS basicos-->
	<link href="http://solarisdemexico.com/css/styles.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/screen.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/css" rel="stylesheet" type="text/css">
	<link href="http://solarisdemexico.com/css/adjust.js" rel="stylesheet" type="text/css">
	
	<!-- Variable de accesso al server-->
	<script>var SERVER_URL_BASE="http://localhost/solaris/index.php/"</script>
</head>
<body>
			';
	}
	
	/**
 * Menu Base
 *
 * Genera el menu base segun los permisos del usuario loggeado, 
 * recibe como parametro un String para agregar un titulo a la pestaña.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function getMenu(){
		return '
		<!--nav id="menuPrinc" class="navbar navbar-default navbar-fixed-top" role="navigation">
	  		<!--div class="navbar-inner" >
		  		<div class="container container-fluid">
			  		<a href="#" class="brand">
			  			<p class="text-info"><strong><?php echo $text?></strong></p>
			  		</a>
			  		<ul id="menu" class="nav navbar-nav">
			  			<li class=""><a href="menu.php" >inicio</a></li>
			  			
			  			<li class="dropdown ">
			  				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  				Altas <span class="caret"></span>
			  				</a>
			  				<ul class="dropdown-menu" role="menu">
			  				<li><a href="altaSucursales.php">Sucursales </a> </li>
			  				<li><a href="altaEmpleados.php">Empleados </a></li>
			  				<li><a href="altaProveedores.php">Proveedores </a></li>
			  				<li><a href="altaClientes.php">Clientes </a></li>
			  				<li><a href="altaProductos.php">Productos </a></li>
			  				<li><a href="altaCotizacion.php">Cotizacion </a></li>
			  				</ul>
			  			</li>
			  			<li class="dropdown">
			  				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  					Consultas <span class="caret"></span>
			  				</a>
			  				<ul class="dropdown-menu" role="menu">
			  				<li><a href="consultaSucursales.php">Sucursales </a> </li>
			  				<li><a href="consultaEmpleados.php">Empleados </a></li>
			  				<li><a href="consultaProveedores.php">Proveedores </a></li>
			  				<li><a href="consultaClientes.php">Clientes </a></li>
			  				<li><a href="consultaProductos.php">Productos </a></li>
			  				</ul>
			  			</li>
			  			<li> <a href="PHP/logout.php">salir </a></li>
			  		</ul>
		  		</div>
	  		</div-->
	  	</nav-->
	  	<div class="container">
	  	<nav class="navbar navbar-default" role="navigation">
		  <div class="container">
		    <div class="collapse navbar-collapse"><p class="navbar-text">Signed in as Mark Otto</p></div>
		  </div>
		</nav>
		</div>
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
