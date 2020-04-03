<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InstanciaAsignatura extends MY_Controller {

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

    public function crearAsignatura()
	{
		$seccion = $this->input->post("seccion");
		$semestre 	= $this->input->post("semestre");
		$anio 	= $this->input->post("anio");
		$refInstanciaAsignatura	= $this->input->post("refInstanciaAsignatura");


		$this->modelo->guardarDatos($seccion, $semestre, $anio, $refInstanciaAsignatura);
		redirect(base_url('index.php/instanciaAsignatura'));
	}

    function crear()
	{
		$data['asignaturas'] = $this->modelo->obtenerAsignaturas();
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        $this->load->view('header2', $data);
		$this->load->view('crear', $data);
	}

    function cargarDatos(){

		$output = $this->modelo->cargarDatos();

		$data['asignaturas'] = $output;
        $data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        $this->load->view('header2', $data);
		$this->load->view('instanciaAsignatura', $data);
	}

    function guardarCambios(){
		$id  	= $this->input->post("id");
		$seccion = $this->input->post("seccion");
		$semestre = $this->input->post("semestre");
		$anio = $this->input->post("anio");
		$refAsignatura = $this->input->post("refAsignatura");

		$this->modelo->guardarCambios($id, $seccion, $semestre, $anio, $refAsignatura);
	}

	function eliminarDato(){
		$id = $this->input->post("id");
		$this->modelo->eliminarDato($id);
	}

	public function index($output = null)
	{

        $data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        $this->load->view('header2', $data);

        if($data['perfilBD'] == 1){ //admin
            $output = $this->modelo->cargarDatos();
            $data['asignaturas'] = $output;

		  $this->load->view('instanciaAsignatura', $data);
        }
        elseif($data['perfilBD'] == 2){ //docente
            $data['correoBD'] = $this->session->userdata('correo');
            $output = $this->modelo->cargarDatosDocente($data['correoBD']);
            $data['asignaturas'] = $output;
            $this->load->view('instanciaAsignaturaDocente', $data);
        }
	}

    function cargarAlumnos()
    {
    	$archivo = $this->input->post("form_data");
    	echo("archivo: "+$archivo);
    	$this->modelo->insertExcel($archivo);
    }

    function asignarProfesor()
    {
    	$asignaturas = $this->modelo->asignaturasNoAsignadas();
    	$profesores = $this->modelo->obtenerProfesores();

    	$data['asignaturas'] = $asignaturas;
    	$data['profesores'] = $profesores;

		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        $this->load->view('header2', $data);
    	$this->load->view('asignarProfesor', $data);
    }

    function guardarProfesorAsignatura()
    {
    	$this->modelo->guardarProfesorAsignatura();
    	redirect(base_url('index.php/instanciaAsignatura/asignaturasAsignadas'));
    }

    function asignaturasAsignadas()
    {
    	$asignaturas = $this->modelo->asignaturasAsignadas();
		$data['asignaturas'] = $asignaturas;
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        $this->load->view('header2', $data);
    	$this->load->view('asignaturasAsignadas',$data);
    }

    function eliminarAsignacion()
    {
    	$refInstAsignatura = $this->input->post('refInstAsignatura');
    	$this->modelo->eliminarAsignacion($refInstAsignatura);
    }

    function crearAlumno()
    {
    	$asignaturas = $this->modelo->obtenerTodasAsignaturas();
    	$data['asignaturas'] = $asignaturas;

    	$this->load->view('crearAlumno',$data);
    }

    function guardarAlumno()
    {
    	$matricula = $this->input->post("matricula");
    	$nombre = $this->input->post("nombre");
    	$correo = $this->input->post("correo");
    	$refInstAsignatura = $this->input->post("refInstAsignatura");

    	$this->modelo->guardarAlumno($matricula, $nombre, $correo, $refInstAsignatura);
    	redirect(base_url('index.php/instanciaAsignatura'));
    }
}


