<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cursos extends MY_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	private $controlador = "web_admin/cursos/";
	private $upload_path = './uploads/web_cursos/';

	public function __construct()
	{
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Web_contenido_curso_model");
		$this->load->helper(array('download'));

		$this->load->library('Layout');
		$this->layout->setLayout('web_admin');
	}

	public function index()	{
		$data  = array(
			'titulo' => 'Cursos',
			'subtitulo' => 'Listado',
			'tabla' => 'Curso',
			'controlador' => $this->controlador,
			'permisos' => $this->permisos, 
			'upload_path'=> base_url("uploads/web_cursos/"),
			'data' => $this->Web_contenido_curso_model->getCursos()
		);
		$this->layout->view("list", $data);
	} 

	public function edit($id){
		$data  = array(
			'data' => $this->Web_contenido_curso_model->getData($id),
			'titulo' => 'Cursos',
			'subtitulo' => 'Editar',
			'tabla' => 'curso',
			'controlador' => $this->controlador
		);
		$this->layout->view("edit", $data);
	}

	public function add(){
		$data  = array(
			'titulo' => 'Cursos',
			'subtitulo' => 'Agregar',
			'tabla' => 'Curso',
			'controlador' => $this->controlador
		);
		$this->layout->view("add", $data);
	}
	
	public function editCursoDet($id){

		$this->layout->css(
			array (base_url('assets/css/web_admin_cursos_contenido.css'))
		);		

		$data  = array(
			'titulo' => 'Contenido web del curso',
			'subtitulo' => 'Modificar',
			'dataContenido' => $this->Web_contenido_curso_model->getDataCursoContenido($id),
			'dataContenidoDet' => $this->Web_contenido_curso_model->getDataCursoContenidoDet($id),
			'dataModulo' => $this->Web_contenido_curso_model->getDataCursoModulo($id),
			'dataModuloDet' => $this->Web_contenido_curso_model->getDataCursoModuloDet($id),
			'dataIcono' => $this->Web_contenido_curso_model->getDataCursoIcono($id),
			'dataIconoDet' => $this->Web_contenido_curso_model->getDataCursoIconoDet($id),
			'id' => $id,
			'tituloContenido' => 'Contenido',
			'controlador' => $this->controlador,
		);
		$this->layout->view("editContenido", $data);
	}

	public function store(){	

		$this->form_validation->set_rules("codigo_curso","Codigo del curso","required");
		$this->form_validation->set_rules("nombre_curso","Nombre del curso","required");
		$this->form_validation->set_rules("descripcion_curso","Descripcion del curso","required");

		if ($this->form_validation->run()==TRUE) {

			$imagen = $this->upload_imagen($this->upload_path,"imagen_curso");

			$data  = array(
				'codigo_curso' => $this->input->post("codigo_curso"),
				'nombre_curso' => $this->input->post("nombre_curso"),
				'descripcion_curso' => $this->input->post("descripcion_curso"),
				'abreviatura_curso' => $this->input->post("abreviatura_curso"),
				'enlace_web_curso' => $this->input->post("enlace_web_curso"),
				'enlace_web_informacion_curso' => $this->input->post("enlace_web_informacion_curso"),
				'estado' => $this->input->post("estado")
			);

			if(!empty($imagen["img"])){ $data['imagen_curso'] = $imagen["img"]; }

			if ($this->Web_contenido_curso_model->save($data)) {
				redirect(base_url($this->controlador));
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url($this->controlador)."/add");
			}
		}
		else{
			$this->add();
		}
	}

	public function update(){
		$id = $this->input->post("curso_id");		

		$this->form_validation->set_rules("codigo_curso","Codigo del curso","required");
		$this->form_validation->set_rules("nombre_curso","Nombre del curso","required");
		$this->form_validation->set_rules("descripcion_curso","Descripcion del curso","required");

		if ($this->form_validation->run()==TRUE) {

			$imagen = $this->upload_imagen($this->upload_path,"imagen_curso");

			$data  = array(
				'codigo_curso' => $this->input->post("codigo_curso"),
				'nombre_curso' => $this->input->post("nombre_curso"),
				'descripcion_curso' => $this->input->post("descripcion_curso"),
				'abreviatura_curso' => $this->input->post("abreviatura_curso"),
				'enlace_web_curso' => $this->input->post("enlace_web_curso"),
				'enlace_web_informacion_curso' => $this->input->post("enlace_web_informacion_curso"),
				'estado' => $this->input->post("estado")
			);

			if(!empty($imagen["img"])){ $data['imagen_curso'] = $imagen["img"]; }
			
			if ($this->Web_contenido_curso_model->update($id,$data)) {
				if(!empty($imagen["error"])){
					$this->session->set_flashdata("error",$imagen["error"]);
				}else{
					$this->session->set_flashdata("success","Guardado con éxito");
				}
				$this->redireccionar($this->controlador,"");
			}
			else{
				$this->session->set_flashdata("error","No se pudo editar la informacion");
				redirect(base_url($this->controlador)."edit/".$id);
			}
		}
		else{
			$this->edit($id);
		}
	}

	public function updateCursoContenido(){
		$curso_id = $this->input->post("curso_id");
		$data  = array(
		 'descripcion' =>  $this->input->post("descripcion_contenido"),
		 'curso_id' =>  $curso_id,
		);
	         		
		if ( $this->Web_contenido_curso_model->savecontenido($data)) {
			$this->session->set_flashdata("tab_select","contenido");
			redirect(base_url($this->controlador)."editCursoDet/".$curso_id);
		} else{
			$this->session->set_flashdata("error","No se pudo actualizar la información");
		}

	}
	public function updateCursoContenidoDet(){
		$curso_id = $this->input->post("curso_id");
		$data  = array(
		 'descripcion' => $this->input->post("descripcion_contenido_det"),
		 'curso_contenido_id' => $this->input->post("contenido_id"),
		 'curso_id' =>  $curso_id,
		);

		if ( $this->Web_contenido_curso_model->savecontenidodet($data)) {
			$this->session->set_flashdata("tab_select","contenido");
			redirect(base_url($this->controlador)."editCursoDet/".$curso_id);
		} else{
			$this->session->set_flashdata("error","No se pudo actualizar la información");
		}
	}

	public function updateCursoModulo(){
		$curso_id = $this->input->post("curso_id");
		$data  = array(
         'descripcion' => $this->input->post("descripcion_modulo"),
         'curso_id' =>  $curso_id,
     	);		
	    if ( $this->Web_contenido_curso_model->savemodulo($data)) {
	    	$this->session->set_flashdata("tab_select","modulo");
			redirect(base_url($this->controlador)."editCursoDet/".$curso_id);
		} else{
			$this->session->set_flashdata("error","No se pudo actualizar la información");
		}
	}

	public function updateCursoModuloDet(){
		$curso_id = $this->input->post("curso_id");
 		$data  = array(
	        'descripcion' =>  $this->input->post("descripcion_modulo_det"),
	        'curso_modulo_id' =>  $this->input->post("modulo_id"),
	        'curso_id' =>  $curso_id,
        );    
	         		
	    if ( $this->Web_contenido_curso_model->savemodulodet($data)) {
	    	$this->session->set_flashdata("tab_select","modulo");
			redirect(base_url($this->controlador)."editCursoDet/".$curso_id);
		} else{
			$this->session->set_flashdata("error","No se pudo actualizar la información");
		}
	}

	public function updateCursoIcono(){
		$curso_id = $this->input->post("curso_id");
 		$data  = array(
	         'descripcion' => $this->input->post("descripcion_icono"),
	         'curso_id' =>  $curso_id,
	         'icono' =>  $this->input->post("icono"),
	         'color' =>  $this->input->post("color")
        );		        
	         		
	    if ( $this->Web_contenido_curso_model->saveicono($data)) {
	       	$this->session->set_flashdata("tab_select","icono");
			redirect(base_url($this->controlador)."editCursoDet/".$curso_id);
	    } else{
			$this->session->set_flashdata("error","No se pudo actualizar la información");
	    }

	}

	public function updateCursoIconoDet(){
		$curso_id = $this->input->post("curso_id");
 		$data  = array(
	         'descripcion' =>  $this->input->post("descripcion_icono_det"),
	         'curso_icono_id' =>  $this->input->post("icono_id"),
	         'curso_id' =>  $curso_id,
	         'orden' =>  $this->input->post("orden")
        );

	    if ( $this->Web_contenido_curso_model->saveiconodet($data)) {
	    	$this->session->set_flashdata("tab_select","icono");
			redirect(base_url($this->controlador)."editCursoDet/".$curso_id);
		} else{
			$this->session->set_flashdata("error","No se pudo actualizar la información");
		}

	}

	public function view($id)
	{
		$data  = array(
			'data_view' => $this->Web_contenido_curso_model->getVer($id),
			'upload_path'=> base_url("uploads/web_cursos/")
		);
		$this->load->view("web_admin/cursos/view", $data);
	}

	public function iconosDisponibles()
	{		
		$this->load->view("web_admin/cursos/iconosDisponibles");
	}

	public function delete($id){

		$data  = array(
			'estado' => "inactivo",
		);
		$this->Web_contenido_curso_model->update($id,$data);
				redirect(base_url($this->controlador));
	}
	public function eliminarcontenido($id,$idcurso){
		$this->session->set_flashdata("tab_select","contenido");
		$this->Web_contenido_curso_model->eliminarcontenido($id);
		redirect(base_url($this->controlador)."editCursoDet/".$idcurso);
	}
	public function eliminarcontenidodet($id,$idcurso){
		$this->session->set_flashdata("tab_select","contenido");
		$this->Web_contenido_curso_model->eliminarcontenidodet($id);
		redirect(base_url($this->controlador)."editCursoDet/".$idcurso);
	}

	public function eliminarmodulo($id,$idcurso){
		$this->session->set_flashdata("tab_select","modulo");
		$this->Web_contenido_curso_model->eliminarmodulo($id);
		redirect(base_url($this->controlador)."editCursoDet/".$idcurso);
	}
	public function eliminarmodulodet($id,$idcurso){
		$this->session->set_flashdata("tab_select","modulo");
		$this->Web_contenido_curso_model->eliminarmodulodet($id);
		redirect(base_url($this->controlador)."editCursoDet/".$idcurso);
	}

	public function eliminaricono($id,$idcurso){
		$this->session->set_flashdata("tab_select","icono");
		$this->Web_contenido_curso_model->eliminaricono($id);
		redirect(base_url($this->controlador)."editCursoDet/".$idcurso);
	}
	public function eliminariconodet($id,$idcurso){
		$this->session->set_flashdata("tab_select","icono");
		$this->Web_contenido_curso_model->eliminariconodet($id);
		redirect(base_url($this->controlador)."editCursoDet/".$idcurso);
	}

}
