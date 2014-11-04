<?php echo getHeader('Remisiones');?>

<?php
echo form_open('remisiones/cremisiones/insertRemision');
echo form_submit('','NUEVO');
echo form_close();
echo "<br>";

$this->table->set_heading('ID--', 'SUCURSAL--', 'CLIENTE--','TIPO DE PAGO--','FECHA--','INSTALACION--','TOTAL--','IVA--', 'creado_en--', 'creado_por--', 'modificado_en--', 'modificado_por');
echo $this->table->generate($query);
?>


<?php echo getFooter();?>