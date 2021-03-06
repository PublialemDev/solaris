<?php 
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Remisiones');
	echo getMenu();
	//remisiones
	$cli_id =array('name'=>'cli_id','placeholder'=>'Cliente','value'=>'','class'=>'form-control');
	$fecha_inicio =array('name'=>'fecha_inicio','placeholder'=>'Fecha de Inicio', 'value'=>'','class'=>'form-control');
	$fecha_fin =array('name'=>'fecha_fin','placeholder'=>'Fecha de fin', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_remisiones=array('id'=>'form_remisiones','role'=>'form','class'=>'form-inline','onSubmit'=>'selectRemisiones(this,event)');
	
	//Dropdown sucursales
	$sucursal_data['0']= '';
	foreach ($sucursales->result() as $sucursal) {
		$sucursal_data[(string)$sucursal->id_sucursal]= (string)$sucursal->nombre_sucursal;
	}
	
	//Dropdown tipo de pagos
	$tipopago_data['0']= '';
	if($tipopagos!=false){
		foreach ($tipopagos->result() as $tipopago) {
			$tipopago_data[(string)$tipopago->id_tipoPago]= (string)$tipopago->nombre_tipoPago;
		}
	}else{
		$tipopago_data[' ']= ' ';
	}
	//Dropdown estatus remisiones
	$estatus_remisiones=array('-'=>'Todas','A'=>'Activo','I'=>'Inactivo');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Remisiones</div>
		<div class="panel-body">
			<center>
				<?php echo form_open('#',$form_remisiones); ?>
					<div class="form-group">
						<?php echo form_label('Cliente: ','cli_id');?>
						<?php echo form_input($cli_id);?>
					</div>
				
					<div class="form-group">
						<?php echo form_label('Sucursal: ','suc_id');?>
						<?php echo form_dropdown('suc_id',$sucursal_data,'','class="form-control"');?>
					</div>
					
					<div class="form-group">
						<?php echo form_label('Tipo de pago: ','tipopago_id');?>
						<?php echo form_dropdown('tipopago_id',$tipopago_data,'','class="form-control"');?>
					</div>
					<div class="form-group">
						<?php echo form_label('Estatus: ','estatus_remision');?>
						<?php echo form_dropdown('estatus_remision',$estatus_remisiones,'','class="form-control"');;?>
					</div>
	
				
					<div class="form-group">
						<?php echo form_label('Fecha inicio: ','fecha_inicio');?>
						<?php echo form_input($fecha_inicio);?>
					</div>
				
					<div class="form-group">
						<?php echo form_label('Fecha fin: ','fecha_fin');?>
						<?php echo form_input($fecha_fin);?>
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
				<th>Folio</th>
				<th>Cliente</th>
				<th>Sucursal</th>
				<th>Tipo de pago</th>
				<th>Fecha</th>
				<th>Instalacion</th>
				<th>Total</th>
				<th>Iva</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<?php
//$this->table->set_heading( 'CLIENTE--','SUCURSAL--','TIPO DE PAGO--','FECHA--','INSTALACION--','TOTAL--','IVA--', 'creado_en--', 'creado_por--', 'modificado_en--', 'modificado_por');
//echo $this->table->generate($query);
?>

</div>
<?php 
echo form_close();
echo getFooter('<script src="/solaris/resources/JS/remisiones/remisiones_select.js"></script>');
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>