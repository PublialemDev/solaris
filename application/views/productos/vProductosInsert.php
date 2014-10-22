<?php
echo getHeader('Productos');
echo form_open('productos/cProductos/recibirDatos');

echo form_label('Nombre: ');
echo form_input('nombre_txt');
echo "<br>";

echo form_label('Categoria: ');
echo '<select name="categoria">' ;
echo '<option value="0"></option>';
foreach ($categorias->result() as $categoria) {
	echo '<option value="'.$categoria->id_categoriaProducto.'">'.$categoria->nombre_categoriaProducto.'</option>';
}  
echo '</select>'; 
echo "<br>";

echo form_label('Precio: ');
echo form_input('precio_txt');
echo "<br>";

echo form_label('Proveedor: ');
echo form_input('proveedor_txt');
echo "<br>";

$opc = array('A' => 'ACTIVO', 'I' => 'INACTIVO'); 
echo form_label('Estatus: ');
echo form_dropdown('estatus',$opc,'A');
echo "<br>";

$tamano = array('id' => 'descripcion_txt','name' => 'descripcion_txt','rows' => 5, 'cols' =>30);
echo form_label('Descripcion:');
echo "<br>";
echo form_textarea($tamano);
echo "<br>";


echo form_submit('','GUARDAR');

echo form_close();
echo getFooter();
?>