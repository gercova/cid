<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organizacion extends MY_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	private $controlador = "web_admin/organizacion/";

	public function __construct()
	{
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Web_organizacion_model");

		$this->load->library('Layout');
		$this->layout->setLayout('web_admin');
	}

	public function index()//edit
	{
		$id = 1;

		$data  = array(
			'data' => $this->Web_organizacion_model->getData($id),
			'titulo' => 'Organizacion',
			'subtitulo' => 'Datos institucionales',
			'tabla' => 'Organizacion',
			'controlador' => $this->controlador,
			'permisos' => $this->permisos,
		);
		$this->layout->view("edit", $data);
	}

	public function update(){

		$id = 1;//$this->input->post("id_organizacion");

		$this->form_validation->set_rules("introduccion_organizacion","Introducción","required");
		$this->form_validation->set_rules("vision_organizacion","Visión","required");
		$this->form_validation->set_rules("mision_organizacion","Misión","required");

		$this->form_validation->set_rules("telefono_principal","Teléfono principal","required");
		$this->form_validation->set_rules("correo_principal","Correo principal","required");
		$this->form_validation->set_rules("informacion_pago","Información de pago","required");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'introduccion_organizacion' => $this->input->post("introduccion_organizacion"),
				'vision_organizacion' => $this->input->post("vision_organizacion"),
				'mision_organizacion' => $this->input->post("mision_organizacion"),
				'direccion' => $this->input->post("direccion"),
				'direccion_referencia' => $this->input->post("direccion_referencia"),
				'telefono_principal' => $this->input->post("telefono_principal"),
				'telefonos' => $this->input->post("telefonos"),
				'correo_principal' => $this->input->post("correo_principal"),
				'correos' => $this->input->post("correos"),
				'informacion_pago' => $this->input->post("informacion_pago")
			);

			if ($this->Web_organizacion_model->update($id,$data)) {
				$this->session->set_flashdata("success","Guardado con éxito");
				$this->redireccionar($this->controlador,"");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la información");
				$this->redireccionar($this->controlador,"");
			}
		}
		else{
			$this->index();
		}

	}

}
