<?php
echo getHeader('Clientes');
echo form_open('clientes/cClientes/recibirDatos');

echo form_label('Nombre: ', 'nombre');
echo form_input('nombre_txt');
echo "<br>";

echo form_label('R.F.C: ', 'rfc');
echo form_input('rfc_txt');
echo "<br>";

echo form_submit('','GUARDAR');

echo form_close();
echo getFooter();
?>
