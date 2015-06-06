<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){
	echo getHeader('Actualización de Categoria de Productos'); 
	echo getMenu();
	$catprodu_nombre_data='';$catprodu_descripcion_data='';

//Obtiene los datos para cargar el formulario lleno 
	if($catproducto!=false){
		$catprodu_data=$catproducto->first_row();
		$catprodu_nombre_data=$catprodu_data->nombre_categoriaProducto;
		$catprodu_descripcion_data=$catprodu_data->descripcion_categoriaProducto;
	}


//Propiedades del form
$form_catproducto = array('id'=>'form_catproducto','onSubmit'=>'getValues(this,event)','class'=>'form-inline');

//Propiedades del input 
$catproducto_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>$catprodu_nombre_data,'class'=>'form-control', 'disabled'=>'disabled');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','value' =>$catprodu_descripcion_data,'rows' => 1, 'cols' =>30,'class'=>'form-control', 'disabled'=>'disabled');

$label=array('class'=>'control-label');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Seguimiento a Clientes</div>
	<div class="panel-body">
		<center>			
			<?php echo form_open('#',$form_catproducto); ?>
				<?php echo form_hidden('idCatProducto',$catprodu_data->id_categoriaProducto);?>					
				<div class="form-group">
					<?php echo form_label('Nombre: ','nombre',$label);?>
					<?php echo form_input($catproducto_nombre);?>
				</div>
			
				<div class="form-group">
					<?php echo form_label('Descripcion:','descripcion',$label);?>
					<?php echo form_textarea($datos);?>
				</div>
				<?php echo form_button('editar','Editar','class="enableButton btn btn-primary"');?>
				<?php echo form_button('eliminar','Eliminar','class="deleteButton btn btn-primary"');?>
			<?php echo form_close(); ?>																				
		</center>
	</div>
	</div>		
</div>

<?php
echo getFooter('<script src="/solaris/resources/JS/productos/categoriaproductos_update.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>