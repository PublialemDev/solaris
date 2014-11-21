<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
echo getHeader(); 
//echo base64_decode($_SESSION['USUARIO_ID']);
echo getMenu();
?>


     <br>   
        <div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Clientes -</h4></center><br>
						<a class="btn btn-primary btn-xs btn-block" href='/solaris/index.php/clientes/cClientes/formInsertCliente'>Alta clientes</a>
						<a class="btn btn-primary btn-xs btn-block" href='/solaris/index.php/clientes/cClientes/formSelectCliente'>Consulta/Actualización de clientes</a>
						<a class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/clientes/ccategoriaseguimiento/insertCategoriaSeguimiento'>Alta Categoria Seguimiento Clientes</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/clientes/ccategoriaseguimiento/formSelectCategoriaSeguimiento'>Consulta/Actualización Categoria Seguimiento Clientes</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Productos -</h4></center><br>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/productos/ccategoriaproductos/insertCategoriaProductos'>Alta Categoria Productos</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/productos/ccategoriaproductos/formselectCategoriaProductos'>Consulta/Actualización Categoria Productos</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/productos/cproductos/insertProductoForm'>Alta Productos</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/productos/cproductos/selectProductosForm'>Consulta/Actualización Productos</a><br>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Sucursales -</h4></center><br>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/sucursales/csucursales/forminsertSucursales'>Alta Sucursales</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/sucursales/csucursales/formSelectSucursales'>Consulta/Actualización Sucursales</a>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Pagos -</h4></center><br>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/remisiones/ctipopago/insertTipoPago'>Alta tipo de pago</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/remisiones/ctipopago/formSelectTipoPago'>Consulta/Actualización tipo de pago</a>	
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<!--div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Usuarios -</h4></center><br>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuarios'>Alta tipo de usuario</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/usuarios/ctipousuarios/formSelectTipoUsuarios'>Consulta/Actualización tipo de usuario</a>
				</div>
			</div-->
			<!--div class="col-md-4">
				<div class="jumbotron">      
						<center><h4>- Remisiones -</h4></center><br>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/remisiones/cremisiones/insertRemision'>Alta Remisiones</a>
						<a  class="btn btn-primary btn-xs btn-block"href='/solaris/index.php/remisiones/cremisiones/selectRemisiones'>Consulta/Actualización Remisiones</a>
				</div>
			</div-->
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