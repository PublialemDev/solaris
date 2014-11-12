<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Clientes'); 
	echo getMenu();
	$cli_nombre_data='';$cli_rfc_data='';
	$dir_calle_data='';$dir_num_ext_data='';$dir_num_int_data='';$dir_col_data='';$dir_muni_data='';$dir_cp_data='';
	$estado_id='';
	if($cliente!=false){
		$cli_data=$cliente->first_row();
		$cli_nombre_data=$cli_data->nombre_cliente;
		$cli_rfc_data=$cli_data->rfc;
	}
	if($direccion!=false){
		$dir_data=$direccion->first_row();
		$estado_id=$dir_data->id_estado;
		$dir_calle_data=$dir_data->calle;
		$dir_num_ext_data=$dir_data->numero_ext;
		$dir_num_int_data=$dir_data->numero_int;
		$dir_col_data=$dir_data->colonia;
		$dir_muni_data=$dir_data->municipio;
		$dir_cp_data=$dir_data->cp;
	}else if($telefono==false){
		echo "telefono no data found;";
	}else if($correo==false){
		echo "correo no data found;";
	}
	//labels
	 $label=array('class'=>'control-label');
	//cliente
	$cli_nombre =array('name'=>'nombre','placeholder'=>'Nombre','value'=>$cli_nombre_data, 'disabled'=>'disabled','class'=>'form-control');
	$cli_rfc =array('name'=>'rfc','placeholder'=>'RFC', 'value'=>$cli_rfc_data, 'disabled'=>'disabled','class'=>'form-control');
	//direccion
	$dir_calle =array('name'=>'dir_calle','placeholder'=>'Calle','value'=>$dir_calle_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_num_ext =array('name'=>'dir_num_ext','placeholder'=>'Num. Exterior','value'=>$dir_num_ext_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_num_int =array('name'=>'dir_num_int','placeholder'=>'Num. interior','value'=>$dir_num_int_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_col =array('name'=>'dir_col','placeholder'=>'Colonia','value'=>$dir_col_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_muni =array('name'=>'dir_muni','placeholder'=>'Municipio','value'=>$dir_muni_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_cp =array('name'=>'dir_cp','placeholder'=>'Codigo Postal','value'=>$dir_cp_data, 'disabled'=>'disabled','class'=>'form-control');
	//formularios
	$form_cliente=array('id'=>'form_cliente','onSubmit'=>'insertCliente(this,event)','role'=>'form');
	$form_dir=array('id'=>'form_dir','onSubmit'=>'insertCliente(this,event)','role'=>'form');
	foreach ($estados->result() as $estado) {
		$dir_estado[(string)$estado->id_estado]= (string)$estado->nombre_estado;
	}
?>


<div id="container" class='container'>
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Clientes</div>
	<div class="panel-body">
		<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-6'>
		<table>
			<tbody>
		<?php echo form_open('#',$form_cliente); ?>
		<?php echo form_hidden('cli_id',$cli_data->id_cliente);?>
			<!--inicio Datos del Cliente -->
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Nombre: ','nombre',$label);?>
						<?php echo form_input($cli_nombre);?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('RFC: ','rfc',$label);?>
						<?php echo form_input($cli_rfc);?>
					</div>
				</td>
			</tr>
			<!--fin Datos del Cliente -->
		
		<?php echo form_close(); ?>
		<?php echo form_open('#',$form_dir); ?>
		
			<!--inicio direccion-->
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Estado: ','dir_estado',$label);?>
						<?php echo form_dropdown('dir_estado', $dir_estado,$estado_id,'disabled="disabled" class="form-control"');?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Calle: ','dir_calle',$label);?>
						<?php echo form_input($dir_calle);?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Num. Exterior: ','dir_num_ext',$label);?>
						<?php echo form_input($dir_num_ext);?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Num. Interior: ','dir_num_int',$label);?>
						<?php echo form_input($dir_num_int);?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Colonia: ','dir_col',$label);?>
						<?php echo form_input($dir_col);?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Municipio: ','dir_muni',$label);?>
						<?php echo form_input($dir_muni);?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Codigo Postal: ','dir_cp',$label);?>
						<?php echo form_input($dir_cp);?>
					</div>
				</td>
			</tr>
		<?php echo form_close(); ?>
		<!--fin direccion-->
		<!--inicio telefono-->
		<tr>
			<td>
				<div class="form-group">
					<?php echo form_button('tel','Agregar Teléfono','class="addTelefono   btn btn-primary" disabled="disabled"');?>
				</div>
			</td>
		</tr>
		
		<?php 
			
			foreach ($telefono->result() as $value) { 
			$tel_num =array('name'=>'tel_num','class'=>'telefono form-control','placeholder'=>'Teléfono','value'=>$value->numero_telefono, 'disabled'=>'disabled');
		?>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Teléfono: ','tel_num',$label);?>
						<?php echo form_input($tel_num);?>
					</div>
				</td>
			</tr>
		<?php } ?>
		<!--fin telefono-->
		<!--inicio correo-->
		<tr>
			<td>
				<div class="form-group">
					<?php echo form_button('corr','Agregar correo','class="addCorreo  btn btn-primary" disabled="disabled"');?>
				</div>
			</td>
		</tr>
		
		<?php foreach ($correo->result() as $value) { 
			$corr_correo =array('name'=>'corr_correo','class'=>'correo form-control','placeholder'=>'Correo','value'=>$value->nombre_correo, 'disabled'=>'disabled');
		?>
		<tr>
			<td>
				<div class="form-group">
					<?php echo form_label('Correo: ','corr_correo',$label);?>
					<?php echo form_input($corr_correo);?>
				</div>
			</td>
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
	</div>
	</div>
	</center>
	</div>
	</div>
</div>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/clientes/clientes_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>

