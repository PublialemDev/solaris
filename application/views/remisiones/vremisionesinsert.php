<?php
echo getHeader('Remisiones');

//Propiedades del form
//$form_remision = array('id'=>'form_remision','onSubmit'=>'getValues(this,event)');

//Propiedades de los input 
$remision_cliente =array('name'=>'cliente_txt','placeholder'=>'Cliente','value'=>'');
$remision_fecha =array('id' => 'fecha', 'name'=>'fecha_txt','placeholder'=>'Fecha','value'=>'');
$remision_total =array('name'=>'total_txt','placeholder'=>'Total','value'=>'');
$remision_iva =array('name'=>'iva_txt','placeholder'=>'IVA','value'=>'');

//Propiedades del combobox
$remision_instalacion = array('N' => 'NO', 'S' => 'SI');
?>

<div id="container" class='container'>
	
	<table>
		<tbody>
			<?php echo form_open('remisiones/CRemisiones/getValues'); ?>
			<?php echo form_hidden('idRemision','0');?>			
			<tr>
				<td><?php echo form_label('Sucursal: ','sucursal');?></td>
				<td><select name="sucursal"> 
					<option value="0"></option>
					<?php 
					foreach ($sucursales->result() as $sucursal) {
						echo '<option value="'.$sucursal->id_sucursal.'">'.$sucursal->nombre_sucursal.'</option>';
					}?> 
				</select></td>
			</tr>
			<tr>
				<td><?php echo form_label('Cliente: ','cliente');?></td>
				<td><?php echo form_input($remision_cliente);?></td>
				<td><?php echo form_button('buscar','BUSCAR','class="buscarButton"');?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Tipo de Pago: ','tipopago');?></td>
				<td><select name="tipopago"> 
					<option value="0"></option>
					<?php 
					foreach ($tipopagos->result() as $tipopago) {
						echo '<option value="'.$tipopago->id_tipoPago.'">'.$tipopago->nombre_tipoPago.'</option>';
					}?> 
				</select></td>
			</tr>
			<tr>
				<td><?php echo form_label('Fecha: ','fecha');?></td>
				<td><?php echo form_input($remision_fecha);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Instalacion: ','instalacion');?></td>
				<td><?php echo form_dropdown('instalacion',$remision_instalacion,'N');?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Total: ','total');?></td>
				<td><?php echo form_input($remision_total);?></td>
			</tr>
			
			<tr>
				<td><?php echo form_label('IVA:','iva');?></td>
				<td><?php echo form_input($remision_iva);?></td>
			</tr>
			
			<tr>
				<td><?php //echo form_button('enviar','ENVIAR','class="enviarButton"');
					echo form_submit('enviar','ENVIAR');?></td>
			</tr>
		</tbody>
	</table>
</div>

<?php 
echo form_close();
echo obtenerFecha(); 
echo getFooter();
?>