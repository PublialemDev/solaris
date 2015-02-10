<?php 

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	if(base64_decode($_SESSION['USUARIO_TIPO'])==1){	
	echo getHeader('Consulta de Categoria de Productos');
	echo getMenu();
	//categoria seguimiento
	$catprodu_nombre =array('name'=>'catprodu_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
	$catprodu_id =array('name'=>'catprodu_id','placeholder'=>'Número de categoria', 'value'=>'','class'=>'form-control');
	
	//formularios
	$form_catprodu=array('id'=>'form_catprodu','role'=>'form','class'=>'form-inline','onSubmit'=>'selectCategoriaProductos(this,event)');
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de categoria de Productos</div>
		<div class="panel-body">
			<center>
				<?php echo form_open('#',$form_catprodu); ?>
				
					<div class="form-group">
						<?php echo form_label('Número de Categoria: ','catprodu_id');?>
						<?php echo form_input($catprodu_id);?>
					</div>
				
					<div class="form-group">
						<?php echo form_label('Nombre: ','catprodu_nombre');?>
						<?php echo form_input($catprodu_nombre);?>
					</div>
					<?php echo form_submit('enviar','Buscar','class="enviarButton btn btn-primary"');?>
				<?php echo form_close(); ?>
			</center>
		</div>
	</div>
	
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripcion</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="/solaris/resources/JS/productos/categoriaproductos_select.js"></script>') ;
	}else{
		header('Location:/solaris/index.php/main/cMain/main');
	}
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>