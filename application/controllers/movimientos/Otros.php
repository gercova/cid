<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Otros extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Otros_model");
		$this->load->model("Pagos_model");
		$this->load->model("Estudiantes_model");
		$this->load->model("Prematriculas_model");
		$this->load->model('View_model');
	}

	public function index(){
		$data  = [
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'pagos' => $this->Pagos_model->getPagos(),
		];

		$this->View_model->render_view('admin/otros/listjt', $data, 'content/c_otros');
	}

	public function lista(){
		$starIndex 							= $_GET['jtStartIndex'];
		$pageSize 							= $_GET['jtPageSize'];
		$buscar 							= (isset($_POST['search']) ? $_POST['search']: '' );
		$libro 								= $this->Otros_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] 			= 'OK';
		$jTableResult['Records'] 			= $libro[0];
		$jTableResult['TotalRecordCount'] 	= $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function add(){
		$data = [
			"estudiantes" 	=> $this->Estudiantes_model->getEstudiantes(),
			"conceptos" 	=> $this->Otros_model->getConceptos(),
		];

		$this->View_model->render_view('admin/otros/add', $data, $content_data);
	}

	public function store(){
		$idusuario 			= $this->session->userdata("id");
		$estudiante_id 		= $this->input->post("idestudiante");
		$concepto_id 		= $this->input->post("idconcepto");
		$descripcionpago 	= $this->input->post("descripcionpago");
		$montopago 			= $this->input->post("montopago");
		$codigopago 		= $this->input->post("codigopago");
		$fechapago 			= $this->input->post("fechapago");
		

		if($this->save_pago($idusuario, $estudiante_id,$concepto_id, $descripcionpago, $montopago, $codigopago, $fechapago, $deuda)){
			redirect(base_url('movimientos/otros'));
		}else{
			$this->session->set_flashdata("error", "No se pudo guardar la informacion");
			redirect(base_url('movimientos/otros/add'));
		}
	}

	protected function save_pago($idusuario, $estudiante_id, $concepto_id, $descripcionpago, $montopago, $codigopago, $fechapago, $deuda){
		for ($i = 0; $i < count($codigopago); $i++){
			$data  = array(
				'usuario_id' 		=> $idusuario,
				'estudiante_id' 	=> $estudiante_id[$i],
				'concepto_id' 		=> $concepto_id[$i],
				'fecha_registro' 	=> date('Y-m-d'),
				'descripcion' 		=> $descripcionpago[$i],
				'monto' 			=> $montopago[$i],
				'codigo' 			=> $codigopago[$i],
				'fecha_pago' 		=> $fechapago[$i],
				'estado' 			=> '1',
			);
			$this->Otros_model->save($data);
		}
		redirect(base_url('movimientos/otros'));
	}

	public function edit($id){
		$data = [
			'pago' 		=> $this->Otros_model->getPago($id),
			"conceptos" => $this->Otros_model->getConceptos(),
		];

		$this->View_model->render_view('admin/otros/edit', $data, $content_data = null);
	}

	public function update(){
		$idpago 				= $this->input->post("idpago");
		$data['usu_mod'] 		= $this->session->userdata("id");
		$data['fecha_mod'] 		= date('Y-m-d');
		$data['concepto_id'] 	= $this->input->post("idconcepto");
		$data['descripcion'] 	= $this->input->post("descripcion");
		$data['monto'] 			= $this->input->post("monto");
		$data['codigo'] 		= $this->input->post("codigo");
		$data['fecha_pago'] 	= $this->input->post("fecha_pago");
	
		if($this->Otros_model->update($idpago, $data)){
			redirect(base_url('movimientos/otros'));
		}else{
			$this->session->set_flashdata("error", "No se pudo Actualizar la informacion");
			redirect(base_url('movimientos/otros/edit/'.$idpago));
		}
	}

	public function view($id){
		$data['pagocuo'] = $this->Otros_model->getPago($id);
		$this->load->view("admin/otros/view", $data);
	}

	public function delete($id){
		$this->Otros_model->delete($id);
		echo json_encode(['sucess' => true]);
	}
}
