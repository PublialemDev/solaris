<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){
echo getHeader('Alta Tipos de Usuario');
echo getMenu();
//Propiedades del form
$form_tipousuarios = array('id'=>'form_tipousuarios','onSubmit'=>'getValues(this,event)','class'=>'form-inline');

//Propiedades del input 
$tipousuarios_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'','class'=>'form-control');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 1, 'cols' =>30,'class'=>'form-control');

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Registro de Tipos de Usuarios</div>
		<div class="panel-body">
			<center>				
				<?php echo form_open('#',$form_tipousuarios); ?>
					<?php echo form_hidden('idTipoUsuario','0');?>
					
					<div class="form-group">
						<?php echo form_label('Nombre: ','nombre',$label);?>
						<?php echo form_input($tipousuarios_nombre);?>
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
echo getFooter('<script src="/solaris/resources/JS/usuarios/tipousuarios_insert.js"></script>');
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>