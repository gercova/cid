<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class estudiantes_model extends CI_Model {

	public function getestudiantes(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("estudiantes");
		return $resultados->result();
	}

	public function grilla($starIndex, $pageSize, $buscar){
		$cont=$this->db->count_all_results('estudiantes'); 
		$this->db->select("e.id, e.dni,e.nombre,e.celular,e.email, e.fec_reg");
		$this->db->from("estudiantes as e");
		$this->db->or_where("(e.dni LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND e.estado=1");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('e.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function one($id){
		$this->db->select('*');
		$this->db->from('estudiantes');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();

	}
	public function create($params){
		$this->db->insert('estudiantes',$params);
		return $this->bd->insert();
	}

	public function save($data){ /** guarda los estudiantes */
		return $this->db->insert("estudiantes",$data);
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id",$id);
		return $this->db->update("estudiantes",$data);
	}

	public function getedit($id) /// cargar datos docente aula fechas del mantenimiento add prematricula
	{
		$this->db->select("*");
		$this->db->from("estudiantes");
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
