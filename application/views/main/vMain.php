<?php 
if (isset($_SESSION['USUARIO']) and $_SESSION['USUARIO']!=null ){
	
getHeader('Accesso'); 
//cliente
echo $_SESSION['USUARIO'];
$usr_nombre =array('name'=>'usr_nombre','placeholder'=>'Usuario','value'=>'','required'=>'required');
$usr_passw =array('name'=>'usr_passw','placeholder'=>'Contraseña', 'value'=>'','required'=>'required');
//form
$form_login=array('id'=>'form_login','onSubmit'=>'validaLogin(this,event)');


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