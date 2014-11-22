<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){	
	echo getHeader('Seguimiento a Clientes');
	//Propiedades del form
	$form_segui = array('id'=>'form_segui','onSubmit'=>'selectSeguimiento(this,event)');

	//Propiedades del input 
	$segui_id =array('name'=>'segui_id','placeholder'=>'ID','value'=>'','class'=>'form-control');
	$segui_cli =array('name'=>'segui_cli','placeholder'=>'Cliente','value'=>'','class'=>'form-control');
	$segui_cat = array('name'=>'segui_cat','placeholder'=>'Categoria','value'=>'','class'=>'form-control');
	
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Seguimiento a Clientes</div>
		<div class="panel-body">
			<center>
			<?php echo form_open('#',$form_segui); ?>
			<table >
				<tbody>
					<tr>
						<td><?php echo form_label('Número de Seguimiento: ','segui_id');?></td>
						<td><?php echo form_input($segui_id);?></td>
					</tr>
					<tr>
						<td><?php echo form_label('Cliente: ','segui_cli');?></td>
						<td><?php echo form_input($segui_cli);?></td>
					</tr>	
					<tr>
						<td><?php echo form_label('Categoria: ','segui_cat');?></td>
						<td><?php echo form_input($segui_cat);?></td>
					</tr>		
					<tr>
						<td><?php echo form_submit('enviar','ENVIAR','class="enviarButton btn btn-primary"');?></td>
					</tr>
				</tbody>
			</table>
			<?php echo form_close(); ?>
			</center>
		</div>
	</div>
	
	<div id='target'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Cliente</th>
					<th>Categoria</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/clientes/seguimiento_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>