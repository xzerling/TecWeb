<?php
class modelo extends CI_Model{
	function validarUsuario($correo, $clave){
			$this->db->select("*");
			$this->db->where('correo',$correo);
			$this->db->where('clave',$clave);
			
			$retorno = $this->db->get ('administrador')->num_rows();
			if ($retorno != 0) {
				return true;
			}
			$retorno = $this->db->get ('profesor')->num_rows();
			if ($retorno != 0) {
				return true;
			}
			$retorno = $this->db->get ('ayudante')->num_rows();
			if ($retorno != 0) {
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
				return $fila->nombre;
			}
		}
		if($perfil==3){
			$result = $this->db->get ('ayudante')->result();
			foreach ($result as $correo) {
				return $fila->nombre;
			}
		}
		else{
				return 0;
		}
	}	
	function buscarPerfil($correo, $clave){
		$this->db->select("*");
		$this->db->where('correo',$correo);
		$this->db->where('clave',$clave);

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
		}

	}

}
?>
