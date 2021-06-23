<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagos_model extends CI_Model
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
		$cont=$this->db->count_all_results('pagos'); 
		$this->db->select("p.id,pr.id as prematricula_id,e.num_documento,e.nombre as estudiante,a.id as codigo,c.nombre as curso,g.nombre as grupo,p.fecha_pago,p.monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("(e.num_documento LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%') AND p.estado='1'");
		$this->db->limit($pageSize);
		$this->db->offset($starIndex);
		$this->db->order_by('p.id', 'DESC');
		return [$this->db->get()->result_array(), $cont];
	} 

	public function getPago($id)
	{
		/** guarda los Modulos */
		$this->db->select("p.*,p.id,pr.id as prematricula_id,e.nombre,a.id as ape,c.nombre as curso,pr.monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->where("p.estado", "1");
		$this->db->where("p.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getPagocuo($prematricula_id)
	{
		/** guarda los Modulos */
		$this->db->select("p.*,p.id,p.descripcion,p.monto,p.codigo,p.fecha_pago");
		$this->db->from("pagos p");
		$this->db->where("p.estado", "1");
		$this->db->where("p.prematricula_id", $prematricula_id);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getPrematriculapago()
	{
		$this->db->select("p.*,p.id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin,p.deuda");
		$this->db->from("prematriculas p");
		$this->db->join("estudiantes e", "p.estudiante_id = e.id");
		$this->db->join("aperturas a", "p.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		//$this->db->where("p.matriculado","0");
		$this->db->where("p.deuda>", "0");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
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


	public function GuadarPago($id, $totaldeuda)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		$data  = array(
			'pagado' => "1",
			'deuda' => $totaldeuda,
		);
		return $this->db->update("prematriculas", $data);
	}


	public function getDeudaprema($prematricula_id)
	{
		/** sacra deuda de s */
		$this->db->select("deuda");
		$this->db->from("prematriculas");
		$this->db->where("id", $prematricula_id);
		$resultado = $this->db->get();
		//return $resultado->result();
		return $resultado->row();
		//	exit();
		//$resultado->row();
		//echo json_encode($resultado);
	}
	public function getMomtopago($id)
	{
		/** sacra deuda de s */
		$this->db->select("monto");
		$this->db->from("pagos");
		$this->db->where("id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}


	public function delete($id)
	{
		/** actualiza los datos **/
		$this->db->where("id", $id);
		return $this->db->delete("pagos");
	}
	public function years()
	{ /* recupera el año  */
		$this->db->select("YEAR(fecha_registro) as year ");
		$this->db->from("pagos");
		$this->db->group_by("year");
		$this->db->order_by("year", "desc");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function montos($year)
	{/* recupera el mes y el momto por mes  */
		$this->db->select("MONTH(fecha_pago) as mes, SUM(monto) as monto");
		$this->db->from("pagos");
		$this->db->where("fecha_pago >=", $year . "-01-01");
		$this->db->where("fecha_pago <=", $year . "-12-31");
		$this->db->group_by("mes");
		$this->db->order_by("mes");
		$resultados = $this->db->get();
		return $resultados->result();
	}
/////*reporte deudas */
	
	/////*reporte pagos por grupos */
	public function getPagogrupos()
	{
		$this->db->select("p.*,p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,pr.deuda,p.monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		//$this->db->where("pr.deuda >", "0");
		//$this->db->group_by("pr.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getcursoPagogrupos($d)
	{
		$this->db->select("p.*,p.id,pr.id as prematricula_id,e.num_documento as dni,e.nombre,a.id as ape,c.nombre as curso,p.monto");
		$this->db->from("pagos p");
		$this->db->join("prematriculas pr", "p.prematricula_id = pr.id");
		$this->db->join("aperturas a", "pr.apertura_id = a.id");
		$this->db->join("estudiantes e", "pr.estudiante_id = e.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("p.estado", "1");
		//$this->db->where("pr.deuda >", "0");
		$this->db->where("a.id", $d);
		//$this->db->group_by("pr.id");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getcursoPagog()
	{
		$this->db->select("a.*,a.id as ape,c.nombre as curso");
		$this->db->from("aperturas a");
		$this->db->join("prematriculas pr", "pr.apertura_id = a.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
	//	$this->db->where("pr.deuda >", "0");
		$this->db->group_by("ape");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
}
