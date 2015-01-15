
<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
	echo getHeader('Consulta de Usuarios');
	echo getMenu(); 
	//sucursal
	$usr_nombre =array('name'=>'usr_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$usr_tipo =array('name'=>'usr_tipo','placeholder'=>'Tipo de Usuario', 'value'=>'','class'=>'form-control');
	$usr_id =array('name'=>'usr_id','placeholder'=>'Número de usuario', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_usr=array('id'=>'form_usr','role'=>'form','onSubmit'=>'selectUsuarios(this,event)');
	
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Usuarios</div>
		<div class="panel-body">
			<center>
			<?php echo form_open('#',$form_usr); ?>
			<table >
				<tbody>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Número de Usuario: ','usr_id');?>
							<?php echo form_input($usr_id);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Nombre: ','usr_nombre');?>
							<?php echo form_input($usr_nombre);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Tipo de Usuario: ','usr_tipo');?>
							<?php echo form_input($usr_tipo);?>
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo form_submit('enviar','Buscar','class="enviarButton btn btn-primary"');?></td>
					</tr>
				</tbody>
			</table>
			<?php echo form_close(); ?>
			</center>
		</div>
	</div>
	
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Tipo de Usuario</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/usuarios/usuarios_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>

