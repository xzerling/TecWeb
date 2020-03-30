<?php

class modelo extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	public function obtenerProfesores(){
		$query = "select profesor.correo, profesor.nombre from profesor";

		$profesores = $this->db->query($query)->result();
		return $profesores;
	}

	public function guardar()
	{
		$data = array(
			'correo' => $this->input->post('correo'),
			'nombre' => $this->input->post('nombre'),
			'clave' => $this->input->post('contrasena')
		);

		$this->db->insert('profesor',$data);
	}
}