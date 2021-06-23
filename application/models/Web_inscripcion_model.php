<?php 
class Web_inscripcion_model extends CI_Model {

    public function getCurso($id = 'none')
    {                       
        $this->db->select("id as id, nombre as nombre, costo");
        $this->db->from('cursos');
        $this->db->where("inscripcion_web","mostrar");
        $this->db->where("estado","1");
		$this->db->order_by('nombre','asc');
		if($id != 'none'){
			$this->db->where('id',$id);
		}
        $query = $this->db->get();
        return $query->result();
    }

    public function getCarreras(){
		$resultados = $this->db->get("carreras");
		return $resultados->result();
	}

	public function getNiveles($id = 'none'){
		$this->db->where("estado","1");
		if($id != 'none'){
			$this->db->where('id',$id);
		}
		$resultados = $this->db->get("niveles");
		return $resultados->result();
	}
	
	public function getSedes($id = 'none'){
		$this->db->where("estado","1");
		if($id != 'none'){
			$this->db->where('id',$id);
		}
		$resultados = $this->db->get("sedes");
		return $resultados->result();
	}

    public function getEstudiante()
    {                       
        $this->db->select("*");
        $this->db->from('estudiantes');
		//$this->db->order_by('nombre','asc');
        $query = $this->db->get();

        return $query->result_array();
    }
    public function getPrematriculaEstAperCurso($curso_id,$estudiante_id){
		$this->db->select("pr.id");
		$this->db->from('prematriculas as pr');
		$this->db->join('aperturas as ape', 'ape.id = pr.apertura_id');

		$this->db->where("ape.curso_id",$curso_id);
		$this->db->where("pr.estudiante_id",$estudiante_id);
		$this->db->where("coalesce(pr.nota,0) <> 1"); 	

		$resultado = $this->db->get();
		return $resultado->row();
	}
	
    public function getPrematriculaEstAper($id,$estudiante_id){ /** para la opcion editar **/
		$this->db->select("id");
		$this->db->where("apertura_id",$id);
		$this->db->where("estudiante_id",$estudiante_id);
		$resultado = $this->db->get("prematriculas");
		return $resultado->row();

	}
	public function getEstudianteInscripcion($tipo,$numero){ /** para la opcion editar **/
		$this->db->select("nombre, fecha_nacimiento, sexo_id, carrera_id, celular, email, direccion, 'cti' as fuente ");
		$this->db->where("tipo_documento_id",$tipo);
		$this->db->where("num_documento",$numero);
		$resultado = $this->db->get("estudiantes");
		return $resultado->row();

	}
    public function validEstudiante($id){ 
    	$this->db->select("id");
		$this->db->where("num_documento",$id);
		$resultado = $this->db->get("estudiantes");
		return $resultado->row();

	}
    public function getUltEstudiante(){ /** para la opcion editar **/
    	
    	$this->db->select_max('id');
		$resultado = $this->db->get("estudiantes");
		return $resultado->row();

	}
    public function getPrematriculaUlt($estudiante_id,$apertura_id){ /** para la opcion editar **/
    	$this->db->select_max('id');
    	$this->db->where("estudiante_id",$estudiante_id);
    	$this->db->where("apertura_id",$apertura_id);
		$resultado = $this->db->get("prematriculas");
		return $resultado->row();

	}


	public function getCursoApertura($id = 'none', $id_sede = "1"){


		$this->db->select("ape.id as apertura_id, ape.fecha_ini as fecha_inicio, gru.nombre as dias, gru.hora_ini as hora_inicio, gru.hora_fin as hora_fin");
		$this->db->from('aperturas as ape');
		$this->db->join('grupos as gru', 'ape.grupo_id = gru.id');
		if($id != 'none'){
			$this->db->where('ape.curso_id',$id);
		}
		if($id_sede != ''){
			$this->db->where('ape.sede_id',$id_sede);
		}
		$this->db->where("DATE_ADD(ape.fecha_ini, INTERVAL 7 DAY) >= ",date('Y-m-d'));

		$this->db->where('ape.estado_inscripcion',"abierto");
		$this->db->where('ape.notas',"0");
		$this->db->where('ape.estado',"1");
		//$this->db->order_by('ape.fecha_ini', 'ASC');
		$this->db->order_by('ape.fecha_ini, gru.nombre, gru.hora_ini, gru.hora_fin', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}


	public function guardar_solicitud_apertura($data)
	{
		return $this->db->insert("web_solicitud_apertura", $data);
	}
	public function guardar_estudiante($data)
	{
		return $this->db->insert("estudiantes", $data);
	}
	public function guardar_inscripcion($data)
	{
		return $this->db->insert("prematriculas", $data);
	}
	public function guardar_log($data)
	{
		return $this->db->insert("log", $data);
	}

	public function getVer($id){ /** para cargar la informacion en el boton ver **/

		$this->db->select("
				pre.id as id_inscripcion,

				est.num_documento as estudiante_num_documento,
				est.nombre as estudiante_nombre,
				est.email as estudiante_email,
				est.telefono as estudiante_telefono,
				est.celular as estudiante_celular,

				c.nombre as curso_nombre, 
				g.hora_ini as hora_inicio, 
				g.hora_fin as hora_fin, 
				g.nombre as dias,
				a.fecha_ini as fecha_inicio, 
				s.nombre as sede_nombre				
				");
		$this->db->from('prematriculas as pre');
		$this->db->join('aperturas as a', 'a.id = pre.apertura_id');
		$this->db->join('cursos as c', 'c.id = a.curso_id');
		$this->db->join('grupos as g', 'g.id = a.grupo_id');
		$this->db->join('sedes as s', 's.id = a.sede_id');
		$this->db->join('estudiantes as est', 'est.id = pre.estudiante_id');
		$this->db->where('pre.id',$id);
		$query = $this->db->get();
		return $query->row();
	}
}

