<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){	
	echo getHeader('Categorias de Productos');
	//categoria seguimiento
	$catprodu_nombre =array('name'=>'catprodu_nombre','placeholder'=>'Nombre','value'=>'');
	$catprodu_id =array('name'=>'catprodu_id','placeholder'=>'Número de categoria', 'value'=>'');
	
	//formularios
	$form_catprodu=array('id'=>'form_catprodu','onSubmit'=>'selectCategoriaProductos(this,event)');
?>


<div id="container" class='container'>
	
	<?php echo form_open('#',$form_catprodu); ?>
	<table >
		<tbody>
			<tr>
				<td><?php echo form_label('Número de Categoria: ','catprodu_id');?></td>
				<td><?php echo form_input($catprodu_id);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nombre: ','catprodu_nombre');?></td>
				<td><?php echo form_input($catprodu_nombre);?></td>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/productos/categoriaproductos_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>