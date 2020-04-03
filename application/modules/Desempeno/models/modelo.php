<?php
class modelo extends CI_Model{
	function validarUsuario($usuario, $clave){
		$this->db->select("*");
		$this->db->where('nombre',$usuario);
		$this->db->where('clave',$clave);
		$retorno = $this->db->get('login')->num_rows();
		if($retorno == 0){
			return false;
		}
		return true;
	}
	function buscarPerfil($usuario,$clave){
		$this->db->select('perfil');
		$this->db->where('nombre',$usuario);
		$this->db->where('clave',$clave);
		$this->db->limit(1);
		$result = $this->db->get('login')->result();
		foreach ($result as $fila) {
			return $fila->perfil;
		}
	}
	function buscarPerfilPorId($id){
		$this->db->select('perfil');
		$this->db->where('id',$id);
		$this->db->limit(1);
		$result = $this->db->get('login')->result();
		foreach ($result as $fila) {
			return $fila->perfil;
		}
	}
	function buscarId($usuario,$clave){
		$this->db->select('id');
		$this->db->where('nombre',$usuario);
		$this->db->where('clave',$clave);
		$this->db->limit(1);
		$result = $this->db->get('login')->result();
		foreach ($result as $fila) {
			return $fila->id;
		}
	}

	function cargarDatosUsuario(){
		$perfil = $this->buscarPerfilPorId($this->session->userdata("id"));
		$this->db->select("*");
		if($perfil == "usuario"){
			$this->db->where("id",$this->session->userdata("id"));
		}
		return $this->db->get('login')->result();
	}
	function cargarDatosUsuarioExtras(){
		$perfil = $this->buscarPerfilPorId($this->session->userdata("id"));
		$this->db->select("*");
		$variable = $this->session->userdata("id");
		if($perfil == "usuario"){

			$query = $this->db->query("
				SELECT * FROM login 
				WHERE perfil = 'usuario' AND
				id = $variable
				UNION SELECT * FROM login  WHERE perfil = 'usuario'"
);
		}
        return $query->result();
    }

	function cargarDatos(){
		$this->load->helper('url');
		$query = "select instanciaasignatura.id, asignatura.nombre as nombreAsignatura, instanciaasignatura.refAsignatura, instanciaasignatura.anio, alumno.nombre, calificarevaluacion.refAlumno, calificarevaluacion.nota
		from calificarevaluacion, instanciaasignatura, asignatura, evaluacion, alumno
		where asignatura.id = instanciaasignatura.refAsignatura and 
		evaluacion.id = calificarevaluacion.refEvaluacion and
		instanciaasignatura.id = evaluacion.refInstAsignatura and
		alumno.matricula = calificarevaluacion.refAlumno
        ORDER BY(alumno.nombre)";

		$output = $this->db->query($query)->result_array();

		return $output;
	}

	function cargarDatosDocente($correo)
	{
		$this->load->helper('url');
		$query = " select instanciaasignatura.id, asignatura.nombre as nombreAsignatura, instanciaasignatura.refAsignatura, instanciaasignatura.anio, alumno.nombre, calificarevaluacion.refAlumno, calificarevaluacion.nota from calificarevaluacion, instanciaasignatura, asignatura, evaluacion, alumno, profesorasignatura where asignatura.id = instanciaasignatura.refAsignatura and evaluacion.id = calificarevaluacion.refEvaluacion and instanciaasignatura.id = evaluacion.refInstAsignatura and alumno.matricula = calificarevaluacion.refAlumno AND profesorasignatura.refInstAsignatura = instanciaasignatura.id and profesorasignatura.refProfesor = '$correo' ORDER BY(alumno.nombre) ";

		$output = $this->db->query($query)->result_array();
		return $output;
	}

	function eliminarDato($id){
		$this->db->where("id",$id);
		$this->db->delete('asignatura');
	}
	function guardarDatos($avatar, $nombre, $rut, $clave, $perfil, $telefono, $correo){
		$data['avatar'] = $avatar;
		$data['nombre']=$nombre;
		$data['rut'] = $rut;
		$data['clave'] = $clave;
		$data['perfil'] = $perfil;
		$data['telefono'] = $telefono;
		$data['correo'] = $correo;

		$this->db->insert('login',$data);
	}
	function guardarCambiosEx($id, $avatar, $nombre, $rut, $perfil, $telefono, $correo){
		$data['avatar'] = $avatar;
		$data['nombre']=$nombre;
		$data['rut'] = $rut;
		//$data['clave'] = $clave;
		$data['perfil'] = $perfil;
		$data['telefono'] = $telefono;
		$data['correo'] = $correo;

		$this->db->where("id",$id);
		$this->db->update("login",$data);
	}

	function guardarCambios($id, $nombre, $estado){
		//$this->load->helper('url');
		$data['nombre']=$nombre;
		$data['estado'] = $estado;

		$this->db->where("id",$id);
		$this->db->update("asignatura",$data);
	}

	public function numPostUs(){
		//this->get("login")->num_rows();
		$number = $this->db->query("SELECT count(*) as number FROM login WHERE perfil = 'usuario'")->row()->number;
		return intval($number);
	}

	public function getPaginationUs($numberPerPage){
		$perfil = $this->buscarPerfilPorId($this->session->userdata("id"));
		$this->db->select("*");
		$variable = $this->session->userdata("id");
		if($perfil == "usuario"){

			$query = $this->db->query("
				SELECT * FROM login 
				WHERE perfil = 'usuario' AND
				id = $variable
				UNION SELECT * FROM login  WHERE perfil = 'usuario'"
);
		}
		return $this->db->get("login", $numberPerPage, $this->uri->segment(3))->result();
	}

	public function numPost(){
		//this->get("login")->num_rows();
		$number = $this->db->query("SELECT count(*) as number FROM login")->row()->number;
		return intval($number);
	}

	public function getPagination($numberPerPage){
		$perfil = $this->buscarPerfilPorId($this->session->userdata("id"));
		$this->db->select("*");
		if($perfil == "usuario"){
			$this->db->where("perfil",$this->session->userdata("perfil"));
		}

		return $this->db->get("login", $numberPerPage, $this->uri->segment(3))->result();
	}
}
?>