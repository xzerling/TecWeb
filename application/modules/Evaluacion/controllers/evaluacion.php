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
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD']==1)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
        	$resultados['resultados'] = $this->modelo->listarEvaluaciones();
			$this->load->view('header',$data);
			$this->load->view('evaluacion', $resultados);
        }
        elseif($data['perfilBD']==2)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
        	$output = $this->modelo->listarEvaluacionesProfesor($data['correoBD']);
        	$resultados['resultados'] = $output;
        	$this->load->view('header', $data);
        	$this->load->view('evaluacion',$resultados);
        }	
	}

	public function crear()
	{
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD'] == 1)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
        	$data['resultados'] = $this->modelo->obtenerAsignaturas();
			$this->load->view('header', $data);
			$this->load->view('crear', $data);
        }
        elseif($data['perfilBD'] == 2)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
        	$data['resultados'] = $this->modelo->obtenerAsignaturasDocente($data['correoBD']);
        	$this->load->view('header', $data);
        	$this->load->view('crear', $data);

        }
		
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

	public function monitoreo()
	{
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
		
		if($data['perfilBD'] == 1)
		{
			$data['correoBD'] = $this->session->userdata('correo');
			$data['evaluadas'] = $this->modelo->obtenerEvaluadas();
			$data['pendientes'] = $this->modelo->obtenerPendientes();
			$data['atrasadas'] = $this->modelo->obtenerAtrasadas();
			$this->load->view('header');
			$this->load->view('monitoreo',$data);
		}
		elseif($data['perfilBD']== 2)
		{
			$data['correoBD'] = $this->session->userdata('correo');
			$data['evaluadas'] = $this->modelo->obtenerEvaluadasDocente($data['correoBD']);
			$data['pendientes'] = $this->modelo->obtenerPendientesDocente($data['correoBD']);
			$data['atrasadas'] = $this->modelo->obtenerAtrasadasDocente($data['correoBD']);
			$this->load->view('header', $data);
			$this->load->view('monitoreo',$data);
		}

	}

}
