<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CTipoPago extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('remisiones/mtipopago');
		$this->load->model('logs/mLogs');
	}
	
	public function insertTipoPago(){		
		$this->load->view('remisiones/vtipopagoinsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('NOMBRE_TXT'), 
		'descripcion' => $this->input->post('DESCRIPCION_TXT'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$tipopago_id = $this->mtipopago->insertTipoPago($datos);
		
		echo 'SUCCESS;'.$tipopago_id;

	}
	
	
	public function formSelectTipoPago(){		
		$this->load->view('remisiones/vtipopagoselect');
	}
	
	public function selectTipoPago(){		
		$tipopago_id=$this->input->post('tipopago_id');
		$tipopago_nombre=$this->input->post('tipopago_nombre');
		$where_clause=array();
		
		if($tipopago_id!= null and $tipopago_id!=''){
			$where_clause['tipopago_id']=$tipopago_id;
		}
		if($tipopago_nombre!= null and $tipopago_nombre!=''){
			$where_clause['tipopago_nombre']=$tipopago_nombre;
		}
		
		$res=$this->mtipopago->selectTipoPago($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $tipopago) {
				$json.='{';
				$json.='"id":'.'"'.$tipopago->id_tipoPago.'",';
				$json.='"nombre":'.'"'.$tipopago->nombre_tipoPago.'",';
				$json.='"descripcion":'.'"'.$tipopago->descripcion_tipoPago.'"';
				$json.='}';
				if($tipopago->id_tipoPago!=$last->id_tipoPago){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}		
	}

	public function updateTipoPago(){
		$tipopago_id=$this->input->post('IDTIPOPAGO');//Almacenara el ID(hidden) generado en la actualizacion
		$tipopago_data;
		$response;
		
		//establece los datos de la categoria para la actualizacion
		$tipopago_data = array(
		'idTipoPago'=>$tipopago_id,
		'nombre'=>$this->input->post('NOMBRE_TXT'),
		'descripcion'=>$this->input->post('DESCRIPCION_TXT')
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->mtipopago->updateTipoPago($tipopago_data);
		if($response == 1){
			echo "El registro se actualizo correctamente";
		}
		
	}

	public function formUpdateTipoPago(){
		$id_tipopago=$this->input->get('id_tipoPago');
		$data['tipopago']=$this->mtipopago->selectTipoPagoById($id_tipopago);
		$this->load->view('remisiones/vtipopagoupdate',$data);
	}
	
	public function deleteTipoPago(){
		$id_tipopago = $this->input->post('idTipoPago');		
		$returned = $this->mtipopago->deleteTipoPago($id_tipopago);
		
		if($returned>0){
			$this->mLogs->insertLog(array('tipo_log'=>'delete_tipopago','descripcion_log'=>'se elimino el tipo de pago: '.$id_tipopago));
		}
		return 'Mensage: '.$returned;
	}
}
?>