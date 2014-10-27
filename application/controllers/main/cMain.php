<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMain extends CI_Controller {
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
		$this->load->model('estados/mestados');
		$this->load->model('clientes/mclientes');
		$this->load->model('direcciones/mdirecciones');
		$this->load->model('telefonos/mtelefonos');
		$this->load->model('correos/mcorreos');
		//$this->load->helper('url');
		//$this->load->library('javascript');
		//$this->load->view('JS/clientes.js');
	}
}
?>