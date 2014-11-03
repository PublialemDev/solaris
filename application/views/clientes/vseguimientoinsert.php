<?php
echo getHeader('Categorias de Seguimiento a Clientes');

//Propiedades del form
$form_seguimiento = array('id'=>'form_seguimiento','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$seguimiento_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30);
?>

<div id="container" class='container'>
	
	<table>
		<tbody>
			<?php echo form_open('#',$form_seguimiento); ?>
			<?php echo form_hidden('idSeguimiento','0');?>
			<tr>
				<td><?php echo form_label('Nombre: ','nombre');?></td>
				<td><?php echo form_input($seguimiento_nombre);?></td>
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