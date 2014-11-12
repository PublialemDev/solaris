<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CLogin extends CI_Controller {
	/**
	 * Controlador para actualizar la información de los clientes.
	 *
	 * @author Luis Briseño
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('pagina');//carga el helper bsico para las view
		$this->load->model('usuarios/musuarios');
		$this->load->model('logs/mlogs');
	}
	public function index(){
		session_start();
		session_destroy();
		$this->load->helper('form');
		$this->load->view('main/vLogin');
	}
	
	public function login(){
		$usr_nombre=$this->input->post('usr_nombre');
		$usr_passw=$this->input->post('usr_passw');
		$usr_nombre=trim($usr_nombre);
		$usr_passw=trim($usr_passw);
		
		if($usr_nombre != null and $usr_nombre!='' and $usr_passw!='' and $usr_passw!=null){
			$usr_data=$this->musuarios->selectClienteByName($usr_nombre);
			
			//base64_encode($str);
			//base64_decode($str);
			if($usr_data!=false){//valida que el usuario exista
			
				$usr_data_db=$usr_data->next_row();
				//temporal hasta que se encripte password en la BD
				$usr_passw_bd=password_hash($usr_data_db->contraseña,PASSWORD_DEFAULT);
				
				if(password_verify($usr_passw,$usr_passw_bd)){//valida que los passw coincidan
				
					session_start();
					$_SESSION['USUARIO_ID']= base64_encode($usr_data_db->id_usuario);
					$_SESSION['USUARIO_TIPO']= base64_encode($usr_data_db->id_tipoUsuario);
					$_SESSION['USUARIO_NOMBRE']= base64_encode($usr_data_db->nombre_usuario);
					
					$this->mlogs->insertLog(array('tipo_log'=>'login_exitoso','descripcion_log'=>'login exitoso usuario: '.base64_decode($_SESSION['USUARIO_ID'])));
					
					$this->load->view('main/vMain');
					
				}else{
					$this->mlogs->insertLog(array('tipo_log'=>'login_fallido','descripcion_log'=>'login fallido usuario: '.$usr_data_db->id_usuario));
					
					echo 'BAD_PASSW';
				}
			}else{
				echo 'BAD_USER';
			}
			
		}else{
			//$this->load->view('main/vMain');
			echo ':\'(';
		}
	}
}
?>