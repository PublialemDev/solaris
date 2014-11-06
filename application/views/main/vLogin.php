<?php 
echo getHeader('Accesso'); 
//cliente
$usr_nombre =array('name'=>'usr_nombre','placeholder'=>'Usuario','value'=>'','required'=>'required');
$usr_passw =array('name'=>'usr_passw','placeholder'=>'Contraseña', 'value'=>'','required'=>'required');
//form
$form_login=array('id'=>'form_login');

echo form_open('main/cLogin/login',$form_login);
?>

<div class="container">
	<div class="row"><br><br><br><br></div>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<center><img src="http://www.solarisdemexico.com/images/logo.png" />
			<br><br>
			<h2>Sistema Administrativo</h2></center>
		</div>
		<div class="col-md-4"></div>
	</div>
	
	
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="jumbotron">
				<!--inicio Datos del Cliente -->
					<p><?php echo form_label('Usuario: ','usr_nombre');?></p>
					<p><?php echo form_input($usr_nombre);?></p>
					<p><?php echo form_label('Contraseña: ','usr_passw');?></p>
					<p><?php echo form_password($usr_passw);?></p>
				<!--fin Datos del Cliente -->
				<center><div class="btn btn-default"><?php echo form_submit('login','Entrar','class="enviarButton"');?></div></center>
				</div>
			<div class="col-md-4"></div>
		</div>
	
		
			
	
</div>
<?php
echo form_close();
echo getFooter() ;
?>