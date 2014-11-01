<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mclientes extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertCliente($datosCliente){
		//$this->db->insert('Clientes',array('nombre'=>'Luis','RFC'=>'bifl900410'));
		$sysdate=new DateTime();
		$this->db->insert('clientes',
		array(
			'nombre_cliente' => $datosCliente['nombre'],
			'rfc' => $datosCliente['rfc'],
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => '1')
		);
		$returned=$this->db->insert_id();
		
		return $returned;
	}
	
	function updateCliente(){
		
		return ;
	}
	
	function selectClientes(){
		$query = $this->db->get('clientes');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectClienteById($id_cliente){
		$where_clause=array('id_cliente'=>$id_cliente);
		$query = $this->db->get_where('clientes',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
}
?>
