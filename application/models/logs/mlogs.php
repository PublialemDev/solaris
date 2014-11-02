<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLogs extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();		
	}
	
	/**
	 * Insertar Logs
	 *
	 * Inserta un registro en la tabla LOGS, 
	 * recibe un arreglo como parametro, 
	 * con los argumentos(id_usuario, tipo_log, descripcion_log, fecha_hora).
	 *
	 * @author  Jorge Amador
	 * @access	public
	 * @param	array los datos del log	
	 */
	public function insertLog($datos = array()){
		//session_start();
		$sysdate = new DateTime();
		$log_data=array(
			'id_usuario'=>$_SESSION['USUARIO'],
			'tipo_log'=>$datos['tipo_log'],
			'descripcion_log'=>$datos['descripcion_log'],
			'fecha_hora'=>	$sysdate->format('Y-m-d H:i:s')
			);
		$this->db->insert('logs',$log_data);
	}
}
?>