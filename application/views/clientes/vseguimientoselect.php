<?php echo getHeader('Categorias de Seguimiento a Clientes');?>

<?php
echo form_open('clientes/CCategoriaSeguimiento/insertCategoriaSeguimiento');
echo form_submit('','NUEVO');
echo form_close();
echo "<br>";

$this->table->set_heading('ID--', 'NOMBRE--', 'DESCRIPCION--', 'creado_en--', 'creado_por--', 'modificado_en--', 'modificado_por');
echo $this->table->generate($query);
?>


<?php echo getFooter();?>