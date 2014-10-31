<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CTipoPago extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('remisiones/mTipoPago');
		$this->load->library('table');
	}
	
	public function insertTipoPago(){		
		$this->load->view('remisiones/vTipoPagoInsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'), 
		'creado_por' =>  1);
		
		$this->mTipoPago->insertTipoPago($datos);

	}
	
	public function selectTipoPago(){
		$consulta['query'] = $this->mTipoPago->selectTipoPago();
		$this->load->view('remisiones/vTipoPagoSelect',$consulta);
	}
}
?>