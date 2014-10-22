<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CClientes extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('clientes/mClientes');
	}
	
	public function nuevoCliente(){
		$this->load->view('clientes/vClientesInsert');
	}
	
	public function recibirDatos(){
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'rfc' => $this->input->post('rfc_txt'), 
		'creado_en' => '9999-12-31 23:59:59', 
		'creado_por' =>  01);
		
		$this->mClientes->insertarCliente($datos);
	}
	
} 
?>