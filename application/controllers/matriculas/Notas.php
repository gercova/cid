<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Notas extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Notas_model");
		$this->load->model("Docentes_model");
		$this->load->model("Aulas_model");
		$this->load->model("Cursos_model");
		$this->load->model("Grupos_model");
		$this->load->model("Aperturas_model");
		$this->load->model("Prematriculas_model");
		$this->load->model('View_model');
		
	}

	public function index(){
		$data  = [
			'permisos' 	=> $this->permisos,
			'notas' 	=> $this->Notas_model->getNotas(),
		];

		$this->View_model->render_view('admin/notas/listjt', $data, 'content/c_notas');
	}

	public function lista(){
		$starIndex 							= $_GET['jtStartIndex'];
		$pageSize 							= $_GET['jtPageSize'];
		$buscar 							= (isset($_POST['search']) ? $_POST['search']: '' );
		$libro 								= $this->Notas_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] 			= 'OK';
		$jTableResult['Records'] 			= $libro[0];
		$jTableResult['TotalRecordCount'] 	= $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function add(){
		$data['matriculas'] = $this->Notas_model->getMatriculas();
		$this->View_model->render_view('admin/notas/add', $data, $content_data = null);
	}

	public function buscaralumno(){
		$idcurso 	= $this->input->post("idcurso");
		$idapertura = $this->input->post("idapertura");
		$this->Notas_model->buscaAlumno($idapertura, $idcurso);
	}

	public function store(){
		$idusuario 	= $this->session->userdata("id");
		$idapertura = $this->input->post("idapertura");
		$nota 		= $this->input->post("nota");
		if($this->save_Nota($idusuario, $nota, $idapertura)) {
			redirect(base_url('matriculas/notas'));
		}else{
			$this->session->set_flashdata("error", "No se pudo guardar la informacion");
			redirect(base_url('admin/notas/add'));
		}	
	}

	protected function save_Nota($idusuario, $nota, $idapertura){
		foreach ($nota as $idpre => $pre){
			foreach ($pre as $idmod => $nota){
				$data  = array(
					'usuario_id' 		=> $idusuario,
					'fecha_nota' 		=> date('Y-m-d'),
					'prematricula_id' 	=> $idpre,
					'modulo_id' 		=> $idmod,
					'nota' 				=> $nota,
					'estado' 			=> '1',
				);
				$idp = $idpre;
				$not['nota'] = '1';
				$this->Notas_model->save($data);
				$this->Prematriculas_model->update($idp,$not);
			}
		}
		
		$this->Notas_model->nota_update($idapertura);
		redirect(base_url('matriculas/notas'));
	}


	public function edit($idapertura){
		$data = [
			'apertura' 	=> $this->Notas_model->getNotaEdit($idapertura),
			'nota' 		=> $this->Notas_model->getEditnotas($idapertura),
			'jalado' 	=> $this->Notas_model->getcontar($idapertura),
		];

		$this->View_model->render_view('admin/notas/edit', $data, $content_data = null);
	}

	public function update(){
		$idusuario 	= $this->session->userdata("id");
		$idnota 	= $this->input->post("idnota");
		$nota 		= $this->input->post("nota");
		if($this->update_Nota($idusuario, $idnota, $nota)){
			redirect(base_url('matriculas/notas'));
		}else{
			$this->session->set_flashdata("error", "No se pudo Actualizar la informacion");
			redirect(base_url('matriculas/notas/edit/'));
		}
	}

	protected function update_Nota($idusuario, $idnota, $nota){
		for ($i = 0; $i < count($idnota); $i++) {
			$d = $idnota[$i];
			$data  = array(
				'usuario_id' => $idusuario,
				'nota' => $nota[$i],
			);
			$this->Notas_model->update($d, $data);
		}
		redirect(base_url('matriculas/notas'));
	}

	public function view($idapertura){
		$data  = array(
			'apertura' 	=> $this->Notas_model->getNotaEdit($idapertura),
			'nota' 		=> $this->Notas_model->getEditnotas($idapertura),
			'jalado' 	=> $this->Notas_model->getcontar($idapertura),
		);
		$this->load->view("admin/notas/view", $data);
	}

	public function delete($apertura){	
		$deleteid = $this->Notas_model->getcontar($apertura);
		for($i = 0; $i < count($deleteid); $i++){
			$d = $deleteid[$i]->idnota;
			$this->Notas_model->delete($d);
			$idpre=$deleteid[$i]->idpre;
			$datas['nota'] => null;
			$this->Prematriculas_model->updatenota($idpre, $datas);
		}
		
		$data['notas'] = '0';
		$this->Aperturas_model->update($apertura, $data);
		echo json_encode(['sucess' => true]);
	}

	public function addm(){
		$data['matriculas'] = $this->Notas_model->getMatriculasmod();
		$this->View_model->render_view('admin/notas/addm', $data, $content_data = null);
	}

	public function buscaralumnomod(){
		$idcurso 	= $this->input->post("idcurso");
		$idapertura = $this->input->post("idapertura");
		$this->Notas_model->buscaAlumnomod($idapertura, $idcurso);
	}
}