<?php 
class Web_pagos_model extends CI_Model {

    public function getListaPagos($id = '0'){
		$this->db->select("p.*, p.id as id_pre, c.nombre as curso, g.hora_ini as hora_inicio, g.hora_fin as hora_fin, a.fecha_ini as fecha_inicio,p.deuda as deuda, c.id as id_curso, g.nombre as dias	");
		$this->db->from('prematriculas as p');
		$this->db->join('aperturas as a', 'a.id = p.apertura_id');
		$this->db->join('cursos as c', 'c.id = a.curso_id');
		$this->db->join('grupos as g', 'g.id = a.grupo_id');
	    $this->db->where('p.estudiante_id',$id);
	    $this->db->where('p.deuda > 0');

		$query = $this->db->get();
		return $query->result_array();
	}//

	public function guardar_pago($data)
	{
		return $this->db->insert("pagos", $data);
	}

	public function guardar_pago_web($data)
	{
		return $this->db->insert("web_pagos", $data);
	}

	public function getInfoEstudiante($prematricula_id){
		$this->db->select("est.email, est.nombre ");
		$this->db->from('prematriculas as pre');
		$this->db->join('estudiantes as est', 'est.id = pre.estudiante_id');
		$this->db->where("pre.id",$prematricula_id);
		$query = $this->db->get();
		return $query->row();
	}

    public function getEstudianteInscripcion($tipo,$numero){ /** para la opcion editar **/
		$this->db->select("est.nombre, est.fecha_nacimiento, carr.nombre as carrera, est.celular, est.email, est.direccion, 'cti' as fuente, est.id as id_estudiante,
			CASE WHEN est.sexo_id = 1 THEN 'Masculino' WHEN est.sexo_id = 2 THEN 'Femenino' ELSE 'Sin especificar' END as sexo");
		$this->db->from('estudiantes as est');
		$this->db->join('carreras as carr', 'carr.id = est.carrera_id');
		$this->db->where("est.tipo_documento_id",$tipo);
		$this->db->where("est.num_documento",$numero);
		 $query = $this->db->get();
		return $query->row();
	}

	//Desde web admin
	public function getPagosWeb(){
		$this->db->select("pag.id as id_pago, 
				pag.fecha_registro as fecha_registro, 
				c.nombre as curso_nombre, 
				g.hora_ini as hora_inicio, 
				g.hora_fin as hora_fin, 
				g.nombre as dias,
				a.fecha_ini as fecha_inicio, 
				est.nombre as estudiante_nombre,
				pag.monto as monto
				");
		$this->db->from('web_pagos as pag');
		$this->db->join('prematriculas as pre', 'pag.prematricula_id = pre.id');
		$this->db->join('aperturas as a', 'a.id = pre.apertura_id');
		$this->db->join('cursos as c', 'c.id = a.curso_id');
		$this->db->join('grupos as g', 'g.id = a.grupo_id');
		$this->db->join('estudiantes as est', 'est.id = pre.estudiante_id');

		$query = $this->db->get();
		return $query->result();
	}//

	public function getVer($id){ /** para cargar la informacion en el boton ver **/

		$this->db->select("pag.id as id_pago, 			
				pag.fecha_registro as fecha_registro, 				
				pag.monto as monto,
				pag.descripcion as descripcion,
				pag.codigo as codigo,
				pag.fecha_pago as fecha_pago,
				pag.comentario as comentario,
				pag.imagen as imagen,

				est.num_documento as estudiante_num_documento,
				est.nombre as estudiante_nombre,
				c.nombre as curso_nombre, 
				g.hora_ini as hora_inicio, 
				g.hora_fin as hora_fin, 
				g.nombre as dias,
				a.fecha_ini as fecha_inicio, 
				pre.deuda as deuda
				
				");
		$this->db->from('web_pagos as pag');
		$this->db->join('prematriculas as pre', 'pag.prematricula_id = pre.id');
		$this->db->join('aperturas as a', 'a.id = pre.apertura_id');
		$this->db->join('cursos as c', 'c.id = a.curso_id');
		$this->db->join('grupos as g', 'g.id = a.grupo_id');
		$this->db->join('estudiantes as est', 'est.id = pre.estudiante_id');
		$this->db->where('pag.id',$id);
		$query = $this->db->get();
		return $query->row();
	}

}

