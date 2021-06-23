<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_eventos_model extends CI_Model {

	public function getEventos(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("web_eventos");
		return $resultados->result();
	}

	public function getVer($id){ /** para cargar la informacion en el boton ver **/

		$this->db->select("t.*");
		$this->db->from("web_eventos t");
		$this->db->where("t.evento_id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function save($data){ /** guarda los aulas */
		return $this->db->insert("web_eventos",$data);
	}

	public function getData($id){ /** para la opcion editar **/
		$this->db->where("evento_id",$id);
		$resultado = $this->db->get("web_eventos");
		return $resultado->row();
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("evento_id",$id);
		return $this->db->update("web_eventos",$data);
	}



}
