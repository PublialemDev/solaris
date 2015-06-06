<?php
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Remisiones');
echo getMenu();
//
$rem_id='';$rem_suc='';$rem_cli='';$rem_tipopago='';$rem_fecha='';$rem_inst='N';$rem_total=0;$rem_iva=0;$rem_cli_nom='';
$rem_cli_nivel='nor';
if(isset($remision)){
	//
	$rem_data = $remision->first_row();
	//
	$rem_id=$rem_data->id_remision;
	$rem_suc=$rem_data->id_sucursal;//no
	$rem_cli=$rem_data->id_cliente;
	$rem_tipopago=$rem_data->id_tipoPago;
	$rem_fecha=$rem_data->fecha;
	$rem_inst=$rem_data->instalacion;
	$rem_total=$rem_data->total;
	$rem_iva=$rem_data->iva;
	$rem_cli_nom=$rem_data->nombre_cliente;
	$rem_cli_nivel=$rem_data->nivel;
}
if(isset($tipoUsuario)){
	//
	$tipouser_data = $tipoUsuario->first_row();
	//
	$nombre_tipoUsuario=(string)$tipouser_data->nombre_tipoUsuario;
}

//
foreach ($sucursales->result() as $sucursal) {
	$sucursal_data[(string)$sucursal->id_sucursal]= (string)$sucursal->nombre_sucursal;
}

//
foreach ($tipopagos->result() as $tipopago) {
	$tipopago_data[(string)$tipopago->id_tipoPago]= (string)$tipopago->nombre_tipoPago;
}

//Propiedades del form
$form_remision = array('id'=>'form_remision','role'=>'form');
$form_remision_reporte = array('id'=>'form_remision_reporte','style'=>'margin-right: 100px;');

//Propiedades de los input 
//$remision_cliente =array('name'=>'cliente_txt','placeholder'=>'Cliente','value'=>$rem_cli,'class'=>'form-control','disabled'=>'disabled');
$remision_cliente_name =array('name'=>'cliente_name','placeholder'=>'Cliente','value'=>$rem_cli_nom,'class'=>'form-control','disabled'=>'disabled');
$remision_fecha =array('id' => 'fecha', 'name'=>'fecha_txt','placeholder'=>'Fecha','value'=>$rem_fecha,'class'=>'form-control','disabled'=>'disabled');
$remision_total =array('name'=>'total_txt','placeholder'=>'Total','value'=>$rem_total,'class'=>'form-control','disabled'=>'disabled');
$remision_iva =array('name'=>'iva_txt','placeholder'=>'IVA','value'=>$rem_iva,'class'=>'form-control','disabled'=>'disabled');

//labels
$label=array('class'=>'control-label');
//Propiedades del combobox
$remision_instalacion = array('N' => 'No', 'S' => 'Si');


?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading"><b>Registro de Remisiones<b></div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-5'>
							<?php echo form_open('#',$form_remision); ?>
						<table>
							
							<tbody>
								
								<?php echo form_hidden('idRemision',$rem_id);?>			
								<tr>
									<td>
										<div class="form-group" >
										
										<?php echo form_label('Sucursal: ','sucursal');?>
										<?php echo form_dropdown('sucursal',$sucursal_data,$rem_suc,'class="form-control " disabled');?> 
										
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Cliente: ','cliente',$label);?>
										<?php echo form_hidden('cliente_txt',$rem_cli);?>
										<?php echo form_hidden('cliente_nivel',$rem_cli_nivel);?>
										<?php echo form_input($remision_cliente_name);?>
										</div>
									</td>
									<!--boton para buscar un cliente -->
								</tr>
								<tr>	
									<td><?php echo form_button('buscar','Buscar Cliente','class="btn btn-primary buscarButton" onclick="prepararModal(\'CLIENTES\')" disabled');?></td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Tipo de Pago: ','tipopago',$label);?>
										<?php echo form_dropdown('tipopago',$tipopago_data,$rem_tipopago,'class="form-control" disabled');?> 
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Fecha: ','fecha',$label);?>
										<?php echo form_input($remision_fecha);?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Instalacion: ','instalacion',$label);?>
										<?php echo form_dropdown('instalacion',$remision_instalacion,$rem_inst,'class="form-control" disabled');?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Total: ','total',$label);?>
										<?php echo form_input($remision_total);?>
										</div>
									</td>
								</tr>
								
								<!--<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('IVA:','iva',$label);?>
										<!--Para pruebas- ->
										<?php 
										$checked=false;
										if($rem_iva>0){$checked=true;}
										echo form_checkbox(array('name'=>'iva_check','disabled'=>'disabled'),'.16',$checked);?>
										<?php echo form_input($remision_iva);?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<?php echo form_label('Total:','total_general',$label);?>
											<span id="total_general"><?php echo $rem_total+$rem_iva;  ?></span>
										</div>
									</td>
								</tr>-->
								<tr>
									<td><?php echo form_button('saveButton','Editar','class="btn btn-primary enableButton"');?></td>
									<td><?php if($nombre_tipoUsuario == 'ADMINISTRADOR'){
										echo form_button('eliminar','Eliminar','class="deleteButton btn btn-primary"');
									}?></td>
								</tr>
							</tbody>
						</table>
						<?php echo form_close(); ?>
						<table>
							<tr>
								<td>
									<?php echo form_open('reportes/cremisionnote/generarPDF',$form_remision_reporte); ?>
									<?php echo form_hidden('idRemision',$rem_id);?>	
									<?php echo form_submit('printButton','Imprimir','class="btn btn-primary"');?>
									<?php echo form_close(); ?>
								</td>
							</tr>
						</table>
						</div>
						<div id="tableTarget" class='col-md-7'>
							<?php echo form_button('agregarProductos','Agregar Productos','class="btn btn-primary" onclick="prepararModal(\'PRODUCTOS\')" disabled');?>
							<?php echo form_button('eliminarProductos','Eliminar Producto','class="btn btn-danger" onclick="eliminarProducto()" disabled');?>
							<table id="tableProductos" class='table table-striped'>
								<thead>
									<th>Producto</th>
									<th>Descripcion</th>
									<th>cantidad</th>
								</thead>
								<tbody>
									<?php 
									$table='';
									if ($remisionproducto!=null){
									foreach ($remisionproducto->result() as $producto) {
										$table.='<tr id="'.$producto->id_producto.'">';
										$table.='<td>'.$producto->nombre_producto.'</td>';
										$table.='<td>'.$producto->descripcion_producto.'</td>';
										$table.='<td><input name="prod_precio" type="hidden" value="'.$producto->precio_actual.'">';
										$table.='<input name="prod_cant" type="text" value="'.$producto->cantidad.'" disabled></td>';
										$table.='</tr>';
										
										$tipopago_data[(string)$tipopago->id_tipoPago]= (string)$tipopago->nombre_tipoPago;
									}
									}
									echo $table;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			
			
			</center>
		</div> 
	</div>
</div>

<?php 
echo form_close();
echo getFooter('<script src="/solaris/resources/JS/remisiones/remisiones_update.js"></script>');
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>