<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class modulos_model extends CI_Model {
	public function grilla($starIndex, $pageSize, $buscar){
		$cont=$this->db
		->where("estado", '1')
		->where("descripcion", $buscar)
		->from('modulos')->count_all_results(); 
		$this->db->select("c.id as cuid, m.id, n.descripcion as nivel, ci.descripcion as ciclo, c.descripcion as curso,m.descripcion as modulo,m.horas");
		$this->db->from("modulos as m");
		$this->db->join("cursos as c", "m.curso_id = c.id");
		$this->db->join("niveles as n", "c.nivel_id = n.id");
		$this->db->join("ciclos as ci", "c.ciclo_id = ci.id");
		$this->db->or_where("(c.descripcion LIKE '%$buscar%' AND m.descripcion LIKE '%$buscar%') AND m.estado=1");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('m.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function save($data){ /** guarda los modulos */
		return $this->db->insert("modulos",$data);
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id",$id);
		return $this->db->update("modulos",$data);
	}

	public function getedit($id) /// cargar datos docente aula fechas del mantenimiento add prematricula
	{
		$this->db->select("c.id,ci.descripcion as ciclo, n.descripcion as nivel, c.descripcion");
		$this->db->from("cursos as c");
		$this->db->join("ciclos as ci", "ci.id = c.ciclo_id");
		$this->db->join("niveles as n", "n.id = c.nivel_id");
		$this->db->or_where("c.estado =1 AND ci.estado=1 AND n.estado=1");
		$this->db->where("c.id",$id);
		//$this->db->where("estado","1");
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			echo json_encode($resultado->result()[0]);
		} else {
			echo json_encode($resultado->result());
		}
	}

	public function getmodulos($id){
		$this->db->select("m.id,m.descripcion,m.abreviatura,m.horas");
		$this->db->from("modulos as m");
		$this->db->join("cursos as c", "c.id = m.curso_id");
		$this->db->where("c.estado = 1 AND m.estado = 1");
		$this->db->where("c.id",$id);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}


}
