<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Alta de Seguimiento a Clientes');
echo getMenu();

//Propiedades del form
$form_segui = array('id'=>'form_segui','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$segui_cli =array('name'=>'cliente_txt','placeholder'=>'Nombre','value'=>$cli_name.'('.$cli_id.')','class'=>'form-control','disabled'=>'disabled');
$segui_fecha = array('id'=>'fecha_txt','name'=>'fecha_txt','placeholder'=>'Fecha','value'=>'','class'=>'form-control');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30,'class'=>'form-control');

$label=array('class'=>'control-label');

//Categoria de Seguimiento
foreach ($catseguimiento->result() as $catsegui) {
		$segui_cate[(string)$catsegui->id_categoriaSeguimiento]= (string)$catsegui->nombre_categoriaSeguimiento;
}
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Alta de Seguimiento a Clientes</div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-12'>
	
						<table>
							<tbody>
								<?php echo form_open('#',$form_segui); ?>
								<?php echo form_hidden('idSeguimiento','0');?>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Cliente: ','cliente',$label);?>
										<?php echo form_input($segui_cli);?>
										<?php echo form_hidden('cli_id',$cli_id);?>
										</div>	
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Categoria: ','segui_cate',$label);?>
										<?php echo form_dropdown('segui_cate',$segui_cate,'', 'class="form-control"');?>
										</div>										
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Fecha:','fecha',$label);?>
										<?php echo form_input($segui_fecha);?>
										</div>										
									</td>
								</tr>								
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Comentario:','coment',$label);?>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/clientes/seguimiento_insert.js"></script>');
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>