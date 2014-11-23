<?php 
//session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Tipos de Pago'); 
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
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Tipo de Pago</div>
	<div class="panel-body">
		<center>
			<div class='container-fluid'>
				<div class="row">
					<div class='col-md-6'>	
					<?php echo form_open('#',$form_tipopago); ?>
					<?php echo form_hidden('idTipoPago',$tipopago_data->id_tipoPago);?>
					<table>
						<tbody>
							<tr>
								<td><?php echo form_label('Nombre: ','nombre',$label);?></td>
								<td><?php echo form_input($tipopago_nombre);?></td>
							</tr>
							<tr>
								<td><?php echo form_label('Descripcion:','descripcion',$label);?></td>
								<td><?php echo form_textarea($datos);?></td>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/remisiones/tipopago_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>