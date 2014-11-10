<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){	
	echo getHeader('Categorias de Seguimiento a Clientes');
	//categoria seguimiento
	$catseguimiento_nombre =array('name'=>'catseguimiento_nombre','placeholder'=>'Nombre','value'=>'');
	$catseguimiento_id =array('name'=>'catseguimiento_id','placeholder'=>'Número de categoria', 'value'=>'');
	
	//formularios
	$form_catseguimiento=array('id'=>'form_catseguimiento','onSubmit'=>'selectCategoriaSeguimiento(this,event)');
?>


<div id="container" class='container'>
	
	<?php echo form_open('#',$form_catseguimiento); ?>
	<table >
		<tbody>
			<tr>
				<td><?php echo form_label('Número de Categoria: ','catseguimiento_id');?></td>
				<td><?php echo form_input($catseguimiento_id);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nombre: ','catseguimiento_nombre');?></td>
				<td><?php echo form_input($catseguimiento_nombre);?></td>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/clientes/categoriaseguimiento_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>