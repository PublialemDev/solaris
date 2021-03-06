<?php

if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
echo getHeader('Reporte mensual');
echo getMenu();
//Propiedades del form
$form_ventaarticulos = array('id'=>'form_ventaarticulos', 'class'=>'form-inline');
$meses = array(
                  'january'  => 'Enero',
                  'february'    => 'Febrero',
                  'march'   => 'Marzo',
                  'april' => 'Abril',
                  'may'  => 'Mayo',
                  'june'    => 'Junio',
                  'july'   => 'Julio',
                  'august' => 'Agosto',
                  'september'  => 'Septiembre',
                  'october'    => 'Octubre',
                  'november'   => 'Noviembre',
                  'december' => 'Diciembre',
                );

$label=array('class'=>'control-label');
?>

<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Reporte Venta de Articulos por Mes</div>
		<div class="panel-body">
			<center>
				<?php echo form_open('reportes/cventaarticulos/reporteVentaArticulos',$form_ventaarticulos); ?>								
					<div class="form-group">
						<?php echo form_label('MES:','mes',$label);?>
						<?php echo form_dropdown('mes', $meses, 'january','class="form-control"');?>
					</div>	
				
					<div class="form-group">
						<?php echo form_label('AÑO:','anio',$label);?>
						<select name="anio" class="form-control"> 
						<?php 
						$anio = date('Y');
						for($i=$anio; $i>($anio-5);$i--) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}?> 
						</select>
					</div>	
				
					<div class="form-group">
						<?php echo form_label('Categoria: ','prod_categoria',$label);?>
						<select name="prod_categoria" class="form-control"> 
						<?php foreach ($categorias->result() as $categoria) {
							echo '<option value="'.$categoria->id_categoriaProducto.'">'.$categoria->nombre_categoriaProducto.'</option>';
						}?> 
						</select>
					</div>
				<?php echo form_button('enviar','Generar Reporte','class="enviarButton  btn btn-primary"');?>
				<?php echo form_close();?>																
							
			</center>
		</div>								
	</div> 
</div>

<?php 
echo getFooter('<script src="/solaris/resources/JS/reportes/ventaarticulos.js"></script>');
}else{
	header('Location:/solaris/index.php/main/cLogin/');
}
?>


