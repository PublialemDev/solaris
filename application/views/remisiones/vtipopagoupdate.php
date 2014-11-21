<?php 
//session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de tipos de pago'); 
	echo getMenu();
	$tipopago_nombre_data='';$tipopago_descripcion_data='';

	if($tipopago!=false){
		$tipopago_data=$tipopago->first_row();
		$tipopago_nombre_data=$tipopago_data->nombre_tipoPago;
		$tipopago_descripcion_data=$tipopago_data->descripcion_tipoPago;
	}
	
	//Propiedades del form
$form_tipopago = array('id'=>'form_tipopago','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$tipopago_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>$tipopago_nombre_data,'class'=>'form-control', 'disabled'=>'disabled');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','value' =>$tipopago_descripcion_data,'rows' => 5, 'cols' =>30,'class'=>'form-control', 'disabled'=>'disabled');

$label=array('class'=>'control-label');
?>


<div id="container" class='container'>
	
	<table>
		<tbody>
	<?php echo form_open('#',$form_tipopago); ?>
	<?php echo form_hidden('idTipoPago',$tipopago_data->id_tipoPago);?>
		<!--,$catsegui_data->id_categoriaSeguimiento-->
		<tr>
			<td><?php echo form_label('Nombre: ','nombre',$label);?></td>
			<td><?php echo form_input($tipopago_nombre);?></td>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/remisiones/tipopago_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>