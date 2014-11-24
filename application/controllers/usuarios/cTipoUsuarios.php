<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CTipoUsuarios extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('usuarios/mtipousuarios');
		$this->load->model('logs/mLogs');
	}
	
	public function insertTipoUsuarios(){		
		$this->load->view('usuarios/vtipousuariosinsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('NOMBRE_TXT'), 
		'descripcion' => $this->input->post('DESCRIPCION_TXT'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$tipousuarios_id = $this->mtipousuarios->insertTipoUsuarios($datos);
		
		echo 'SUCCESS;'.$tipousuarios_id;

	}
	
	
	public function formSelectTipoUsuarios(){		
		$this->load->view('usuarios/vtipousuariosselect');
	}
	
	public function selectTipoUsuarios(){		
		$tipousuarios_id=$this->input->post('tipousuarios_id');
		$tipousuarios_nombre=$this->input->post('tipousuarios_nombre');
		$where_clause=array();
		
		if($tipousuarios_id!= null and $tipousuarios_id!=''){
			$where_clause['tipousuarios_id']=$tipousuarios_id;
		}
		if($tipousuarios_nombre!= null and $tipousuarios_nombre!=''){
			$where_clause['tipousuarios_nombre']=$tipousuarios_nombre;
		}
		
		$res=$this->mtipousuarios->selectTipoUsuarios($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $tipousuario) {
				$json.='{';
				$json.='"id":'.'"'.$tipousuario->id_tipoUsuario.'",';
				$json.='"nombre":'.'"'.$tipousuario->nombre_tipoUsuario.'",';
				$json.='"descripcion":'.'"'.$tipousuario->descripcion_tipoUsuario.'"';
				$json.='}';
				if($tipousuario->id_tipoUsuario!=$last->id_tipoUsuario){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}		
	}

	public function updateTipoUsuarios(){
		$tipousuarios_id=$this->input->post('idTipoUsuario');//Almacenara el ID(hidden) generado en la actualizacion
		$tipousuarios_data;
		$response;
		
		//establece los datos de la categoria para la actualizacion
		$tipousuarios_data = array(
		'idTipoUsuario'=>$tipousuarios_id,
		'nombre'=>$this->input->post('NOMBRE_TXT'),
		'descripcion'=>$this->input->post('DESCRIPCION_TXT')
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->mtipousuarios->updateTipoUsuarios($tipousuarios_data);
		if($response == 1){
			echo "El registro se actualizo correctamente";
		}
		
	}

	public function formUpdateTipoUsuarios(){
		$id_tipousuarios=$this->input->get('id_tipoUsuario');
		$data['tipousuario']=$this->mtipousuarios->selectTipoUsuariosById($id_tipousuarios);
		$this->load->view('usuarios/vtipousuariosupdate',$data);
	}
	
	public function deleteTipoUsuarios(){
		$id_tipousuarios = $this->input->post('idTipoUsuario');		
		$returned = $this->mtipousuarios->deleteTipoUsuarios($id_tipousuarios);
		
		if($returned>0){
			$this->mLogs->insertLog(array('tipo_log'=>'delete_tipousuarios','descripcion_log'=>'se elimino el tipo de usuario: '.$id_tipousuarios));
		}
		return 'Mensage: '.$returned;
	}
}
?>