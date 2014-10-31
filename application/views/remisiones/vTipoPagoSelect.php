<?php echo getHeader('Tipo de Pago');?>

<?php
echo form_open('remisiones/cTipoPago/insertTipoPago');
echo form_submit('','NUEVO');
echo form_close();

echo form_open('productos/cProductos/recibirDatos');
echo form_submit('','MODIFICAR');
echo form_close();

echo form_open('productos/cProductos/recibirDatos');
echo form_submit('','ELIMINAR');
echo form_close();

echo "<br>";

$this->table->set_heading('ID--', 'NOMBRE--', 'DESCRIPCION--', 'creado_en--', 'creado_por--', 'modificado_en--', 'modificado_por');
echo $this->table->generate($query);
?>


<?php echo getFooter();?>