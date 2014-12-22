<?php 
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){	
	echo getHeader('Consulta de Seguimiento a Clientes');
	echo getMenu();

	//Propiedades del input 
	$segui_id =array('name'=>'segui_id','placeholder'=>'ID','value'=>'','class'=>'form-control');
	$segui_cli =array('name'=>'segui_cli','placeholder'=>'Cliente','value'=>'','class'=>'form-control');
	$segui_cat = array('name'=>'segui_cat','placeholder'=>'Categoria','value'=>'','class'=>'form-control');
	$cli_data=$clientes->first_row();
	$cli_id=$cli_data->id_cliente;
	$cli_nombre=$cli_data->nombre_cliente;
	$cli_rfc=$cli_data->rfc;
	//traduce el nivel del cliente
	$cli_nivel=$cli_data->nivel;
	switch($cli_nivel){
		case 'nor':
			$cli_nivel='Normal';
			break;
		case 'adv':
			$cli_nivel='Avanzado';
			break;
		case 'pre':
			$cli_nivel='Premier';
			break;
		default:
			$cli_nivel='--';
	}
?>


<div id="container" class='container'>
	<div class="panel panel-info">
		<div class="panel-heading">Consulta de Seguimiento a Clientes</div>
		<div class="panel-body">
			<div class='container-fluid'>
					<div class="row">
						<div class='col-md-9'>
			<center>
			<table >
				<tbody>
					<tr>
						<td><h4>
							<span><?php echo 'Id de Cliente: ';?></span>
							<span><b><?php echo $cli_id .'&nbsp&nbsp&nbsp';?></b></span>
							<span><?php echo 'Nombre: ';?></span>
							<span><b><?php echo $cli_nombre .'&nbsp&nbsp&nbsp';?></b></span>
							</h4>
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo 'RFC: ';?></span>
							<span><b><?php echo $cli_rfc.'&nbsp&nbsp&nbsp';?></b></span>
							<span><?php echo 'Nivel: ';?></span>
							<span><b><?php echo $cli_nivel.'&nbsp&nbsp&nbsp';?></b></span>
						</td>
					</tr>	
				</tbody>
			</table>
			</center>
			</div>
			<div class='col-md-3'>
				<?php echo form_button('seg_insertar','Insertar seguimeinto','class="btn btn-primary"'); ?>
			</div>
			</div>
			</div>
		</div>
	</div>
	
	<div id='target' class='well'>
		<table class='table table-hover datos'>
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Categoria</th>
					<th>Comentario</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$row='';
				if($seguimientos!=false){
					foreach ($seguimientos->result() as $seguimiento) {
						$seg_id=$seguimiento->id_seguimientoCliente;
						$cat_id=$seguimiento->idCategoria;
						$cat_nombre=$seguimiento->nombre_categoriaSeguimiento;
						$seg_fecha=$seguimiento->fecha;
						$seg_comentario=$seguimiento->comentario;
						$marca='';
						if($cat_id=='0'){
							$marca='class="success"';
						}
						
						$row.='<tr id="'.$seg_id.'" '.$marca.'>';
						$row.='<td>'.$seg_fecha.'</td>';
						$row.='<td>'.$cat_nombre.'</td>';
						$row.='<td>'.$seg_comentario.'</td>';
						$row.='</tr>';
					}
				}else{
					$row='<tr><td colspan="3">No hay seguimientos para mostrar</td></tr>';
				}
				echo $row;
				?>
			</tbody>
		</table>
		
	</div>
	
</div>

<?php
echo getFooter('<script src="http://localhost/solaris/resources/JS/clientes/seguimiento_select.js"></script>') ;

}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>