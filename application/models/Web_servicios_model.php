<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_servicios_model extends CI_Model {

	public function getServicios(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("web_servicios");
		return $resultados->result();
	}

	public function getVer($id){ /** para cargar la informacion en el boton ver **/

		$this->db->select("t.*");
		$this->db->from("web_servicios t");
		$this->db->where("t.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function save($data){ /** guarda los datos */
		return $this->db->insert("web_servicios",$data);
	}

	public function getData($id){ /** para la opcion editar **/
		$this->db->where("id",$id);
		$resultado = $this->db->get("web_servicios");
		return $resultado->row();
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id",$id);
		return $this->db->update("web_servicios",$data);
	}



}
