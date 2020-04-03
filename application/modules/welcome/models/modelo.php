<?php
class modelo extends CI_Model{

		public function __construct(){
		$this->load->database();
	}
	function validarUsuario($correo, $clave){


  		$query1= "SELECT * FROM administrador WHERE administrador.correo =" . '"'.$correo.'"' . "AND administrador.clave =" . '"'.$clave.'"';
	  	$query2= "SELECT * FROM profesor WHERE profesor.correo =" . '"'.$correo.'"'. "AND profesor.clave =" . '"'.$clave.'"';
	  	$query3= "SELECT * FROM ayudante WHERE ayudante.correo =" . '"'.$correo.'"'. "AND ayudante.clave =" . '"'.$clave.'"';

	  	$resultado = $this->db->query($query1)->result();
	  	if(count($resultado) != 0)
	  	{
	  		return true;
	  	}

	  	$resultado = $this->db->query($query2)->result();
	  	if(count($resultado) != 0)
	  	{
	  		return true;
	  	}

	  	$resultado = $this->db->query($query3)->result();
	  	if(count($resultado) != 0)
	  	{
	  		return true;
	  	}
		return false;

	}

	function buscarUsuario($correo, $perfil){
		$this->db->select("nombre");
		$this->db->where('correo',$correo);
		$this->db->limit(1);
		
		if($perfil ==1){
			$result = $this->db->get ('administrador')->result();
			foreach ($result as $fila) {
				return $fila->nombre;
			}
		}	
		if($perfil==2){
			$result = $this->db->get ('profesor')->result();
			foreach ($result as $correo) {
				return $correo->nombre;
			}
		}
		if($perfil==3){
			$result = $this->db->get ('ayudante')->result();
			foreach ($result as $correo) {
				return $correo->nombre;
			}
		}
		else{
				return 0;
		}
	}	
	function buscarPerfil($correo, $clave){
		
		/*$this->db->select("*");
		$this->db->where('correo',$correo);
		$this->db->where('clave',$clave);*/

  		$query1= "SELECT * FROM administrador WHERE administrador.correo =" . '"'.$correo.'"';
	  	$query2= "SELECT * FROM profesor WHERE profesor.correo =" . '"'.$correo.'"';
	  	$query3= "SELECT * FROM ayudante WHERE ayudante.correo =" . '"'.$correo.'"';
	  	$resultado = $this->db->query($query1)->result();
	  	if(count($resultado) != 0)
	  	{
	  		return 1;
	  	}

	  	$resultado = $this->db->query($query2)->result();
	  	if(count($resultado) != 0)
	  	{
	  		return 2;
	  	}

	  	$resultado = $this->db->query($query3)->result();
	  	if(count($resultado) != 0)
	  	{
	  		return 3;
	  	}
	  	else
	  	{
	  		return 0;
	  	}

	  	/*


		$retorno = $this->db->get ('administrador')->num_rows();
		if ($retorno != 0) {
			return 1;
		}
		$retorno = $this->db->get ('profesor')->num_rows();
		if ($retorno != 0) {
			return 2;
		}
		$retorno = $this->db->get ('ayudante')->num_rows();
		if ($retorno != 0) {
			return 3;
		}
		else{
			return 0;
		}*/

	}

	public function listarEvaluaciones($correo){
		$query = "select evaluacion.id,evaluacion.fecha, evaluacion.diasAntes, evaluacion.diasDespues, asignatura.nombre, instanciaasignatura.anio,instanciaasignatura.semestre, instanciaasignatura.seccion, evaluacion.refInstAsignatura, profesorasignatura.refProfesor
			 from evaluacion, instanciaasignatura, asignatura, profesorasignatura
			where evaluacion.refInstAsignatura = instanciaasignatura.id and instanciaasignatura.refAsignatura = asignatura.id
			AND profesorasignatura.refInstAsignatura = instanciaasignatura.id
			AND profesorasignatura.refProfesor = '$correo' " ;

		$resultado = $this->db->query($query)->result_array();
		return $resultado;
	}

}
?>
