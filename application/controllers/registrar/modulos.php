<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modulos extends CI_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	public function __construct()
	{	parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("modulos_model");	
		$this->load->model("cursos_model");	

	}

	public function index()
	{	$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			"cursos" => $this->cursos_model->getcursos(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/modulos/listjt", $data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_modulos");	
	}

	public function lista()
	{	$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		$libro = $this->modulos_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function edit()
	{
		$id = $this->input->post("id");
		$this->modulos_model->getedit($id);
		$this->Modulos_model->getmodulo($id);
	}

	public function store(){
		$idusuario = $this->session->userdata("id");
		$id = $this->input->post("id");
		$idcurso = $this->input->post("idcurso");
		$modulo = $this->input->post("nombremodulo");
		$abreviatura = $this->input->post("abreviaturamodulo");
		$hora = $this->input->post("horamodulo");

		//$this->form_validation->set_rules("id", "Numero de Documento", "required|is_unique[docentes.id]");
		
		if ($id<=0) {
			for ($i=0; $i < count($modulo); $i++) { 
				$data  = array(
					'descripcion' => $modulo[$i], 
					'abreviatura' => $abreviatura[$i],
					'horas' => $hora [$i],
					'curso_id' => $idcurso,
					'usu_reg' => $idusuario,
					'fec_reg' => date('Y-m-d'),
					'estado'=> '1',
				);
			$this->modulos_model->save($data);
			}
			echo json_encode(['sucess' => true]);
		//	redirect(base_url()."administrador/pacientes");
		}
		else{
			$this->modulos_model->update($id,$data);
			echo json_encode(['sucess' => true]);
		}



	/*	$data  = array(
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
			}*/
		}
	public function delete($id)
	{
		$data  = array(
			'estado' => "0",
		);
		$this->modulos_model->update($id, $data);
		echo json_encode(['sucess' => true]);
	}
}
