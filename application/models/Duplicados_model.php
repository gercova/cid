<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Duplicados_model extends CI_Model
{
	public function listo($starIndex, $pageSize, $buscar){
		$cont=
		$this->db
		->where("duplicado", '1')
		->where("estad", '1')
		->from('certificado')->count_all_results();
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha_dupli,c.entrega_dupli");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND (c.estad='1' And c.duplicado='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('c.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function listexp($starIndex, $pageSize, $buscar){
		$cont=$this->db
		->where("estad", '1')
		->where("duplicado", '1')
		->where("fecha_dupli", $buscar)
		->from('certificado')->count_all_results(); 
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha_dupli,c.entrega_dupli");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(c.fecha_dupli LIKE '%$buscar%') AND (c.estad='1' And c.duplicado='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('c.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getCertificados() // cargar los datos del add
	{	date_default_timezone_set('America/Lima');
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha_dupli ");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("c.entrega='1' And c.estad='1'");
		//$this->db->group_by("a.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getEdit($id)
	{
		$this->db->select("c.id,e.nombre as alumno, cu.nombre as curso, c.folio, c.correlativo, c.fecha_dupli, c.img");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->where("c.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	/// actualizar 
	public function update($id, $data)
	{	/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->update("certificado", $data);
	}

	// elimina
	public function ActuaCert($id)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		$data  = array(
			'certificado' => NULL,
		);
		return $this->db->update("prematriculas", $data);
	}

	public function getEstudiante($id)
	{
		$this->db->select("c.*,c.id,e.num_documento,e.nombre as alumno,tc.descripcion as tipocurso, cu.nombre as curso, c.folio, c.correlativo,c.fecha_ini,c.fecha_fin, c.fecha_dupli");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id= tc.id");
		$this->db->where("c.id", $id);

		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getHoras($pre) // notas
	{
		$this->db->select("c.*,sum(m.hora) as horas");
		$this->db->from("cursos as c");
		$this->db->join("modulos as m", "m.curso_id = c.id");
		$this->db->join("aperturas as a", "a.curso_id = c.id");
		$this->db->join("prematriculas as p", "p.apertura_id = a.id");
		$this->db->where("p.id",$pre);
		$this->db->group_by("p.id");
		$resultado = $this->db->get();
		return $resultado->row();
	}

		public function getDetalle($pre) // notas
	{
		$this->db->select("n.*,n.prematricula_id as pre,m.nombre as modulo, n.nota, m.hora");
		$this->db->from("notas as n");
		$this->db->join("modulos as m", "n.modulo_id = m.id");
		$this->db->where("n.prematricula_id",$pre);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
    
    	public function Excel()
	{
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha_ini,c.fecha_fin,c.fecha_dupli,c.entrega_dupli");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(c.estad='1' And c.duplicado='1'))");
		$this->db->order_by('c.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function Excelbus($buscar)
	{
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha_ini,c.fecha_fin,c.fecha_dupli,c.entrega_dupli");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(c.fecha_dupli LIKE '%$buscar%') AND (c.estad='1')");
		$this->db->order_by('c.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

}
