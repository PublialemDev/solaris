<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MClientes extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertCliente($datosCliente){
		//$this->db->insert('Clientes',array('nombre'=>'Luis','RFC'=>'bifl900410'));
		$this->db->insert('clientes',
		array('nombre_cliente' => $datosCliente['nombre'],
			'rfc' => $datosCliente['rfc'],
			'creado_en' => $datosCliente['creado_en'],
			'creado_por' => $datosCliente['creado_por'])
		);
	}
	function insertTel($datosTel){
		
	}
	function insertDir($datosDir){
		
	}
	
}
?>
