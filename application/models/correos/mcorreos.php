<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mcorreos extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		function insertCorreo($datosCorreo){
			$sysdate=new DateTime();//obtener el sysdate
			
			$returned=$this->db->insert('correos',
			array(
				'id_perfil' => $datosCorreo['cli_id'],
				'nombre_correo' => $datosCorreo['corr_correo'],
				'creado_en' => $sysdate->format('Y-m-d H:i:s'),
				'creado_por' => '1')
			);
			
			return $returned;
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