<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Certificados_model extends CI_Model
{
	public function getCertificados() // grilla de la lista 
	{
		$this->db->select("c.id,p.id as pre,e.num_documento as dni,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("c.estad", "1");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	public function listo($starIndex, $pageSize, $buscar){
		$cont=
		$this->db->count_all_results('certificado');
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha,c.entrega");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND (c.estad='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('c.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function listexp($starIndex, $pageSize, $buscar){
		$cont=$this->db
		->where("estad", '1')
		->where("fecha", $buscar)
		->from('certificado')->count_all_results(); 
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha,c.entrega");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(c.fecha LIKE '%$buscar%') AND (c.estad='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('c.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getAlumnos(){ // cargar los datos del add
		date_default_timezone_set('America/Lima');
		$fechaactual = date('Y-m-d');
		$this->db->select("p.*,p.id, e.num_documento as dni, e.nombre as alumno,c.id as cod,c.nombre as curso,a.fecha_ini,a.fecha_fin");
		$this->db->from("prematriculas p");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->where("p.deuda <=", "0");
		$this->db->where("a.notas", "1");
		$this->db->where("p.estado", "1");
		$this->db->where("p.certificado", Null);
		$this->db->where("p.matriculado", "1");
		//$this->db->group_by("a.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getTipocertificados(){
		$resultados = $this->db->get("tipo_certificado");
		return $resultados->result();
	}

	public function getEdit($id){
		$this->db->select("c.*,c.id,e.nombre as alumno, cu.nombre as curso,c.fecha_ini,c.fecha_fin ,c.folio, c.correlativo, c.fecha, c.img, c.modalidad");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->where("c.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function save($data)
	{
		return $this->db->insert("certificado", $data);

	}

	public function GuardarCert($id)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		$data  = array(
			'certificado' => '1',
		);
		return $this->db->update("prematriculas", $data);
	}

	/// actualizar 
	public function update($id, $data)
	{
		/** actualiza los datos **/
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
		$this->db->select("c.*,c.id,e.num_documento,e.nombre as alumno,tc.descripcion as tipocurso, cu.nombre as curso, c.folio, c.correlativo,c.fecha_ini,c.fecha_fin, c.fecha");
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
		$this->db->select("sum(m.hora) as horas");
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
		$this->db->select("n.prematricula_id as pre,m.nombre as modulo, n.nota, m.hora");
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
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha_ini,c.fecha_fin,c.fecha,c.entrega");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(c.estad='1')");
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
		$this->db->select("c.id,p.id as pre,e.num_documento,e.nombre as estudiante,tc.descripcion,a.id as codc, cu.nombre as curso, c.folio, c.correlativo,c.fecha_ini,c.fecha_fin,c.fecha,c.entrega");
		$this->db->from("certificado as c");
		$this->db->join("prematriculas as p", "c.prematricula_id = p.id");
		$this->db->join("estudiantes as e", "p.estudiante_id = e.id");
		$this->db->join("aperturas as a", "p.apertura_id = a.id");
		$this->db->join("cursos as cu", "a.curso_id = cu.id");
		$this->db->join("tipo_curso as tc", "cu.tipocurso_id = tc.id");
		$this->db->where("(c.fecha LIKE '%$buscar%') AND (c.estad='1')");
		$this->db->order_by('c.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

}
