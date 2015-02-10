<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
	echo getHeader('Consulta de Productos'); 
	echo getMenu();
	//cliente
	$prod_codigo =array('name'=>'prod_codigo','placeholder'=>'Numero de Producto','value'=>'','class'=>'form-control');
	$prod_nombre =array('name'=>'prod_nombre','placeholder'=>'Nombre', 'value'=>'','class'=>'form-control');
	$prod_desc =array('name'=>'prod_desc','placeholder'=>'Descripción', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_producto=array('id'=>'form_producto','role'=>'form','class'=>'form-inline','onSubmit'=>'selectProductos(this,event)');

?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Productos</div>
		<div class="panel-body">
			<center>
			<?php echo form_open('#',$form_producto); ?>
			
				<div class="form-group">
					<?php echo form_label('Código de Producto: ','prod_codigo');?>
					<?php echo form_input($prod_codigo);?>
				</div>
			
				<div class="form-group">
					<?php echo form_label('Nombre: ','prod_nombre');?>
					<?php echo form_input($prod_nombre);?>
				</div>
			
				<div class="form-group">
					<?php echo form_label('Descripción: ','prod_desc');?>
					<?php echo form_input($prod_desc);?>
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
					<th>Código</th>
					<th>Categoría</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Precio normal</th>
					<th>Precio avanzado</th>
					<th>Precio premier</th>
					<th>Estatus</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		
	</div>
	
</div></div>

<?php
echo getFooter('<script src="/solaris/resources/JS/productos/productos_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>