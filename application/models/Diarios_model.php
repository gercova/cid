<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diarios_model extends CI_Model
{

	public function getDiarios()
	{
		$this->db->select("p.*,p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	public function getDiariosbyDate($fechainicio, $fechafin)
	{
		$this->db->select("p.*,p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.fecha_registro >=", $fechainicio);
		$this->db->where("p.fecha_registro <=", $fechafin);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	public function getVoucherbyDate($fechainicio, $fechafin)
	{
		$this->db->select("p.*,p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.fecha_pago >=", $fechainicio);
		$this->db->where("p.fecha_pago <=", $fechafin);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
}
