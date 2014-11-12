<?php
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Alta de Productos');
echo getMenu();
	$prod_id_data='0';
	$prod_nombre_data='';
	$prod_cat_data='';
	$prod_precio_data='';
	$prod_proveedor_data='';
	$prod_estatus_data='A';
	$prod_desc_data='';
	
	if($producto!=false){
		$prod_data=$producto->first_row();
		$prod_id_data=$prod_data->id_producto;
		$prod_nombre_data=$prod_data->nombre_producto;//
		$prod_cat_data=$prod_data->id_categoriaProducto;
		$prod_precio_data=$prod_data->precio;//
		$prod_proveedor_data=$prod_data->proveedor;//
		$prod_estatus_data=$prod_data->estatus_producto;
		$prod_desc_data=$prod_data->descripcion_producto;//
	}
	

//labels
 $label=array('class'=>'control-label');
	 
//Propiedades del form
$form_producto = array('id'=>'form_producto','onSubmit'=>'getValues(this,event)','role'=>'form');

//Propiedades de los input 
$producto_nombre =array('name'=>'prod_nombre','placeholder'=>'Nombre','value'=>$prod_nombre_data,'class'=>'form-control','disabled'=>'disabled');
$producto_proveedor =array('name'=>'prod_proveedor','placeholder'=>'Proveedor','value'=>$prod_proveedor_data,'class'=>'form-control','disabled'=>'disabled');
$producto_precio =array('name'=>'prod_precio','placeholder'=>'Precio','value'=>$prod_precio_data,'class'=>'form-control','disabled'=>'disabled');

//Propiedades del TextArea
$datos = array('id' => 'prod_desc','name' => 'prod_desc','rows' => 5, 'cols' =>30,'class'=>'form-control','value'=>$prod_desc_data,'disabled'=>'disabled');

//Propiedades del combobox
$producto_estatus = array('A' => 'ACTIVO', 'I' => 'INACTIVO');

foreach ($categorias->result() as $categoria) {
	$prod_categoria[$categoria->id_categoriaProducto]=$categoria->nombre_categoriaProducto;
}
												
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Actualización de Productos</div>
		<div class="panel-body">
			<center>
				<div class='container-fluid'>
					<div class="row">
						<div class='col-md-6'>
								<table>
								<tbody>
									<?php echo form_open('#',$form_producto); ?>
									<?php echo form_hidden('prod_id',$prod_id_data);?>
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
												<?php echo form_dropdown('prod_categoria', $prod_categoria,$prod_cat_data,'disabled="disabled" class="form-control"');?>
												
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
												<?php echo form_dropdown('prod_estatus',$producto_estatus,$prod_estatus_data, 'disabled="disabled" class="form-control"');?>
											</div>
										</td>
									</tr>
									</tbody>
							</table>
						</div>
						<div class='col-md-6'>
								<table>
								<tbody>
									<tr>
										<td>
											<div class="form-group">
												<?php echo form_label('Descripcion:','prod_desc',$label);?>
												<?php echo form_textarea($datos);?>
											
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<?php echo form_button('editar','Editar','class="enableButton btn btn-primary"');?>
											<?php echo form_button('eliminar','Eliminar','class="deleteButton btn btn-primary"');?>
										</td>
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
echo getFooter('<script src="http://localhost/solaris/resources/JS/productos/productos_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>