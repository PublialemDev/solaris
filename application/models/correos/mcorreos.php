<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mcorreos extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function selectCorreos($id_perfil){
			$query = $this->db->query('SELECT * FROM correos WHERE id_perfil=?',array($id_perfil));
			if($query->num_rows()>0){
				return $query;
			}
			else{
				return false;
			}
		}
	}
?>