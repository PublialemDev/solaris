<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Musuarios extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function selectClienteByName($cli_nombre){
		$where_clause=array('nombre_usuario'=>strtoupper($cli_nombre));
		$query = $this->db->get_where('usuarios',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}	
}
?>
	