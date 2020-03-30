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

		$this->load->view('crear', $data);
	}

    function cargarDatos(){

		$output = $this->modelo->cargarDatos();

		$data['asignaturas'] = $output;
        
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
		/*$crud = new grocery_CRUD();
 
        $crud->set_table('asignatura');
        $crud->columns('id','nombre','estado');
        $output = $crud->render();*/

        
        $output = $this->modelo->cargarDatos();

		$data['asignaturas'] = $output;
        
		$this->load->view('instanciaAsignatura', $data);
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

    	$this->load->view('asignaturasAsignadas',$data);
    }
}
