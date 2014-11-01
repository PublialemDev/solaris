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
		$this->load->helper('jsClientes');//carga el helper bsico para las view
		//$this->load->model('estados/mestados');
		//$this->load->model('clientes/mclientes');
		//$this->load->model('direcciones/mdirecciones');
		//$this->load->model('telefonos/mtelefonos');
		//$this->load->model('correos/mcorreos');
	}
	public function index(){
		session_start();
		session_destroy();
		$this->load->helper('form');
		$this->load->view('main/vLogin');
	}
	
	public function login(){
		$usr=$this->input->post('usr_nombre');
		if($usr != null){
			session_start();
			$_SESSION['USUARIO']= $this->input->post('usr_nombre');
			$this->load->view('main/vMain');
		}else{
			//$this->load->view('main/vMain');
			echo ':\'(';
		}
	}
}
?>