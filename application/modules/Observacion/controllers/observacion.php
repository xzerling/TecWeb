<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observacion extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('modelo');
	}

	public function index(){
		$data['resultados'] = $this->modelo->listarObservaciones();

		$this->load->view('observacion', $data);
	}

	public function crear(){
		$data['profesores'] = $this->modelo->obtenerProfesores();
		$data['alumnos'] = $this->modelo->obtenerAlumnos();

		$this->load->view('crear',$data);
	}

	public function crearObservacion(){
		$this->modelo->guardar();
		redirect(base_url('index.php/observacion'));
	}

	public function guardarCambios(){
		$id = $this->input->post('id');
		$correo = $this->input->post('correo');
		$matricula = $this->input->post('matricula');
		$comentario = $this->input->post('comentario');

		$this->modelo->actualizar($id,$correo,$matricula,$comentario);
	}

	public function eliminarDato(){
		$id = $this->input->post('id');
		$this->modelo->eliminar($id);
	}
}
