<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_solicitudes_model extends CI_Model {

	public function getSolicitudes(){
		
		$this->db->select("sol.solicitud_apertura_id, sol.fecha_server, cur.nombre as curso_nombre, sol.nombre as solicitud_persona, sol.correo as solicitud_correo");
		$this->db->from('web_solicitud_apertura as sol');
		$this->db->join('cursos as cur', 'sol.curso_id = cur.id');
		$this->db->order_by("fecha_server","desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function getVer($id){ /** para cargar la informacion en el boton ver **/

		$this->db->select("sol.solicitud_apertura_id as id, sol.fecha_server, cur.nombre as curso_nombre, sol.nombre as solicitud_persona, sol.correo as solicitud_correo, sol.celular as solicitud_celular, sol.lunes,sol.martes, sol.miercoles, sol.jueves, sol.viernes, sol.sabado, sol.domingo, sol.hora_tentativa, sol.mensaje");
		$this->db->from('web_solicitud_apertura as sol');
		$this->db->join('cursos as cur', 'sol.curso_id = cur.id');

		$this->db->where("sol.solicitud_apertura_id",$id);
		$query = $this->db->get();
		return $query->row();
	}

}
