<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CCategoriaSeguimiento extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('clientes/mCategoriaSeguimiento');
		$this->load->library('table');
	}
	
	public function insertCategoriaSeguimiento(){		
		$this->load->view('clientes/vCategoriaSeguimientoInsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'), 
		'creado_por' =>  1);
		
		$this->mCategoriaSeguimiento->insertCategoriaSeguimiento($datos);

	}
	
	public function selectCategoriaSeguimiento(){
		$consulta['query'] = $this->mCategoriaSeguimiento->selectCategoriaSeguimiento();
		$this->load->view('clientes/vCategoriaSeguimientoSelect',$consulta);
	}
}
?>