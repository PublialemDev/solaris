
<?php 
session_start();
if (isset($_SESSION['USUARIO']) and $_SESSION['USUARIO']!=null ){
	echo getHeader('Alta de Clientes'); 
	//cliente
	$cli_nombre =array('name'=>'nombre','placeholder'=>'Nombre','value'=>'');
	$cli_rfc =array('name'=>'rfc','placeholder'=>'RFC', 'value'=>'');
	//$cli_id=array('0','idCliente') ;//hidden
	//direccion
	$dir_calle =array('name'=>'dir_calle','placeholder'=>'Calle','value'=>'');
	$dir_num_ext =array('name'=>'dir_num_ext','placeholder'=>'Num. Exterior','value'=>'');
	$dir_num_int =array('name'=>'dir_num_int','placeholder'=>'Num. interior','value'=>'');
	$dir_col =array('name'=>'dir_col','placeholder'=>'Colonia','value'=>'');
	$dir_muni =array('name'=>'dir_muni','placeholder'=>'Municipio','value'=>'');
	$dir_cp =array('name'=>'dir_cp','placeholder'=>'Codigo Postal','value'=>'');
	//teléfono
	$tel_num =array('name'=>'tel_num','class'=>'telefono','placeholder'=>'Teléfono','value'=>'');
	//correos
	$corr_correo =array('name'=>'corr_correo','class'=>'correo','placeholder'=>'Correo','value'=>'');
	//formularios
	$form_cliente=array('id'=>'form_cliente','onSubmit'=>'insertCliente(this,event)');
	$form_dir=array('id'=>'form_dir','onSubmit'=>'insertCliente(this,event)');
	//$form_tel=array('id'=>'form_tel','onSubmit'=>'insertCliente(this,event)','class'=>'form');
	foreach ($estados->result() as $estado) {
		$dir_estado[(string)$estado->id_estado]= (string)$estado->nombre_estado;
	}
?>


<div id="container" class='container'>
	
	<table>
		<tbody>
	<?php echo form_open('#',$form_cliente); ?>
	<?php echo form_hidden('idCliente','0');?>
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
			<td><?php echo form_dropdown('dir_estado', $dir_estado,'','');?></td>
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
		<td><?php echo form_button('tel','Agregar Teléfono','class="addTelefono"');?></td>
	</tr>

		<tr>
			<td><?php echo form_label('Teléfono: ','tel_num');?></td>
			<td><?php echo form_input($tel_num);?></td>
		</tr>
	<!--fin telefono-->
	<!--inicio correo-->
	<tr>
		<td><?php echo form_button('corr','Agregar correo','class="addCorreo"');?></td>
	</tr>
	
		<tr>
			<td><?php echo form_label('Correo: ','corr_correo');?></td>
			<td><?php echo form_input($corr_correo);?></td>
		</tr>
	<!--fin correo-->
	</tbody>
	</table>
	
	<table>
		<tr>
			<td><?php echo form_button('enviar','ENVIAR','class="enviarButton"');?></td>
		</tr>
	</table>
	
</div>

<?php
echo getJsClientes_insert(); 
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>

