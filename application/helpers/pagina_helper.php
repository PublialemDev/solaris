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
	<!-- script src="http://localhost/solaris/resources/JS/clientes.js"></script-->
	
	<!-- CSS basicos-->
	<script src="http://localhost/solaris/resources/JS/validaciones_form.js"></script>
	<link href="http://solarisdemexico.com/css/styles.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/screen.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/stylesheet.css" rel="stylesheet" type="text/css">
	<script src="http://solarisdemexico.com/css/adjust.js"></script>
	<link href="http://solarisdemexico.com/css/Cabin-Medium-webfont.woff" rel="stylesheet" type="text/css">
	<link href="http://solarisdemexico.com/css/Cabin-Medium-webfont.ttf" rel="stylesheet" type="text/css">
	
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
	  	<header class="navbar navbar-static-top bs-docs-nav" role="banner">
		  	<div class="container-fluid">
		  		<div class="row">
		  			<div class="col-xs-12 col-sm-12 col-md-12">
					  	<nav class="navbar navbar-default  navbar-static-top" role="navigation" >
						  <div class="container">
						    <ul class="nav navbar-nav">
						        <li class="dropdown">
						          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
						          <ul class="dropdown-menu" role="menu">
						            <li><a href="#">Action</a></li>
						            <li><a href="#">Another action</a></li>
						            <li><a href="#">Something else here</a></li>
						            <li class="divider"></li>
						            <li><a href="#">Separated link</a></li>
						            <li class="divider"></li>
						            <li><a href="#">One more separated link</a></li>
						          </ul>
						        </li>
						      </ul>
						  </div>
						</nav>
					</div>
				</div>
			</div>
		</header>
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
		<div class="clear"></div>
		 	<img class="lines_bg" src="http://solarisdemexico.com/images/lines_bg.png">
			<footer>
			    <div id="footer_cont1">
			          <div class="footer_info">
			          	<p class="bold">Tel:(55)21571957 / (55)56412732<br> </p>
			          	<div class="direccion">
			             
			             	<p  class="copy">email: ventas@solarisdemexico.com</p>
			             
			          	</div>
			        	<div class="logo2"> <img src="http://solarisdemexico.com/images/logo2.png" alt="logo">
			              <p class="copy">Todos los derechos reservados</p>
			        	</div>
			      	</div>
			          <!--end of footer_info--> 
			          
			    </div>
			    <!--End of footer_cont--> 
			</footer>
		</body>
		</html>
			';
	}
?>
