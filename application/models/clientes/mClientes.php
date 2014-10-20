<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MClientes extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function insertarCliente($datos){
		$this->db->insert('clientes',
		array('nombre_cliente' => $datos['nombre'],
			'rfc' => $datos['rfc'],
			'creado_en' => $datos['creado_en'],
			'creado_por' => $datos['creado_por'])
		);
	}
}
