<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cursos extends CI_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	public function __construct()
	{	parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("cursos_model");	
		$this->load->model("ciclos_model");	
		$this->load->model("niveles_model");
		$this->load->helper("download");	
	}

	public function index()
	{	$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'ciclos' => $this->ciclos_model->getciclos(), 
			'niveles' => $this->niveles_model->getniveles(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/cursos/listjt", $data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_cursos");	
	}

	public function lista()
	{	$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		$libro = $this->cursos_model->grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function edit()
	{
		$id = $this->input->post("id");
		$this->cursos_model->getedit($id);
	}

	public function store(){
		$idusuario = $this->session->userdata("id");
		$id = $this->input->post("id");
		$descripcion = $this->input->post("descripcion");
		$costo = $this->input->post("costo");
		//$silabus = $this->input->post("silabus");
		$ciclos = $this->input->post("ciclos");
		$niveles = $this->input->post("niveles");
		$web = $this->input->post("web");

		/// subir archivos
		$config = [
			"upload_path" => "./uploads/silabus/",
			"allowed_types" => "pdf|xlsx|docx",
			"max_size" => "20048"
		];
		$this->load->library("upload",$config);
		//$this->upload->initialize($config);
		if($this->upload->do_upload("silabus")){
			$archivo = array("upload_data" => $this->upload->data());
			$data  = array(
				'ciclo_id' => $ciclos,
				'nivel_id' => $niveles,
				'descripcion' => $descripcion,
				'costo' => $costo,
				'silabus' => $archivo['upload_data']['file_name'],
				'act_web' => $web,
				'usu_reg' => $idusuario,
				'fec_reg' => date('Y-m-d'),
				'estado' => "1",
	
			);
	
				if ($id<=0) {
					$this->cursos_model->save($data);
					echo json_encode(['sucess' => true]);
				//	redirect(base_url()."administrador/pacientes");
				}
				else{
					$this->cursos_model->update($id,$data);
					echo json_encode(['sucess' => true]);
				}
		}
		else{
				echo $this->upload->display_errors();
			}
		//	$file_info = $this->upload->data(); 
		//	$archivo = $file_info['file_name'];	
		
		/// fin de subir archivso

/*		$data  = array(
			'ciclo_id' => $ciclos,
			'nivel_id' => $niveles,
			'descripcion' => $descripcion,
			'costo' => $costo,
			'silabus' => $archivo,
			'act_web' => $web,
			'usu_reg' => $idusuario,
			'fec_reg' => date('Y-m-d'),
			'estado' => "1",

		);

			if ($id<=0) {
				$this->cursos_model->save($data);
				echo json_encode(['sucess' => true]);
			//	redirect(base_url()."administrador/pacientes");
			}
			else{
				$this->cursos_model->update($id,$data);
				echo json_encode(['sucess' => true]);
			}*/
		}
	public function delete($id)
	{
		$data  = array(
			'estado' => "0",
		);
		$this->cursos_model->update($id, $data);
		echo json_encode(['sucess' => true]);
	}
}
