<?php
echo getHeader('Tipo de Pago');

//Propiedades del form
$form_tipopago = array('id'=>'$form_tipopago','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$tipopago_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30);
?>

<div id="container" class='container'>
	
	<table>
		<tbody>
			<?php echo form_open('#',$form_tipopago); ?>
			<?php echo form_hidden('idTipoPago','0');?>
			<tr>
				<td><?php echo form_label('Nombre: ','nombre');?></td>
				<td><?php echo form_input($tipopago_nombre);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Descripcion:','descripcion');?></td>
				<td><?php echo form_textarea($datos);?></td>
			</tr>
			
			<tr>
				<td><?php echo form_button('enviar','ENVIAR','class="enviarButton"');?></td>
			</tr>
		</tbody>
	</table>
</div>

<?php 
echo form_close();
echo getFooter();
?>