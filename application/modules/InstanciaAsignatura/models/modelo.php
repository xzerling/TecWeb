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

    public function cargarDatos(){ 
		$query = "select instanciaasignatura.id, asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.semestre, instanciaasignatura.anio, instanciaasignatura.refAsignatura
		from asignatura, instanciaasignatura 
		where asignatura.id = instanciaasignatura.refAsignatura and 
		asignatura.estado = 1"; //solo las asignaturas disponibles
 
		$output = $this->db->query($query)->result_array();
		
		return $output; 
	} 

	public function obtenerAsignaturas(){
		$query = "select id, nombre from asignatura
		 where estado = 1";

		$resultado = $this->db->query($query)->result_array();
		return $resultado;
	}

	function eliminarDato($id){
		$this->db->where("id",$id);
		$this->db->delete('InstanciaAsignatura');
	}
	function guardarDatos($seccion, $semestre, $anio, $refInstanciaAsignatura){
		$data['seccion'] = $seccion;
		//echo $seccion;
		$data['semestre']=$semestre;
		$data['anio'] = $anio;
		$data['refAsignatura'] = $refInstanciaAsignatura;

		$this->db->insert('instanciaasignatura',$data);
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

	function guardarCambios($id, $seccion, $semestre, $anio, $refAsignatura){
		//$this->load->helper('url');
		$data['seccion']=$seccion;
		$data['semestre'] = $semestre;
		$data['anio'] = $anio;
		$data['refAsignatura'] = $refAsignatura;

		$this->db->where("id",$id);
		$this->db->update("InstanciaAsignatura",$data);
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