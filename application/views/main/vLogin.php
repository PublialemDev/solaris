<?php 
echo getHeader('Accesso'); 
//cliente
$usr_nombre =array('name'=>'usr_nombre','placeholder'=>'Usuario','value'=>'','required'=>'required');
$usr_passw =array('name'=>'usr_passw','placeholder'=>'Contraseña', 'value'=>'','required'=>'required');
//form
$form_login=array('id'=>'form_login');

echo form_open('main/cLogin/login',$form_login);
?>
	<table>
	<!--inicio Datos del Cliente -->
		<tr>
			<td><?php echo form_label('Usuario: ','usr_nombre');?></td>
			<td><?php echo form_input($usr_nombre);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Contraseña: ','usr_passw');?></td>
			<td><?php echo form_password($usr_passw);?></td>
		</tr>
	<!--fin Datos del Cliente -->
	<tr>
		<td><?php echo form_submit('login','Entrar','class="enviarButton"');?></td>
	</tr>
	</table>
<?php
echo form_close();
echo getFooter() ;
?>