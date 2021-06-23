<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller {
	private $permisos; /* crear para permisos de modulos  */

	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Modulos_model");
		//$this->load->helper(array('download'));
		$this->load->model("Cursos_model");
	}

	
	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'modulos' => $this->Modulos_model->getModulos(),
		
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/modulos/listjt",$data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_modulos");
	}
	public function lista()
	{
		$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		$libro = $this->Modulos_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);

	}

	public function add(){

		$data = array(
			"cursos" => $this->Cursos_model->getCursos(),
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/modulos/add",$data);
		$this->load->view("layouts/footer");
	}


	public function store(){ 

		$curso_id = $this->input->post("idcurso");
		$curso = $this->input->post("curso");
		$nombremodulo = $this->input->post("nombremodulo");
		$abreviaturamodulo = $this->input->post("abreviaturamodulo");
		$horamodulo = $this->input->post("horamodulo");
		$this->form_validation->set_rules("curso","Curso de Modulos","required");
		$this->form_validation->set_rules("curso","Curso de Modulos","required");
		if ($this->form_validation->run()==TRUE) {

			if ($this->save_modulo($nombremodulo,$abreviaturamodulo,$horamodulo,$curso_id)) {

				redirect(base_url()."mantenimiento/modulos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/modulos/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/Niveles/add");*/
			$this->add();
		}

	}

	protected function save_modulo($nombremodulo,$abreviaturamodulo,$horamodulo,$curso_id){
		for ($i=0; $i < count($nombremodulo); $i++) { 
			$data  = array(
				'nombre' => $nombremodulo[$i], 
				'abreviatura' => $abreviaturamodulo[$i],
				'hora' => $horamodulo [$i],
				'curso_id' => $curso_id,
				'estado'=> '1',
			);
			$this->Modulos_model->save($data);
		}
		redirect(base_url()."mantenimiento/modulos");
	}


	public function edit($id){
		$data  = array(
			'curso' => $this->Modulos_model->getCurso($id), 
			'modulo' => $this->Modulos_model->getModulo($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/modulos/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){ 

		$id = $this->input->post("idmodulo");
		$nombre = $this->input->post("nombremodulo");
		$abreviatura = $this->input->post("abreviaturamodulo");
		$hora = $this->input->post("horamodulo");
		if ($this->update_modulo($id,$nombre,$abreviatura,$hora)) {
				redirect(base_url()."mantenimiento/Modulos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo Actualizar la informacion");
				redirect(base_url()."mantenimiento/modulos/edit");
			}
			
	}


	protected function update_modulo($id,$nombre,$abreviatura,$hora){
		for ($i=0; $i < count($id); $i++) { 
			$d=$id[$i];
			$data  = array( 
				'nombre' => $nombre[$i], 
				'abreviatura' => $abreviatura[$i],
				'hora' => $hora[$i],
			);
			$this->Modulos_model->update($d,$data);
		}
		redirect(base_url()."mantenimiento/modulos");
	}

	public function view($id){
		$data  = array(
			'curso' => $this->Modulos_model->getCurso($id), 
			'modulo' => $this->Modulos_model->getModulo($id), 
		);
		$this->load->view("admin/modulos/view",$data);
	}


	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Modulos_model->update($id,$data);
		echo json_encode(['sucess' => true]);
	}


}
