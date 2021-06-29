<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dias_model extends CI_Model {

	function getDays(){
		$query = $this->db->get('dias');
		return $query->result();
	}

	public function grilla($starIndex, $pageSize, $buscar){
		$cont = $this->db->count_all_results('dias'); 
		$this->db->select("a.id, a.descripcion, a.estado");
		$this->db->from("dias as a");
		$this->db->or_where("a.descripcion LIKE '%$buscar%' AND a.estado=1");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('a.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function save($data){ /** guarda los dias */
		return $this->db->insert("dias",$data);
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id",$id);
		return $this->db->update("dias",$data);
	}

	public function getedit($id){
		// cargar datos docente aula fechas del mantenimiento add prematricula
		$resultado = $this->db->select("*")
			->from("dias")
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
