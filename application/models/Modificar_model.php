<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modificar_model extends CI_Model
{
		/* para las modificaciones */
	public function getAperturadosmod()
	{
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,c.costo");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.estado", "1");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
		public function listo($starIndex, $pageSize, $buscar){
		$cont=
		$this->db
		//->where("matriculado", '0')
	//	->where("estado", '1')
		->from('prematriculas')->count_all_results(); 
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,a.id as codigo,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin,p.estado");
		//$this->db->select("*");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND (a.estado= '1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function listexp($starIndex, $pageSize, $buscar){
		$cont=
		$this->db
		//->where("matriculado", '0')
	//	->where("estado", '1')
		->where("apertura_id", $buscar)
		->from('prematriculas')->count_all_results(); 
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,a.id as codigo,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin");
		//$this->db->select("*");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(a.id ='$buscar') AND (a.estado= '1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function Excel()
	{
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,a.id as codigo,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(p.estado='1' AND a.estado= '1')");
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function Excelbus($buscar)
	{
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,a.id as codigo,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(a.id = '$buscar') AND (p.estado='1' AND a.estado= '1')");
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
}
