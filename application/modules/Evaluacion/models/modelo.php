<?php

class modelo extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listarEvaluaciones(){
		$query = "select evaluacion.id,evaluacion.fecha, evaluacion.diasAntes, evaluacion.diasDespues, asignatura.nombre, instanciaasignatura.seccion, evaluacion.refInstAsignatura from evaluacion, instanciaasignatura, asignatura where evaluacion.refInstAsignatura = instanciaasignatura.id and instanciaasignatura.refAsignatura = asignatura.id";

		$resultado = $this->db->query($query)->result();
		return $resultado;
	}

	public function obtenerAsignaturas(){
		$query = "select instanciaasignatura.id, asignatura.nombre from asignatura, instanciaasignatura where asignatura.id = instanciaasignatura.refAsignatura";

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
}

?>