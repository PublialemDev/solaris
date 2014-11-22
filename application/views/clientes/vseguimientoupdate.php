<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Seguimiento a clientes'); 
	$segui_cli_data='';$segui_descripcion_data='';$segui_cat_data='';$segui_fecha_data='';
	
	//Obtiene los datos para cargar el formulario lleno 
	if($seguimiento!=false){
		$segui_data=$seguimiento->first_row();
		$segui_cli_data=$segui_data->id_cliente;
		$segui_descripcion_data=$segui_data->comentario;
		$segui_cat_data=$segui_data->id_categoriaSeguimiento;
		$segui_fecha_data=$segui_data->fecha;
	}
	
//Propiedades del form
$form_segui = array('id'=>'form_segui','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$segui_cli =array('name'=>'cliente_txt','placeholder'=>'Nombre','value'=>$segui_cli_data,'class'=>'form-control');
$segui_fecha = array('name'=>'fecha_txt','placeholder'=>'Fecha','value'=>$segui_fecha_data,'class'=>'form-control');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','value'=>$segui_descripcion_data,'rows' => 5, 'cols' =>30,'class'=>'form-control');

$label=array('class'=>'control-label');

//Categoria se seguimiento
foreach ($catseguimiento->result() as $catsegui) {
		$segui_cate[(string)$catsegui->id_categoriaSeguimiento]= (string)$catsegui->nombre_categoriaSeguimiento;
}

?>


<div id="container" class='container'>
	<div class="panel panel-info">
	<div class="panel-heading">Actualización de Seguimiento a Clientes</div>
	<div class="panel-body">
		<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-6'>		
						<?php echo form_open('#',$form_segui); ?>
						<?php echo form_hidden('idSeguimiento',$segui_data->id_seguimientoCliente);?>

						<table>
							<tbody>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Cliente: ','cliente',$label);?>
										<?php echo form_input($segui_cli);?>
										<?php //echo form_button('buscar_cli','Buscar','class="buscarCliente  btn btn-xs btn-default"');?>
										</div>	
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Categoria: ','segui_cate',$label);?>
										<?php echo form_dropdown('segui_cate',$segui_cate,$segui_cat_data, 'class="form-control"');?>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/clientes/seguimiento_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>