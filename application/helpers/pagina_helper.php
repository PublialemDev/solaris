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
	function getHeader($titulo='Sistema de Seguimiento a Clientes'){
		return '
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>'.$titulo.'</title>
	<!-- JQuery-->
	<script src="http://datos.alem.com.mx/solaris/resources/JS/jquery-2.1.1.min.js"></script>
	<!-- Boostrap-->
	<script src="http://datos.alem.com.mx/solaris/resources/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://datos.alem.com.mx/solaris/resources/bootstrap-3.2.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
	<!-- JS basicos-->
	<!-- script src="http://localhost/solaris/resources/JS/clientes.js"></script-->
	
	<!-- CSS basicos-->
	<script src="http://datos.alem.com.mx/solaris/resources/JS/validaciones_form.js"></script>
	<link href="http://solarisdemexico.com/css/styles.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/screen.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="http://solarisdemexico.com/css/stylesheet.css" rel="stylesheet" type="text/css">
	<script src="http://solarisdemexico.com/css/adjust.js"></script>
	<link href="http://solarisdemexico.com/css/Cabin-Medium-webfont.woff" rel="stylesheet" type="text/css">
	<link href="http://solarisdemexico.com/css/Cabin-Medium-webfont.ttf" rel="stylesheet" type="text/css">
	
	<!-- Variable de accesso al server-->
	<script>var SERVER_URL_BASE="/solaris/index.php/"</script>
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
	
	if(base64_decode($_SESSION['USUARIO_TIPO'])=='1'){
	return $script='
	<!--Inicia menu--> 
<div class="navbar-wrapper">
  <div class="container">    
    <div class="navbar navbar-static-top" role="navigation">
      <div class="container">
        <div class="nav">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <div class="central_header">
          <a class="transicion" href="/solaris/index.php/main/cMain/main"><div id="logo"></div></a>
          
          <div class="navbar-collapse collapse">
          	<ul class="nav navbar-nav">
          		<li><a href="/solaris/index.php/main/cMain/main">Inicio </a></li>
          		<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Clientes
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/clientes/cClientes/formInsertCliente">Alta clientes</a></li>
        	    		<li><a href="/solaris/index.php/clientes/cClientes/formSelectCliente">Consulta/Actualización de clientes</a></li>
        	    		<li><a href="/solaris/index.php/clientes/ccategoriaseguimiento/insertCategoriaSeguimiento">Alta Categoria Seguimiento Clientes</a></li>
	            		<li><a href="/solaris/index.php/clientes/ccategoriaseguimiento/formSelectCategoriaSeguimiento">Consulta/Actualización Categoria Seguimiento Clientes</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Productos
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/productos/ccategoriaproductos/insertCategoriaProductos">Alta Categoria Productos</a></li>
						<li><a href="/solaris/index.php/productos/ccategoriaproductos/formselectCategoriaProductos">Consulta/Actualización  Categoria Productos</a></li>
						<li><a href="/solaris/index.php/productos/cproductos/insertProductoForm">Alta Productos</a></li>
						<li><a href="/solaris/index.php/productos/cproductos/selectProductosForm">Consulta/Actualización Productos</a></li>
	            	</ul>
	            </li>
	            <!--li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Remisiones
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/remisiones/cremisiones/insertRemision">Alta Remisiones</a></li>
						<li><a href="/solaris/index.php/remisiones/cremisiones/selectRemisiones">Consulta/Actualización Remisiones</a></li>
	            	</ul>
	            </li-->
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Pagos
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/remisiones/ctipopago/insertTipoPago">Alta tipo de pago</a></li>
						<li><a href="/solaris/index.php/remisiones/ctipopago/formSelectTipoPago">Consulta/Actualización tipo de pago</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Sucursales
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/sucursales/csucursales/forminsertSucursales">Alta de Sucursales</a></li>
						<li><a href="/solaris/index.php/sucursales/csucursales/formSelectSucursales">Consulta/Actualización de Sucursales</a></li>
	            	</ul>
	            </li>
	            <!--li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Usuarios
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuarios">Alta tipo de usuario</a></li>
						<li><a href="/solaris/index.php/usuarios/ctipousuarios/formselectTipoUsuarios">Consulta/Actualización tipo de usuario</a></li>
	            	</ul>
	            </li-->
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<!--Termina menu--> 
	';
	}else if(base64_decode($_SESSION['USUARIO_TIPO'])=='2'){
		return $script='
	<!--Inicia menu--> 
<div class="navbar-wrapper">
  <div class="container">    
    <div class="navbar navbar-static-top" role="navigation">
      <div class="container">
        <div class="nav">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <div class="central_header">
          <a class="transicion" href="index.html"><div id="logo"></div></a>
          
          <div class="navbar-collapse collapse">
          	<ul class="nav navbar-nav">
          		<li><a href="/solaris/index.php/main/cMain/main">Inicio </a></li>
          		<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Clientes
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/clientes/cClientes/formInsertCliente">Alta clientes</a></li>
        	    		<li><a href="/solaris/index.php/clientes/cClientes/formSelectCliente">Select/Update de clientes</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Productos
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
						<li><a href="/solaris/index.php/productos/cproductos/insertProductoForm">Alta Productos</a></li>
						<li><a href="/solaris/index.php/productos/cproductos/selectProductosForm">Select Productos</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Remisiones
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/remisiones/cremisiones/insertRemision">Alta Remisiones</a></li>
						<li><a href="/solaris/index.php/remisiones/cremisiones/selectRemisiones">Select Remisiones</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Pagos
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href="/solaris/index.php/remisiones/ctipopago/insertTipoPago">Alta tipo de pago</a></li>
						<li><a href="/solaris/index.php/remisiones/ctipopago/formSelectTipoPago">select tipo de pago</a></li>
	            	</ul>
	            </li>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<!--Termina menu--> 
	';
	}else{
		return base64_decode($_SESSION['USUARIO_TIPO']);
	}
}
?>