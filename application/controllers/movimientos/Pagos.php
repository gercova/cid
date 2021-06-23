<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model('Pagos_model');
		$this->load->model('Prematriculas_model');
		$this->load->model('View_model');
	}

	public function index(){
		$data = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'pagos' => $this->Pagos_model->getPagos(),
		);

		$this->View_model->render_view('admin/pagos/listjt', $data, 'content/c_pagos');
	}

	public function lista(){
		$starIndex 							= $_GET['jtStartIndex'];
		$pageSize 							= $_GET['jtPageSize'];
		$buscar 							= (isset($_POST['search']) ? $_POST['search']: '' );
		$libro 								= $this->Pagos_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] 			= 'OK';
		$jTableResult['Records'] 			= $libro[0];
		$jTableResult['TotalRecordCount'] 	= $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function add(){
		$data["prematriculas"] = $this->Pagos_model->getPrematriculapago();
		$this->View_model->render_view('admin/pagos/add', $data, $content_data = null);
	}

	public function store(){
		$idusuario 			= $this->session->userdata("id");
		$prematricula_id 	= $this->input->post("idpre");
		$deuda 				= $this->input->post("deudas");
		$descripcionpago 	= $this->input->post("descripcionpago");
		$montopago 			= $this->input->post("montopago");
		$codigopago 		= $this->input->post("codigopago");
		$fechapago 			= $this->input->post("fechapago");
		
		$this->form_validation->set_rules("contador", "Datos del  Pago", "required");
		if ($this->form_validation->run() == TRUE) {
			if ($this->save_pago($idusuario, $prematricula_id, $descripcionpago, $montopago, $codigopago, $fechapago, $deuda)) {
				redirect(base_url('movimientos/pagos'));
			}else{
				$this->session->set_flashdata('error', 'No se pudo guardar la informacion');
				redirect(base_url('movimientos/pagos/add'));
			}
		}else{
			$this->add();
		}
	}

	protected function save_pago($idusuario, $prematricula_id, $descripcionpago, $montopago, $codigopago, $fechapago, $deuda){
		for ($i = 0; $i < count($codigopago); $i++) {
			$data  = array(
				'usuario_id' 		=> $idusuario,
				'prematricula_id' 	=> $prematricula_id[$i],
				'fecha_registro' 	=> date('Y-m-d'),
				'descripcion' 		=> $descripcionpago[$i],
				'monto' 			=> $montopago[$i],
				'codigo'		 	=> $codigopago[$i],
				'fecha_pago' 		=> $fechapago[$i],
				'estado' 			=> '1',
			);
			$this->Pagos_model->save($data);
			$idpre 		= $prematricula_id[$i];
			$deudas 	= $this->Pagos_model->getDeudaprema($idpre);
			$deuda 		= $deudas->deuda;
			$totaldeuda = $deuda - $montopago[$i];
			$this->Pagos_model->GuadarPago($idpre, $totaldeuda);
		}

		redirect(base_url('movimientos/pagos'));
	}

	public function edit($id, $prematricula_id){
		$data  = array(
			'pago' => $this->Pagos_model->getPago($id),
			'pagocuo' => $this->Pagos_model->getPagocuo($prematricula_id),
		);

		$this->View_model->render_view('admin/pagos/edit', $data, $content_data = null);
	}


	public function update(){
		$idusuario 			= $this->session->userdata("id");
		$prematricula_id 	= $this->input->post("idprematricula");
		$prematricula 		= $this->input->post("prematricula");
		$montopre 			= $this->input->post("monto");
		$idpago 			= $this->input->post("idpago");
		$descripcionpago 	= $this->input->post("descripcionpago");
		$montopago 			= $this->input->post("montopago");
		$codigopago 		= $this->input->post("codigopago");
		$fechapago 			= $this->input->post("fechapago");

		if($this->update_pago($prematricula_id, $idpago, $descripcionpago, $montopago, $codigopago, $fechapago, $montopre,$idusuario )){
			redirect(base_url('movimientos/pagos'));
		}else{
			$this->session->set_flashdata('error', 'No se pudo Actualizar la informacion');
			redirect(base_url('movimientos/pagos/edit/'.$prematricula_id));
		}
	}


	protected function update_pago($prematricula_id, $idpago, $descripcionpago, $montopago, $codigopago, $fechapago, $montopre,$idusuario){
		$sumapago = 0;
		for($i = 0; $i < count($idpago); $i++){
			$d = $idpago[$i];
			$sumapago = $sumapago + $montopago[$i];
			$data  = array(
				'descripcion' 	=> $descripcionpago[$i],
				'monto' 		=> $montopago[$i],
				'codigo' 		=> $codigopago[$i],
				'fecha_pago' 	=> $fechapago[$i],
				'usu_mod' 		=> $idusuario,
				'fecha_mod' 	=> date('Y-m-d'),

			);
			$this->Pagos_model->update($d, $data);
		}
		if($montopre == $sumapago){
			$totaldeuda = 0;
		}else{
			$totaldeuda = $montopre - $sumapago;
		}

		$this->Pagos_model->GuadarPago($prematricula_id, $totaldeuda);
		redirect(base_url('movimientos/pagos'));
	}

	public function view($id){
		$data  = array(
			'prematricula' => $this->Prematriculas_model->getPrever($id),
			'pagocuo' => $this->Pagos_model->getPagocuo($id),
		);
		$this->load->view('admin/pagos/view', $data);
	}

	public function delete($id, $prematricula_id){
		$monto 			= $this->Pagos_model->getMomtopago($id);
		$deuda 			= $this->Pagos_model->getDeudaprema($prematricula_id);
		$deudapre 		= $deuda->deuda;
		$montopago 		= $monto->monto;
		$saldo 			= $deudapre + $montopago;
		$data['deuda'] 	= $saldo;
		$this->Prematriculas_model->update($prematricula_id, $data);
		$this->Pagos_model->delete($id);
		echo json_encode(['sucess' => true]);
	}
}
