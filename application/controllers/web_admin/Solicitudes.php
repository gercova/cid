<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes extends MY_Controller {

	private $permisos; /* crear para permisos de modulos  */
	private $controlador = "web_admin/solicitudes/";

	public function __construct()
	{
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->library('Layout');
		$this->layout->setLayout('web_admin');
	}

	public function index()
	{	
		$this->load->model("Web_solicitudes_model");
		$data  = array(
			'titulo' => 'Solicitudes',
			'subtitulo' => 'Listado',
			'tabla' => 'Solicitud',
			'controlador' => $this->controlador,
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'data' => $this->Web_solicitudes_model->getSolicitudes()

		);
		$this->layout->view("list", $data);
	}

	public function view($id)
	{	
		$this->load->model("Web_solicitudes_model");
		$data  = array(
			'data_view' => $this->Web_solicitudes_model->getVer($id)
		);

		$this->load->view("web_admin/solicitudes/view", $data);
	}
}
