<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Reporte mensual');
echo getMenu();
//Propiedades del form
$form_mensual = array('id'=>'form_mensual','target'=>'_blank','class'=>'form-inline');

//Propiedades del input 
$fecha_ini =array('id'=>'fecha_ini','name'=>'fecha_ini','placeholder'=>'INICIO','value'=>'','class'=>'form-control');
$fecha_fin =array('id'=>'fecha_fin','name'=>'fecha_fin','placeholder'=>'FIN','value'=>'','class'=>'form-control');

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Reporte Mensual</div>
		<div class="panel-body">
			<center>
				<?php echo form_open('reportes/cmensual/reporteMensual',$form_mensual); ?>
				<!--<?php echo form_hidden('idCatProducto','0');?>-->
	
				<div class="form-group">
					<?php echo form_label('FECHA DE INICIO: ','ini',$label);?>
					<?php echo form_input($fecha_ini);?>
				</div>	
				<div class="form-group">
					<?php echo form_label('FECHA DE FIN: ','fin',$label);?>
					<?php echo form_input($fecha_fin);?>
				</div>	
				<?php echo form_button('enviar','Generar Reporte','class="enviarButton  btn btn-primary"');?>
				<?php echo form_close();?>																
					
				<br>
				<!--div para mostrar las alertas-->
				<div class='container-fluid'>
					<div id='alert'>
						<span></span>
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