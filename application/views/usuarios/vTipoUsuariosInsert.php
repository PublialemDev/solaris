<?php
echo getHeader('Tipos de Usuario');

//Propiedades del form
$form_tipousuario = array('id'=>'$form_tipousuario','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$tipousuario_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30);
?>

<div id="container" class='container'>
	
	<table>
		<tbody>
			<?php echo form_open('#',$form_tipousuario); ?>
			<?php echo form_hidden('idTipoUsuario','0');?>
			<tr>
				<td><?php echo form_label('Nombre: ','nombre');?></td>
				<td><?php echo form_input($tipousuario_nombre);?></td>
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