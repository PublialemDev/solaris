<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){
	echo getHeader('Actualización de Categorias de Seguimiento a Clientes'); 
	echo getMenu();
	$catsegui_nombre_data='';$catsegui_descripcion_data='';
	
//Obtiene los datos para cargar el formulario lleno 
	if($catseguimiento!=false){
		$catsegui_data=$catseguimiento->first_row();
		$catsegui_nombre_data=$catsegui_data->nombre_categoriaSeguimiento;
		$catsegui_estatus_data=$catsegui_data->estatus_categoriaSeguimiento;
		$catsegui_descripcion_data=$catsegui_data->descripcion_categoriaSeguimiento;
	}
	
//$catsegui_estatus = array('A' => 'ACTIVO', 'I' => 'INACTIVO');
//Propiedades del form
$form_catseguimiento = array('id'=>'form_catseguimiento','onSubmit'=>'getValues(this,event)','class'=>'form-inline');

//Propiedades del input 
$catseguimiento_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>$catsegui_nombre_data,'class'=>'form-control', 'disabled'=>'disabled');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','value' =>$catsegui_descripcion_data,'rows' => 1, 'cols' =>30,'class'=>'form-control', 'disabled'=>'disabled');

$label=array('class'=>'control-label');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Seguimiento a Clientes</div>
	<div class="panel-body">
		<center>			
			<?php echo form_open('#',$form_catseguimiento); ?>
			<?php echo form_hidden('idCatSeguimiento',$catsegui_data->id_categoriaSeguimiento);?>			
					<div class="form-group">
						<?php echo form_label('Nombre: ','nombre',$label);?>
						<?php echo form_input($catseguimiento_nombre);?>
					</div>
					
					<div class="form-group">
						<?php echo form_label('Descripcion:','descripcion',$label);?>
						<?php echo form_textarea($datos);?>
					</div>
					<div class="form-group">
						<?php echo form_button('editar','Editar','class="enableButton btn btn-primary"');?>
						<?php echo form_button('eliminar','Eliminar','class="deleteButton btn btn-primary"');?>
					</div>						
			<?php echo form_close(); ?>																			
		</center>
	</div>
	</div>		
</div>

<?php
echo getFooter('<script src="/solaris/resources/JS/clientes/categoriaseguimiento_update.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>