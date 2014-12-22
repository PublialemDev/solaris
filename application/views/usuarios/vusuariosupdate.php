<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Usuarios'); 
	echo getMenu();
	$usr_nombre_data='';$usr_password_data='';
	$dir_calle_data='';$dir_num_ext_data='';$dir_num_int_data='';$dir_col_data='';$dir_muni_data='';$dir_cp_data='';
	$estado_id='';
	if($usuarios!=false){
		$usr_data=$usuarios->first_row();
		$usr_nombre_data=$usr_data->nombre_usuario;
		$usr_password_data=$usr_data->contraseña;
		$usr_estatus_data = $usr_data->estatus_usuario;
		$id_sucursal = $usr_data->id_sucursal;
		$id_tipousuario = $usr_data->id_tipoUsuario;
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
		$dir_ref_data=$dir_data->comentarios;
	}else if($telefono==false){
		echo "telefono no data found;";
	}else if($correo==false){
		echo "correo no data found;";
	}
	//labels
	 $label=array('class'=>'control-label');
	///usuarios
	$usr_nombre =array('name'=>'nombre','placeholder'=>'Nombre','value'=>$usr_nombre_data, 'disabled'=>'disabled','class'=>'form-control');
	$usr_password =array('name'=>'password','placeholder'=>'Contraseña', 'value'=>$usr_password_data, 'disabled'=>'disabled','class'=>'form-control');
	//$usr_estatus = array('A' => 'ACTIVO', 'I' => 'INACTIVO');
	//direccion
	$dir_calle =array('name'=>'dir_calle','placeholder'=>'Calle','value'=>$dir_calle_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_num_ext =array('name'=>'dir_num_ext','placeholder'=>'Num. Exterior','value'=>$dir_num_ext_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_num_int =array('name'=>'dir_num_int','placeholder'=>'Num. interior','value'=>$dir_num_int_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_col =array('name'=>'dir_col','placeholder'=>'Colonia','value'=>$dir_col_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_muni =array('name'=>'dir_muni','placeholder'=>'Municipio','value'=>$dir_muni_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_cp =array('name'=>'dir_cp','placeholder'=>'Codigo Postal','value'=>$dir_cp_data, 'disabled'=>'disabled','class'=>'form-control');
	$dir_ref=array('id' => 'dir_ref','name' => 'dir_ref','rows' => 5, 'cols' =>30,'class'=>'form-control','disabled'=>'disabled','value'=>$dir_ref_data);
	//formularios
	$form_usr=array('id'=>'form_usr','onSubmit'=>'insertUsuarios(this,event)','role'=>'form');
	$form_dir=array('id'=>'form_dir','onSubmit'=>'insertUsuarios(this,event)','role'=>'form');
	foreach ($estados->result() as $estado) {
		$dir_estado[(string)$estado->id_estado]= (string)$estado->nombre_estado;
	}
	//Tipo usuarios
	foreach ($tipousuarios->result() as $tipousuario) {
		$usr_tipousuario[(string)$tipousuario->id_tipoUsuario] = (string)$tipousuario->nombre_tipoUsuario;
	}
	//Sucursales
	foreach ($sucursales->result() as $sucursal) {
		$usr_sucursal[(string)$sucursal->id_sucursal]= (string)$sucursal->nombre_sucursal;
	}
?>


<div id="container" class='container'>
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Usuarios</div>
	<div class="panel-body">
		<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-6'>
		<table>
			<tbody>
		<?php echo form_open('#',$form_usr); ?>
		<?php echo form_hidden('usr_id',$usr_data->id_usuario);?>
			<!--inicio Datos del usuario -->
			<tr>
				<td>
					<div class="form-group">
					<?php echo form_label('Nombre: ','nombre',$label);?>
					<?php echo form_input($usr_nombre);?>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Contraseña: ','password',$label);?>
						<?php echo form_password($usr_password);?>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Tipo de Usuario: ','usr_tipousuario',$label);?>
						<?php echo form_dropdown('usr_tipousuario', $usr_tipousuario,$id_tipousuario,'disabled="disabled" class="form-control"');?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Sucursal: ','usr_sucursal',$label);?>
						<?php echo form_dropdown('usr_sucursal', $usr_sucursal,$id_sucursal,'disabled="disabled" class="form-control"');?>
					</div>
				</td>
			</tr>
			<!--fin Datos del usuario -->
		
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
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Referencias: ','dir_ref',$label);?>
						<?php echo form_textarea($dir_ref);?>
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
			if($telefono!=false){
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
		<?php } 
			}else{
				$tel_num =array('name'=>'tel_num','class'=>'telefono form-control','placeholder'=>'Teléfono','value'=>'', 'disabled'=>'disabled');
				?>
			<tr>
				<td>
					<div class="form-group">
						<?php echo form_label('Teléfono: ','tel_num',$label);?>
						<?php echo form_input($tel_num);?>
					</div>
				</td>
			</tr>
		<?php 	}
		?>
		<!--fin telefono-->
		<!--inicio correo-->
		<tr>
			<td>
				<div class="form-group">
					<?php echo form_button('corr','Agregar correo','class="addCorreo  btn btn-primary" disabled="disabled"');?>
				</div>
			</td>
		</tr>
		
		<?php 
		if($correo!=false){
		foreach ($correo->result() as $value) { 
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
		<?php }
		}else{ 
			$corr_correo =array('name'=>'corr_correo','class'=>'correo form-control','placeholder'=>'Correo','value'=>'', 'disabled'=>'disabled');
			?>
		<tr>
			<td>
				<div class="form-group">
					<?php echo form_label('Correo: ','corr_correo',$label);?>
					<?php echo form_input($corr_correo);?>
				</div>
			</td>
		</tr>
			
		<?php	
		} ?>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/usuarios/usuarios_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>

