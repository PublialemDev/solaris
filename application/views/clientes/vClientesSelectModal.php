<?php
	//cliente
	$cli_nombre =array('name'=>'cli_nombre','placeholder'=>'Nombre','value'=>'');
	$cli_rfc =array('name'=>'cli_rfc','placeholder'=>'RFC', 'value'=>'');
	$cli_id =array('name'=>'cli_id','placeholder'=>'Número de cliente', 'value'=>'');
	
	//formularios
	$form_cliente=array('id'=>'form_cliente','onSubmit'=>'selectClienteModal(this,event)');
?>
<div>
	<center>
		<?php echo form_open('#',$form_cliente); ?>
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
					<td><?php echo form_submit('Buscar','Buscar','class="btn btn-primary"');?></td>
				</tr>
			</tbody>
		</table>
		<?php echo form_close(); ?>
	</center>
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>RFC</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>