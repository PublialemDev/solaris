<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mclientes extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertCliente($datosCliente){
		session_start();
		$sysdate=new DateTime();
		$returned=$this->db->insert('clientes',
		array(
			'nombre_cliente' => $datosCliente['nombre'],
			'rfc' => $datosCliente['rfc'],
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => $_SESSION['USUARIO'])
		);
		//insertar log para auditoria
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mlogs->insertLog(array('tipo_log'=>'insert_clientes','descripcion_log'=>'alta del cliente: '.$returned));
		}
		return $returned;
	}
	
	function updateCliente($cli_data_form){
		
		session_start();
		$sysdate=new DateTime();
		$cli_data=array(
			'nombre_cliente' => $cli_data_form['nombre'],
			'rfc' => $cli_data_form['rfc'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => $_SESSION['USUARIO']
		);
		$returned=$this->db->update('clientes',$cli_data,array('id_cliente'=>$cli_data_form['cli_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_clientes','descripcion_log'=>'update del cliente: '.$cli_data_form['cli_id']));
		}
		
		return $returned;
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
