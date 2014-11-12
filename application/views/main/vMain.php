<?php 
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
echo getHeader('Accesso'); 
//echo base64_decode($_SESSION['USUARIO_ID']);
echo getMenu();
?>


<<<<<<< HEAD
<!-- lync para Alta de remisiones-->
<a href='/solaris/index.php/remisiones/cremisiones/insertRemision'>Alta Remisiones</a><br>
<!-- lync para select de remisioens-->
<a href='/solaris/index.php/remisiones/cremisiones/selectRemisiones'>Select Remisiones</a><br>

<!-- lync para Alta de tipo de pago-->
<a href='/solaris/index.php/remisiones/ctipopago/insertTipoPago'>Alta tipo de pago</a><br>
<!-- lync para select de tipo de pago-->
<a href='/solaris/index.php/remisiones/ctipopago/formSelectTipoPago'>select tipo de pago</a><br>

<!-- lync para Alta de tipo de usuario-->
<a href='/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuario'>Alta tipo de usuario</a><br>
<!-- lync para select de tipo de usuario-->
<a href='/solaris/index.php/usuarios/ctipousuarios/selectTipoUsuarios'>select tipo de usuario</a><br>
=======
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

>>>>>>> e21a4f2a63feb2cb5817ec45240caffaf58785da
</div>
</div></div>
<?php
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>
