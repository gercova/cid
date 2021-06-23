<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos_Web_model extends CI_Model {

     public function ExecuteArrayResults($sql) 
    	{
    		$query = $this->db->query($sql);
    		$rows = $query->result_array();
    		$query->free_result();

    		return ($rows);

    	}

	public function getCursosWeb(){
		//$this->db->where("estado","1");
		$resultados = $this->db->get("web_cursos");
		return $resultados->result();
	}


	public function save($data){ /** guarda los Cursos contendio */
		return $this->db->insert("web_cursos_contenido",$data);
	}

	public function saveicono($data){ /** guarda los Cursos contendio */
		return $this->db->insert("web_cursos_icono",$data);
	}
	public function savecurso($data){ /** guarda los Cursos contendio */
		return $this->db->insert("web_cursos",$data);
	}
	public function savemodulo($data){ /** guarda los Cursos contendio */
		return $this->db->insert("web_cursos_modulo",$data);
	}
	public function savedetallecontenido($data){ /** guarda los Cursos cursos dcontenido detallado */
		return $this->db->insert("web_cursos_contenido_det",$data);
	}
	public function savedetallemodulo($data){ /** guarda los Cursos cursos dcontenido detallado */
		return $this->db->insert("web_cursos_modulo_det",$data);
	}
	public function savedetalleicono($data){ /** guarda los Cursos cursos dcontenido detallado */
		return $this->db->insert("web_cursos_icono_det",$data);
	}


	public function datoultimocontenido($id){ /** obtenemod id ultimo del contenido agregado **/
		

          $query = "select * from web_cursos_contenido where curso_id=".$id." order by curso_contenido_id desc limit 1";
            return ($this->ExecuteArrayResults($query));

	}
	public function datoultimomodulo($id){ /** obtenemod id ultimo del contenido agregado **/
		

          $query = "select * from web_cursos_modulo where curso_id=".$id." order by curso_modulo_id desc limit 1";
            return ($this->ExecuteArrayResults($query));

	}
	public function datoultimoicono($id){ /** obtenemod id ultimo del contenido agregado **/
		

          $query = "select * from web_cursos_icono where curso_id=".$id." order by curso_icono_id desc limit 1";
            return ($this->ExecuteArrayResults($query));

	}

	public function getCursoWeb1($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos");
		return $resultado->row();

	}
	public function getCursoWeb($id){ /** para la opcion editar **/
		$this->db->where("curso_id",$id);
		$resultado = $this->db->get("web_cursos");
		return $resultado->row();

	}
	public function getCursoContenido($id){ /** para la opcion editar **/
		$this->db->where("curso_contenido_id",$id);
		$resultado = $this->db->get("web_cursos_contenido");
		return $resultado->row();

	}
	public function getCursoMo($id){ /** para la opcion editar **/
		$this->db->where("curso_modulo_id",$id);
		$resultado = $this->db->get("web_cursos_modulo");
		return $resultado->row();

	}
	public function getCursoI($id){ /** para la opcion editar **/
		$this->db->where("curso_icono_id",$id);
		$resultado = $this->db->get("web_cursos_icono");
		return $resultado->row();

	}
	public function getCursoContenidoDet($id){ /** para la opcion editar **/

		$this->db->select("wcc.*,wccd.*,wccd.descripcion as descripcion_det_cont");
		$this->db->from("web_cursos_contenido wcc");
		$this->db->join("web_cursos_contenido_det wccd", "wccd.curso_contenido_id = wcc.curso_contenido_id");
		$this->db->where("wcc.curso_contenido_id",$id);
		$resultados = $this->db->get();
		
		return $resultados->result();

	}
	public function getCursoIconoDet($id){ /** para la opcion editar **/

		$this->db->select("wci.*,wcid.*,wcid.descripcion as descripcion_det_i");
		$this->db->from("web_cursos_icono wci");
		$this->db->join("web_cursos_icono_det wcid", "wcid.curso_icono_id = wci.curso_icono_id");
		$this->db->where("wci.curso_icono_id",$id);
		$resultados = $this->db->get();
		
		return $resultados->result();

	}

	public function getCursoWebDetContenido($id){ /** para la opcion editar **/
		

		$this->db->where("curso_id",$id);
		$resultados = $this->db->get("web_cursos_contenido");
		return $resultados->result();
	}

	public function getCursoModulo($id){ /** para la opcion editar **/
		

		$this->db->where("curso_id",$id);
		$resultados = $this->db->get("web_cursos_modulo");
		return $resultados->result();
	}
	public function getCursoIcono($id){ /** para la opcion editar **/
		

		$this->db->where("curso_id",$id);
		$resultados = $this->db->get("web_cursos_icono");
		return $resultados->result();
	}

	public function getCursoWebDetContenidoDet($id){ /** para la opcion editar **/
		

		$this->db->where("curso_id",$id);
		$resultados = $this->db->get("web_cursos_contenido_det");
		return $resultados->result();
	}

	public function updatecurso($id,$data){ /** actualiza los datos **/
		$this->db->where("curso_id",$id);
		return $this->db->update("web_cursos",$data);
	}
	public function guardarcursomodulo($id,$data){ /** actualiza los datos **/
		$this->db->where("curso_modulo_id",$id);
		return $this->db->update("web_cursos_modulo",$data);
	}
	public function guardarcursoicono($id,$data){ /** actualiza los datos **/
		$this->db->where("curso_icono_id",$id);
		return $this->db->update("web_cursos_icono",$data);
	}


	public function eliminarcontenidodet($id){ /** actualiza los datos **/
		
          //return $this->db->delete('web_cursos_contenido_det', array('curso_contenido_id' => $id));
$id=$id;
		$this->db->where("curso_contenido_id",$id);
		return $va=$this->db->delete("web_cursos_contenido_det");

	}

	public function eliminarmodulodet($id){ /** actualiza los datos **/
		
         $id=$id;
		$this->db->where("curso_modulo_id",$id);
		return $va=$this->db->delete("web_cursos_modulo_det");

	}
	public function eliminariconodet($id){ /** actualiza los datos **/
		
         $id=$id;
		$this->db->where("curso_icono_id",$id);
		return $va=$this->db->delete("web_cursos_icono_det");

	}


}
