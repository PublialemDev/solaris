<?php
echo getHeader('Categorias de Productos');

//Propiedades del form
$form_catproductos = array('id'=>'form_catproductos','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$catproductos_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30);
?>

<div id="container" class='container'>
	
	<table>
		<tbody>
			<?php echo form_open('#',$form_catproductos); ?>
			<?php echo form_hidden('idCatProducto','0');?>
			<tr>
				<td><?php echo form_label('Nombre: ','nombre');?></td>
				<td><?php echo form_input($catproductos_nombre);?></td>
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