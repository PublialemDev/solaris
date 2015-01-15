<?php 
	//cliente
	$prod_codigo =array('name'=>'prod_codigo','placeholder'=>'Numero de Producto','value'=>'');
	$prod_nombre =array('name'=>'prod_nombre','placeholder'=>'Nombre', 'value'=>'');
	$prod_desc =array('name'=>'prod_desc','placeholder'=>'Descripción', 'value'=>'');
	
	//formularios
	$form_producto=array('id'=>'form_producto','onSubmit'=>'selectProductosModal(this,event)');
?>

<div id="container" class='container'>
	<!--div class="panel panel-info">
		<div class="panel-heading">Consulta de Productos</div>
		<div class="panel-body"-->
			<center>
			<?php echo form_open('#',$form_producto); ?>
			<table >
				<tbody>
					<tr>
						<td><?php echo form_hidden('cli_id',$cli_id>0?$cli_id:0);?></td>
					</tr>
					<tr>
						<td><?php echo form_label('Código de Producto: ','prod_codigo');?></td>
						<td><?php echo form_input($prod_codigo);?></td>
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
						<td><?php echo form_submit('enviar','Buscar','class="enviarButton btn btn-primary"');?></td>
					</tr>
				</tbody>
			</table>
			<?php echo form_close(); ?>
			</center>
		<!--/div>
	</div-->
	
	<div id='targetProductos' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Código</th>
					<th>Categoría</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Precio</th>
					<th>Estatus</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		
	</div>
	
</div></div>
