<?php 
class Web_data extends CI_Model {

    public function get_services($id = 'none')
    {                       
        $this->db->select("id, titulo, text, imagen, enlace");
        $this->db->from('web_servicios');
		$this->db->where('estado', 1);
        if($id != 'none'){
	        $this->db->where('id',$id);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_cursos($id = 'none')
    {                       
		$this->db->select("nombre_curso as nombre_web, abreviatura_curso as abreviatura,imagen_curso as imagen,descripcion_curso as descripcion_web,enlace_web_informacion_curso");
		$this->db->from('web_cursos');
		$this->db->where('estado','activo');

        if($id != 'none'){
            $this->db->where('abreviatura',$id);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_organizacion($id = 1)
	{
		$this->db->select("introduccion_organizacion, organigrama, vision_organizacion, mision_organizacion, direccion, direccion_referencia, telefono_principal, telefonos, correo_principal, correos, informacion_pago");
		$this->db->from('web_organizacion');

		if($id != 'id_organizacion'){
			$this->db->where('id_organizacion',$id);
		}

		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_eventos()
	{
		$this->db->select("fecha_inicio as fecha_evento, titulo_evento, subtitulo_evento, descripcion_evento, imagen_evento");
		$this->db->from('web_eventos');
		$this->db->where('estado', 1);
		$this->db->order_by('fecha_inicio','desc')->limit(5);

		$query = $this->db->get();
		return $query->result_array();
	}

	////////////////////////////

	public function get_curso_data ($id = 'none')
	{
		$this->db->select("c.*");
		$this->db->from('web_cursos as c');
		$this->db->where('c.estado','activo');
		$this->db->where('c.enlace_web_informacion_curso','web/cursos/informacion/'.$id);

		$query = $this->db->get();
		return $query->result_array();
	}

    public function get_cursos_informacion($id = 'none')
    {                       

		$this->db->select("c.*,cc.descripcion as curso_contenido,cc.curso_contenido_id");
		$this->db->from('web_cursos as c');
        $this->db->join('web_cursos_contenido cc','cc.curso_id = c.curso_id');
		$this->db->where('c.estado','activo');
		$this->db->where('c.enlace_web_informacion_curso','web/cursos/informacion/'.$id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_cursos_informacion_det($id = 'none')
    {                       

		$this->db->select("c.*,cc.descripcion as curso_contenido,cc.*,ccd.*");
		$this->db->from('web_cursos as c');
        $this->db->join('web_cursos_contenido cc','cc.curso_id = c.curso_id');
        $this->db->join('web_cursos_contenido_det ccd','ccd.curso_contenido_id = cc.curso_contenido_id','c.curso_id=ccd.curso_id');
		$this->db->where('c.estado','activo');
		$this->db->where('c.enlace_web_informacion_curso','web/cursos/informacion/'.$id);

        

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_cursos_modulo($id = 'none')
    {                       

		$this->db->select("c.*,cm.*");
		$this->db->from('web_cursos as c');
        $this->db->join('web_cursos_modulo cm','cm.curso_id = c.curso_id');
		$this->db->where('c.enlace_web_informacion_curso','web/cursos/informacion/'.$id);

        

        $query = $this->db->get();
        return $query->result_array();
    }


     public function get_cursos_modulo_det($id = 'none')
    {                       

		$this->db->select("c.*,cmd.*");
		$this->db->from('web_cursos as c');
        $this->db->join('web_cursos_modulo_det as cmd','cmd.curso_id = c.curso_id');
		$this->db->where('c.enlace_web_informacion_curso','web/cursos/informacion/'.$id);

        

        $query = $this->db->get();
        return $query->result_array();
    }
       public function get_cursos_icono($id = 'none')
    {                       

		$this->db->select("c.*,i.*");
		$this->db->from('web_cursos as c');
        $this->db->join('web_cursos_icono i','i.curso_id = c.curso_id');
		$this->db->where('c.enlace_web_informacion_curso','web/cursos/informacion/'.$id);

        

        $query = $this->db->get();
        return $query->result_array();
    }


     public function get_cursos_icono_det($id = 'none')
    {                       

		$this->db->select("c.*,id.*");
		$this->db->from('web_cursos as c');
        $this->db->join('web_cursos_icono_det as id','id.curso_id = c.curso_id');
		$this->db->where('c.enlace_web_informacion_curso','web/cursos/informacion/'.$id);

        

        $query = $this->db->get();
        return $query->result_array();
    }

}

