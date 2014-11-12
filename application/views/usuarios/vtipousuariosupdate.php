<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de tipos de usuario'); 
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
	
	<table>
		<tbody>
	<?php echo form_open('#',$form_tipousuarios); ?>
	<?php echo form_hidden('idTipoUsuario',$tipousuarios_data->id_tipoUsuario);?>

		<tr>
			<td><?php echo form_label('Nombre: ','nombre',$label);?></td>
			<td><?php echo form_input($tipousuarios_nombre);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Descripcion:','descripcion',$label);?></td>
			<td><?php echo form_textarea($datos);?></td>
		</tr>
	
	<?php echo form_close(); ?>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/usuarios/tipousuarios_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>