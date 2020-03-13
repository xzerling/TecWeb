<?php

class modelo extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listarObservaciones(){
		$query = "select profesorobservacion.id, profesor.correo, alumno.nombre, alumno.matricula , profesorobservacion.comentario from profesor, alumno, profesorobservacion where profesorobservacion.refProfesor = profesor.correo and profesorobservacion.refAlumno = alumno.matricula";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	public function obtenerProfesores(){
		$query = "select profesor.correo, profesor.nombre from profesor";

		$profesores = $this->db->query($query)->result();
		return $profesores;
	}

	public function obtenerAlumnos(){
		$query = "select alumno.matricula, alumno.nombre from alumno";

		$alumnos = $this->db->query($query)->result();
		return $alumnos;
	}

	public function guardar(){
		$data = array(
			'refProfesor' => $this->input->post('refProfesor'),
			'refAlumno' => $this->input->post('refAlumno'),
			'comentario' => $this->input->post('comentario')
		);

		$this->db->insert('profesorobservacion', $data);
	}

	public function actualizar($id, $correo, $matricula,$comentario){
		$data = array(
			'id' => $id,
			'refProfesor' => $correo,
			'refAlumno' => $matricula,
			'comentario' => $comentario
		);

		$this->db->where('id',$id);
		$this->db->replace('profesorobservacion',$data);
	}

	public function eliminar($id){
		$this->db->where('id', $id);
		$this->db->delete('profesorobservacion');
	}
}