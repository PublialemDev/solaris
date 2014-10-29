<?php echo getHeader('Productos');?>

<?php
echo form_open('productos/cProductos/insertProducto');
echo form_submit('','NUEVO');
echo form_close();

echo form_open('productos/cProductos/recibirDatos');
echo form_submit('','MODIFICAR');
echo form_close();

echo form_open('productos/cProductos/recibirDatos');
echo form_submit('','ELIMINAR');
echo form_close();

echo "<br>";

$this->table->set_heading('ID--', 'NOMBRE--', 'CATEGORIA--', 'DESCRIPCION--', 
'PRECIO--', 'PROVEEDOR--', 'ESTATUS--', 'creado_en--', 'creado_por--', 'modificado_en--', 'modificado_por');
echo $this->table->generate($query);
?>


<?php echo getFooter();?>