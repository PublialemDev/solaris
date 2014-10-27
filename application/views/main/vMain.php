<?php 
session_start();
echo session_status();
/*if(session_status()!='PHP_SESSION_ACTIVE' ){
	header('Location: /solaris/index.php/main/cLogin/');
	exit();
}*/
echo getHeader('Accesso'); 
//cliente
$usr_nombre =array('name'=>'usr_nombre','placeholder'=>'Usuario','value'=>'','required'=>'required');
$usr_passw =array('name'=>'usr_passw','placeholder'=>'Contraseña', 'value'=>'','required'=>'required');
//form
$form_login=array('id'=>'form_login','onSubmit'=>'validaLogin(this,event)');


?>
<div>MAIN</div>
<?php

echo getFooter() ;
?>