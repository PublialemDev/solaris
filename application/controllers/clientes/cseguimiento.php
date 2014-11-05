<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CSeguimiento extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('clientes/mseguimiento');
		$this->load->library('table');
	}
	
	public function insertSeguimiento(){		
		$this->load->view('clientes/vseguimientoinsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$this->mseguimiento->insertSeguimiento($datos);

	}
	
	public function selectSeguimiento(){
		$consulta['query'] = $this->mseguimiento->selectSeguimiento();
		$this->load->view('clientes/vseguimientoselect',$consulta);
	}
}
?>