<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_model extends CI_Model
{

	public function listo($starIndex, $pageSize,  $buscaini, $buscafin){
		$cont=
		$this->db
		->where("estado", '1')
		->from('pagos')->count_all_results(); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre estudiante,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(e.num_documento LIKE '%$buscaini%' OR e.nombre LIKE '%$buscafin%') AND (p.estado='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function listexp($starIndex, $pageSize, $buscaini, $buscafin){
		$cont=
		$this->db
		->where("fecha_registro >= ", $buscaini)
		->where("fecha_registro <= ", $buscafin)
		->where("estado", '1')
		->from('pagos')->count_all_results(); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre estudiante,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.fecha_registro >= ",$buscaini);
		$this->db->where("p.fecha_registro <= ",$buscafin);
		$this->db->where("p.estado", "1");
		//$this->db->where("(p.fecha_registro >= $buscaini AND p.fecha_registro <= $buscafin ) AND (p.estado='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function listexpa($starIndex, $pageSize, $buscaini, $buscafin){
		$cont=
		$this->db
		->where("fecha_pago >= ", $buscaini)
		->where("fecha_pago <= ", $buscafin)
		->where("estado", '1')
		->from('pagos')->count_all_results(); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre estudiante,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.fecha_pago >= ",$buscaini);
		$this->db->where("p.fecha_pago <= ",$buscafin);
		$this->db->where("p.estado", "1");
		//$this->db->where("(p.fecha_registro >= $buscaini AND p.fecha_registro <= $buscafin ) AND (p.estado='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
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

//// PARA

	public function Excel()
	{	$this->db->select("p.id,pr.id as prematricula_id,e.num_documento,e.nombre estudiante,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function Excelbus($buscaini, $buscafin)
	{	$this->db->select("p.id,pr.id as prematricula_id,e.num_documento,e.nombre estudiante,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.fecha_registro >=", $buscaini);
		$this->db->where("p.fecha_registro <=", $buscafin);
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function Excelbuscan($buscaini, $buscafin)
	{	$this->db->select("p.id,pr.id as prematricula_id,e.num_documento,e.nombre estudiante,a.id as ape,c.nombre as curso,p.fecha_registro,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.fecha_pago >=", $buscaini);
		$this->db->where("p.fecha_pago <=", $buscafin);
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}



	public function getDeudas($starIndex, $pageSize, $buscar)
	{	$cont=
		$this->db
		->where("estado", '1')
		->where("deuda >", '0')
		->from('prematriculas')->count_all_results(); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,count(p.monto) as cantidad,pr.deuda,sum(p.monto) as monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->group_by("pr.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND (p.estado='1' AND pr.deuda > '0')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	}

	public function getcursoDeudas($starIndex, $pageSize, $buscar)
	{
		$cont=
		$this->db
		->where("estado", '1')
		->where("deuda >", '0')
		->from('prematriculas')->count_all_results(); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,count(p.monto) as cantidad,pr.deuda,sum(p.monto) as monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->group_by("pr.id");
		$this->db->where("(a.id='$buscar') AND (p.estado='1' AND pr.deuda > '0')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	}

	public function getcursoDeudores()
	{
		$this->db->select("a.*,a.id as ape,c.nombre as curso,count(pr.deuda) as deudas");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas pr", "pr.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->where("pr.estado='1' AND pr.deuda >'0'");
		$this->db->group_by("ape");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}


	public function Excele()
	{	$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,count(p.monto) as cantidad,pr.deuda,sum(p.monto) as monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->group_by("pr.id");
		$this->db->where("(p.estado='1' AND pr.deuda > '0')");
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function Excelbuse($buscar)
	{	$this->db->select("p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre as estudiante,e.celular,a.id as ape,c.nombre as curso,count(p.monto) as cantidad,pr.deuda,sum(p.monto) as monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->group_by("pr.id");
		$this->db->where("(a.id = '$buscar') AND (p.estado='1' AND pr.deuda > '0')");
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}



}
