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

	public function insertExcel($archivo)
	{
		    
		$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		  
		  //if(in_array($_FILES["file"]["type"],$allowedFileType)){

		        //$targetPath = 'subidas/'.$_FILES['file']['name'];
		        $targetPath = $archivo;
		        //move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
		        //$reader = \vendor\IOFactory::createReaderForFile($archivo);

		        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	            $spreadsheet = $reader->load($archivo);
     
    			$sheetData = $spreadsheet->getActiveSheet()->toArray();
   				print_r($sheetData);


		        $Reader = new SpreadsheetReader($targetPath);
		        

		        $sheetCount = count($Reader->sheets());
		        for($i=0;$i<$sheetCount;$i++)
		        {
		            
		            $Reader->ChangeSheet($i);
		            
		            foreach ($Reader as $Row)
		            {
		          
		                $matriculas = "";
		                if(isset($Row[0])) {
		                    $matriculas = mysqli_real_escape_string($con,$Row[0]);
		                }
		                
		                $nombres = "";
		                if(isset($Row[1])) {
		                    $nombres = mysqli_real_escape_string($con,$Row[1]);
		                }
						
		                $correo = "";
		                if(isset($Row[2])) {
		                    $correo = mysqli_real_escape_string($con,$Row[2]);
		                }
		                
		                if (!empty($nombres) || !empty($matriculas) || !empty($correo)) {
		                    $query = "insert into alumno(matricula, nombre, correo) values('".$matriculas."','".$nombres."','".$correo."')";
		                    $resultados = mysqli_query($con, $query);
		                
		                    if (! empty($resultados)) {
		                        $type = "success";
		                        $message = "Excel importado correctamente";
		                    } else {
		                        $type = "error";
		                        $message = "Hubo un problema al importar registros";
		                    }
		                }
		             }
		        
		         }
		 // }

	}

	public function asignaturasNoAsignadas()
	{
		$query = " 	select asignatura.nombre, instanciaasignatura.seccion, instanciaasignatura.id
				   	from asignatura, instanciaasignatura 
					where instanciaasignatura.refAsignatura = asignatura.id 
					and instanciaasignatura.anio = YEAR(CURRENT_DATE) 
					and instanciaasignatura.id NOT IN (select refInstAsignatura FROM profesorasignatura)";

		$asignaturas = $this->db->query($query)->result();
		return $asignaturas;
	}

	public function obtenerProfesores()
	{
		$query = "select profesor.correo, profesor.nombre from profesor";

		$profesores = $this->db->query($query)->result();
		return $profesores;
	}

	public function guardarProfesorAsignatura()
	{
		$data = array(
			'refProfesor' => $this->input->post('refProfesor'),
			'refInstAsignatura' => $this->input->post('refInstAsignatura')
		);

		$this->db->insert('profesorasignatura',$data);
	}

	public function asignaturasAsignadas()
	{
		$query = "select profesorasignatura.refProfesor, profesorasignatura.refInstAsignatura, profesor.nombre, asignatura.nombre as nombreasignatura,instanciaasignatura.seccion 
					FROM asignatura, profesor, profesorasignatura, instanciaasignatura 
					WHERE profesorasignatura.refProfesor = profesor.correo 
					AND profesorasignatura.refInstAsignatura = instanciaasignatura.id 
					AND instanciaasignatura.refAsignatura = asignatura.id";

		$asignaturas = $this->db->query($query)->result();
		
		return $asignaturas;
	}

	public function eliminarAsignacion($refInstAsignatura)
	{
		$this->db->where("refInstAsignatura",$refInstAsignatura);
		$this->db->delete('profesorasignatura');
	}
}
?>