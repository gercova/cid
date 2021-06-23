<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Aperturas extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Aperturas_model");
		$this->load->model("Cursos_model");
		$this->load->model("Grupos_model");
		$this->load->model('View_model');
	}

	public function index(){
		$datouno = $this->input->post("datouno");
		$datodos = $this->input->post("datodos");

		if($this->input->post("buscar")){
			$cursospre = $this->Aperturas_model->getCursospre($datouno, $datodos);
		}else{
			$cursospre = $this->Aperturas_model->getAperturas();
		}

		$data  = [
			'permisos' 		=> $this->permisos, /* crear para permisos de modulos  */
			'Aperturas' 	=> $cursospre,
			'curgrupres' 	=> $this->Aperturas_model->getCurgrupres(),
		];

		$this->View_model->render_view('admin/aperturas/listjt', $data, 'content/c_aperturas');
	}
	
	public function lista(){
		$starIndex 							= $_GET['jtStartIndex'];
		$pageSize 							= $_GET['jtPageSize'];
		$buscar 							= (isset($_POST['search']) ? $_POST['search']: '' );
		$libro 								= $this->Aperturas_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] 			= 'OK';
		$jTableResult['Records'] 			= $libro[0];
		$jTableResult['TotalRecordCount'] 	= $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function add(){
		$data = [
			"cursos" 	=> $this->Cursos_model->getCursos(),
			"grupos" 	=> $this->Grupos_model->getGrupos(),
			"sedes" 	=> $this->Aperturas_model->getSedes()
		];
		
		$this->View_model->render_view('admin/aperturas/add', $data, $content_data = null);
	}

	public function edit($id){
		$data  = [
			"cursos" 	=> $this->Cursos_model->getCursos($id),
			"grupos" 	=> $this->Grupos_model->getGrupos($id),
			'apertura' 	=> $this->Aperturas_model->getApertura($id),
			"sedes" 	=> $this->Aperturas_model->getSedes()
		];

		$this->View_model->render_view('admin/aperturas/edit', $data, $content_data = null);
	}

	public function store(){
		$idapertura 				= $this->input->post("idapertura");
		$data['usuario_id'] 		= $this->session->userdata("id");
		$data['curso_id'] 			= $this->input->post("idcurso");
		$data['grupo_id'] 			= $this->input->post("idgrupo");
		date_default_timezone_set('America/Lima');
		$data['fecha_registro'] 	= date('Y-m-d');
		$data['fecha_ini'] 			= $this->input->post("fecha_ini");
		$data['estado_inscripcion'] = $this->input->post("estado_inscripcion");
		$data['sede_id'] 			= $this->input->post("sede_id");

		if(empty($idapertura)){
			if($this->Aperturas_model->save($data)){
				redirect(base_url('movimientos/aperturas'));
			}else{
				$this->session->set_flashdata('error', 'No se pudo guardar la informacion');
				redirect(base_url('movimientos/aperturas/add'));
			}
		}elseif(isset($idapertura)){
			if($this->Aperturas_model->update($idapertura, $data)){
				redirect(base_url('movimientos/aperturas'));
			}else{
				$this->session->set_flashdata("error", "No se pudo Actualizar la informacion");
				redirect(base_url('movimientos/aperturas/edit/'.$idapertura));
			}
		}
	}

	public function view($id){
		$data['apertura'] = $this->Aperturas_model->getPrever($id);
		$this->load->view('admin/aperturas/view', $data);
	}

	public function delete($id){
		$data['estado'] = "0";
		$this->Aperturas_model->update($id, $data);
		echo json_encode(['sucess' => true]);
	}
}