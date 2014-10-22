<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mtelefonos extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function selectTelefonos(){
			$query = $this->db->get('telefonos');
			if($query->num_rows()>0){
				return $query;
			}
			else{
				return false;
			}
		}
	}
?>