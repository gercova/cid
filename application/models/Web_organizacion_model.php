<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_organizacion_model extends CI_Model {


	public function save($data){ /** guarda los aulas */
		return $this->db->insert("web_organizacion",$data);
	}

	public function getData($id){ /** para la opcion editar **/
		$this->db->where("id_organizacion",$id);
		$resultado = $this->db->get("web_organizacion");
		return $resultado->row();
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("id_organizacion",$id);
		return $this->db->update("web_organizacion",$data);
	}



}
