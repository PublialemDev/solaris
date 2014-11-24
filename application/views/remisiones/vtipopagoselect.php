<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){	
	echo getHeader('Consulta de Tipos de Pago');
	echo getMenu();
	//categoria seguimiento
	$tipopago_nombre =array('name'=>'tipopago_nombre','placeholder'=>'Nombre','value'=>'');
	$tipopago_id =array('name'=>'tipopago_id','placeholder'=>'Número de categoria', 'value'=>'');
	
	//formularios
	$form_tipopago=array('id'=>'form_tipopago','onSubmit'=>'selectTipoPago(this,event)');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de tipos de pagos</div>
		<div class="panel-body">
			<center>
	<?php echo form_open('#',$form_tipopago); ?>
	<table >
		<tbody>
			<tr>
				<td><?php echo form_label('Número de Categoria: ','tipopago_id');?></td>
				<td><?php echo form_input($tipopago_id);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nombre: ','tipopago_nombre');?></td>
				<td><?php echo form_input($tipopago_nombre);?></td>
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
	
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripcion</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/remisiones/tipopago_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>