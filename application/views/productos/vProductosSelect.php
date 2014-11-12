<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
	echo getHeader('Consulta de Clientes'); 
	echo getMenu();
	//cliente
	$cli_nombre =array('name'=>'cli_nombre','placeholder'=>'Nombre','value'=>'');
	$cli_rfc =array('name'=>'cli_rfc','placeholder'=>'RFC', 'value'=>'');
	$cli_id =array('name'=>'cli_id','placeholder'=>'Número de cliente', 'value'=>'');
	
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
						<td><?php echo form_label('Número de Cliente: ','cli_id');?></td>
						<td><?php echo form_input($cli_id);?></td>
					</tr>
					<tr>
						<td><?php echo form_label('Nombre: ','cli_nombre');?></td>
						<td><?php echo form_input($cli_nombre);?></td>
					</tr>
					<tr>
						<td><?php echo form_label('RFC: ','cli_rfc');?></td>
						<td><?php echo form_input($cli_rfc);?></td>
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