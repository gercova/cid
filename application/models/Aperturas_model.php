<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Aperturas_model extends CI_Model{

	public function getAperturas(){
		$this->db->select("a.*,a.id,c.nombre as curso,tc.descripcion,g.nombre as grupo,g.hora_ini,g.hora_fin, s.nombre as sede_nombre");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("tipo_curso tc", "c.tipocurso_id = tc.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("sedes s", "a.sede_id = s.id");
		$this->db->where("a.notas", "0");
		$this->db->where("a.estado", "1");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function grilla($starIndex, $pageSize, $buscar){
		$cont=$this->db->count_all_results('aperturas'); 
		$this->db->select("a.id,c.nombre as curso,tc.descripcion as tipo,s.nombre as sede,g.nombre as grupo,g.hora_ini,g.hora_fin, a.fecha_ini,estado_inscripcion");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("sedes s", "a.sede_id = s.id");
		$this->db->join("tipo_curso tc", "c.tipocurso_id = tc.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(c.nombre LIKE '%$buscar%' OR tc.descripcion LIKE '%$buscar%') AND (a.estado='1' AND a.notas= '0')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('a.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getCursospre($datouno, $datodos){
		$this->db->select("a.*,a.id,c.nombre as curso,tc.descripcion,g.nombre as grupo,g.hora_ini,g.hora_fin");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("tipo_curso tc", "c.tipocurso_id = tc.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.notas", "0");
		$this->db->where("a.estado", "1");
		$this->db->where("a.curso_id", $datouno);
		$this->db->where("a.grupo_id", $datodos);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getApertura($id){
		/** guarda los Modulos */
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,tc.descripcion,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin, a.fecha_ini");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("tipo_curso tc", "c.tipocurso_id = tc.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getPrematri($idestudiante, $idcurso, $estado){
		/** para la opcion editar **/
		$this->db->where("estudiante_id", $idestudiante);
		$this->db->where("curso_id", $idcurso);
		$this->db->where("estado", $estado);
		$resultado = $this->db->get("aperturas");
		return $resultado->row();
	}


	public function getPrever($id){
		/** guarda los Modulos */
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_registro,  s.nombre as sede_nombre");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("sedes s", "a.sede_id = s.id");
		$this->db->where("a.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getCurgrupres(){
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.notas", "0");
		$this->db->where("a.estado", "1");
		//$this->db->group_by("a.curso_id");
		//$this->db->group_by("a.grupo_id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
    
    public function getSedes($id = 'none'){
		$this->db->where("estado","1");
		if($id != 'none'){
			$this->db->where('id',$id);
		}
		$resultados = $this->db->get("sedes");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("aperturas", $data);
	}

	public function update($id, $data){
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->update("aperturas", $data);
	}
}
