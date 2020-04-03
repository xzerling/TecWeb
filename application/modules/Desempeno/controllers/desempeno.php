<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desempeno extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
    {
        parent::__construct();
 		$this->load->model("modelo");
        $this->load->database();
 
    }
	public function index()
	{

		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
		$this->load->view('header');
		
		if($data['perfilBD']==1)
		{
			$output = $this->modelo->cargarDatos();

			$data['calificaciones'] = $output;
			$this->load->view('desempeno', $data);
		}
		elseif($data['perfilBD']==2)
		{
			$data['correoBD'] = $this->session->userdata('correo');
			$output = $this->modelo->cargarDatosDocente($data['correoBD']);
			$data['calificaciones'] = $output;
			$this->load->view('desempeno',$data);
		}

	}
}
