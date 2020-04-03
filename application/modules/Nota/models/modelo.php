<?php

class modelo extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listarNotas(){
		$query = "SELECT CalificarEvaluacion.id, instanciaasignatura.id as idInstanciaAsignatura, asignatura.nombre AS asignatura, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, evaluacion.fecha, alumno.nombre, alumno.matricula, calificarevaluacion.nota 
			FROM calificarevaluacion, alumno, alumnoasignatura, evaluacion, instanciaasignatura, asignatura
			WHERE calificarevaluacion.refAlumno = alumnoasignatura.refAlumno
			AND alumno.matricula = alumnoasignatura.refAlumno
			AND evaluacion.id = calificarevaluacion.refEvaluacion
			AND evaluacion.refInstAsignatura = instanciaasignatura.id
			AND asignatura.id = instanciaasignatura.refAsignatura
			AND asignatura.estado = '1' ";

	

		$resultado = $this->db->query($query)->result();
		return $resultado;
	}

	public function listarNotasDocente($correo)
	{
		$query = "SELECT CalificarEvaluacion.id, instanciaasignatura.id as idInstanciaAsignatura, asignatura.nombre AS asignatura, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, evaluacion.fecha, alumno.nombre, alumno.matricula, calificarevaluacion.nota 
			FROM calificarevaluacion, alumno, alumnoasignatura, evaluacion, instanciaasignatura,profesorasignatura , asignatura
			WHERE calificarevaluacion.refAlumno = alumnoasignatura.refAlumno
			AND alumno.matricula = alumnoasignatura.refAlumno
			AND evaluacion.id = calificarevaluacion.refEvaluacion
			AND evaluacion.refInstAsignatura = instanciaasignatura.id
			AND asignatura.id = instanciaasignatura.refAsignatura
            AND profesorasignatura.refInstAsignatura = instanciaasignatura.id
            AND profesorasignatura.refProfesor = '$correo'
			AND asignatura.estado = '1' ";

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

	public function cargarDatosNuevoDocente($correo)
	{
		$query = "SELECT evaluacion.id, evaluacion.fecha, instanciaasignatura.id as idInstanciaAsignatura, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, asignatura.nombre FROM evaluacion, instanciaasignatura, asignatura, profesorasignatura WHERE evaluacion.refInstAsignatura = instanciaasignatura.id AND asignatura.id = instanciaasignatura.refAsignatura AND instanciaasignatura.id = profesorasignatura.refInstAsignatura AND profesorasignatura.refProfesor = '$correo' AND asignatura.estado = '1'  ";

        $output = $this->db->query($query)->result_array();
        return $output;
	}



	public function cargarDatosNuevo(){ 
		$query = "SELECT evaluacion.id, evaluacion.fecha, instanciaasignatura.id as idInstanciaAsignatura, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, asignatura.nombre
			FROM evaluacion, instanciaasignatura, asignatura
			WHERE evaluacion.refInstAsignatura = instanciaasignatura.id
			AND asignatura.id = instanciaasignatura.refAsignatura
			AND asignatura.estado = '1' "; //solo las asignaturas disponibles
 
		$output = $this->db->query($query)->result_array();
		
		return $output; 
	}

	public function cargarAlumnos(){
		$query = "SELECT matricula, nombre FROM alumno";
		$output = $this->db->query($query)->result_array();
		return $output;
	}

	public function cargarAlumnosNuevo($id){
		$query = "SELECT alumno.nombre, alumno.matricula
			FROM alumno, alumnoasignatura, evaluacion, instanciaasignatura, asignatura
			WHERE alumno.matricula = alumnoasignatura.refAlumno
			AND alumnoasignatura.refInstAsignatura = instanciaasignatura.id
			AND evaluacion.refInstAsignatura = instanciaasignatura.id
			AND asignatura.id = instanciaasignatura.refAsignatura
			AND asignatura.estado = '1'
            AND evaluacion.id = '$id' ";
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

	function guardarDatos($refEvaluacion, $refAlumno, $nota){
		//echo $seccion;
		$data['refEvaluacion']=$refEvaluacion;
		$data['refAlumno'] =$refAlumno;
		$data['nota'] = $nota;

		$this->db->insert('CalificarEvaluacion',$data);
	}


}

?>