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
	}
	public function main(){
		$this->load->view('main/vMain');
	}
}
?>