<?php
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Remisiones');
echo getMenu();
//Propiedades del form
$form_remision = array('id'=>'form_remision','role'=>'form');
$form_remision_reporte = array('id'=>'form_remision_reporte');

//Propiedades de los input 
$remision_cliente =array('name'=>'cliente_name','placeholder'=>'Cliente','value'=>'','class'=>'form-control','disabled'=>'disabled');
$remision_fecha =array('id' => 'fecha', 'name'=>'fecha_txt','placeholder'=>'Fecha','value'=>'','class'=>'form-control');
$remision_total =array('name'=>'total_txt','placeholder'=>'Total','value'=>'','class'=>'form-control','disabled'=>'disabled');
$remision_iva =array('name'=>'iva_txt','placeholder'=>'IVA','value'=>'','class'=>'form-control','disabled'=>'disabled');

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
								
								<?php echo form_hidden('idRemision','0');?>			
								<tr>
									<td>
										<div class="form-group" >
										
										<?php echo form_label('Sucursal: ','sucursal');?>
										<select name="sucursal" class="form-control"> 
										<?php 
										foreach ($sucursales->result() as $sucursal) {
											echo '<option value="'.$sucursal->id_sucursal.'">'.$sucursal->nombre_sucursal.'</option>';
										}?> 
										</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Cliente: ','cliente',$label);?>
										<?php echo form_hidden('cliente_txt','0');?>
										<?php echo form_hidden('cliente_nivel','nor');?>
										<?php echo form_input($remision_cliente);?>
										</div>
									</td>
									<!--boton para buscar un cliente -->
								</tr>
								<tr>	
									<td><?php echo form_button('buscar','Buscar Cliente','class="btn btn-primary buscarButton" onclick="prepararModal(\'CLIENTES\')"');?></td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Tipo de Pago: ','tipopago',$label);?>
										<select name="tipopago" class="form-control"> 
										<?php 
										foreach ($tipopagos->result() as $tipopago) {
											echo '<option value="'.$tipopago->id_tipoPago.'">'.$tipopago->nombre_tipoPago.'</option>';
										}?> 
										</select>
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
										<?php echo form_dropdown('instalacion',$remision_instalacion,'N','class="form-control"');?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('Subtotal: ','total',$label);?>
										<?php echo form_input($remision_total);?>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>
										<div class="form-group">
										<?php echo form_label('IVA:','iva',$label);?>
										<?php echo form_checkbox(array('name'=>'iva_check'),'.16');?>
										<?php echo form_input($remision_iva);?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<?php echo form_label('Total:','total_general',$label);?>
											<span id="total_general">0</span>
										</div>
									</td>
								</tr>
								<tr>
									<td><center><?php echo form_button('saveButton','Guardar','class="btn btn-primary" onclick="guardarProductos()"');?></center></td>
								</tr>
								
							</tbody>
						</table>
						<?php echo form_close(); ?>
						<div id='reporte' style="display:none">
						<table>
							<tr>
								<td>
									<?php echo form_open('reportes/cremisionnote/generarPDF',$form_remision_reporte); ?>
									<?php echo form_hidden('idRemision','0');?>	
									<?php echo form_submit('printButton','Imprimir','class="btn btn-primary"');?>
									<?php echo form_close(); ?>
								</td>
							</tr>
						</table>
						</div>
						</div>
						<div id="tableTarget" class='col-md-7'>
							<?php echo form_button('agregarProductos','Agregar Productos','class="btn btn-primary" onclick="prepararModal(\'PRODUCTOS\')"');?>
							<?php echo form_button('eliminarProductos','Eliminar Producto','class="btn btn-danger" onclick="eliminarProducto()" disabled');?>
							<table id="tableProductos" class='table table-striped'>
								<thead>
									<th>Producto</th>
									<th>Descripcion</th>
									<th>cantidad</th>
								</thead>
								<tbody>
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
echo getFooter('<script src="/solaris/resources/JS/remisiones/remisiones_insert.js"></script>');
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>