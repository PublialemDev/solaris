<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mcorreos extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		function insertCorreo($datosCorreo,$tipo_perfil){
			$sysdate=new DateTime();//obtener el sysdate
			
			$returned=$this->db->insert('correos',
			array(
				'id_perfil' => $datosCorreo['cli_id'],
				'perfil_tipo'=>$tipo_perfil,
				'nombre_correo' => $datosCorreo['corr_correo'],
				'creado_en' => $sysdate->format('Y-m-d H:i:s'),
				'creado_por' => base64_decode($_SESSION['USUARIO_ID']))
			);
			return $returned;
		}
		
		function deleteCorreosAll($perfil_id,$tipo_perfil){
			$returned=$this->db->delete('correos',array('id_perfil'=>$perfil_id,'perfil_tipo'=>$tipo_perfil));
			//insertar log para auditoria
			if($returned>0){
				$this->mlogs->insertLog(array('tipo_log'=>'delete_correos','descripcion_log'=>'borrado de correos para el perfil: '.$perfil_id));
				return true;
			}
			return false;
		}
		
		function selectCorreos($id_perfil,$tipo_perfil){
			$where_clause=array('id_perfil'=>$id_perfil,'perfil_tipo'=>$tipo_perfil);
			$query = $this->db->get_where('correos',$where_clause);
			if($query->num_rows()>0){
				return $query;
			}
			else{
				return false;
			}
		}
		/*
		 * Regresa los registros de los correos para el id del cliente o false si no se encuentra
		 * @author Luis Briseño
		 * @param int
		 * @return array 
		 * */
		function selectCorreosByCliId($id_perfil,$tipo_perfil){
			$where_clause=array('id_perfil'=>$id_perfil,'perfil_tipo'=>$tipo_perfil);
			$query = $this->db->get_where('correos',$where_clause);
			if($query->num_rows()>0){
				return $query;
			}
			else{
				return false;
			}
		}
	}
?>