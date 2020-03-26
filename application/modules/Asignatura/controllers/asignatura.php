<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignatura extends MY_Controller {

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

    function cargarDatos(){

		$output = $this->modelo->cargarDatos();

		$data['asignaturas'] = $output;
        
		$this->load->view('asignatura', $data);
	}

    function guardarCambios(){
		$id  	= $this->input->post("id");
		$nombre = $this->input->post("nombre");
		$estado = $this->input->post("estado");

		$this->modelo->guardarCambios($id, $nombre, $estado);
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
        
		$this->load->view('asignatura', $data);
	}
}
