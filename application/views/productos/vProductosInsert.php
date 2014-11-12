<?php
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Alta de Productos');
//labels
 $label=array('class'=>'control-label');
	 
//Propiedades del form
$form_producto = array('id'=>'form_producto','onSubmit'=>'getValues(this,event)','role'=>'form');

//Propiedades de los input 
$producto_nombre =array('name'=>'prod_nombre','placeholder'=>'Nombre','value'=>'','class'=>'form-control');
$producto_proveedor =array('name'=>'prod_proveedor','placeholder'=>'Proveedor','value'=>'','class'=>'form-control');
$producto_precio =array('name'=>'prod_precio','placeholder'=>'Precio','value'=>'','class'=>'form-control');

//Propiedades del TextArea
$datos = array('id' => 'prod_desc','name' => 'prod_desc','rows' => 5, 'cols' =>30,'class'=>'form-control');

//Propiedades del combobox
$producto_estatus = array('A' => 'ACTIVO', 'I' => 'INACTIVO')
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Registro de Productos</div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-6'>
								<table>
								<tbody>
									<?php echo form_open('#',$form_producto); ?>
									<?php echo form_hidden('prod_id','0');?>
									<tr>
										<td>
											<div class="form-group">
											<?php echo form_label('Nombre: ','prod_nombre',$label);?>
											<?php echo form_input($producto_nombre);?>
											</div>
											</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<?php echo form_label('Categoria: ','prod_categoria',$label);?>
												<select name="prod_categoria" class="form-control"> 
												<?php foreach ($categorias->result() as $categoria) {
													echo '<option value="'.$categoria->id_categoriaProducto.'">'.$categoria->nombre_categoriaProducto.'</option>';
												}?> 
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<?php echo form_label('Precio: ','prod_precio',$label);?>
												<?php echo form_input($producto_precio);?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<?php echo form_label('Proveedor: ','prod_proveedor',$label);?>
												<?php echo form_input($producto_proveedor);?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<?php echo form_label('Estatus: ','prod_estatus',$label);?>
												<?php echo form_dropdown('prod_estatus',$producto_estatus,'A', 'class="form-control"');?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<?php echo form_label('Descripcion:','prod_desc',$label);?>
												<?php echo form_textarea($datos);?>
											
											</div>
										</td>
									</tr>
									
									<tr>
										<td><?php echo form_button('enviar','ENVIAR','class="enviarButton btn btn-primary"');?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</center>
		</div>
	</div>
</div>

<?php echo form_close();?>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/productos/productos_insert.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>