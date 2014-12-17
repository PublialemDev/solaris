<?php 
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Alta de Clientes'); 
	echo getMenu();
	//labels
	 $label=array('class'=>'control-label');
	//cliente
	$cli_nombre =array('name'=>'nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$cli_rfc =array('name'=>'rfc','placeholder'=>'RFC', 'value'=>'','class'=>'form-control');
	$cli_nivel=array('nor'=>'Normal','adv'=>'Avanzado','pre'=>'Premier') ;
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
	$form_cliente=array('id'=>'form_cliente','onSubmit'=>'insertCliente(this,event)','role'=>'form');
	$form_dir=array('id'=>'form_dir','onSubmit'=>'insertCliente(this,event)','role'=>'form');
	//$form_tel=array('id'=>'form_tel','onSubmit'=>'insertCliente(this,event)','class'=>'form');
	foreach ($estados->result() as $estado) {
		$dir_estado[(string)$estado->id_estado]= (string)$estado->nombre_estado;
	}
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading"><b>Registro de Clientes<b></div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-6'>
						<table>
							<tbody>
						<?php echo form_open('#',$form_cliente); ?>
						<?php echo form_hidden('cli_id','0');?>
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
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Nivel: ','cli_nivel',$label);?>
										<?php echo form_dropdown('cli_nivel', $cli_nivel,'','class="form-control"');?>
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
								<td><?php echo form_button('tel','Agregar Teléfono','class="addTelefono  btn btn-primary"');?></td>
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
								<td><?php echo form_button('corr','Agregar correo','class="addCorreo  btn  btn-primary"');?></td>
							</tr>
							<!--fin correo-->
							</tbody>
							</table>
							
							<table>
								<tr>
									<td><?php echo form_button('enviar','Guardar','class="enviarButton  btn btn-primary"');?></td>
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
echo getFooter('<script src="/solaris/resources/JS/clientes/clientes_insert.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>