<?php

use phpDocumentor\Reflection\Types\Null_;

defined('BASEPATH') or exit('No direct script access allowed');

class Notas_model extends CI_Model
{

	public function getNotas() // grilla de la lista 
	{
		$this->db->select("a.*,a.id,c.nombre as curso,d.nombre as docente,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_ini,a.fecha_fin,au.nombre as aula");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("docentes d", "a.docente_id = d.id");
		$this->db->join("aulas au", "a.aula_id = au.id");
		$this->db->where("a.estado", "1");
		$this->db->where("a.notas", "1");
		$this->db->where("p.matriculado", "1");
		$this->db->group_by("a.id");
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
		->where("notas", '1')
		->where("estado", '1')
		->from('aperturas')->count_all_results();
		$this->db->select("a.id,c.nombre as curso,d.nombre as docente,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_ini,a.fecha_fin,au.nombre as aula");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("docentes d", "a.docente_id = d.id");
		$this->db->join("aulas au", "a.aula_id = au.id");
		$this->db->where("(a.id LIKE '%$buscar%' OR c.nombre LIKE '%$buscar%' OR d.nombre LIKE '%$buscar%') AND (a.estado='1' AND a.notas='1' AND p.matriculado='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->group_by("a.id");
		$this->db->order_by('a.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getMatriculas() // cargar los datos del add
	{	date_default_timezone_set('America/Lima');
		$fechaactual = date('Y-m-d');
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.docente_id,d.nombre as docente,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_ini,a.fecha_fin,a.aula_id,au.nombre as aula");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("docentes d", "a.docente_id = d.id");
		$this->db->join("aulas au", "a.aula_id = au.id");
		$this->db->where("a.fecha_fin <=", $fechaactual);
		$this->db->where("a.estado", "1");
		$this->db->where("a.notas", "0");
		$this->db->where("p.matriculado", "1");
		$this->db->group_by("a.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}


	public function buscaAlumno($idapertura, $idcurso) // buscar ajax alumnos y modulos
	{
		$this->db->select("a.*,a.id,p.id as idpre ,e.num_documento as dni,p.estudiante_id,e.nombre");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->where("p.pagado", "1");
		$this->db->where("p.estado", "1");
		$this->db->where("p.matriculado", "1");
		$this->db->where("p.apertura_id", $idapertura);
		$resultado = $this->db->get();
		$buscaCurso = $this->buscaCurso($idcurso);
		$modulosleg = count($buscaCurso);
		$data = [
			'alumnos' => $resultado->result(),
			'modulos' => [
				'leng' => $modulosleg,
				'modulodata' => $buscaCurso,
			],
		];
		echo json_encode($data);
	}

	public function buscaCurso($id) // busca el curso en el add
	{
		/** guarda los Modulos */
		$this->db->select("m.*,m.id,m.nombre,m.abreviatura,m.hora");
		$this->db->from("modulos m");
		$this->db->join("cursos c", "m.curso_id = c.id");
		$this->db->where("m.estado", "1");
		$this->db->where("c.id", $id);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}


	public function getNotaEdit($idapertura)
	{
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.docente_id,d.nombre as docente,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_ini,a.fecha_fin,a.aula_id,au.nombre as aula");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("docentes d", "a.docente_id = d.id");
		$this->db->join("aulas au", "a.aula_id = au.id");
		$this->db->where("a.estado", "1");
		$this->db->where("a.notas", "1");
		$this->db->where("p.matriculado", "1");
		$this->db->where("a.id", $idapertura);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getEditnotas($idapertura) // buscar ajax alumnos y modulos
	{
		$this->db->select("a.*,a.id,p.id as idpre ,e.num_documento as dni,p.estudiante_id,e.nombre,m.abreviatura, n.id as idnota,n.nota");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("notas n", "n.prematricula_id = p.id");
		$this->db->join("modulos m", "n.modulo_id = m.id");
		$this->db->where("p.pagado", "1");
		$this->db->where("p.estado", "1");
		$this->db->where("p.matriculado", "1");
		$this->db->where("p.apertura_id", $idapertura);
		$this->db->group_by("n.prematricula_id");
		$resultado = $this->db->get(); /// tengo a los alumnos
		return $resultado->result();
	}
	public function getcontar($idapertura) // buscar ajax alumnos y modulos
	{
		$this->db->select("a.*,a.id,p.id as idpre ,e.num_documento as dni,p.estudiante_id,e.nombre,m.abreviatura, n.id as idnota,n.nota");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("notas n", "n.prematricula_id = p.id");
		$this->db->join("modulos m", "n.modulo_id = m.id");
		$this->db->where("p.pagado", "1");
		$this->db->where("p.estado", "1");
		$this->db->where("p.matriculado", "1");
		$this->db->where("p.apertura_id", $idapertura);
		$resultado = $this->db->get(); /// tengo a los alumnos
		return $resultado->result();
	}


	public function getCursospre($datouno, $datodos)
	{
		$this->db->select("p.*,p.id,e.num_documento as dni,e.nombre,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "p.curso_id = c.id");
		$this->db->join("grupos g", "p.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.matriulado", "0");
		$this->db->where("p.curso_id", $datouno);
		$this->db->where("p.grupo_id", $datodos);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function save($data)
	{
		return $this->db->insert("notas", $data);
	}

	public function update($id, $data)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->update("notas", $data);
	}
	public function nota_update($id)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		$data  = array(
			'notas' => '1',
		);
		return $this->db->update("aperturas", $data);
	}
	public function delete($id)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->delete("notas");
	}

/** modificaciones */
	public function getMatriculasmod() // cargar los datos del add
	{	date_default_timezone_set('America/Lima');
		$fechaactual = date('Y-m-d');
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.docente_id,d.nombre as docente,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_ini,a.fecha_fin,a.aula_id,au.nombre as aula");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("docentes d", "a.docente_id = d.id");
		$this->db->join("aulas au", "a.aula_id = au.id");
		$this->db->where("a.fecha_fin <=", $fechaactual);
		$this->db->where("a.estado", "1");
		//$this->db->where("p.nota", Null);
		$this->db->where("p.matriculado", "1");
		$this->db->group_by("a.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	public function buscaAlumnomod($idapertura, $idcurso) // buscar ajax alumnos y modulos
	{
		$this->db->select("a.*,a.id,p.id as idpre ,e.num_documento as dni,p.estudiante_id,e.nombre");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->where("p.pagado", "1");
		$this->db->where("p.estado", "1");
		$this->db->where("p.matriculado", "1");
		$this->db->where("p.nota", Null);
		$this->db->where("p.apertura_id", $idapertura);
		$resultado = $this->db->get();
		$buscaCurso = $this->buscaCurso($idcurso);
		$modulosleg = count($buscaCurso);
		$data = [
			'alumnos' => $resultado->result(),
			'modulos' => [
				'leng' => $modulosleg,
				'modulodata' => $buscaCurso,
			],
		];
		echo json_encode($data);
	}

}
