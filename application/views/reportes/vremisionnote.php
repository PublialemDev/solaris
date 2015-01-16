<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Nota de Remision');
echo getMenu();
//Propiedades del form
$form_reminote = array('id'=>'form_reminote');

//Propiedades del input 
$num_remision =array('name'=>'idRemision','placeholder'=>'NUMERO','value'=>'','class'=>'form-control');

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Nota de Remision</div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-3'>
	
						<table>
							<tbody>
								<?php echo form_open('reportes/cremisionnote/generarPDF',$form_reminote); ?>
								<!--<?php echo form_hidden('idCatProducto','0');?>-->
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('ID REMISION: ','remi',$label);?>
										<?php echo form_input($num_remision);?>
										</div>	
									</td>
								</tr>								
								<?php echo form_close();?>																
							</tbody>
						</table>
						<table>
							<tr>
								<td><?php echo form_button('enviar','Generar Reporte','class="enviarButton  btn btn-primary"');?></td>
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
echo getFooter('<script src="/solaris/resources/JS/reportes/remisionnote.js"></script>');
}else{
	header('Location:/solaris/index.php/main/cLogin/');
}
?>