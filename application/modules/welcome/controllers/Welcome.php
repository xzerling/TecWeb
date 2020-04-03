<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	public function __construct(){
	parent::__construct(); // vinvular el controlado con el padre
		$this->load->model("modelo");
	}
	
		public function index()
	{
			$data['nombre'] = $this->session->userdata('nombre');
			$data['perfil'] = $this->session->userdata('perfil');
			$data['login'] = $this->session->userdata('login');

		if ($this->session->userdata('login')){
			if ($this->session->userdata('perfil')== 1) { // admin
				$this->load->view("header2", $data);
				$this->load->view("dashboard", $data);
				$this->load->view("fother");
			}
			if ($this->session->userdata('perfil')== 2) {// Profesor 
				//$this->Dashboard->index($data);
				$this->load->view("header2", $data);
				$this->load->view("dashboard", $data);
				$this->load->view("fother");
			}
			if ($this->session->userdata('perfil')== 3) {// Ayudante 
				$this->load->view("header2", $data);
				$this->load->view("dashboard", $data);
				$this->load->view("fother");
			}
		}else{
				$this->load->view('header');
				$this->load->view('login');
				$this->load->view('listProfe');
		}

	}

	function loginf (){
		$correo = $this->input-> post('correo');
		$clave = $this->input-> post('clave');
		$data['correo'] = $correo;
		$login = FALSE;
		$login = $this->modelo->validarUsuario($correo, $clave);
		$data['login'] = $login;
		$data['perfil'] =  $this->modelo->buscarPerfil($correo, $clave);
		$data['nombre'] = $this->modelo->buscarUsuario($correo, $data['perfil']);

		$this->session->set_userdata($data);
		$this->index();
	}

	function salir(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

}
