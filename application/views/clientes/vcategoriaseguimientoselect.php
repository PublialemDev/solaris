<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){	
	echo getHeader('Consulta de Categorias de Seguimiento a Clientes');
	echo getMenu();
	//categoria seguimiento
	$catseguimiento_nombre =array('name'=>'catseguimiento_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$catseguimiento_id =array('name'=>'catseguimiento_id','placeholder'=>'Número de categoria', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_catseguimiento=array('id'=>'form_catseguimiento','role'=>'form','onSubmit'=>'selectCategoriaSeguimiento(this,event)');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de categoría de seguimiento a clientes</div>
		<div class="panel-body">
			<center>
			<?php echo form_open('#',$form_catseguimiento); ?>
			<table >
				<tbody>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Número de Categoria: ','catseguimiento_id');?>
							<?php echo form_input($catseguimiento_id);?>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
							<?php echo form_label('Nombre: ','catseguimiento_nombre');?>
							<?php echo form_input($catseguimiento_nombre);?>
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
					<th>Descripción</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="/solaris/resources/JS/clientes/categoriaseguimiento_select.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>