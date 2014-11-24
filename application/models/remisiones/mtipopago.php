<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoPago extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertTipoPago($datos){
		$returned = $this->db->insert('tipopagos',array('nombre_tipoPago'=> $datos['nombre'],
		'descripcion_tipoPago'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_TIPOPAGO','descripcion_log'=>'SE INSERTO TIPO DE PAGO'.$returned));			
		}
		
		return $returned;
	}
	
	
	function updateTipoPago($tipopago_data_form){		
		$sysdate = new DateTime();
		$tipopago_data = array('nombre_tipoPago'=> $tipopago_data_form['nombre'],
			'descripcion_tipoPago'=> $tipopago_data_form['descripcion'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('tipopagos',$tipopago_data,array('id_tipoPago'=>$tipopago_data_form['idTipoPago']));
		
		//insertar log para auditoria
		if($returned == 1){
			$this->mLogs->insertLog(array('tipo_log'=>'UPDATE_TIPOPAGO','descripcion_log'=>'update del tipo de pago: '.$tipopago_data_form['idTipoPago']));
		}
		
		return $returned;
	}

	function deleteTipoPago($tipopago_id){
		$sysdate=new DateTime();
		
		$returned=$this->db->delete('tipopagos',array('id_tipoPago'=>$tipopago_id));
		return $returned;
	}

function selectTipoPago($where_clause){
		
		if(isset($where_clause['tipopago_id'])){
			$this->db->where('id_tipoPago',$where_clause['tipopago_id']);
		}
		if(isset($where_clause['tipopago_nombre'])){
			$this->db->like('nombre_tipoPago',$where_clause['tipopago_nombre']);
		}
		$query = $this->db->get('tipopagos');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectTipoPagoById($id_tipopago){
		$where_clause = array('id_tipoPago'=>$id_tipopago);
		$query = $this->db->get_where('tipopagos',$where_clause);
		
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}

	
}
?>