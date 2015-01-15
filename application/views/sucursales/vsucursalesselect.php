<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){
	echo getHeader('Consulta de Sucursales');
	echo getMenu(); 
	//sucursal
	$sucu_nombre =array('name'=>'sucu_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$sucu_paginaweb =array('name'=>'sucu_paginaweb','placeholder'=>'Pagina WEB', 'value'=>'','class'=>'form-control');
	$sucu_id =array('name'=>'sucu_id','placeholder'=>'Número de sucursal', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_sucu=array('id'=>'form_sucu','role'=>'form','onSubmit'=>'selectSucursales(this,event)');
	
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Sucursales</div>
		<div class="panel-body">
			<center>
			<?php echo form_open('#',$form_sucu); ?>
			<table >
				<tbody>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Número de Sucursal: ','sucu_id');?>
							<?php echo form_input($sucu_id);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Nombre: ','sucu_nombre');?>
							<?php echo form_input($sucu_nombre);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Pagina WEB: ','sucu_pagianweb');?>
							<?php echo form_input($sucu_paginaweb);?>
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo form_submit('enviar','Buscar','class="enviarButton btn btn-primary"');?></td>
					</tr>
				</tbody>
			</table>
			<?php echo form_close(); ?>
			</center>
		</div>
	</div>
	
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Pagina WEB</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="/solaris/resources/JS/sucursales/sucursales_select.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>

