<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluacion extends MY_Controller {

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
		$resultados['resultados'] = $this->modelo->listarEvaluaciones();

		$this->load->view('evaluacion', $resultados);
	}

	public function crear()
	{
		$data['resultados'] = $this->modelo->obtenerAsignaturas();

		$this->load->view('crear', $data);
	}

	public function crear_evaluacion()
	{
		$this->modelo->guardar();
		redirect(base_url('index.php/evaluacion'));
	}

	public function guardarCambios(){
		$id = $this->input->post('id');
		$fecha = $this->input->post('fecha');
		$diasAntes = $this->input->post('diasAntes');
		$diasDespues = $this->input->post('diasDespues');
		$refInstAsignatura = $this->input->post('refInstAsignatura');

		$this->modelo->actualizar($id,$fecha,$diasAntes,$diasDespues,$refInstAsignatura);
	}

	public function eliminarDato(){
		$id = $this->input->post("id");
		$this->modelo->eliminar($id);

	}

}
