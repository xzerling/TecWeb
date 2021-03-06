<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once('vendor/php-excel-reader/excel_reader2.php');
//require_once('vendor/SpreadsheetReader.php');

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
        if($data['perfilBD']==1)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header2', $data);
        }
        elseif($data['perfilBD']==4)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header3', $data);
        }

		$this->load->view('crear', $data);
	}

    function cargarDatos(){

		$output = $this->modelo->cargarDatos();

		$data['asignaturas'] = $output;
        $data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD']==1)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header2', $data);
        }
        elseif($data['perfilBD']==4)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header3', $data);
        }
		$this->load->view('instanciaAsignatura', $data);
	}

    function cargarDatosDocente(){
        $data['correoBD'] = $this->session->userdata('correo');
        $output = $this->modelo->cargarDatosDocente($data['correoBD']);

        $data['asignaturas'] = $output;
        $data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        
        $this->load->view('header2', $data);            
        $this->load->view('instanciaAsignaturaDocente', $data);
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

        if($data['perfilBD'] == 1){ //admin
            $output = $this->modelo->cargarDatos();
            $data['asignaturas'] = $output;

          $this->load->view('header2', $data);
		  $this->load->view('instanciaAsignatura', $data);
        }
        elseif($data['perfilBD'] == 2){ //docente
            $data['correoBD'] = $this->session->userdata('correo');
            $output = $this->modelo->cargarDatosDocente($data['correoBD']);
            $data['asignaturas'] = $output;

            $this->load->view('header2', $data);            
            $this->load->view('instanciaAsignaturaDocente', $data);
        }
        elseif($data['perfilBD'] == 4){ //director escuela
            $data['correoBD'] = $this->session->userdata('correo');
            $output = $this->modelo->cargarDatos();
            $data['asignaturas'] = $output;
            $this->load->view('header3', $data);
            $this->load->view('instanciaAsignatura', $data);
        }
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



    function paraCSV_Alumnos()
    {
    	$id = $this->input->get("idInstancia");	
    	$output = $this->modelo->listarAlumnos($id);

		if($output > 0)
		{
		    $delimiter = ",";
		    $filename = "alumnos.csv";
		    $link = "<?=base_url()?>".'files/'.$filename;

		    //create a file pointer
		    $f = fopen('files/'.$filename, 'w');
		    
		    //set column headers
		    $fields = array('Nombre', 'Seccion', 'Semestre', 'Anio');
		    fputcsv($f, $fields, $delimiter);
		    
		    //output each row of the data, format line as csv and write to file pointer
		    $i = 0;
		    foreach($output as $row){


		        //$lineData = array($row->asignatura, $row->fecha, $row->anio, $row->semestre, $row->seccion, $row->alumno, $row->nota);
		        fputcsv($f, $row, $delimiter);
		        $i++;
    		}	
		}


	    redirect(base_url('/files/alumnos.csv'));


    }

    function paraCSV_Cursos()
    {

        $data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');

        if($data['perfilBD'] == 1){ //admin
            $output = $this->modelo->cargarDatos();
            $data['asignaturas'] = $output;

        }
        elseif($data['perfilBD'] == 2){ //docente
            $data['correoBD'] = $this->session->userdata('correo');
            $output = $this->modelo->cargarDatosDocente($data['correoBD']);
            $data['asignaturas'] = $output;

        }
        elseif($data['perfilBD'] == 4){ //director escuela
            $data['correoBD'] = $this->session->userdata('correo');
            $output = $this->modelo->cargarDatos();
            $data['asignaturas'] = $output;
        }



		if($output > 0)
		{
		    $delimiter = ",";
		    $filename = "cursos.csv";
		    $link = "<?=base_url()?>".'files/'.$filename;

		    //create a file pointer
		    $f = fopen('files/'.$filename, 'w');
		    
		    //set column headers
		    $fields = array('Nombre', 'Seccion', 'Semestre', 'Anio');
		    fputcsv($f, $fields, $delimiter);
		    
		    //output each row of the data, format line as csv and write to file pointer
		    $i = 0;
		    foreach($output as $row){


		        //$lineData = array($row->asignatura, $row->fecha, $row->anio, $row->semestre, $row->seccion, $row->alumno, $row->nota);
		        fputcsv($f, $row, $delimiter);
		        $i++;
    		}	
		}
	    redirect(base_url('/files/cursos.csv'));
    }

    function asignarProfesor()
    {
    	$asignaturas = $this->modelo->asignaturasNoAsignadas();
    	$profesores = $this->modelo->obtenerProfesores();

    	$data['asignaturas'] = $asignaturas;
    	$data['profesores'] = $profesores;

		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD']==1)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header2', $data);
        }
        elseif($data['perfilBD']==4)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header3', $data);
        }
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
        if($data['perfilBD']==1)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header2', $data);
        }
        elseif($data['perfilBD']==4)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header3', $data);
        }
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
        $data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD']==4)
        {
            $data['correoBD'] = $this->session->userdata('correo');
            $this->load->view('header3', $data);
        }
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

    function cargarAlumnos()
    {

    	//$mi_archivo = 'archivo';
    	$root = 'files/';

    	$direccion = $root."estudiantes.xlsx";
    	$mi_archivo = $this->input->post("archivo");

        $config['upload_path'] = $root;
        $config['allowed_types'] = "*";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";
        $config['remove_spaces'] = FALSE;

        if(!file_exists($root))
        {
        	mkdir($root);
        }

	        $this->load->library('upload', $config);
	        
	        if (!$this->upload->do_upload($mi_archivo)) {
	            //*** ocurrio un error
	            $data['uploadError'] = $this->upload->display_errors();
	            echo $this->upload->display_errors();
	            return;
	        }


        $Reader = new SpreadsheetReader('files/estudiantes.xlsx');
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $matriculas = "";
                if(isset($Row[0])) {
                    $matriculas = mysqli_real_escape_string($this->db(),$Row[0]);
                }
                
                $nombres = "";
                if(isset($Row[1])) {
                    $nombres = mysqli_real_escape_string($this->db(),$Row[1]);
                }
				
                $correo = "";
                if(isset($Row[2])) {
                    $correo = mysqli_real_escape_string($con,$Row[2]);
                }
                
                if (!empty($nombres) || !empty($matriculas) || !empty($correo)) {
                    $query = "insert into alumno(matricula, nombre, correo) values('".$matriculas."','".$nombres."','".$correo."')";
                    $this->db->query($query);
                }
             }
        
         }

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


