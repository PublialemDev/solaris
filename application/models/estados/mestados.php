<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mestados extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function selectEstados(){
			$query = $this->db->get('estados');
			if($query->num_rows()>0){
				return $query;
			}
			else{
				return false;
			}
		}
	}
?>