<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
	echo getHeader('Consulta de Productos'); 
	echo getMenu();
	//cliente
	$prod_id =array('name'=>'prod_id','placeholder'=>'Numero de Producto','value'=>'');
	$prod_nombre =array('name'=>'prod_nombre','placeholder'=>'Nombre', 'value'=>'');
	$prod_desc =array('name'=>'prod_desc','placeholder'=>'Descripción', 'value'=>'');
	
	//formularios
	$form_producto=array('id'=>'form_producto','onSubmit'=>'selectProductos(this,event)');

?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Productos</div>
		<div class="panel-body">
			<center>
			<?php echo form_open('#',$form_producto); ?>
			<table >
				<tbody>
					<tr>
						<td><?php echo form_label('Número de Producto: ','prod_id');?></td>
						<td><?php echo form_input($prod_id);?></td>
					</tr>
					<tr>
						<td><?php echo form_label('Nombre: ','prod_nombre');?></td>
						<td><?php echo form_input($prod_nombre);?></td>
					</tr>
					<tr>
						<td><?php echo form_label('Descripción: ','prod_desc');?></td>
						<td><?php echo form_input($prod_desc);?></td>
					</tr>
					<tr>
						<td><?php echo form_submit('enviar','Enviar','class="enviarButton btn btn-primary"');?></td>
					</tr>
				</tbody>
			</table>
			<?php echo form_close(); ?>
			</center>
		</div>
	</div>
	
	<div id='target' class='well container'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Categoria</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Precio</th>
					<th>Proveedor</th>
					<th>Estatus</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/productos/productos_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>