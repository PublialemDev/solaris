<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){		
	echo getHeader('Consulta de Tipos de Usuario');
	echo getMenu();
	//categoria seguimiento
	$tipousuarios_nombre =array('name'=>'tipousuarios_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$tipousuarios_id =array('name'=>'tipousuarios_id','placeholder'=>'Número de categoria', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_tipousuarios=array('id'=>'form_tipousuarios','role'=>'form','class'=>'form-inline','onSubmit'=>'selectTipoUsuarios(this,event)');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de tipos de usuario</div>
		<div class="panel-body">
			<center>
	<?php echo form_open('#',$form_tipousuarios); ?>
	
		<div class="form-group">
			<?php echo form_label('Número de Categoria: ','tipousuarios_id');?>
			<?php echo form_input($tipousuarios_id);?>
		</div>
	
		<div class="form-group">
			<?php echo form_label('Nombre: ','tipousuarios_nombre');?>
			<?php echo form_input($tipousuarios_nombre);?>
		</div>
		<?php echo form_submit('enviar','Buscar','class="enviarButton btn btn-primary"');?>
				
	<?php echo form_close(); ?>
	</center>
		</div>
	</div>
	
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripcion</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/usuarios/tipousuarios_select.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>