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

	function paraCSV()
	{
				$query = "SELECT CalificarEvaluacion.id, instanciaasignatura.id as idInstanciaAsignatura, asignatura.nombre AS asignatura, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, evaluacion.fecha, alumno.nombre, alumno.matricula, calificarevaluacion.nota 
			FROM calificarevaluacion, alumno, alumnoasignatura, evaluacion, instanciaasignatura, asignatura
			WHERE calificarevaluacion.refAlumno = alumnoasignatura.refAlumno
			AND alumno.matricula = alumnoasignatura.refAlumno
			AND evaluacion.id = calificarevaluacion.refEvaluacion
			AND evaluacion.refInstAsignatura = instanciaasignatura.id
			AND asignatura.id = instanciaasignatura.refAsignatura
			AND asignatura.estado = '1' ";

		$resultado = $this->db->query($query)->result_array();	
		$count = count($resultado);

		//echo "asdadasd: ".$resultado['id'];



		if($resultado > 0)
		{
		    $delimiter = ",";
		    $filename = "notas.csv";
		    $link = "<?=base_url()?>".'files/'.$filename;

		    //create a file pointer
		    $f = fopen('files/'.$filename, 'w');
		    
		    //set column headers
		    $fields = array('Asignatura', 'Evaluacion', 'Anio', 'Semestre', 'Seccion', 'Alumno', 'Nota');
		    fputcsv($f, $fields, $delimiter);
		    
		    //output each row of the data, format line as csv and write to file pointer
		    $i = 0;
		    foreach($resultado as $row){


		        //$lineData = array($row->asignatura, $row->fecha, $row->anio, $row->semestre, $row->seccion, $row->alumno, $row->nota);
		        fputcsv($f, $row, $delimiter);
		        $i++;
	    }
	    redirect(base_url('/files/notas.csv'));

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

    function crearNota()
	{
		$refEvaluacion 	= $this->input->post("asignatura");
		$refAlumno 	= $this->input->post("alumno");
		$nota	= $this->input->post("nota");


		$this->modelo->guardarDatos($refEvaluacion, $refAlumno, $nota);
		redirect(base_url('index.php/nota'));
	}
}
