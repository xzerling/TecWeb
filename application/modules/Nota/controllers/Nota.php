<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends MY_Controller {

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

	public function __construct(){
		parent::__construct();
		$this->load->model('modelo');
	}
	public function index()
	{
		$resultados['resultados'] = $this->modelo->listarNotas();

		$this->load->view('nota', $resultados);
	}

	    function crear()
	{
		$data['asignaturas'] = $this->modelo->cargarDatos();
		$data2['alumnos'] = $this->modelo->cargarAlumnos();

		$this->load->view('crear', $data);
	}

    function guardarCambios(){
		$id  	= $this->input->post("id");
		$seccion = $this->input->post("seccion");
		$semestre = $this->input->post("semestre");
		$anio = $this->input->post("anio");
		$nota = $this->input->post("nota");

		$this->modelo->guardarCambios($id, $nota);
	}

	function eliminarDato(){
		$id = $this->input->post("id");
		$this->modelo->eliminarDato($id);
	}

    public function crearNota()
	{
		$refInstAsignatura = $this->input->post("asignatura");
		$refEvaluacion 	= $this->input->post("evaluacion");
		$refAlumno 	= $this->input->post("matricula");
		$nota	= $this->input->post("nota");


		$this->modelo->guardarDatos($refInstAsignatura, $refEvaluacion, $refAlumno, $nota);
		redirect(base_url('index.php/nota'));
	}
}
