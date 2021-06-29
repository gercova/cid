<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pre extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('View_model');
		$this->load->model('Estudiantes_model');
		$this->load->model('Tipos_model');
		$this->load->model('Cursos_model');
		$this->load->model('Ciclos_model');
		$this->load->model('Niveles_model');
		$this->load->model('Dias_model');
		$this->load->model('Matriculas_model');
	}

	public function add(){
		$data = [
			'alumnos' 	=> $this->Estudiantes_model->getestudiantes(),
			'tipos' 	=> $this->Tipos_model->getTipo(),
			'idiomas' 	=> $this->Cursos_model->getCursos(),
			'ciclos' 	=> $this->Ciclos_model->getCiclos(),
			'niveles' 	=> $this->Niveles_model->getNiveles(),
			'dias' 		=> $this->Dias_model->getDays(),
		];

		$this->View_model->render_view('pre/add', $data, $content_data = null);
	}

	public function store(){
		$id 					= $this->input->post('id_matricula');
		$data['estudiante_id'] 	= $this->input->post('estudiante');
		$data['apertura_id'] 	= $this->input->post('apertura');
		$data['tipo_id'] 		= $this->input->post('tipo');
		$data['carrera_id'] 	= $this->input->post('carrera');
		$data['costo'] 			= $this->input->post('costo');
		$data['descuento'] 		= $this->input->post('descuento');
		$data['monto'] 			= $this->input->post('monto');
		$data['deuda'] 			= $this->input->post('deuda');
		$data['usu_reg'] 		= $this->session->userdata('id');
		date_default_timezone_set('America/Lima');
		$data['fec_reg'] 		= date('Y-m-d');

		if(empty($id)){
			if($this->Matricula_model->save($data)){
				redirect(base_url(''));
			}else{
				$this->session->set_flashdata('error', 'Algo salió mal');
				redirect(base_url(''));
			}
		}elseif(isset($id)){
			if($this->Matricula_model->update($id, $data)){
				redirect(base_url(''));
			}else{
				$this->session->set_flashdata('error', 'Algo salió mal');
				redirect(base_url(''));
			}
		}
	}

	public function anular_prematricula(){
		//$matricula_id = $this->input->post('');
		//$this->Matriculas_model->
	}
}