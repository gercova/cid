<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matriculas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Matriculas_model");
		$this->load->model("Docentes_model");
		$this->load->model("Aulas_model");
		$this->load->model("Aperturas_model");
		$this->load->model('View_model');
	}

	public function index(){
		$data  = [
			'permisos' 		=> $this->permisos,
			'matriculas' 	=> $this->Matriculas_model->getMatriculas(),
		];

		$this->View_model->render_view('admin/matriculas/listjt', $data, 'content/c_matriculas');
	}

	public function lista(){
		$starIndex 							= $_GET['jtStartIndex'];
		$pageSize 							= $_GET['jtPageSize'];
		$buscar 							= (isset($_POST['search']) ? $_POST['search']: '' );
		$libro 								= $this->Matriculas_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] 			= 'OK';
		$jTableResult['Records'] 			= $libro[0];
		$jTableResult['TotalRecordCount'] 	= $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function add(){
		$data = [
			"docentes" 	=> $this->Docentes_model->getDocentes(),
			"aulas" 	=> $this->Aulas_model->getAulas(),
			'aperturas' => $this->Matriculas_model->getApertura()
		];

		$this->View_model->render_view('admin/matriculas/add', $data, $content_data = null);
	}

	public function buscar(){
		$idapertura = $this->input->post("idapertura");
		$this->Matriculas_model->getDocAul($idapertura);
	}

	public function buscaralumno(){
		$idapertura = $this->input->post("idapertura");
		$this->Matriculas_model->buscarAlumnos($idapertura);
	}

	public function store(){
		$idapertura 			= $this->input->post("idapertura");
		$idprematricula 		= $this->input->post("idprematricula");
		$data['docente_id'] 	= $this->input->post("iddocente");
		$data['aula_id'] 		= $this->input->post("idaula");
		$data['fecha_ini'] 		= $this->input->post("fecha_ini");
		$data['fecha_fin'] 		= $this->input->post("fecha_fin");
		$data['fecha_apertura'] = date('Y-m-d');
		
		if($this->Aperturas_model->update($idapertura, $data) && $this->save_matricula($idprematricula)){
			redirect(base_url('matriculas/matriculas'));
		}else{
			$this->session->set_flashdata('error', 'No se pudo guardar la información');
			redirect(base_url('matriculas/matriculas/add'));
		}
	}

	public function update(){
		$idapertura = $this->input->post("idapertura");
		$idcurso 	= $this->input->post("idcurso");
		$fecha_ini 	= $this->input->post("fecha_ini");
		$fecha_fin 	= $this->input->post("fecha_fin");
		$iddocente 	= $this->input->post("iddocente");
		$idaula 	= $this->input->post("idaula");
		$idapcu 	= $this->input->post("idapcu");

		$data  = array(
			'docente_id' 	=> $iddocente,
			'aula_id' 		=> $idaula,
			'fecha_ini' 	=> $fecha_ini,
			'fecha_fin' 	=> $fecha_fin,

		);
		if($this->Aperturas_model->update($idapertura, $data)) {
			redirect(base_url('matriculas/matriculas'));
		}else{
			$this->session->set_flashdata("error", "No se pudo Actualizar la informacion");
			redirect(base_url('matriculas/matriculas/edit/'));
		}
	}

	protected function save_matricula($idprematricula){
		foreach($idprematricula as $k => $v){
			$id 					= intval($v);
			$data['matriculado'] 	= '1';
			$this->Matriculas_model->update($id, $data);
		}

		redirect(base_url('matriculas/matriculas'));
	}

	public function completos($id){ /// cargar cursos en el formulario add
		$this->db->select("a.*,a.id,c.nombre as curso,g.nombre as grupo,g.hora_ini,g.hora_fin,a.docente_id,d.nombre as docente,a.aula_id,au.nombre as aula,a.fecha_ini,fecha_fin");
		$this->db->from("aperturas a");
		$this->db->join("docentes d", "a.docente_id = d.id");
		$this->db->join("aulas au", "a.aula_id = au.id");
		$this->db->join("cursos c", "a.curso_id = c.id");
		$this->db->join("grupos g", "a.grupo_id = g.id");
		$this->db->where("a.notas", "0");
		$this->db->where("a.estado", "1");
		$this->db->where("a.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function edit($id){
		$data = [
			'docentes' 			=> $this->Docentes_model->getDocentes(),
			'aulas' 			=> $this->Aulas_model->getAulas(),
			'matricula' 		=> $this->Matriculas_model->getMatricula($id),
			'prematriculado' 	=> $this->Matriculas_model->getprematriculados($id)
		];

		$this->View_model->render_view('admin/matriculas/edit', $data, $content_data = null);
	}

	public function view($id){
		$data = [
			'matricula' 		=> $this->Matriculas_model->getMatricula($id),
			'prematriculado' 	=> $this->Matriculas_model->getprematriculados($id)
		];
		
		$this->load->view("admin/matriculas/view", $data);
	}

	public function delete($id){
		$deleteid = $this->Matriculas_model->getMatriculaDelete($id);
		for($i = 0; $i < count($deleteid); $i++){
			$id = $deleteid[$i]->id;
			$data['matriculado'] = '0';
			$this->Matriculas_model->update($id, $data);
		}

		$datos = [
			'docente_id' 		=> null,
			'aula_id' 			=> null,
			'fecha_ini' 		=> null,
			'fecha_fin' 		=> null,
			'fecha_apertura' 	=> null,
		];

		$this->Aperturas_model->update($id, $datos);
		echo json_encode(['sucess' => true]);
	}

	public function deletelista($id){
		$data['matriculado'] = '0';
		$this->Matriculas_model->update($id, $data);
		echo "matriculas/matriculas";
	}

	public function addm(){
		$data = [
			"docentes" 	=> $this->Docentes_model->getDocentes(),
			"aulas" 	=> $this->Aulas_model->getAulas(),
			'aperturas' => $this->Matriculas_model->getAperturamod()
		];

		$this->View_model->render_view('admin/matriculas/addm', $data, $content_data = null);
	}
	
	public function storem(){
		$idprematricula 		= $this->input->post("idprematricula");
		$idapertura 			= $this->input->post("idapertura");
		$data['docente_id'] 	= $this->input->post("iddocente");
		$data['aula_id'] 		= $this->input->post("idaula");
		$data['fecha_ini'] 		= $this->input->post("fecha_ini");
		$data['fecha_fin'] 		= $this->input->post("fecha_fin");
		$data['fecha_apertura'] = date('Y-m-d');
		
		if($this->Aperturas_model->update($idapertura, $data) && $this->save_matricula($idprematricula)){
			redirect(base_url('modificar/Modprema'));
		}else{
			$this->session->set_flashdata("error", "No se pudo guardar la informacion");
			redirect(base_url('matriculas/matriculas/addm'));
		}
	}

	public function buscarmod(){
		$idapertura = $this->input->post("idapertura");
		$this->Matriculas_model->getDocAulmod($idapertura);
	}
}