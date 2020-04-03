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

	function verDatos()
	{
		/*$crud = new grocery_CRUD();
 
        $crud->set_table('asignatura');
        $crud->columns('id','nombre','estado');
        $output = $crud->render();*/

        $id = $this->input->get("idInstancia");
        $output = $this->modelo->cargarArchivos($id);

		$data['tabla'] = $output;
        
		$this->load->view('verDatos', $data);

	}

    function cargarAlumnos()
    {
    	$archivo = $this->input->post("form_data");
    	echo("archivo: "+$archivo);
    	$this->modelo->insertExcel($archivo);
    }

    function cargarArchivo()
    {
    	$id_asignatura_instancia = $this->input->post("idA");
    	$nombreCurso = $this->input->post("nombreCurso");
    	$anio = $this->input->post("anio");
    	$semestre = $this->input->post("semestre");
    	$nombreArchivo = $this->input->post("nombreArchivo");
    	//$idd = 'idA';
    	$mi_archivo = 'archivoCurso';
    	//$mi_archivo = $this->input->post('file');

    	$root = 'files/';
    	$ruta = $root.$nombreCurso.'/';
    	$ruta2 = $ruta.$anio.'/';
    	$ruta3 = $ruta2.$semestre.'/';
    	$rutaFinal = $ruta3.$nombreArchivo;
		$archivo = $ruta.$mi_archivo;
        $config['upload_path'] = $ruta3;
        $config['allowed_types'] = "*";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";
        $config['remove_spaces'] = FALSE;
        
        if(!file_exists($root))
        {
        	mkdir($root);
        }
		if(!file_exists($ruta))
		{
			mkdir($ruta);
		}
		if(!file_exists($ruta2))
		{
			mkdir($ruta2);
		}
		if(!file_exists($ruta3))
		{
			mkdir($ruta3);
		}
		if(!file_exists($mi_archivo))
		{
	        $this->load->library('upload', $config);
	        
	        if (!$this->upload->do_upload($mi_archivo)) {
	            //*** ocurrio un error
	            $data['uploadError'] = $this->upload->display_errors();
	            echo $this->upload->display_errors();
	            return;
	        }
		}
		else
		{
			echo "Archivo ya existe";
		}   		

        $data['uploadSuccess'] = $this->upload->data();
        $this->modelo->cargarArchivoBD($id_asignatura_instancia, $semestre, $anio, $rutaFinal);
        $this->index();
    }

    function guardarArchivo()
    {
		if($_FILES["fileToUpload"]["error"]>0)
		{
			echo "error al cargar archivo";
		}
		else
		{
			$ruta = 'files/';
			$archivo = $ruta.$_FILES["fileToUpload"]["name"];
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}
			if(!file_exists($archivo))
			{
				$resultado = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $archivo);
				if($resultado)
				{
					echo "Archivo Guardado";
				}
				else
				{
					echo "Error al guardar Archivo";
				}
			}
			else
			{
				echo "Archivo ya existe";
			}   		
	    }
    	$this->modelo->cargarArchivoServer($id_insert);

	}
}
