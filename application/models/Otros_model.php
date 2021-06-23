<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Otros_model extends CI_Model
{

	public function getPagos()
	{
		$this->db->select("p.*,p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,g.nombre as grupo,p.fecha_pago,p.monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		//	$this->db->group_by("pr.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function grilla($starIndex, $pageSize, $buscar){
		$cont=
		$this->db
		->where("concepto_id != 'NULL'")
		->where("estado", '1')
		->from('pagos')->count_all_results(); 
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,c.nombre as concepto,p.fecha_pago,p.monto");
		$this->db->from("pagos p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("conceptos c", "p.concepto_id = c.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND (p.estado='1' AND p.concepto_id != 'NULL')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getPago($id)
	{
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,p.concepto_id,c.nombre as concepto,p.descripcion,p.codigo, p.fecha_pago,p.monto");
		$this->db->from("pagos p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("conceptos c", "p.concepto_id = c.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getConceptos(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("conceptos");
		return $resultados->result();
	}


	public function save($data)
	{
		return $this->db->insert("pagos", $data);
	}

	public function update($id, $data)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->update("pagos", $data);
	}
	
	
	public function delete($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete("pagos");
	}
	

}
