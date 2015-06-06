<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Nota de Remision');
echo getMenu();
//Propiedades del form
$form_reminote = array('id'=>'form_reminote','target'=>'_blank','class'=>'form-inline');

//Propiedades del input 
$num_remision =array('name'=>'idRemision','placeholder'=>'NUMERO','value'=>'','class'=>'form-control');

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Nota de Remision</div>
		<div class="panel-body">
			<center>				
				<?php echo form_open('reportes/cremisionnote/generarPDF',$form_reminote); ?>
					<div class="form-group">
						<?php echo form_label('ID REMISION: ','remi',$label);?>
						<?php echo form_input($num_remision);?>
					</div>	
					<?php echo form_button('enviar','Generar Reporte','class="enviarButton  btn btn-primary"');?>								
				<?php echo form_close();?>																
				
				<br>
				<!--div para mostrar la alerta si no existe la remision-->
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
echo getFooter('<script src="/solaris/resources/JS/reportes/remisionnote.js"></script>');
}else{
	header('Location:/solaris/index.php/main/cLogin/');
}
?>