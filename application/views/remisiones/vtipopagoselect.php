<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
		if(base64_decode($_SESSION['USUARIO_TIPO'])==1){	
	echo getHeader('Consulta de Tipos de Pago');
	echo getMenu();
	//categoria seguimiento
	$tipopago_nombre =array('name'=>'tipopago_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$tipopago_id =array('name'=>'tipopago_id','placeholder'=>'Número de categoria', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_tipopago=array('id'=>'form_tipopago','role'=>'form','class'=>'form-inline','onSubmit'=>'selectTipoPago(this,event)');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de tipos de pagos</div>
		<div class="panel-body">
			<center>
	<?php echo form_open('#',$form_tipopago); ?>
	
		<div class="form-group">
			<?php echo form_label('Número de Categoria: ','tipopago_id');?>
			<?php echo form_input($tipopago_id);?>
		</div>
	
		<div class="form-group">
			<?php echo form_label('Nombre: ','tipopago_nombre');?>
			<?php echo form_input($tipopago_nombre);?>
		</div>
		<?php echo form_submit('enviar','Buscar','class="enviarButton btn btn-primary"');?>
		
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
echo getFooter('<script src="/solaris/resources/JS/remisiones/tipopago_select.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>