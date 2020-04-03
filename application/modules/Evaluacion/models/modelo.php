<?php

class modelo extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listarEvaluaciones(){
		$query = "select evaluacion.id,evaluacion.fecha, evaluacion.diasAntes, evaluacion.diasDespues, asignatura.nombre, instanciaasignatura.anio,instanciaasignatura.semestre, instanciaasignatura.seccion, evaluacion.refInstAsignatura from evaluacion, instanciaasignatura, asignatura where evaluacion.refInstAsignatura = instanciaasignatura.id and instanciaasignatura.refAsignatura = asignatura.id";

		$resultado = $this->db->query($query)->result();
		return $resultado;
	}

	public function listarEvaluacionesProfesor($correo)
	{
		$query = "select evaluacion.id,evaluacion.fecha, evaluacion.diasAntes, evaluacion.diasDespues, asignatura.nombre, instanciaasignatura.anio,instanciaasignatura.semestre, instanciaasignatura.seccion, evaluacion.refInstAsignatura from evaluacion, instanciaasignatura, asignatura, profesor, profesorasignatura where evaluacion.refInstAsignatura = instanciaasignatura.id and instanciaasignatura.refAsignatura = asignatura.id and instanciaasignatura.id = profesorasignatura.refInstAsignatura and profesor.correo = '$correo' and profesorasignatura.refProfesor = '$correo'";

		$resultado = $this->db->query($query)->result();
		return $resultado;
	}

	public function obtenerAsignaturas(){
		$query = "select instanciaasignatura.id, asignatura.nombre, instanciaasignatura.anio, instanciaasignatura.semestre, instanciaasignatura.seccion from asignatura, instanciaasignatura where asignatura.id = instanciaasignatura.refAsignatura";

		$resultado = $this->db->query($query)->result();
		return $resultado;
	}

	public function obtenerAsignaturasDocente($correo)
	{
		$query = "select instanciaasignatura.id, asignatura.nombre, instanciaasignatura.anio, instanciaasignatura.semestre, instanciaasignatura.seccion from asignatura, instanciaasignatura, profesor, profesorasignatura where asignatura.id = instanciaasignatura.refAsignatura and  instanciaasignatura.id = profesorasignatura.refInstAsignatura and profesorasignatura.refProfesor = '$correo' and profesor.correo = '$correo'";
		$resultado = $this->db->query($query)->result();
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

	public function obtenerEvaluadas()
	{
		$query= " Select DISTINCT asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, evaluacion.fecha 
				FROM asignatura, evaluacion, instanciaasignatura, calificarevaluacion 
				WHERE evaluacion.refInstAsignatura = instanciaasignatura.id 
				AND instanciaasignatura.refAsignatura = asignatura.id 
				AND evaluacion.id = calificarevaluacion.refEvaluacion ";

		$evaluadas = $this->db->query($query)->result();
		return $evaluadas;
	}

	public function obtenerPendientes()
	{
		$query=" Select DISTINCT asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre , instanciaasignatura.anio, evaluacion.fecha 
				FROM asignatura, evaluacion, instanciaasignatura, calificarevaluacion 
				WHERE evaluacion.refInstAsignatura = instanciaasignatura.id 
				AND instanciaasignatura.refAsignatura = asignatura.id 
				AND DATE_ADD(evaluacion.fecha, INTERVAL evaluacion.diasDespues DAY) > CURRENT_DATE 
				AND evaluacion.id NOT IN (SELECT refEvaluacion FROM calificarevaluacion)";

		$pendientes = $this->db->query($query)->result();
		return $pendientes;
	}

	public function obtenerAtrasadas()
	{
		$query = " Select DISTINCT asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre ,instanciaasignatura.anio, evaluacion.fecha 
				FROM asignatura, evaluacion, instanciaasignatura, calificarevaluacion 
				WHERE evaluacion.refInstAsignatura = instanciaasignatura.id 
				AND instanciaasignatura.refAsignatura = asignatura.id 
				AND DATE_ADD(evaluacion.fecha, INTERVAL evaluacion.diasDespues DAY) < CURRENT_DATE 
				AND evaluacion.id NOT IN (SELECT refEvaluacion FROM calificarevaluacion) ";

		$atrasadas = $this->db->query($query)->result();
		return $atrasadas;
	}

	public function obtenerEvaluadasDocente($correo)
	{
		$query= "Select DISTINCT asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, evaluacion.fecha FROM asignatura, evaluacion, instanciaasignatura, calificarevaluacion, profesorasignatura WHERE evaluacion.refInstAsignatura = instanciaasignatura.id AND instanciaasignatura.refAsignatura = asignatura.id AND evaluacion.id = calificarevaluacion.refEvaluacion AND instanciaasignatura.id = profesorasignatura.refInstAsignatura AND profesorasignatura.refProfesor = 'rhenzi@hotmail.com'  ";

		$evaluadas = $this->db->query($query)->result();
		return $evaluadas;
	}

	public function obtenerPendientesDocente($correo)
	{
		$query = "Select DISTINCT asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre , instanciaasignatura.anio, evaluacion.fecha 
				FROM asignatura, evaluacion, instanciaasignatura, calificarevaluacion, profesorasignatura 
				WHERE evaluacion.refInstAsignatura = instanciaasignatura.id 
				AND instanciaasignatura.refAsignatura = asignatura.id 
				AND DATE_ADD(evaluacion.fecha, INTERVAL evaluacion.diasDespues DAY) > CURRENT_DATE
                AND instanciaasignatura.id = profesorasignatura.refInstAsignatura
				AND evaluacion.id NOT IN (SELECT refEvaluacion FROM calificarevaluacion)";

		$pendientes = $this->db->query($query)->result();
		return $pendientes;
	}

	public function obtenerAtrasadasDocente($correo)
	{
		$query = "Select DISTINCT asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre ,instanciaasignatura.anio, evaluacion.fecha 
				FROM asignatura, evaluacion, instanciaasignatura, calificarevaluacion, profesorasignatura 
				WHERE evaluacion.refInstAsignatura = instanciaasignatura.id 
				AND instanciaasignatura.refAsignatura = asignatura.id 
				AND DATE_ADD(evaluacion.fecha, INTERVAL evaluacion.diasDespues DAY) < CURRENT_DATE
                AND instanciaasignatura.id = profesorasignatura.refInstAsignatura
				AND evaluacion.id NOT IN (SELECT refEvaluacion FROM calificarevaluacion)";

		$atrasadas = $this->db->query($query)->result();
		return $atrasadas;
	}
}

?>