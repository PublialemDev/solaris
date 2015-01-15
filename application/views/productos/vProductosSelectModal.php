<?php 
	//cliente
	$prod_codigo =array('name'=>'prod_codigo','placeholder'=>'Numero de Producto','value'=>'','class'=>'form-control');
	$prod_nombre =array('name'=>'prod_nombre','placeholder'=>'Nombre', 'value'=>'','class'=>'form-control');
	$prod_desc =array('name'=>'prod_desc','placeholder'=>'Descripción', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_producto=array('id'=>'form_producto','role'=>'form','onSubmit'=>'selectProductosModal(this,event)');
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
						<td>
							<div class="form-group">
							<?php echo form_label('Código de Producto: ','prod_codigo');?>
							<?php echo form_input($prod_codigo);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Nombre: ','prod_nombre');?>
							<?php echo form_input($prod_nombre);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Descripción: ','prod_desc');?>
							<?php echo form_input($prod_desc);?>
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
