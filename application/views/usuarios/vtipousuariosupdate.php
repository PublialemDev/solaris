<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){
	echo getHeader('Actualización de Tipos de Usuario'); 
	echo getMenu();
	$tipousuarios_nombre_data='';$tipousuarios_descripcion_data='';

	if($tipousuario!=false){
		$tipousuarios_data=$tipousuario->first_row();
		$tipousuarios_nombre_data=$tipousuarios_data->nombre_tipoUsuario;
		$tipousuarios_descripcion_data=$tipousuarios_data->descripcion_tipoUsuario;
	}
	
	
	//Propiedades del form
$form_tipousuarios = array('id'=>'form_tipousuarios','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$tipousuarios_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>$tipousuarios_nombre_data,'class'=>'form-control', 'disabled'=>'disabled');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','value' =>$tipousuarios_descripcion_data,'rows' => 5, 'cols' =>30,'class'=>'form-control', 'disabled'=>'disabled');

$label=array('class'=>'control-label');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Tipo de Usuario</div>
	<div class="panel-body">
		<center>
			<div class='container-fluid'>
				<div class="row">
					<div class='col-md-6'>
					<?php echo form_open('#',$form_tipousuarios); ?>
					<?php echo form_hidden('idTipoUsuario',$tipousuarios_data->id_tipoUsuario);?>
					<table>
						<tbody>
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Nombre: ','nombre',$label);?>
										<?php echo form_input($tipousuarios_nombre);?>
									</div>
								</td>
							</tr>													
							<tr>
								<td>
									<div class="form-group">
										<?php echo form_label('Descripcion:','descripcion',$label);?>
										<?php echo form_textarea($datos);?>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<?php echo form_close(); ?>
	
	
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/usuarios/tipousuarios_update.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>