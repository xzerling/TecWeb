<?php

class modelo extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listarNotas(){
		$query = "SELECT CalificarEvaluacion.id, asignatura.nombre AS asignatura, evaluacion.fecha, alumno.nombre, calificarevaluacion.nota 
				  FROM asignatura, evaluacion, alumno, calificarevaluacion 
  				  WHERE asignatura.id = calificarevaluacion.refInstAsignatura 
				  AND evaluacion.id = calificarevaluacion.refEvaluacion 
				  AND alumno.matricula = calificarevaluacion.refAlumno";

	

		$resultado = $this->db->query($query)->result();
		return $resultado;
	}

	public function obtenerAsignaturas(){
		$query = "select id, nombre from asignatura
		 where estado = 1";

		$resultado = $this->db->query($query)->result_array();
		return $resultado;
	}

	public function guardar(){
		$data = array(
			'fecha' => $this->input->post('fecha'),
			'diasAntes' => $this->input->post('diasAntes'),
			'diasDespues' => $this->input->post('diasDespues'),
			'refInstAsignatura' => $this->input->post('refInstAsignatura')
		);

		$this->db->insert('evaluacion', $data);
	}

	public function actualizar($id, $fecha, $diasAntes, $diasDespues,$refInstAsignatura){

		$data = array(
			'id' => $id,
			'fecha' => $fecha,
			'diasAntes' => $diasAntes,
			'diasDespues' => $diasDespues,
			'refInstAsignatura' => $refInstAsignatura
		);

		$this->db->where('id',$id);
		$this->db->replace('evaluacion',$data);
	}

	public function eliminar($id){
		$this->db->where("id",$id);
		$this->db->delete('evaluacion');
	}

    public function cargarDatos(){ 
		$query = "select instanciaasignatura.id, asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, instanciaasignatura.refAsignatura
		from asignatura, instanciaasignatura 
		where asignatura.id = instanciaasignatura.refAsignatura and 
		asignatura.estado = 1"; //solo las asignaturas disponibles
 
		$output = $this->db->query($query)->result_array();
		
		return $output; 
	}

	public function cargarAlumnos(){
		$query = "SELECT matricula, nombre FROM alumno";
		$output = $this->db->query($query)->result_array();
		return $output;
	}

	function guardarCambios($id, $nota){
		//$this->load->helper('url');

		$data['nota'] = $nota;

		$this->db->where("id",$id);
		$this->db->update("CalificarEvaluacion",$data);
	}

	function eliminarDato($id){
		$this->db->where("id",$id);
		$this->db->delete('CalificarEvaluacion');
	}

	function guardarDatos($refInstAsignatura, $refEvaluacion, $refAlumno, $nota){
		$data['refInstAsignatura'] = $refInstAsignatura;
		//echo $seccion;
		$data['refEvaluacion']=$refEvaluacion;
		$data['refAlumno'] =$refAlumno;
		$data['nota'] = $nota;

		$this->db->insert('CalificarEvaluacion',$data);
	}


}

?>