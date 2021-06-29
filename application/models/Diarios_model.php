<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Diarios_model extends CI_Model {

	public function getDiarios(){
		$resultados = $this->db->select("p.*, p.id,pr.id as prematricula_id, e.num_documento as dni, e.nombre, a.id as ape, c.nombre as curso, p.fecha_registro, p.monto, p.codigo, p.fecha_pago")
			->from("pagos p")
			->join("prematriculas pr", "p.prematricula_id = pr.id")
			->join("aperturas a", "pr.apertura_id = a.id")
			->join("estudiantes e", "pr.estudiante_id = e.id")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("p.estado", "1")
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getDiariosbyDate($fechainicio, $fechafin){
		$resultados = $this->db->select("p.*, p.id, pr.id as prematricula_id, e.num_documento as dni, e.nombre, a.id as ape, c.nombre as curso, p.fecha_registro, p.monto, p.codigo, p.fecha_pago")
			->from("pagos p")
			->join("prematriculas pr", "p.prematricula_id = pr.id")
			->join("aperturas a", "pr.apertura_id = a.id")
			->join("estudiantes e", "pr.estudiante_id = e.id")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("p.estado", "1")
			->where("p.fecha_registro >=", $fechainicio)
			->where("p.fecha_registro <=", $fechafin)
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getVoucherbyDate($fechainicio, $fechafin){
		$resultados = $this->db->select("p.*,p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago")
			->from("pagos p")
			->join("prematriculas pr", "p.prematricula_id = pr.id")
			->join("aperturas a", "pr.apertura_id = a.id")
			->join("estudiantes e", "pr.estudiante_id = e.id")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("p.estado", "1")
			->where("p.fecha_pago >=", $fechainicio)
			->where("p.fecha_pago <=", $fechafin)
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
}
