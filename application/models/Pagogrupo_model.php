<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagogrupo_model extends CI_Model
{

//// PARA

	public function getpagogrupo($starIndex, $pageSize, $buscar)
	{	$cont=
		$this->db
		->where("estado", '1')
		->from('pagos')->count_all_results(); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,p.codigo as boucher,p.monto,p.fecha_pago as fecha");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		//$this->db->group_by("pr.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND (p.estado='1' AND pr.deuda >= '0')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('e.num_documento', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	}

	public function getpagogrupos($starIndex, $pageSize, $buscar)
	{
		$cont=
		$this->db
		->where("estado", '1')
		->from('pagos')->count_all_results(); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,p.codigo as boucher,p.monto,p.fecha_pago as fecha");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		//$this->db->group_by("pr.id");
		$this->db->where("(a.id='$buscar') AND (p.estado='1' AND pr.deuda >= '0')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('e.num_documento', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	}

	public function getalumnos()
	{
		$this->db->select("a.*,a.id as ape,c.nombre as curso,count(pr.deuda) as deudas");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas pr", "pr.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->where("pr.estado='1' AND pr.deuda >='0'");
		$this->db->group_by("ape");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getcursoDeudores()
	{
		$this->db->select("a.*,a.id as ape,c.nombre as curso,count(pr.deuda) as deudas");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas pr", "pr.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->where("pr.deuda >", "0");
		$this->db->group_by("ape");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}


	public function Excele()
	{	$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,p.codigo as boucher,p.monto,p.fecha_pago as fecha");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		//$this->db->group_by("pr.id");
		$this->db->where("(p.estado='1' AND pr.deuda >='0')");
		$this->db->order_by('e.num_documento', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function Excelbuse($buscar)
	{	$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,p.codigo as boucher,p.monto,p.fecha_pago as fecha");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		//$this->db->group_by("pr.id");
		$this->db->where("(a.id = '$buscar') AND (p.estado='1' AND pr.deuda >='0')");
		$this->db->order_by('e.num_documento', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}



}
