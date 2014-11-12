<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){	
	echo getHeader('Tipos de Usuario');
	//categoria seguimiento
	$tipousuarios_nombre =array('name'=>'tipousuarios_nombre','placeholder'=>'Nombre','value'=>'');
	$tipousuarios_id =array('name'=>'tipousuarios_id','placeholder'=>'Número de categoria', 'value'=>'');
	
	//formularios
	$form_tipousuarios=array('id'=>'form_tipousuarios','onSubmit'=>'selectTipoUsuarios(this,event)');
?>


<div id="container" class='container'>
	
	<?php echo form_open('#',$form_tipousuarios); ?>
	<table >
		<tbody>
			<tr>
				<td><?php echo form_label('Número de Categoria: ','tipousuarios_id');?></td>
				<td><?php echo form_input($tipousuarios_id);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nombre: ','tipousuarios_nombre');?></td>
				<td><?php echo form_input($tipousuarios_nombre);?></td>
			</tr>			
			<tr>
				<td><?php echo form_submit('enviar','ENVIAR','class="enviarButton btn btn-primary"');?></td>
			</tr>
		</tbody>
	</table>
	<?php echo form_close(); ?>
	
	<div id='target'>
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
	header('Location: /solaris/index.php/main/cLogin/');
}
?>