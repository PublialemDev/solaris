<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mtelefonos extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		function insertTelefono($datosTel){
			$sysdate=new DateTime();//obtener el sysdate
			
			$returned=$this->db->insert('telefonos',
			array(
				'id_perfil' => $datosTel['cli_id'],
				'numero_telefono' => $datosTel['tel_numero'],
				'creado_en' => $sysdate->format('Y-m-d H:i:s'),
				'creado_por' => $_SESSION['USUARIO']
				)
			);
			//$datos_log=array('tipo_log'=>'insert_telefonos','descripcion'=>'para el perfil: ')
			//insertLog($datos_log);
			return $returned;
		}
		
		function deleteTelefonosAll($perfil_id){
			$returned=$this->db->delete('telefonos',array('id_perfil'=>$perfil_id));
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