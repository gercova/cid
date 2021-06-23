<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class conceptos_model extends CI_Model {

	public function grilla($starIndex, $pageSize, $buscar){
		$cont=$this->db->count_all_results('conceptos'); 
		$this->db->select("a.id, a.descripcion,a.referencia, a.estado");
		$this->db->from("conceptos as a");
		$this->db->or_where("(a.descripcion LIKE '%$buscar%' AND a.referencia LIKE '%$buscar%' ) AND a.estado=1");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('a.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function save($data){ /** guarda los conceptos */
		return $this->db->insert("conceptos",$data);
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id",$id);
		return $this->db->update("conceptos",$data);
	}

	public function getedit($id) /// cargar datos docente aula fechas del mantenimiento add prematricula
	{
		$this->db->select("*");
		$this->db->from("conceptos");
		$this->db->where("id",$id);
		$this->db->where("estado","1");
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			echo json_encode($resultado->result()[0]);
		} else {
			echo json_encode($resultado->result());
		}
	}
}
