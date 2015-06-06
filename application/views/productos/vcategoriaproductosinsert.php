<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){
echo getHeader('Alta Categoria de Productos');
echo getMenu();
//Propiedades del form
$form_catproductos = array('id'=>'form_catproductos','onSubmit'=>'getValues(this,event)','class'=>'form-inline');

//Propiedades del input 
$catproductos_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'','class'=>'form-control');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 1, 'cols' =>30,'class'=>'form-control');

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Registro de Categoria de Productos</div>
		<div class="panel-body">
			<center>				
				<?php echo form_open('#',$form_catproductos); ?>
					<?php echo form_hidden('idCatProducto','0');?>
				
					<div class="form-group">
						<?php echo form_label('Nombre: ','nombre',$label);?>
						<?php echo form_input($catproductos_nombre);?>
					</div>	
				
					<div class="form-group">
						<?php echo form_label('Descripcion:','descripcion',$label);?>
						<?php echo form_textarea($datos);?>
					</div>										
					<?php echo form_button('enviar','Guardar','class="enviarButton  btn btn-primary"');?>	
				<?php echo form_close();?>																										
			</center>
		</div>								
	</div> 
</div>

<?php 
echo getFooter('<script src="/solaris/resources/JS/productos/categoriaproductos_insert.js"></script>');
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>