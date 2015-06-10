
<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){
	echo getHeader('Alta de Usuarios'); 
	echo getMenu();
	//labels
	 $label=array('class'=>'control-label');
	//usuarios
	$usr_nombre =array('name'=>'nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$usr_password =array('name'=>'password','placeholder'=>'Contraseña', 'value'=>'','class'=>'form-control');
	//$usr_estatus = array('A' => 'ACTIVO', 'I' => 'INACTIVO');

	//direccion
	$dir_calle =array('name'=>'dir_calle','placeholder'=>'Calle','value'=>'','class'=>'form-control');
	$dir_num_ext =array('name'=>'dir_num_ext','placeholder'=>'Num. Exterior','value'=>'','class'=>'form-control');
	$dir_num_int =array('name'=>'dir_num_int','placeholder'=>'Num. interior','value'=>'','class'=>'form-control');
	$dir_col =array('name'=>'dir_col','placeholder'=>'Colonia','value'=>'','class'=>'form-control');
	$dir_muni =array('name'=>'dir_muni','placeholder'=>'Municipio','value'=>'','class'=>'form-control');
	$dir_cp =array('name'=>'dir_cp','placeholder'=>'Codigo Postal','value'=>'','class'=>'form-control');
	$dir_ref=array('id' => 'dir_ref','name' => 'dir_ref','rows' => 5, 'cols' =>30,'class'=>'form-control');
	//teléfono
	$tel_num =array('name'=>'tel_num','class'=>'telefono form-control','placeholder'=>'Teléfono','value'=>'');
	//correos
	$corr_correo =array('name'=>'corr_correo','class'=>'correo form-control','placeholder'=>'Correo','value'=>'');
	//formularios
	$form_usr=array('id'=>'form_usr','onSubmit'=>'insertUsuarios(this,event)','role'=>'form');
	$form_dir=array('id'=>'form_dir','onSubmit'=>'insertUsuarios(this,event)','role'=>'form');
	
	//Estados
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
		<div class="panel-heading"><b>Registro de Usuarios<b></div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-6'>
						<table>
							<tbody>
						<?php echo form_open('#',$form_usr); ?>
						<?php echo form_hidden('usr_id','0');?>
							<!--inicio Datos de la sucursal -->
							
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
										<?php echo form_dropdown('usr_tipousuario', $usr_tipousuario,'','class="form-control"');?>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Sucursal: ','usr_sucursal',$label);?>
										<?php echo form_dropdown('usr_sucursal', $usr_sucursal,'','class="form-control"');?>
									</div>
								</td>
							</tr>
							<!--fin Datos de la sucursal -->
						
						<?php echo form_close(); ?>
						<?php echo form_open('#',$form_dir); ?>
						
							<!--inicio direccion-->
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Estado: ','dir_estado',$label);?>
										<?php echo form_dropdown('dir_estado', $dir_estado,'','class="form-control"');?>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Calle: ','dir_calle');?>
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
						</tbody>
						</table>
						</div>
						
						<div class='col-md-6'>
							<table>
							<tbody>
							<!--inicio telefono-->
													
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Teléfono: ','tel_num',$label);?>
										<?php echo form_input($tel_num);?>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo form_button('tel','Agregar Teléfono','class="btn btn-primary addTelefono"');?></td>
							</tr>
							<!--fin telefono-->
							<!--inicio correo-->
													
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Correo: ','corr_correo',$label);?>
										<?php echo form_input($corr_correo);?>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo form_button('corr','Agregar correo','class="addCorreo  btn btn-primary"');?></td>
							</tr>
							<tr>
								<td style="padding-top: 15px"><?php echo form_button('enviar','Guardar','class="enviarButton  btn btn-primary"');?></td>
							</tr>
							<!--fin correo-->
							</tbody>
							</table>							
						</div>
					</div>
				</div>
			
			
			</center>
		</div> 
	</div>
</div>
</div>

<?php
echo getFooter('<script src="/solaris/resources/JS/usuarios/usuarios_insert.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location:/solaris/index.php/main/cLogin/');
}
?>

