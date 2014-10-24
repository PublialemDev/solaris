<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mclientes extends CI_Model{
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
	function updateCliente(){
		
		return ;
	}
	function selectClientes(){
		$query = $this->db->get('clientes');
		if($query->row_count()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
}
?>
