<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Matriculas_model extends CI_Model {

	public function getMatriculas(){ /// grillaaa
		$this->db->select("a.*,a.id,c.nombre as curso,d.nombre as docente,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_ini,a.fecha_fin,au.nombre as aula");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->join("docentes d", "a.docente_id = d.id");
		$this->db->join("aulas au", "a.aula_id = au.id");
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
	public function grilla($starIndex, $pageSize, $buscar){
		$cont=
		$this->db
		->where("notas", '0')
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
		$this->db->where("(c.nombre LIKE '%$buscar%' OR d.nombre LIKE '%$buscar%') AND (a.estado='1' AND a.notas='0' AND p.matriculado='1')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->group_by("a.id");
		$this->db->order_by('a.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getApertura(){ /// cargar cursos en el formulario add
		$resultados = $this->db->select("a.*,a.id,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin")
			->from("aperturas a")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("a.notas", "0")
			->where("a.estado", "1")
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	public function getDocAul($id){ /// cargar datos docente aula fechas del mantenimiento add prematricula
		$resultado = $this->db->select("a.*,a.id,a.docente_id,d.nombre as docente,a.aula_id,au.nombre as aula,a.fecha_ini,a.fecha_fin")
			->from("aperturas a")
			->join("docentes d", "a.docente_id = d.id")
			->join("aulas au", "a.aula_id = au.id")
			->where("a.notas", "0")
			->where("a.estado", "1")
			->where("a.id", $id)
			->get();
		if ($resultado->num_rows() > 0) {
			echo json_encode($resultado->result()[0]);
		} else {
			echo json_encode($resultado->result());
		}
	}

	public function getDocAulmod($id){ /// cargar datos docente aula fechas del mantenimiento add prematricula
		$resultado = $this->db->select("a.*,a.id,a.docente_id,d.nombre as docente,a.aula_id,au.nombre as aula,a.fecha_ini,a.fecha_fin")
			->from("aperturas a")
			->join("docentes d", "a.docente_id = d.id")
			->join("aulas au", "a.aula_id = au.id")
			->where("a.estado", "1")
			->where("a.id", $id)
			->get();
		if ($resultado->num_rows() > 0) {
			echo json_encode($resultado->result()[0]);
		} else {
			echo json_encode($resultado->result());
		}
	}

	public function buscarAlumnos($idapertura){
		$resultado = $this->db->select("p.*,p.id as codigo,e.num_documento as dni,p.estudiante_id,e.nombre")
			->from("prematriculas p")
			->join("aperturas a", "p.apertura_id = a.id")
			->join("estudiantes e", "p.estudiante_id = e.id")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("p.apertura_id", $idapertura)
			->where("p.pagado", "1")
			->where("p.estado", "1")
			->where("p.matriculado", "0")
			->get();
		echo json_encode($resultado->result());
	}

	public function getMatricula($id){ /// cargar formulario editar
		$resultado = $this->db->select("a.*,a.id,c.nombre as curso,a.docente_id,d.nombre as docente,g.nombre as grupo,g.hora_ini,g.hora_fin,a.fecha_ini,a.fecha_fin,a.aula_id,au.nombre as aula")
			->from("aperturas a")
			->join("prematriculas p", "p.apertura_id = a.id")
			->join("estudiantes e", "p.estudiante_id = e.id")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->join("docentes d", "a.docente_id = d.id")
			->join("aulas au", "a.aula_id = au.id")
			->where("a.id", $id)
			->get();
		return $resultado->row();
	}

	public function getprematriculados($id){ /// cargar alumnos formulario editar
		/** guarda los Modulos */
		$resultados = $this->db->select("p.*,p.id,e.num_documento as dni,e.nombre,e.celular")
			->from("prematriculas p")
			->join("aperturas a", "p.apertura_id = a.id")
			->join("estudiantes e", "p.estudiante_id = e.id")
			->where("p.apertura_id", $id)
			->where("p.matriculado", "1")
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function update($id, $data){
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->update("prematriculas", $data);
	}

	public function getMatriculaDelete($id){
		$resultados = $this->db->select("p.*,p.id")
			->from("prematriculas p")
			->join("aperturas a", "p.apertura_id = a.id")
			->where("p.estado", "1")
			->where("p.matriculado", "1")
			->where("p.apertura_id", $id)
			->get();
		if ($resultados->num_rows() > 0){
			return $resultados->result();
		} else {
			return false;
		}
	}

	/** modificciones */
	public function getAperturamod(){ /// cargar cursos en el formulario add
		$resultados = $this->db->select("a.*,a.id,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin")
			->from("aperturas a")
			->join("cursos c", "a.curso_id = c.id")
			->join("grupos g", "a.grupo_id = g.id")
			->where("a.estado", "1")
			->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

}