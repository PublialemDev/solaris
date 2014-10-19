<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CClientesUpdate extends CI_Controller {

	/**
	 * Controlador para actualizar la información de los clientes.
	 *
	 * @author Luis Briseño
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('pagina');
	}
	
	public function index()
	{
		$this->load->view('clientes/vClientesUpdate');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>
