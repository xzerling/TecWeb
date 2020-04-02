<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
	public function index()
	{
		
		if ($this->session->userdata('login')){
			if ($this->session->userdata('perfil')== 1) {
				$this->load->view('header');
				//$this->load->view('admin/admin');
				$this->load->view('fother');
			}
			if ($this->session->userdata('perfil')== 2) {
				//$data = $this->session->userdata('nombre');
				$this->load->view('header');
				$this->load->view('super',$data);
				$this->load->view('fother');
			}
		}else{
				$data = $this->session->userdata('Nombre');
				$this->load->view('header',$data);
				$this->load->view('login');
				$this->load->view('listProfe');
				$this->load->view('logProfe');
				$this->load->view('fother');
				//$this->load->view('sendNotification');
		}
		

		//$this->load->view('welcome_message');
	}

	function loginf (){
		/*
		$rut = $this->input-> post('rut');
		$clave = $this->input-> post('clave');
		$data['rut'] = $rut;
		$login = FALSE;
		$login = $this->modelo->validarUsuario($rut, md5($clave));
		$data['perfil'] =  $this->modelo->buscarPerfil($rut, md5($clave));
		$data['login'] = $login;
		*/
		$data['perfil'] = 2;
		$data['rut'] = "11 111.111-1";
		$data['Nombre'] = "Nombre USuario";
		$data['login'] = TRUE;
		$this->session->set_userdata($data);
		$this->index();
	}
}
