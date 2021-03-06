<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CCategoriaSeguimiento extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('clientes/mcategoriaseguimiento');
		$this->load->model('logs/mLogs');
	}
	
	public function insertCategoriaSeguimiento(){		
		$this->load->view('clientes/vcategoriaseguimientoinsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('NOMBRE_TXT'), 
		'descripcion' => $this->input->post('DESCRIPCION_TXT'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$catsegui_id = $this->mcategoriaseguimiento->insertCategoriaSeguimiento($datos);
		
		echo 'SUCCESS;'.$catsegui_id;

	}
	
	
	public function formSelectCategoriaSeguimiento(){		
		$this->load->view('clientes/vcategoriaseguimientoselect');
	}
	
	public function selectCategoriaSeguimiento(){		
		$segui_id=$this->input->post('catseguimiento_id');
		$segui_nombre=$this->input->post('catseguimiento_nombre');
		$where_clause=array();
		
		if($segui_id!= null and $segui_id!=''){
			$where_clause['catseguimiento_id']=$segui_id;
		}
		if($segui_nombre!= null and $segui_nombre!=''){
			$where_clause['catseguimiento_nombre']=$segui_nombre;
		}
		
		$res=$this->mcategoriaseguimiento->selectCategoriaSeguimiento($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $catseguimiento) {
				$json.='{';
				$json.='"id":'.'"'.$catseguimiento->id_categoriaSeguimiento.'",';
				$json.='"nombre":'.'"'.$catseguimiento->nombre_categoriaSeguimiento.'",';
				$json.='"descripcion":'.'"'.$catseguimiento->descripcion_categoriaSeguimiento.'"';
				$json.='}';
				if($catseguimiento->id_categoriaSeguimiento!=$last->id_categoriaSeguimiento){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}		
	}

	public function updateCategoriaSeguimiento(){
		$catsegui_id=$this->input->post('IDCATSEGUIMIENTO');//Almacenara el ID(hidden) generado en la actualizacion
		$catsegui_data;
		$response;
		
		//establece los datos de la categoria para la actualizacion
		$catsegui_data = array(
		'idCatSeguimiento'=>$catsegui_id,
		'nombre'=>$this->input->post('NOMBRE_TXT'),
		'descripcion'=>$this->input->post('DESCRIPCION_TXT')		
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->mcategoriaseguimiento->updateCategoriaSeguimiento($catsegui_data);
		if($response == 1){
			echo "El registro se actualizo correctamente";
		}
		
	}
	
	public function formUpdateCategoriaSeguimiento(){
		$id_catseguimiento=$this->input->get('id_categoriaSeguimiento');
		$data['catseguimiento']=$this->mcategoriaseguimiento->selectCategoriaSeguimientoById($id_catseguimiento);
		$this->load->view('clientes/vcategoriaseguimientoupdate',$data);
	}
	
	public function deleteCategoriaSeguimiento(){
		$id_catseguimiento = $this->input->post('idCatSeguimiento');		
		$returned = $this->mcategoriaseguimiento->deleteCategoriaSeguimiento($id_catseguimiento);
		
		if($returned>0){
			$this->mLogs->insertLog(array('tipo_log'=>'delete_categoriaseguimiento','descripcion_log'=>'se elimino la categoria de seguimiento: '.$id_catseguimiento));
		}
		return 'Mensage: '.$returned;
	}
}
?>