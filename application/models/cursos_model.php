<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cursos_model extends CI_Model {

	public function getcursos(){
		$resultados = $this->db->select("c.id, c.descripcion, ci.descripcion as ciclo, n.descripcion as nivel, c.costo")
			->from("cursos as c")
			->join("niveles as n", "c.nivel_id = n.id")
			->join("ciclos as ci", "c.ciclo_id = ci.id")
			->where("c.estado", "1")
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	public function grilla($starIndex, $pageSize, $buscar){
		$cont = $this->db->where("estado", '1')->from('cursos')->count_all_results(); 
		$this->db->select("c.id, c.descripcion,n.descripcion as nivel,ci.descripcion as ciclo,c.silabus, c.costo,c.act_web as web");
		$this->db->from("cursos as c");
		$this->db->join("ciclos as ci", "c.ciclo_id = ci.id");
		$this->db->join("niveles as n", "c.nivel_id = n.id");
		$this->db->or_where("c.descripcion LIKE '%$buscar%' AND c.estado=1");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('c.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function save($data){ /** guarda los cursos */
		return $this->db->insert("cursos",$data);
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id",$id);
		return $this->db->update("cursos",$data);
	}

	public function getedit($id){
		/// cargar datos docente aula fechas del mantenimiento add prematricula
		$resultado = $this->db->select("id,ciclo_id as ciclos, nivel_id as niveles, descripcion, costo, silabus, act_web as web")
			->from("cursos")
			->where("id",$id)
			->where("estado","1")
			->get();
		if ($resultado->num_rows() > 0) {
			echo json_encode($resultado->result()[0]);
		} else {
			echo json_encode($resultado->result());
		}
	}


}
