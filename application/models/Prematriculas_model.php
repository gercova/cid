<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prematriculas_model extends CI_Model {

	public function listo($starIndex, $pageSize, $buscar){
		$cont= $this->db->where("matriculado", '0')->where("estado", '1')->from('prematriculas')->count_all_results(); 
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,a.id as codigo,c.nombre as curso,g.nombre as grupo,concat_ws(' ',g.hora_ini, g.hora_fin) as horario,p.monto, p. deuda");
		//$this->db->select("*");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND (p.estado='1' AND p.matriculado= '0')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 


	public function listexp($starIndex, $pageSize, $buscar){
		$cont = $this->db->where("matriculado", '0')->where("estado", '1')->where("apertura_id", $buscar)->from('prematriculas')->count_all_results(); 
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,a.id as codigo,c.nombre as curso,g.nombre as grupo,concat_ws(' ',g.hora_ini, g.hora_fin) as horario,p.monto, p. deuda");
		//$this->db->select("*");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(a.id = '$buscar') AND (p.estado='1' AND p.matriculado= '0')");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getCuraperturado($idapertura){
		$this->db->select("p.*,p.id,e.num_documento as dni,e.nombre,e.celular,a.id as aper,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.matriculado", "0");
		$this->db->where("p.apertura_id", $idapertura);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	
	public function buscarestu($dni){
		/** guarda los Modulos */
		$this->db->select("*");
		$this->db->from("estudiantes");
		$this->db->where("num_documento", $dni);
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			echo json_encode($resultado->result()[0]);
		} else {
			echo json_encode($resultado->result());
		}
	}

	public function getAperturas(){
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,tc.descripcion,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,c.costo");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("tipo_curso tc", "c.tipocurso_id = tc.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.estado", "1");
		$this->db->where("a.notas", "0");
		$this->db->order_by("a.id","DESC");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	
	public function getAperturasm(){
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,tc.descripcion,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,c.costo");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("tipo_curso tc", "c.tipocurso_id = tc.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.estado", "1");
		$this->db->order_by("a.id","DESC");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
	
	public function getAperturados(){
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,c.costo, count(pr.id) as alumnos");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas pr", "pr.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.estado", "1");
		$this->db->where("pr.estado", "1");
		$this->db->where("a.notas", "0");
	    $this->db->group_by("a.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getPrematricula($id){
		/** guarda los Modulos */
		$this->db->select("p.*,p.id,p.estudiante_id,e.nombre,p.nivel_id,n.nombre as nivel,n.descuento as porcentaje,a.id as aper,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin,p.costo,p.descuento,p.descripcion,p.monto");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("niveles n", "p.nivel_id = n.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getPrematri($idestudiante, $idcurso, $estado){
		/** para la opcion editar **/
		$this->db->select("a.*,p.id,p.estudiante_id,e.nombre as estudiante,a.curso_id,c.nombre as curso,p.estado,a.notas");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("prematriculas p", "p.apertura_id = a.id");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->where("p.estudiante_id", $idestudiante);
		$this->db->where("a.curso_id", $idcurso);
		$this->db->where("p.estado", $estado);
		$resultado = $this->db->get("aperturas");
		return $resultado->row();
	}

	public function getPrever($id){
		/** guarda los Modulos */
		$this->db->select("p.*,p.id,p.estudiante_id,e.nombre,p.nivel_id,n.nombre as nivel,n.descuento as porcentaje,a.id as aper,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin,p.costo,p.descuento,p.descripcion,p.monto");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("niveles n", "p.nivel_id = n.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function save($data){
		return $this->db->insert("prematriculas", $data);
	}

	public function update($id, $data){
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->update("prematriculas", $data);
	}

	public function updatenota($id,$nota){
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->update("prematriculas", $nota);
	}

	public function getAperturass(){
		$this->db->select("a.*,a.id,a.curso_id,c.nombre as curso,tc.descripcion,a.grupo_id,g.nombre as grupo,g.hora_ini,g.hora_fin,c.costo");
		$this->db->from("aperturas a");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("tipo_curso tc", "c.tipocurso_id = tc.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.estado", "1");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	// deudas
	public function Excel(){
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,e.email,a.id as codigo,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin,p.monto, p. deuda");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(p.estado='1' AND p.matriculado= '0')");
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function Excelbus($buscar){
		$this->db->select("p.id,e.num_documento,e.nombre as estudiante,e.celular,e.email,a.id as codigo,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin,p.monto, p. deuda");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(a.id = '$buscar') AND (p.estado='1' AND p.matriculado= '0')");
		$this->db->order_by('p.id', 'DESC');
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
}