<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class CRemisiones extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('remisiones/mremisiones');
		$this->load->model('remisiones/mproductoremision');
		$this->load->model('clientes/mseguimiento');
		$this->load->library('table');
	}
	
	/*
	 * Muestra el formulario para generar una remision
	 * @author Luis Briseño
	 * 
	 * */
	public function insertRemisionForm(){		
		$datos['sucursales'] = $this->mremisiones->selectSucursales();
		$datos['tipopagos'] = $this->mremisiones->selectTipoPagos();

		$this->load->view('remisiones/vremisionesinsert',$datos);
	}
	
	/*
	 * Muestra el formulario para generar una remision
	 * @author Luis Briseño
	 * 
	 * */
	public function insertRemision(){
		$sysdate=new DateTime();
		$remi_data=array(
		'idSucursal'=>$this->input->post('IDSUCURSAL'),
		'idCliente'=>$this->input->post('CLIENTE_TXT'),
		'idTipoPago'=>$this->input->post('IDTIPOPAGO'),
		'fecha'=>$this->input->post('FECHA_TXT'),
		'instalacion'=>$this->input->post('INSTALACION'),
		'total'=>$this->input->post('TOTAL_TXT'),
		'iva'=>$this->input->post('IVA_TXT'));		
		$generated=$this->mremisiones->insertRemision($remi_data);
		if(is_numeric($generated)){
			$productos=$this->input->post('PRODUCTOS');
			$prod_data=explode('#',$productos);
			foreach ($prod_data as $prod) {
				if($prod!='' && $prod != null){
				$producto=explode(';',$prod);
				$this->mproductoremision->insertProductoRemision(
				array( 
				'id_remision'=>$generated,
				'id_producto'=>$producto[0],
				'cantidad'=>$producto[1],
				'precio_actual'=>$producto[2],
				'descuento'=>$producto[3],
				'nivel_cliente'=>$producto[4]
				));
				}
			}
			$datos=array(
			'id_cliente'=> $remi_data['idCliente'],
			'id_catseguimiento'=> '0',
			'comentario'=> 'Remision generada ('.$generated.')'.'Total:'.($remi_data['total'] + $remi_data['iva']),
			'fecha'=> $remi_data['fecha'],
			);
			$this->mseguimiento->insertSeguimiento($datos);
			echo 'SUCCESS;'.$generated;
		}else{
			echo 'ERROR;'.$generated;
		}
		
		
	}
	
	
	//muestra la estructura para la ventana modal de busqueda de clientes
	public function modalClientes(){
		
		$this->load->view('clientes/vClientesSelectModal');
	}
	
	//muestra la estructura para la ventana modal de busqueda de productos
	public function modalProductos(){
		$datos['cli_id'] = $this->input->post('cli_id');
		$this->load->view('productos/vProductosSelectModal',$datos);
	}
	
	public function formUpdateRemision(){
		$id_remision=$this->input->get('id_Remision');
		$datos['sucursales'] = $this->mremisiones->selectSucursales();
		$datos['tipopagos'] = $this->mremisiones->selectTipoPagos();
		$datos['remision'] = $this->mremisiones->selectRemisionById($id_remision);
		$datos['remisionproducto'] = $this->mproductoremision->selectProductoRemisionById($id_remision);
		$datos['tipoUsuario'] = $this->mremisiones->tipoUsuario(base64_decode($_SESSION['USUARIO_ID']));
		$this->load->view('remisiones/vremisionesupdate',$datos);
	}
	
	public function updateRemision(){
		$remi_data=array(
		'idRemision'=>$this->input->post('IDREMISION'),
		'idSucursal'=>$this->input->post('IDSUCURSAL'),
		'idCliente'=>$this->input->post('CLIENTE_TXT'),
		'idTipoPago'=>$this->input->post('IDTIPOPAGO'),
		'fecha'=>$this->input->post('FECHA_TXT'),
		'instalacion'=>$this->input->post('INSTALACION'),
		'total'=>$this->input->post('TOTAL_TXT'),
		'iva'=>$this->input->post('IVA_TXT'));		
		$generated=$this->mremisiones->updateRemision($remi_data);
		
		if($generated>0){
			$generated=$this->mproductoremision->deleteProductoRemision($remi_data['idRemision']);
			if($generated){
				$productos=$this->input->post('PRODUCTOS');
				$prod_data=explode('#',$productos);
				foreach ($prod_data as $prod) {
					if($prod!='' && $prod != null){
						$producto=explode(';',$prod);
						$this->mproductoremision->insertProductoRemision(
							array( 
								'id_remision'=>$remi_data['idRemision'],
								'id_producto'=>$producto[0],
								'cantidad'=>$producto[1],
								'precio_actual'=>$producto[2],
								'descuento'=>$producto[3]
							)
						);
					}
				}
				echo 'SUCCESS;'.$remi_data['idRemision'];
			}else{
				echo 'ERROR;'.$generated;
			}
		}else{
			echo 'ERROR;'.$generated;
		}
		
		
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('idSucursal' => $this->input->post('sucursal'), 
		'idCliente' => $this->input->post('cliente_txt'), 
		'idTipoPago' => $this->input->post('tipopago'), 
		'fecha' => $this->input->post('fecha_txt'), 
		'instalacion' => $this->input->post('instalacion'), 
		'total' => $this->input->post('total_txt'), 
		'iva' => $this->input->post('iva_txt'),
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$this->mremisiones->insertRemision($datos);
	}
	
	public function selectRemisionesForm(){
		$datos['sucursales'] = $this->mremisiones->selectSucursales();
		$datos['tipopagos'] = $this->mremisiones->selectTipoPagos();
		$this->load->view('remisiones/vremisionesselect',$datos);
	}

	public function selectRemisionesJson(){
		$cli_id=$this->input->post('cli_id');
		$suc_id=$this->input->post('suc_id');
		$tipopago_id=$this->input->post('tipopago_id');
		$fecha_inicio=$this->input->post('fecha_inicio');
		$fecha_fin=$this->input->post('fecha_fin');
		
		$where_clause=array();
		if($cli_id!= null and $cli_id!=''){
			$where_clause['cli_id']=$cli_id;
		}
		if($suc_id!= null and $suc_id!='0'){
			$where_clause['suc_id']=$suc_id;
		}
		if($tipopago_id!= null and $tipopago_id!='0'){
			$where_clause['tipopago_id']=$tipopago_id;
		}
		if($fecha_inicio!= null and $fecha_inicio!=''){
			$where_clause['fecha_inicio']=$fecha_inicio;
		}
		if($fecha_fin!= null and $fecha_fin!=''){
			$where_clause['fecha_fin']=$fecha_fin;
		}

		$res=$this->mremisiones->selectRemisiones($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $remision) {
				$json.='{';
				$json.='"rem_id":'.'"'.$remision->id_remision.'",';
				$json.='"suc_id":'.'"'.$remision->id_sucursal.'",';
				$json.='"cli_id":'.'"'.$remision->id_cliente.'",';
				$json.='"tipopago_id":'.'"'.$remision->id_tipoPago.'",';
				$json.='"rem_fecha":'.'"'.$remision->fecha.'",';
				$json.='"rem_instalacion":'.'"'.$remision->instalacion.'",';
				$json.='"rem_total":'.'"'.$remision->total.'",';
				$json.='"rem_iva":'.'"'.$remision->iva.'"';
				$json.='}';
				if($remision->id_remision!=$last->id_remision){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}
	}

function deleteRemision(){
	$id_remision=$this->input->post('idRemision');	
	$returned = $this->mremisiones->deleteRemision($id_remision);
	
	if($returned>0){
		$this->mLogs->insertLog(array('tipo_log'=>'delete_remision','descripcion_log'=>'se elimino la remision: '.$id_remision));
	}
	return 'Mensage: '.$returned;
}
			
} 
?>