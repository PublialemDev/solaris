<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CSeguimiento extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('clientes/mseguimiento');
		$this->load->model('logs/mLogs');
	}
	
	public function modalClientes(){
		
		$this->load->view('clientes/vClientesSelectModal');
	}
	
	public function insertSeguimiento(){
		$data['catseguimiento'] = $this->mseguimiento->selectCatSeguimiento();		
		$this->load->view('clientes/vseguimientoinsert',$data);
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array(
		'id_cliente' => $this->input->post('CLIENTE_TXT'), 
		'fecha' => $this->input->post('FECHA_TXT'), 
		'comentario' => $this->input->post('DESCRIPTCION_TXT'), 
		'id_catseguimiento' => $this->input->post('SEGUI_CATE'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$segui_id = $this->mseguimiento->insertSeguimiento($datos);
		
		echo 'SUCCESS;'.$segui_id;

	}
	

	public function formSelectSeguimiento(){		
		$this->load->view('clientes/vseguimientoselect');
	}
	
	public function selectSeguimiento(){		
		$segui_id=$this->input->post('segui_id');
		$segui_cli=$this->input->post('segui_cli');
		$segui_cat=$this->input->post('segui_cat');
		
		$where_clause=array();
		
		if($segui_id!= null and $segui_id!=''){
			$where_clause['segui_id']=$segui_id;
		}
		if($segui_cli!= null and $segui_cli!=''){
			$where_clause['segui_cli']=$segui_cli;
		}
		if($segui_cat!= null and $segui_cat!=''){
			$where_clause['segui_cat']=$segui_cat;
		}
		
		$res=$this->mseguimiento->selectSeguimiento($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $seguimiento) {
				$json.='{';
				$json.='"id":'.'"'.$seguimiento->id_seguimientoCliente.'",';
				$json.='"cliente":'.'"'.$seguimiento->nombre_cliente.'",';
				$json.='"categoria":'.'"'.$seguimiento->nombre_categoriaSeguimiento.'"';
				$json.='}';
				if($seguimiento->id_seguimientoCliente!=$last->id_seguimientoCliente){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}		
	}

	public function updateSeguimiento(){
		$segui_id=$this->input->post('idSeguimiento');//Almacenara el ID(hidden) generado en la actualizacion
		$segui_data;
		$response;
		
		//establece los datos de la categoria para la actualizacion
		$segui_data = array(
		'idSeguimiento'=>$segui_id,
		'id_cliente' => $this->input->post('CLIENTE_TXT'), 
		'fecha' => $this->input->post('FECHA_TXT'), 
		'comentario' => $this->input->post('DESCRIPTCION_TXT'), 
		'id_catseguimiento' => $this->input->post('SEGUI_CATE'),
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->mseguimiento->updateSeguimiento($segui_data);
		if($response == 1){
			echo "El registro se actualizo correctamente";
		}
		
	}
	
	public function formUpdateSeguimiento(){
		$data['catseguimiento'] = $this->mseguimiento->selectCatSeguimiento();
		$id_segui = $this->input->get('id_seguimiento');
		$data['seguimiento']=$this->mseguimiento->selectSeguimientoById($id_segui);
		$this->load->view('clientes/vseguimientoupdate',$data);
	}
	
	public function deleteSeguimiento(){
		$id_segui = $this->input->post('idSeguimiento');		
		$returned = $this->mseguimiento->deleteSeguimiento($id_segui);
		
		if($returned>0){
			$this->mLogs->insertLog(array('tipo_log'=>'delete_seguimiento','descripcion_log'=>'se elimino el seguimiento: '.$id_segui));
		}
		return 'Mensage: '.$returned;
	}
}
?>