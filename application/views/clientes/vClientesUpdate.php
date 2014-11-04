<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Clientes'); 
	if($cliente==false){
		echo "cliente no data found ; ";
	}else if($direccion==false){
		echo "direccion no data found ; ";
	}else if($telefono==false){
		echo "telefono no data found ; ";
	}else if($correo==false){
		echo "correo no data found ; ";
	}
	$cli_data=$cliente->first_row();
	$dir_data=$direccion->first_row();
	//cliente
	$cli_nombre =array('name'=>'nombre','placeholder'=>'Nombre','value'=>$cli_data->nombre_cliente, 'disabled'=>'disabled');
	$cli_rfc =array('name'=>'rfc','placeholder'=>'RFC', 'value'=>$cli_data->rfc, 'disabled'=>'disabled');
	//direccion
	$dir_calle =array('name'=>'dir_calle','placeholder'=>'Calle','value'=>$dir_data->calle, 'disabled'=>'disabled');
	$dir_num_ext =array('name'=>'dir_num_ext','placeholder'=>'Num. Exterior','value'=>$dir_data->numero_ext, 'disabled'=>'disabled');
	$dir_num_int =array('name'=>'dir_num_int','placeholder'=>'Num. interior','value'=>$dir_data->numero_int, 'disabled'=>'disabled');
	$dir_col =array('name'=>'dir_col','placeholder'=>'Colonia','value'=>$dir_data->colonia, 'disabled'=>'disabled');
	$dir_muni =array('name'=>'dir_muni','placeholder'=>'Municipio','value'=>$dir_data->municipio, 'disabled'=>'disabled');
	$dir_cp =array('name'=>'dir_cp','placeholder'=>'Codigo Postal','value'=>$dir_data->cp, 'disabled'=>'disabled');
	//formularios
	$form_cliente=array('id'=>'form_cliente','onSubmit'=>'insertCliente(this,event)');
	$form_dir=array('id'=>'form_dir','onSubmit'=>'insertCliente(this,event)');
	foreach ($estados->result() as $estado) {
		$dir_estado[(string)$estado->id_estado]= (string)$estado->nombre_estado;
	}
?>


<div id="container" class='container'>
	
	<table>
		<tbody>
	<?php echo form_open('#',$form_cliente); ?>
	<?php echo form_hidden('cli_id',$cli_data->id_cliente);?>
		<!--inicio Datos del Cliente -->
		<tr>
			<td><?php echo form_label('Nombre: ','nombre');?></td>
			<td><?php echo form_input($cli_nombre);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('RFC: ','rfc');?></td>
			<td><?php echo form_input($cli_rfc);?></td>
		</tr>
		<!--fin Datos del Cliente -->
	
	<?php echo form_close(); ?>
	<?php echo form_open('#',$form_dir); ?>
	
		<!--inicio direccion-->
		<tr>
			<td><?php echo form_label('Estado: ','dir_estado');?></td>
			<td><?php echo form_dropdown('dir_estado', $dir_estado,$dir_data->id_estado,'disabled="disabled"');?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Calle: ','dir_calle');?></td>
			<td><?php echo form_input($dir_calle);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Num. Exterior: ','dir_num_ext');?></td>
			<td><?php echo form_input($dir_num_ext);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Num. Interior: ','dir_num_int');?></td>
			<td><?php echo form_input($dir_num_int);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Colonia: ','dir_col');?></td>
			<td><?php echo form_input($dir_col);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Municipio: ','dir_muni');?></td>
			<td><?php echo form_input($dir_muni);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Codigo Postal: ','dir_cp');?></td>
			<td><?php echo form_input($dir_cp);?></td>
		</tr>
	<?php echo form_close(); ?>
	<!--fin direccion-->
	<!--inicio telefono-->
	<tr>
		<td><?php echo form_button('tel','Agregar Teléfono','class="addTelefono" disabled="disabled"');?></td>
	</tr>
	
	<?php foreach ($telefono->result() as $value) { 
		$tel_num =array('name'=>'tel_num','class'=>'telefono','placeholder'=>'Teléfono','value'=>$value->numero_telefono, 'disabled'=>'disabled');
	?>
		<tr>
			<td><?php echo form_label('Teléfono: ','tel_num');?></td>
			<td><?php echo form_input($tel_num);?></td>
		</tr>
	<?php } ?>
	<!--fin telefono-->
	<!--inicio correo-->
	<tr>
		<td><?php echo form_button('corr','Agregar correo','class="addCorreo" disabled="disabled"');?></td>
	</tr>
	
	<?php foreach ($correo->result() as $value) { 
		$corr_correo =array('name'=>'corr_correo','class'=>'correo','placeholder'=>'Correo','value'=>$value->nombre_correo, 'disabled'=>'disabled');
	?>
	<tr>
		<td><?php echo form_label('Correo: ','corr_correo');?></td>
		<td><?php echo form_input($corr_correo);?></td>
	</tr>
	<?php } ?>
	<!--fin correo-->
	</tbody>
	</table>
	
	<table>
		<tr>
			<td><?php echo form_button('editar','Editar','class="enableButton btn btn-primary"');?></td>
			<td><?php echo form_button('eliminar','Eliminar','class="deleteButton btn btn-primary"');?></td>
		</tr>
	</table>
	
</div>

<?php
echo getJsClientes_update(); 
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>

