<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CTipoUsuarios extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('usuarios/mTipoUsuarios');
		$this->load->library('table');
	}
	
	public function insertTipoUsuario(){		
		$this->load->view('usuarios/vTipoUsuariosInsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'), 
		'creado_por' =>  1);
		
		$this->mTipoUsuarios->insertTipoUsuario($datos);

	}
	
	public function selectTipoUsuarios(){
		$consulta['query'] = $this->mTipoUsuarios->selectTipoUsuarios();
		$this->load->view('usuarios/vTipoUsuariosSelect',$consulta);
	}
}
?>