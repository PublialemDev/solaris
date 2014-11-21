<?php 
//session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	echo getHeader('Actualización de Categoria de Productos'); 
	echo getMenu();
	$catprodu_nombre_data='';$catprodu_descripcion_data='';

	if($catproducto!=false){
		$catprodu_data=$catproducto->first_row();
		$catprodu_nombre_data=$catprodu_data->nombre_categoriaProducto;
		$catprodu_descripcion_data=$catprodu_data->descripcion_categoriaProducto;
	}
	
	//Propiedades del form
$form_catproducto = array('id'=>'form_catproducto','onSubmit'=>'getValues(this,event)');

//Propiedades del input 
$catproducto_nombre =array('name'=>'nombre_txt','placeholder'=>'Nombre','value'=>$catprodu_nombre_data,'class'=>'form-control', 'disabled'=>'disabled');

//Propiedades del TextArea
$datos = array('id' => 'descripcion_txt','name' => 'descripcion_txt','value' =>$catprodu_descripcion_data,'rows' => 5, 'cols' =>30,'class'=>'form-control', 'disabled'=>'disabled');

$label=array('class'=>'control-label');
?>


<div id="container" class='container'>
	
	<table>
		<tbody>
	<?php echo form_open('#',$form_catproducto); ?>
	<?php echo form_hidden('idCatProducto',$catprodu_data->id_categoriaProducto);?>
		<!--,$catsegui_data->id_categoriaSeguimiento-->
		<tr>
			<td><?php echo form_label('Nombre: ','nombre',$label);?></td>
			<td><?php echo form_input($catproducto_nombre);?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Descripcion:','descripcion',$label);?></td>
			<td><?php echo form_textarea($datos);?></td>
		</tr>
	
	<?php echo form_close(); ?>
	</tbody>
	</table>
	
	<table>
		<tr>
			<td><?php echo form_button('editar','Editar','class="enableButton btn btn-primary"');?></td>
			<td><?php echo form_button('eliminar','Eliminar','class="deleteButton btn btn-primary"');?></td>
		</tr>
	</table>
	
</div>

<?php
echo getFooter('<script src="/solaris/resources/JS/productos/categoriaproductos_update.js"></script>') ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>