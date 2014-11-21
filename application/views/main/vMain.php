<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
echo getHeader('Accesso'); 
//echo base64_decode($_SESSION['USUARIO_ID']);
echo getMenu();
?>

<a href='/solaris/index.php/usuarios/cusuarios/formInsertUsuarios'>Alta usuarios</a><br />
<a href='/solaris/index.php/usuarios/cusuarios/formSelectUsuarios'>select usuarios</a><br />
<a href='/solaris/index.php/clientes/cseguimiento/InsertSeguimiento'>Alta Seguimiento</a><br />
<a href='/solaris/index.php/clientes/cseguimiento/formSelectSeguimiento'>Select/Update Seguimiento</a><br />
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
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/remisiones/ctipopago/formSelectTipoPago'>Select tipo de pago</a></button>	
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Usuarios -</h4></center><br>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuarios'>Alta tipo de usuario</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/usuarios/ctipousuarios/formSelectTipoUsuarios'>Select tipo de usuario</a></button>
				</div>
			</div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Sucursales -</h4></center><br>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/sucursales/csucursales/forminsertSucursales'>Alta Sucursales</a></button>
						<button type="button" class="btn btn-primary btn-xs btn-block"><a href='/solaris/index.php/sucursales/csucursales/formSelectSucursales'>Select Sucursales</a></button>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row"><br><br><br><br></div>
	</div>
</div>
</div></div>
<?php
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>
