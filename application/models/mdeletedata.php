<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MDeleteData extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();		
	}

 	function deleteData($id, $perfil){
		$dir_estatus = array('estatus_direccion'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
		$tel_estatus = array('estatus_telefono'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
		$correo_estatus = array('estatus_correo'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
			
		if($returned == 1){
			$returned = $this->db->update('direcciones',$dir_estatus,array('id_perfil'=>$id,'perfil_tipo' => $perfil));
			if($returned == 1){
				$returned = $this->db->update('telefonos',$tel_estatus,array('id_perfil'=>$id,'perfil_tipo' => $perfil));
				if($returned == 1){
					$returned = $this->db->update('correos',$correo_estatus,array('id_perfil'=>$id,'perfil_tipo' => $perfil));			
				}
			}			
		}	
		
		return returned;
	}
	
	function deleteProduRemi(){
		$proremi_estatus = array('estatus_productoRemision'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
		
		$query = $this->db->query("SELECT id_remision FROM remisiones WHERE estatus_remision = 'I' ");
		foreach ($query->result() as $value) {
			$returned = $this->db->update('productoremision',$proremi_estatus,array('id_remision'=>$value->id_remision));
		}
		
		return $returned;
	}
	
	function deleteUser(){
		$usr_estatus = array('estatus_usuario'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
		
		$query = $this->db->query("SELECT id_usuario FROM usuarios WHERE estatus_usuario = 'I' ");
		foreach ($query->result() as $value) {
			$returned = $this->deleteData($value->id_usuario,'usr');
		}
		
		return $returned;
	}
}