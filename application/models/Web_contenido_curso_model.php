<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_contenido_curso_model extends CI_Model {

	public function getCursos(){
		$this->db->where("estado","activo");
		$resultados = $this->db->get("web_cursos");
		return $resultados->result();
	}

	public function save($data){ /** guarda los aulas */
		return $this->db->insert("web_cursos",$data);
	}
	public function savecontenido($data){ /** guarda los aulas */
		return $this->db->insert("web_cursos_contenido",$data);
	}
	public function savecontenidodet($data){ /** guarda los aulas */
		return $this->db->insert("web_cursos_contenido_det",$data);
	}
	public function savemodulo($data){ /** guarda los aulas */
		return $this->db->insert("web_cursos_modulo",$data);
	}
	public function savemodulodet($data){ /** guarda los aulas */
		return $this->db->insert("web_cursos_modulo_det",$data);
	}
	public function saveicono($data){ /** guarda los aulas */
		return $this->db->insert("web_cursos_icono",$data);
	}
	public function saveiconodet($data){ /** guarda los aulas */
		return $this->db->insert("web_cursos_icono_det",$data);
	}



	public function getData($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos");
		return $resultado->row();
	}
	public function getDataCursoContenido($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos_contenido");
		return $resultado->result();
	}
	public function getDataCursoContenidoDet($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos_contenido_det");
		return $resultado->result();
	}
	public function getDataCursoModulo($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos_modulo");
		return $resultado->result();
	}
	public function getDataCursoModuloDet($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos_modulo_det");
		return $resultado->result();
	}
	public function getDataCursoIcono($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos_icono");
		return $resultado->result();
	}
	public function getDataCursoIconoDet($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos_icono_det");
		return $resultado->result();
	}

	public function update($id,$data){ /** actualiza los datos **/
		$this->db->where("curso_id",$id);
		return $this->db->update("web_cursos",$data);
	}

	public function updateContenido($id,$data){ /** actualiza los datos **/
		$this->db->where("curso_contenido_id",$id);
		return $this->db->update("web_cursos_contenido",$data);
	}

	public function getVer($id){ /** para cargar la informacion en el boton ver **/
		$this->db->select("c.*");
		$this->db->from("web_cursos c");
		$this->db->where("c.curso_id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

    public function eliminarcontenido($id){ 
		
		$this->db->where("curso_contenido_id",$id);
		$this->db->delete("web_cursos_contenido");

		$this->db->where("curso_contenido_id",$id);
		return $va=$this->db->delete("web_cursos_contenido_det");

	}
    public function eliminarcontenidodet($id){ 
		
		$this->db->where("curso_contenido_det_id",$id);
		return $va=$this->db->delete("web_cursos_contenido_det");

	}


    public function eliminarmodulo($id){ 
		
		$this->db->where("curso_modulo_id",$id);
		$this->db->delete("web_cursos_modulo");

		$this->db->where("curso_modulo_id",$id);
		return $va=$this->db->delete("web_cursos_modulo_det");

	}
    public function eliminarmodulodet($id){ 
		
		$this->db->where("curso_modulo_det_id",$id);
		return $va=$this->db->delete("web_cursos_modulo_det");

	}

    public function eliminaricono($id){ 
		
		$this->db->where("curso_icono_id",$id);
		$this->db->delete("web_cursos_icono");

		$this->db->where("curso_icono_id",$id);
		return $va=$this->db->delete("web_cursos_icono_det");

	}

    public function eliminariconodet($id){ 
		
		$this->db->where("curso_icono_det_id",$id);
		return $va=$this->db->delete("web_cursos_icono_det");

	}


}
