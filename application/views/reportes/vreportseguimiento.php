<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Reporte Seguimiento');
echo getMenu();
//Propiedades del form
$form_segui = array('id'=>'form_segui','role'=>'form','target'=>'_blank','class'=>'form-inline');

//Propiedades del input 
$cliente =array('name'=>'cliente_name','placeholder'=>'Cliente','value'=>'','class'=>'form-control');


$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Reporte de Seguimiento al Cliente</div>
		<div class="panel-body">
			<center>				
				<?php echo form_open('reportes/creportseguimiento/reporteSeguimiento',$form_segui); ?>					
					<div class="form-group">
						<?php echo form_label('Cliente: ','cliente',$label);?>
						<?php echo form_hidden('cliente_txt',0);?>
						<?php echo form_input($cliente);?>
					</div>	
					<?php echo form_button('buscar','Buscar Cliente','class="btn btn-primary buscarButton" onclick="prepararModal(\'CLIENTES\')"');?></td>
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
echo getFooter('<script src="/solaris/resources/JS/reportes/reportseguimiento.js"></script>');
}else{
	header('Location:/solaris/index.php/main/cLogin/');
}
?>