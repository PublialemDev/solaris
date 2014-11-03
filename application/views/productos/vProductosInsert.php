<?php
echo getHeader('Productos');

//Propiedades del form
$form_producto = array('id'=>'form_producto','onSubmit'=>'getValues(this,event)');

//Propiedades de los input 
$producto_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>'');
$producto_proveedor =array('name'=>'proveedor_txt','placeholder'=>'Proveedor','value'=>'');
$producto_precio =array('name'=>'precio_txt','placeholder'=>'Precio','value'=>'');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30);

//Propiedades del combobox
$producto_estatus = array('A' => 'ACTIVO', 'I' => 'INACTIVO')
?>

<div id="container" class='container'>
	
	<table>
		<tbody>
			<?php echo form_open('#',$form_producto); ?>
			<?php echo form_hidden('idSeguimiento','0');?>
			<tr>
				<td><?php echo form_label('Nombre: ','nombre');?></td>
				<td><?php echo form_input($producto_nombre);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Categoria: ','categoria');?></td>
				<td><select name="categoria"> 
					<option value="0"></option>
					<?php foreach ($categorias->result() as $categoria) {
						echo '<option value="'.$categoria->id_categoriaProducto.'">'.$categoria->nombre_categoriaProducto.'</option>';
					}?> 
				</select></td>
			</tr>
			<tr>
				<td><?php echo form_label('Precio: ','precio');?></td>
				<td><?php echo form_input($producto_precio);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Proveedor: ','proveedor');?></td>
				<td><?php echo form_input($producto_proveedor);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Estatus: ','estatus');?></td>
				<td><?php echo form_dropdown('estatus',$producto_estatus,'A');?></td>
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