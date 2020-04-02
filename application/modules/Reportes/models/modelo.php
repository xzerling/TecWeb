<?php

class modelo extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}


	public function profesoresAlDia()
	{
		$query = " Select DISTINCT profesor.nombre, asignatura.nombre as nombreasignatura, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio 
			FROM profesor, instanciaasignatura, asignatura, evaluacion, calificarevaluacion, profesorasignatura 
			WHERE instanciaasignatura.refAsignatura = asignatura.id 
			AND profesor.correo = profesorasignatura.refProfesor 
			AND instanciaasignatura.id = profesorasignatura.refInstAsignatura 
			AND instanciaasignatura.id = evaluacion.refInstAsignatura 
			AND evaluacion.id = calificarevaluacion.refEvaluacion";

		$profesores = $this->db->query($query)->result();
		return $profesores;
	}

	public function profesoresAtrasados()
	{
		$query = " Select DISTINCT profesor.nombre, asignatura.nombre as nombreasignatura, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio 
			FROM profesor, instanciaasignatura, asignatura, evaluacion, calificarevaluacion, profesorasignatura 
			WHERE instanciaasignatura.refAsignatura = asignatura.id 
			AND profesor.correo = profesorasignatura.refProfesor 
			AND instanciaasignatura.id = profesorasignatura.refInstAsignatura 
			AND instanciaasignatura.id = evaluacion.refInstAsignatura 
			AND evaluacion.id NOT IN (SELECT refEvaluacion FROM calificarevaluacion) ";

		$profesores = $this->db->query($query)->result();
		return $profesores;
	}

	public function cursosConCantidad()
	{
		$cantidad = $this->input->post('cantidad');

		$query = 'Select asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio , COUNT(alumnoasignatura.refAlumno) as alumnos 
			FROM asignatura, instanciaasignatura, alumnoasignatura 
			WHERE instanciaasignatura.id = alumnoasignatura.refInstAsignatura 
			AND asignatura.id = instanciaasignatura.refAsignatura 
			GROUP BY asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio 
			ORDER BY alumnos DESC ';
		$result = $this->db->query($query)->result();
		$cursos;
		$i = 0;
		foreach ($result as $row) {
			if($row->alumnos > $cantidad){
				$cursos[$i] = $row;
				$i++;
			}
		}

		return $cursos;
	}
}

?>