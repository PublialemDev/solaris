<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mtelefonos extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		function insertTelefono($datosTel){
			$sysdate=new DateTime();//obtener el sysdate
			
			$this->db->insert('telefonos',
			array(
				'id_perfil' => $datosTel['cli_id'],
				'numero_telefono' => $datosTel['tel_numero'],
				'creado_en' => $sysdate->format('Y-m-d H:i:s'),
				'creado_por' => '1')
			);
			
			$returned=$this->db->insert_id();
			
			return $returned;
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
		/*
		 * Regresa los registros de los telefonos para el id del cliente o false si no se encuentra
		 * @author Luis Briseño
		 * @param int
		 * @return array 
		 * */
		function selectTelefonosByCliId($id_cliente){
			$where_clause=array('id_perfil'=>$id_cliente);
			$query = $this->db->get_where('telefonos',$where_clause);
			if($query->num_rows()>0){
				return $query;
			}
			else{
				return false;
			}
		}
	}
?>