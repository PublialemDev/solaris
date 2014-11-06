
<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
	echo getHeader('Consulta de Clientes'); 
	//cliente
	$cli_nombre =array('name'=>'cli_nombre','placeholder'=>'Nombre','value'=>'');
	$cli_rfc =array('name'=>'cli_rfc','placeholder'=>'RFC', 'value'=>'');
	$cli_id =array('name'=>'cli_id','placeholder'=>'Número de cliente', 'value'=>'');
	
	//formularios
	$form_cliente=array('id'=>'form_cliente','onSubmit'=>'selectCliente(this,event)');
	//$form_tel=array('id'=>'form_tel','onSubmit'=>'insertCliente(this,event)','class'=>'form');
	/*foreach ($estados->result() as $estado) {
		$dir_estado[(string)$estado->id_estado]= (string)$estado->nombre_estado;
	}*/
?>


<div id="container" class='container'>
	
	<?php echo form_open('#',$form_cliente); ?>
	<table >
		<tbody>
			<tr>
				<td><?php echo form_label('Número de Cliente: ','cli_id');?></td>
				<td><?php echo form_input($cli_id);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nombre: ','cli_nombre');?></td>
				<td><?php echo form_input($cli_nombre);?></td>
			</tr>
			<tr>
				<td><?php echo form_label('RFC: ','cli_rfc');?></td>
				<td><?php echo form_input($cli_rfc);?></td>
			</tr>
			<tr>
				<td><?php echo form_submit('enviar','ENVIAR','class="enviarButton btn btn-primary"');?></td>
			</tr>
		</tbody>
	</table>
	<?php echo form_close(); ?>
	
	<div id='target'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>RFC</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getJsClientes_select(); 
echo getFooter() ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>

