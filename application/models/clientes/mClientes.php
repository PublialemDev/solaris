<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mClientes extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertCliente($datosCliente){
		//$this->db->insert('Clientes',array('nombre'=>'Luis','RFC'=>'bifl900410'));
	}
	function insertTel($datosTel){
		
	}
	function insertDir($datosDir){
		
	}
	
}
?>