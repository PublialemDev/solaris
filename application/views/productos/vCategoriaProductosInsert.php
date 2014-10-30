<?php
echo getHeader('Categorias de Productos');
echo form_open('productos/cCategoriaProductos/getValues');

echo form_label('Nombre: ');
echo form_input('nombre_txt');
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