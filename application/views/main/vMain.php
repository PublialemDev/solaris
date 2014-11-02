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
<a href='/solaris/index.php/clientes/cClientes/formSelectCliente'>Select/Update de clientes</a>

</div>

<?php
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>