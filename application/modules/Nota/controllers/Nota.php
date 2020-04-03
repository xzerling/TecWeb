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
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD'] == 1)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
        	$resultados['resultados'] = $this->modelo->listarNotas();
			$this->load->view('header',$data);
			$this->load->view('nota', $resultados);
        }
        elseif($data['perfilBD'] == 2)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
        	$resultados['resultados'] = $this->modelo->listarNotasDocente($data['correoBD']);
        	$this->load->view('header', $data);
        	$this->load->view('nota', $resultados);
        }
	}

	    function crear()
	{
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD'] == 1)
        {
        	$data['correoBD'] = $this->session->userdata('correo');

			$data['asignaturas'] = $this->modelo->cargarDatosNuevo();
			$data['alumnos'] = $this->modelo->cargarAlumnosNuevo(1);

			$this->load->view('crear', $data);
        }
        elseif($data['perfilBD']==2)
        {
        	$data['correoBD'] = $this->session->userdata('correo');

			$data['asignaturas'] = $this->modelo->cargarDatosNuevoDocente($data['correoBD']);
			$data['alumnos'] = $this->modelo->cargarAlumnosNuevo(1);

			$this->load->view('crear',$data);
        }

	}

	function cargarAlumnosNuevo()
	{
		$id = $this->input->post("id");

		$data['alumnos'] = $this->modelo->cargarAlumnosNuevo($id);
		$data['asignaturas'] = $this->modelo->cargarDatosNuevo();

		$this->load->view('crear', $data);
		//return $data;
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
		$refEvaluacion 	= $this->input->post("asignatura");
		$refAlumno 	= $this->input->post("alumno");
		$nota	= $this->input->post("nota");


		$this->modelo->guardarDatos($refEvaluacion, $refAlumno, $nota);
		redirect(base_url('index.php/nota'));
	}
}
