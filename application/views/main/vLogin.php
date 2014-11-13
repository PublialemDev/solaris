<?php 
echo getHeader('Accesso'); 
//cliente
$usr_nombre =array('name'=>'usr_nombre','placeholder'=>'Usuario','value'=>'','required'=>'required','class'=>'form-control');
$usr_passw =array('name'=>'usr_passw','placeholder'=>'Contraseña', 'value'=>'','required'=>'required','class'=>'form-control');
//form
$form_login=array('id'=>'form_login','role'=>'form');
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
					<?php echo form_open('main/cLogin/login',$form_login);?>
						<div class="form-group">
							<?php echo form_label('Usuario: ','usr_nombre');?>
							<?php echo form_input($usr_nombre);?>
						</div>
						<div class="form-group">
							<?php echo form_label('Contraseña: ','usr_passw');?>
							<?php echo form_password($usr_passw);?>
						</div>
					<!--fin Datos del Cliente -->
						<center>
							<br><?php echo form_button('login','Entrar','class="enviarButton btn btn-primary"');?>
						</center>
					<?php echo form_close();?>
				</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</div>

<?php

echo getFooter('<script src="http://localhost/solaris/resources/JS/main/main.js"></script>') ;
?>
 
