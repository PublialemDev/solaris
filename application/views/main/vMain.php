<?php 
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
echo getHeader('Accesso'); 
//echo base64_decode($_SESSION['USUARIO_ID']);

?>

<<<<<<< HEAD
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
          		<li><a href='/solaris/index.php/main/cLogin/login'>Inicio </a></li>
          		<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Clientes
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href='/solaris/index.php/clientes/cClientes/formInsertCliente'>Alta clientes</a></li>
        	    		<li><a href='/solaris/index.php/clientes/cClientes/formSelectCliente'>Select/Update de clientes</a></li>
        	    		<li><a href='/solaris/index.php/clientes/ccategoriaseguimiento/insertCategoriaSeguimiento'>Alta Categoria Seguimiento Clientes</a></li>
	            		<li><a href='/solaris/index.php/clientes/ccategoriaseguimiento/formSelectCategoriaSeguimiento'>Select Categoria Seguimiento Clientes</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Productos
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href='/solaris/index.php/productos/ccategoriaproductos/insertCategoriaProductos'>Alta Categoria Productos</a></li>
						<li><a href='/solaris/index.php/productos/ccategoriaproductos/formselectCategoriaProductos'>Select Categoria Productos</a></li>
						<li><a href='/solaris/index.php/productos/cproductos/insertProductoForm'>Alta Productos</a></li>
						<li><a href='/solaris/index.php/productos/cproductos/selectProductosForm'>Select Productos</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Remisiones
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href='/solaris/index.php/remisiones/cremisiones/insertRemision'>Alta Remisiones</a></li>
						<li><a href='/solaris/index.php/remisiones/cremisiones/selectRemisiones'>Select Remisiones</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Pagos
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href='/solaris/index.php/remisiones/ctipopago/insertTipoPago'>Alta tipo de pago</a></li>
						<li><a href='/solaris/index.php/remisiones/ctipopago/formSelectTipoPago'>select tipo de pago</a></li>
	            	</ul>
	            </li>
	            <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		Usuarios
                		<sapan class="caret"></sapan>
                	</a>
                	<ul class="dropdown-menu">
      	    	    	<li><a href='/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuario'>Alta tipo de usuario</a></li>
						<li><a href='/solaris/index.php/usuarios/ctipousuarios/selectTipoUsuarios'>select tipo de usuario</a></li>
	            	</ul>
	            </li>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--Termina menu--> 
     <br>   
        <div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Clientes -</h4></center><br>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/clientes/cClientes/formInsertCliente'>Alta clientes</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/clientes/cClientes/formSelectCliente'>Select/Update de clientes</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/clientes/ccategoriaseguimiento/insertCategoriaSeguimiento'>Alta Categoria Seguimiento Clientes</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/clientes/ccategoriaseguimiento/formSelectCategoriaSeguimiento'>Select Categoria Seguimiento Clientes</a></button>
				</div>
			</div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Productos -</h4></center><br>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/productos/ccategoriaproductos/insertCategoriaProductos'>Alta Categoria Productos</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/productos/ccategoriaproductos/formselectCategoriaProductos'>Select Categoria Productos</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/productos/cproductos/insertProductoForm'>Alta Productos</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/productos/cproductos/selectProductosForm'>Select Productos</a><br></button>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Remisiones -</h4></center><br>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/remisiones/cremisiones/insertRemision'>Alta Remisiones</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/remisiones/cremisiones/selectRemisiones'>Select Remisiones</a></button>
				</div>
			</div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Pagos -</h4></center><br>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/remisiones/ctipopago/insertTipoPago'>Alta tipo de pago</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/remisiones/ctipopago/formSelectTipoPago'>select tipo de pago</a></button>	
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Usuarios -</h4></center><br>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuario'>Alta tipo de usuario</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/usuarios/ctipousuarios/selectTipoUsuarios'>select tipo de usuario</a></button>
				</div>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-2"></div>
		</div>
		<div class="row"><br><br><br><br></div>
	</div>
=======
<!-- lync para Alta Seguimiento Clientes-->
<a href='/solaris/index.php/clientes/ccategoriaseguimiento/insertCategoriaSeguimiento'>Alta Categoria Seguimiento Clientes</a><br>
<!-- lync para Select Seguimiento Clientes-->
<a href='/solaris/index.php/clientes/ccategoriaseguimiento/formSelectCategoriaSeguimiento'>Select Categoria Seguimiento Clientes</a><br>

<!-- lync para Alta de Categoria Productos-->
<a href='/solaris/index.php/productos/ccategoriaproductos/insertCategoriaProductos'>Alta Categoria Productos</a><br>
<!-- lync para select de Categoria Productos-->
<a href='/solaris/index.php/productos/ccategoriaproductos/formselectCategoriaProductos'>Select Categoria Productos</a><br>

<!-- lync para Alta de Productos-->
<a href='/solaris/index.php/productos/cproductos/insertProductoForm'>Alta Productos</a><br>
<!-- lync para select de productos-->
<a href='/solaris/index.php/productos/cproductos/selectProductosForm'>Select Productos</a><br>

<!-- lync para Alta de remisiones-->
<a href='/solaris/index.php/remisiones/cremisiones/insertRemision'>Alta Remisiones</a>
<!-- lync para select de remisioens-->
<a href='/solaris/index.php/remisiones/cremisiones/selectRemisiones'>Select Remisiones</a>

<!-- lync para Alta de tipo de pago-->
<a href='/solaris/index.php/remisiones/ctipopago/insertTipoPago'>Alta tipo de pago</a>
<!-- lync para select de tipo de pago-->
<a href='/solaris/index.php/remisiones/ctipopago/formSelectTipoPago'>select tipo de pago</a>

<!-- lync para Alta de tipo de usuario-->
<a href='/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuario'>Alta tipo de usuario</a><br>
<!-- lync para select de tipo de usuario-->
<a href='/solaris/index.php/usuarios/ctipousuarios/selectTipoUsuarios'>select tipo de usuario</a><br>
>>>>>>> ab6f16b323dffdb5c635f8a16ae23dd014507633
</div>
</div></div>
<?php
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>
