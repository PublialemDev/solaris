<?php
//session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Alta de Categorias de Seguimiento a Clientes');
echo getMenu();
//Propiedades del form
$form_catseguimiento = array('id'=>'form_catseguimiento','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$catseguimiento_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'','class'=>'form-control');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30,'class'=>'form-control');

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Registro de Categoria de Seguimiento</div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-3'>
	
						<table>
							<tbody>
								<?php echo form_open('#',$form_catseguimiento); ?>
								<?php echo form_hidden('idCatSeguimiento','0');?>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Nombre: ','nombre',$label);?>
										<?php echo form_input($catseguimiento_nombre);?>
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
								<?php echo form_close();?>																
							</tbody>
						</table>
						<table>
							<tr>
								<td><?php echo form_button('enviar','Guardar','class="enviarButton  btn btn-primary"');?></td>
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
echo getFooter('<script src="/solaris/resources/JS/clientes/categoriaseguimiento_insert.js"></script>');
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>