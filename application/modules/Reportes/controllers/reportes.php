<?php

class reportes extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelo');
	}

	public function index()
	{
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD'] == 4)
        {
        	$data['correoBD'] = $this->session->userdata('correo');

        	$this->load->view('header3', $data);
        	$this->load->view('reportes');
        }		
	}

	public function profesoresAlDia()
	{
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD'] == 4)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
        	$this->load->view('header3', $data);
        	$profesores = $this->modelo->profesoresAlDia();
			$data['profesores'] = $profesores;
			$this->load->view('reportes');
			$this->load->view('profesAlDia', $data);	
        }		
	}

	public function profesoresAtrasados()
	{
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
		if($data['perfilBD']== 4)
		{
			$profesores = $this->modelo->profesoresAtrasados();
		
			$data['correoBD'] = $this->session->userdata('correo');
	        $this->load->view('header3', $data);
			$data['profesores'] = $profesores;

			$this->load->view('reportes');
			$this->load->view('profesAtrasados', $data);
		}
	}

	public function cantidadAlumnos()
	{
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
		if($data['perfilBD']== 4)
		{
			$data['correoBD'] = $this->session->userdata('correo');
	        $this->load->view('header3', $data);
			$this->load->view('reportes');
			$this->load->view('cantidadAlumnos');
		}	
	}

	public function cursos(){		
		
		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');

		if($data['perfilBD']== 4)
		{
			$data['correoBD'] = $this->session->userdata('correo');
	        $this->load->view('header3', $data);			
			$cursos = $this->modelo->cursosConCantidad();
			$data['cursos'] = $cursos;
			$this->load->view('reportes');
			$this->load->view('cursos', $data);
		}
	}

	public function promediosCursos()
	{	

		$data['nombreBD'] = $this->session->userdata('nombre');
        $data['perfilBD'] = $this->session->userdata('perfil');
        if($data['perfilBD']== 4)
        {
        	$data['correoBD'] = $this->session->userdata('correo');
	        $this->load->view('header3', $data);	

        	$promedios = $this->modelo->obtenerPromedios();

			$data['promedios'] = $promedios;

			$this->load->view('reportes');
			$this->load->view('promediosCursos', $data);
        }		
	}
}

?>