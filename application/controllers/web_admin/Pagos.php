<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends MY_Controller {

	private $permisos; /* crear para permisos de modulos  */
	private $controlador = "web_admin/pagos/";
	private $upload_path = "./uploads/web_pagos/";

	public function __construct()
	{
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->library('Layout');
		$this->layout->setLayout('web_admin');
	}

	public function index()
	{	
		$this->load->model("Web_pagos_model");
		$data  = array(
			'titulo' => 'Pagos x web',
			'subtitulo' => 'Listado',
			'tabla' => 'Pagos registrados',
			'controlador' => $this->controlador,
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'data' => $this->Web_pagos_model->getPagosWeb()

		);
		$this->layout->view("list", $data);
	}

	public function view($id)
	{	
		$this->load->model("Web_pagos_model");
		$data  = array(
			'data_view' => $this->Web_pagos_model->getVer($id),
			'upload_path'=> base_url("uploads/web_pagos/")
			
		);

		//print_r($data);
		$this->load->view("web_admin/pagos/view", $data);
	}
}
