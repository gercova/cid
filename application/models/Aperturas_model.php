<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Aperturas_model extends CI_Model{

	public function getAperturas(){
		$resultados = $this->db->select("a.*,a.id,c.nombre as curso,tc.descripcion,g.nombre as grupo,g.hora_ini,g.hora_fin, s.nombre as sede_nombre")
			->from("aperturas a")
			->join("cursos c", "a.curso_id = c.id")
			->join("tipo_curso tc", "c.tipocurso_id = tc.id")
			->join("grupos g", "a.grupo_id = g.id")
			->join("sedes s", "a.sede_id = s.id")
			->where("a.notas", "0")
			->where("a.estado", "1")
			->get();
		if($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function grilla($starIndex, $pageSize, $buscar){
		$cont = $this->db->count_all_results('aperturas'); 
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
		$resultados = $this->db->select("a.*,a.id,c.nombre as curso,tc.descripcion,g.nombre as grupo,g.hora_ini,g.hora_fin")
			->from("aperturas a")
			->join("cursos c", "a.curso_id = c.id")
			->join("tipo_curso tc", "c.tipocurso_id = tc.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("a.notas", "0")
			->where("a.estado", "1")
			->where("a.curso_id", $datouno)
			->where("a.grupo_id", $datodos)
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getApertura($id){
		/** guarda los Modulos */
		$resultado = $this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,tc.descripcion,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin, a.fecha_ini")
			->from("aperturas a")
			->join("cursos c", "a.curso_id = c.id")
			->join("tipo_curso tc", "c.tipocurso_id = tc.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("a.id", $id)
			->get();
		return $resultado->row();
	}

	public function getPrematri($idestudiante, $idcurso, $estado){
		/** para la opcion editar **/
		$resultado = $this->db->where("estudiante_id", $idestudiante)
			->where("curso_id", $idcurso)
			->where("estado", $estado)
			->get("aperturas");
		return $resultado->row();
	}

	public function getPrever($id){
		/** guarda los Modulos */
		$resultado = $this->db->select("a.*, a.id, a.curso_id, c.nombre as curso, a.grupo_id, g.nombre as grupo, g.hora_ini, g.hora_fin, a.fecha_registro,  s.nombre as sede_nombre")
			->from("aperturas a")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->join("sedes s", "a.sede_id = s.id")
			->where("a.id", $id)
			->get();
		return $resultado->row();
	}

	public function getCurgrupres(){
		$resultados = $this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin")
			->from("aperturas a")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("a.notas", "0")
			->where("a.estado", "1")
			->get();
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