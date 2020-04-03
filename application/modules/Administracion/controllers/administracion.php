<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$data['profesores'] = $this->modelo->obtenerProfesores();
		$this->load->view('administracion', $data); 
	}

	public function crear()
	{
		$this->load->view('crear');
	}

	public function agregarProfesor()
	{
		$this->modelo->guardar();
		redirect(base_url('index.php/administracion'));
	}

	public function eliminarProfesor()
	{
		$correo = $this->input->post('correo');
		$this->modelo->eliminarProfesor($correo);
	}
}
