<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Categorias de Seguimiento a Clientes'); 
	echo getMenu();
	$catsegui_nombre_data='';$catsegui_descripcion_data='';
	
//Obtiene los datos para cargar el formulario lleno 
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
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Seguimiento a Clientes</div>
	<div class="panel-body">
		<center>
			<div class='container-fluid'>
				<div class="row">
					<div class='col-md-6'>
					<?php echo form_open('#',$form_catseguimiento); ?>
					<?php echo form_hidden('idCatSeguimiento',$catsegui_data->id_categoriaSeguimiento);?>
					<table>
						<tbody>
						<tr>
							<td><?php echo form_label('Nombre: ','nombre',$label);?></td>
							<td><?php echo form_input($catseguimiento_nombre);?></td>
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
echo getFooter('<script src="/solaris/resources/JS/clientes/categoriaseguimiento_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>