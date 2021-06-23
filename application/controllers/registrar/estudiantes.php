<?php
defined('BASEPATH') or exit('No direct script access allowed');

class estudiantes extends CI_Controller
{
	private $permisos; /* crear para permisos de modulos  */
	public function __construct()
	{	parent::__construct();
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("estudiantes_model");	
	}

	public function index()
	{	$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/estudiantes/listjt", $data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_estudiantes");	
	}

	public function lista()
	{	$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		$libro = $this->estudiantes_model->grilla($starIndex, $pageSize, $buscar);
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


	public function getDNI()
	{	$numero = $this->input->post("documento");
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://aplicaciones007.jne.gob.pe/srop_publico/Consulta/api/AfiliadoApi/GetNombresCiudadano",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "CODDNI=$numero",
		  CURLOPT_HTTPHEADER => array(
			"Requestverificationtoken: Dmfiv1Unnsv8I9EoXEzbyQExSD8Q1UY7viyyf_347vRCfO-1xGFvDddaxDAlvm0cZ8XgAKTaWclVFnnsGgoy4aLlBGB5m-E8rGw_ymEcCig1:eq4At-H2zqgXPrPnoiDGFZH0Fdx5a-1UiyVaR4nQlCvYZzAhzmvWxLwkUk6-yORYrBBxEnoG5sm-Hkiyc91so6-nHHxIeLee5p700KE47Cw1",
			"Content-Type: application/x-www-form-urlencoded",
			"Cookie: ASP.NET_SessionId=zjlc4c43wx03oqtdg45t05fn"
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		echo $response;
		
	}

	public function getRUC()
	{	$numero = $this->input->post("documento");
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://services.wijoata.com/consultar-ruc/api/ruc/$numero",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_HTTPHEADER => array(
			"Accept: application/json",
			"Content-Type: application/json"
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}


	public function edit()
	{
		$id = $this->input->post("id");
		$this->estudiantes_model->getedit($id);
	}

	public function store(){
		$idusuario = $this->session->userdata("id");
		$id = $this->input->post("id");
		$dni = $this->input->post("dni");
		$nombre = $this->input->post("nombre");
		$celular = $this->input->post("celular");
		$adicional = $this->input->post("adicional");
		$email = $this->input->post("email");
		$this->form_validation->set_rules("id", "Numero de Documento", "required|is_unique[estudiantes.id]");

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
				$this->estudiantes_model->save($data);
				echo json_encode(['sucess' => true]);
			//	redirect(base_url()."administrador/pacientes");
			}
			else{
				$this->estudiantes_model->update($id,$data);
				echo json_encode(['sucess' => true]);
			}
		}
	public function delete($id)
	{
		$data  = array(
			'estado' => "0",
		);
		$this->estudiantes_model->update($id, $data);
		echo json_encode(['sucess' => true]);
	}
}
