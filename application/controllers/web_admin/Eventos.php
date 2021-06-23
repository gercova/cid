<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eventos extends MY_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	private $controlador = "web_admin/eventos/";
	private $upload_path = "./uploads/web_eventos/";

	public function __construct()
	{
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Web_eventos_model");
		$this->load->helper(array('download'));
		$this->load->library('Layout');
		$this->layout->setLayout('web_admin');
	}

	public function index()
	{	
		$data  = array(
			'titulo' => 'Eventos',
			'subtitulo' => 'Listado',
			'tabla' => 'Evento',
			'controlador' => $this->controlador,
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'data' => $this->Web_eventos_model->getEventos(),

		);
		$this->layout->view("list", $data);
	}

	public function add(){
		$data  = array(
			'titulo' => 'Eventos',
			'subtitulo' => 'Agregar',
			'tabla' => 'Evento',
			'controlador' => $this->controlador
		);
		$this->layout->view("add", $data);
	}

	public function edit($id){

		$data  = array(
			'data' => $this->Web_eventos_model->getData($id),
			'titulo' => 'Eventos',
			'subtitulo' => 'Editar',
			'tabla' => 'Evento',
			'controlador' => $this->controlador
		);
		$this->layout->view("edit", $data);
	}

	public function store(){

		$this->form_validation->set_rules("fecha_inicio","Fecha del evento","required");
		$this->form_validation->set_rules("titulo_evento","Titulo del evento","required");
		$this->form_validation->set_rules("descripcion_evento","Descripción del evento","required");

		if ($this->form_validation->run()==TRUE) {

			$imagen = $this->upload_imagen($this->upload_path,"imagen_evento");

			$data  = array(
				'fecha_inicio' => $this->input->post("fecha_inicio"),
				'fecha_fin' => $this->input->post("fecha_fin"),
				'titulo_evento' => $this->input->post("titulo_evento"),
				'subtitulo_evento' => $this->input->post("subtitulo_evento"),
				'descripcion_evento' => $this->input->post("descripcion_evento"),
				'estado' => "1"
			);

			if(!empty($imagen["img"])){ $data['imagen_evento'] = $imagen["img"]; }

			if ($this->Web_eventos_model->save($data)) {
				if(!empty($imagen["error"])){
					$this->session->set_flashdata("error",$imagen["error"]);
				}else{
					$this->session->set_flashdata("success","Guardado con éxito");
				}
				$this->redireccionar($this->controlador,"");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				$this->redireccionar($this->controlador,"add");
			}
		}
		else{
			$this->add();
		}
	}

	public function update(){
		$id = $this->input->post("evento_id");

		$this->form_validation->set_rules("fecha_inicio","Fecha del evento","required");
		$this->form_validation->set_rules("titulo_evento","Titulo del evento","required");
		$this->form_validation->set_rules("descripcion_evento","Descripción del evento","required");

		if ($this->form_validation->run()==TRUE) {

			$imagen = $this->upload_imagen($this->upload_path,"imagen_evento");

			$data  = array(
				'fecha_inicio' => $this->input->post("fecha_inicio"),
				'fecha_fin' => $this->input->post("fecha_fin"),
				'titulo_evento' => $this->input->post("titulo_evento"),
				'subtitulo_evento' => $this->input->post("subtitulo_evento"),
				'descripcion_evento' => $this->input->post("descripcion_evento"),
				'estado' => "1"
			);

			if(!empty($imagen["img"])){ $data['imagen_evento'] = $imagen["img"]; }

			if ($this->Web_eventos_model->update($id,$data)) {
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

	public function view($id)
	{
		$data  = array(
			'data_view' => $this->Web_eventos_model->getVer($id),
			'upload_path'=> base_url("uploads/web_eventos/")
		);
		$this->load->view("web_admin/eventos/view", $data);
	}

	public function delete($id){

		$data  = array(
			'estado' => "0",
		);
		$this->Web_eventos_model->update($id,$data);
		redirect(base_url($this->controlador));
	}

}
