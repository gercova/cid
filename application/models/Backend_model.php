<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Backend_model extends CI_Model {
	
	public function getID($link){
		$this->db->like("link",$link);
		$resultado = $this->db->get("menus");
		return $resultado->row();

	}

	public function getPermisos($menu,$rol){
		$this->db->Where("menu_id",$menu);
		$this->db->where ("rol_id",$rol);
		$resultado = $this->db->get("permisos");
		return $resultado->row();
	}
	
	public function showMenu($rol){
		$resultados = $this->db->select("m.link as link")
			->from("permisos p")
			->join("menus m", "p.menu_id = m.id")
			->where ("p.read",1)
			->where ("p.rol_id",$rol)
			->get();
		$enlaces = array_column($resultados->result_array(), 'link');
		return $enlaces;
	}

	/** para contar cuantos registros tenemos en las tablas y ademas contar las ventas con la condicion **/
	public function rowCount($tabla){
		$this->db->where("estado","1");
		$resultados = $this->db->get($tabla);
		return $resultados->num_rows();
	}
	
	public function rowSuma($tabla){
		$this->db->select_sum("monto");
		$this->db->where("estado","1");
		$resultados = $this->db->get($tabla);
		return $resultados->result()[0]->monto;
	}
}