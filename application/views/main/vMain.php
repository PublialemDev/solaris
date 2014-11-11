<?php 
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
getHeader('Accesso'); 
//echo base64_decode($_SESSION['USUARIO_ID']);

?>
<!-- funge como pagina principal por el momento-->
<div class='container'>
	<!-- lync para Alta de clientes-->
<a href='/solaris/index.php/clientes/cClientes/formInsertCliente'>Alta clientes</a><br>
	<!-- lync para Select/Update de clientes-->
<a href='/solaris/index.php/clientes/cClientes/formSelectCliente'>Select/Update de clientes</a><br>

<!-- lync para Alta Seguimiento Clientes-->
<a href='/solaris/index.php/clientes/ccategoriaseguimiento/insertCategoriaSeguimiento'>Alta Categoria Seguimiento Clientes</a><br>
<!-- lync para Select Seguimiento Clientes-->
<a href='/solaris/index.php/clientes/ccategoriaseguimiento/formSelectCategoriaSeguimiento'>Select Categoria Seguimiento Clientes</a><br>

<!-- lync para Alta de Categoria Productos-->
<a href='/solaris/index.php/productos/ccategoriaproductos/insertCategoria'>Alta Categoria Productos</a><br>
<!-- lync para select de Categoria Productos-->
<a href='/solaris/index.php/productos/ccategoriaproductos/selectCategorias'>Select Categoria Productos</a><br>

<!-- lync para Alta de Productos-->
<a href='/solaris/index.php/productos/cproductos/insertProductoForm'>Alta Productos</a><br>
<!-- lync para select de productos-->
<a href='/solaris/index.php/productos/cproductos/selectProductosForm'>Select Productos</a><br>

<!-- lync para Alta de remisiones-->
<a href='/solaris/index.php/remisiones/cremisiones/insertRemision'>Alta Remisiones</a><br>
<!-- lync para select de remisioens-->
<a href='/solaris/index.php/remisiones/cremisiones/selectRemisiones'>Select Remisiones</a><br>

<!-- lync para Alta de tipo de pago-->
<a href='/solaris/index.php/remisiones/ctipopago/insertTipoPago'>Alta tipo de pago</a><br>
<!-- lync para select de tipo de pago-->
<a href='/solaris/index.php/remisiones/ctipopago/selectTipoPago'>select tipo de pago</a><br>

<!-- lync para Alta de tipo de usuario-->
<a href='/solaris/index.php/usuarios/ctipousuarios/insertTipoUsuario'>Alta tipo de usuario</a><br>
<!-- lync para select de tipo de usuario-->
<a href='/solaris/index.php/usuarios/ctipousuarios/selectTipoUsuarios'>select tipo de usuario</a><br>
</div>

<?php
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>