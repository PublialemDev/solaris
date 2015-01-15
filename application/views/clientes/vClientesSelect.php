<?php 
//session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
	echo getHeader('Consulta de Clientes');
	echo getMenu(); 
	//cliente
	$cli_nombre =array('name'=>'cli_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$cli_rfc =array('name'=>'cli_rfc','placeholder'=>'RFC', 'value'=>'','class'=>'form-control');
	$cli_id =array('name'=>'cli_id','placeholder'=>'Número de cliente', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_cliente=array('id'=>'form_cliente','role'=>'form','onSubmit'=>'selectCliente(this,event)');
	
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Clientes</div>
		<div class="panel-body">
			<div class='container-fluid'>
					<div class="row">
						<div class='col-md-12'>
			<center>
			<?php echo form_open('#',$form_cliente); ?>
			<table >
				<tbody>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Número de Cliente: ','cli_id');?>
							<?php echo form_input($cli_id);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Nombre: ','cli_nombre');?>
							<?php echo form_input($cli_nombre);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('RFC: ','cli_rfc');?>
							<?php echo form_input($cli_rfc);?>
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo form_submit('enviar','Buscar','class="enviarButton btn btn-primary"');?></td>
					</tr>
				</tbody>
			</table>
			<?php echo form_close(); ?>
			</center>
			</div>
					<div class='col-md-6'>
						<center>
						<?php echo form_button('seguimiento','Ver seguimiento','class="seguimientoButton btn btn-primary" style="display:none" onclick="mostrarSeguimiento()"');?>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>RFC</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div></div>

<?php
echo getFooter('<script src="/solaris/resources/JS/clientes/clientes_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>
