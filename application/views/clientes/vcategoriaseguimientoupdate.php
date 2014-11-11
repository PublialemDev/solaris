<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Categoria de Seguimiento'); 
	$catsegui_nombre_data='';$catsegui_descripcion_data='';

	if($catseguimiento!=false){
		$catsegui_data=$catseguimiento->first_row();
		$catsegui_nombre_data=$catsegui_data->nombre_categoriaSeguimiento;
		$catsegui_descripcion_data=$catsegui_data->descripcion_categoriaSeguimiento;
	}
	
	//Propiedades del form
$form_catseguimiento = array('id'=>'form_catseguimiento','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$catseguimiento_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>$catsegui_nombre_data,'class'=>'form-control', 'disabled'=>'disabled');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','value' =>$catsegui_descripcion_data,'rows' => 5, 'cols' =>30,'class'=>'form-control', 'disabled'=>'disabled');

$label=array('class'=>'control-label');
?>


<div id="container" class='container'>
	
	<table>
		<tbody>
	<?php echo form_open('#',$form_catseguimiento); ?>
	<?php echo form_hidden('idCatSeguimiento',$catsegui_data->id_categoriaSeguimiento);?>
		<!--,$catsegui_data->id_categoriaSeguimiento-->
		<tr>
			<td><?php echo form_label('Nombre: ','nombre',$label);?></td>
			<td><?php echo form_input($catseguimiento_nombre);?></td>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/clientes/categoriaseguimiento_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>