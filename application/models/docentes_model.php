<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class docentes_model extends CI_Model {

	public function grilla($starIndex, $pageSize, $buscar){
		$cont=$this->db->count_all_results('docentes'); 
		$this->db->select("e.id, e.dni,e.nombre,e.celular,e.email, e.fec_reg");
		$this->db->from("docentes as e");
		$this->db->or_where("(e.dni LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND e.estado=1");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('e.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function save($data){ /** guarda los docentes */
		return $this->db->insert("docentes",$data);
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id",$id);
		return $this->db->update("docentes",$data);
	}

	public function getedit($id) /// cargar datos docente aula fechas del mantenimiento add prematricula
	{
		$this->db->select("*");
		$this->db->from("docentes");
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
