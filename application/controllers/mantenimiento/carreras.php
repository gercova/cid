<?php
defined('BASEPATH') or exit('No direct script access allowed');

class carreras extends CI_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	public function __construct()
	{	parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("carreras_model");	
	}

	public function index()
	{	$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/carreras/listjt", $data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_carreras");	
	}

	public function lista()
	{	$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		$libro = $this->carreras_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function edit()
	{
		$id = $this->input->post("id");
		$this->carreras_model->getedit($id);
	}

	public function store(){
		$id = $this->input->post("id");
		$descripcion = $this->input->post("descripcion");

		$data  = array(
			'descripcion' => $descripcion,
			'estado' => "1",

		);

			if ($id<=0) {
				$this->carreras_model->save($data);
				echo json_encode(['sucess' => true]);
			//	redirect(base_url()."administrador/pacientes");
			}
			else{
				$this->carreras_model->update($id,$data);
				echo json_encode(['sucess' => true]);
			}
		}
	public function delete($id)
	{
		$data  = array(
			'estado' => "0",
		);
		$this->carreras_model->update($id, $data);
		echo json_encode(['sucess' => true]);
	}
}
