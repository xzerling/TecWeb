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
		$this->load->view('reportes');
	}

	public function profesoresAlDia()
	{
		$profesores = $this->modelo->profesoresAlDia();
		$data['profesores'] = $profesores;

		$this->load->view('reportes');
		$this->load->view('profesAlDia', $data);
	}

	public function profesoresAtrasados()
	{
		$profesores = $this->modelo->profesoresAtrasados();
		$data['profesores'] = $profesores;

		$this->load->view('reportes');
		$this->load->view('profesAtrasados', $data);
	}

	public function cantidadAlumnos()
	{
		$this->load->view('reportes');
		$this->load->view('cantidadAlumnos');
	}

	public function cursos(){		
		$cursos = $this->modelo->cursosConCantidad();

		$data['cursos'] = $cursos;
		$this->load->view('reportes');
		$this->load->view('cursos', $data);
	}

	public function promediosCursos()
	{
		$promedios = $this->modelo->obtenerPromedios();

		$data['promedios'] = $promedios;

		$this->load->view('reportes');
		$this->load->view('promediosCursos', $data);
	}
}

?>