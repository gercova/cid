<?php
defined('BASEPATH') or exit('No direct script access allowed');

class docentes extends CI_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	public function __construct()
	{	parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("docentes_model");	
	}

	public function index()
	{	$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/docentes/listjt", $data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_docentes");	
	}

	public function lista()
	{	$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		$libro = $this->docentes_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function create(){
		$id=$this->Estuiantes_model->create($_POST);
		if($id==0){
			$jTableResult['Result'] = 'ERROR';
			$jTableResult['Message']= 'No se Inserto';
		}else
		{
			$libro=$this->Estuidantes_model->one($id);
			$jTableResult['Result'] = 'ERROR';
			$jTableResult['Record']= $libro;
		}
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function edit()
	{
		$id = $this->input->post("id");
		$this->docentes_model->getedit($id);
	}

	public function store(){
		$idusuario = $this->session->userdata("id");
		$id = $this->input->post("id");
		$dni = $this->input->post("dni");
		$nombre = $this->input->post("nombre");
		$celular = $this->input->post("celular");
		$adicional = $this->input->post("adicional");
		$email = $this->input->post("email");
		$this->form_validation->set_rules("id", "Numero de Documento", "required|is_unique[docentes.id]");

		$data  = array(
			'dni' => $dni,
			'nombre' => $nombre,
			'celular' => $celular,
			'email' => $email,
			'adicional' => $adicional,
			'usu_reg' => $idusuario,
			'fec_reg' => date('Y-m-d'),
			'estado' => "1",

		);

			if ($id<=0) {
				$this->docentes_model->save($data);
				echo json_encode(['sucess' => true]);
			//	redirect(base_url()."administrador/pacientes");
			}
			else{
				$this->docentes_model->update($id,$data);
				echo json_encode(['sucess' => true]);
			}
		}
	public function delete($id)
	{
		$data  = array(
			'estado' => "0",
		);
		$this->docentes_model->update($id, $data);
		echo json_encode(['sucess' => true]);
	}
}
