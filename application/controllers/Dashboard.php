<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Pagos_model");
		$this->load->model("Backend_model");
	}
	public function index()
	{	// para contar cuatos registros tenemos en las tablas

		$data = array(
		/*	"cantEstudiantes" => $this->Backend_model->rowCount("estudiantes"),
			"cantAperturas" => $this->Backend_model->rowCount("aperturas"),
			"cantCursos" => $this->Backend_model->rowCount("cursos"),
			"sumaPagos" => $this->Backend_model->rowSuma("pagos"),
			"years" => $this->Pagos_model->years(),
*/
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/dashboard", $data);
		$this->load->view("layouts/footer");
	}

/*	public function getData()
	{
		$year = $this->input->post("year");
		$resultados = $this->Pagos_model->montos($year);
		echo json_encode($resultados);
	}*/
}
