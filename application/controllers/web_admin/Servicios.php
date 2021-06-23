<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicios extends MY_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	private $controlador = "web_admin/servicios/";
	private $upload_path = './uploads/web_servicios/';

	public function __construct()
	{	
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->helper(array('download'));
		$this->load->library('Layout');
		$this->layout->setLayout('web_admin');

	}

	public function index()
	{	
		$this->load->model("Web_servicios_model");
		$data  = array(
			'titulo' => 'Servicios',
			'subtitulo' => 'Listado',
			'tabla' => 'Servicio',
			'controlador' => $this->controlador,
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'data' => $this->Web_servicios_model->getServicios(),

		);
		$this->layout->view("list", $data);
	}

	public function add(){
		$data  = array(
			'titulo' => 'Servicios',
			'subtitulo' => 'Agregar',
			'tabla' => 'Servicio',
			'controlador' => $this->controlador
		);
		$this->layout->view("add", $data);
	}

	public function edit($id){
		$this->load->model("Web_servicios_model");
		$data  = array(
			'data' => $this->Web_servicios_model->getData($id),
			'titulo' => 'Servicios',
			'subtitulo' => 'Editar',
			'tabla' => 'Servicio',
			'controlador' => $this->controlador
		);
		$this->layout->view("edit", $data);
	}

	public function store(){
		
		$this->load->model("Web_servicios_model");

		$this->form_validation->set_rules("titulo","Nombre de Servicio","required");
		$this->form_validation->set_rules("text","Descripción del Servicio","required");
		$this->form_validation->set_rules("enlace","Enlace del Servicio","required");

		if ($this->form_validation->run()==TRUE) {

			$imagen = $this->upload_imagen($this->upload_path,"imagen");
			$data  = array(
				'titulo' => $this->input->post("titulo"),
				'text' => $this->input->post("text"),
				'enlace' => $this->input->post("enlace"),
				'estado' => "1"
			);

			if(!empty($imagen["img"])){ $data['imagen'] = $imagen["img"]; }

			if ($this->Web_servicios_model->save($data)) {
				if(!empty($imagen["error"])){
					$this->session->set_flashdata("error",$imagen["error"]);
				}else{
					$this->session->set_flashdata("success","Guardado con éxito");
				}
				$this->redireccionar($this->controlador,"");
			}else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				$this->redireccionar($this->controlador,"add");
			}

		} else{
			$this->add();
		}
	}	

	public function update(){
		$this->load->model("Web_servicios_model");
		$id = $this->input->post("id");

		$titulo = $this->input->post("titulo");
		$text = $this->input->post("text");
		$enlace = $this->input->post("enlace");

		$this->form_validation->set_rules("titulo","Nombre de Servicio","required");
		$this->form_validation->set_rules("text","Descripción del Servicio","required");
		$this->form_validation->set_rules("enlace","Enlace del Servicio","required");

		if ($this->form_validation->run()==TRUE) {

			$imagen = $this->upload_imagen($this->upload_path,"imagen");
			$data  = array(
				'titulo' => $this->input->post("titulo"),
				'text' => $this->input->post("text"),
				'enlace' => $this->input->post("enlace"),
				'estado' => "1"
			);

			if(!empty($imagen["img"])){ $data['imagen'] = $imagen["img"]; }

			if ($this->Web_servicios_model->update($id,$data)) {

				if(!empty($imagen["error"])){
					$this->session->set_flashdata("error",$imagen["error"]);
				}else{
					$this->session->set_flashdata("success","Guardado con éxito");
				}
				redirect(base_url($this->controlador));
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la información");
				redirect(base_url($this->controlador)."edit/".$id);
			}
		}
		else{
			$this->edit($id);
		}
	}

	public function view($id)
	{	
		$this->load->model("Web_servicios_model");
		$data  = array(
			'data_view' => $this->Web_servicios_model->getVer($id),
			'upload_servicio_path'=> base_url("uploads/web_servicios/")
		);
		$this->load->view("web_admin/servicios/view", $data);
	}

	public function delete($id){

		$this->load->model("Web_servicios_model");
		$data  = array(
			'estado' => "0",
		);
		$this->Web_servicios_model->update($id,$data);
		redirect(base_url($this->controlador));
	}

}
