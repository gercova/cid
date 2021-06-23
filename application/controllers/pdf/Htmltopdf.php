<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HtmltoPDF extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Certificados_model");
		$this->load->model("Prematriculas_model");
        $this->load->model("Cursos_model");
        $this->load->model("Modulos_model");
		$this->load->model("Aperturas_model");
    }
    
	public function index()
	{

		$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'certificados' => $this->Certificados_model->getCertificados(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/certificados/list", $data);
		$this->load->view("layouts/footer");
	}


}