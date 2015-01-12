<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Reporte mensual');
echo getMenu();
//Propiedades del form
$form_mensual = array('id'=>'form_mensual','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$fecha_ini =array('name'=>'fecha_ini','placeholder'=>'INICIO','value'=>'','class'=>'form-control');
$fecha_fin =array('name'=>'fecha_fin','placeholder'=>'FIN','value'=>'','class'=>'form-control');

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Reporte Mensual</div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-3'>
	
						<table>
							<tbody>
								<?php echo form_open('#',$form_mensual); ?>
								<!--<?php echo form_hidden('idCatProducto','0');?>-->
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('INICIO: ','ini',$label);?>
										<?php echo form_input($fecha_ini);?>
										</div>	
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('FIN: ','fin',$label);?>
										<?php echo form_input($fecha_fin);?>
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
echo getFooter('<script src="/solaris/resources/JS/reportes/mensual.js"></script>');
}else{
	header('Location:/solaris/index.php/main/cLogin/');
}
?>