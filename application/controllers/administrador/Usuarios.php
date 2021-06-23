<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")) {
            redirect(base_url());
        }
        $this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model('Usuarios_model');
		$this->load->model('View_model');

	}

	public function index(){
		$data  = [
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'usuarios' => $this->Usuarios_model->getUsuarios(), 
		];

		$this->View_model->render_view('admin/usuarios/list', $data, $content_data = null);
	}

	public function add(){
		$data  = [
			'roles' => $this->Usuarios_model->getRoles(), 
		];

		$this->View_model->render_view('admin/usuarios/add', $data, $content_data = null);
	}

	public function edit($id){
		$data  = [
			'roles' 	=> $this->Usuarios_model->getRoles(), 
			'usuario' 	=> $this->Usuarios_model->getUsuario($id), 
		];

		$this->View_model->render_view('admin/usuarios/edit', $data, $content_data = null);
	}

	public function store(){
		
		$idusuario 			= $this->input->post("idusuario");
		$data['nombres'] 	= $this->input->post("nombres");
		$data['apellidos'] 	= $this->input->post("apellidos");
		$data['telefono'] 	= $this->input->post("telefono");
		$data['email'] 		= $this->input->post("email");
		$data['username'] 	= $this->input->post("username");
		$data['password'] 	= $this->input->post("password");
		$data['rol_id'] 	= $this->input->post("rol");
		
		if(empty($idusuario)){
			if($this->Usuarios_model->save($data)) {
				redirect(base_url('administrador/usuarios'));
			}else{
				$this->session->set_flashdata('error', 'No se pudo guardar la informacion');
				redirect(base_url('administrador/usuarios/add'));
			}
		}elseif(isset($idusuario)){
			if ($this->Usuarios_model->update($idusuario,$data)) {
				redirect(base_url('administrador/usuarios'));
			}else{
				$this->session->set_flashdata('error', 'No se pudo guardar la informacion');
				redirect(base_url('administrador/usuarios/edit/'.$idusuario));
			}
		}
	}

	public function view(){
		$idusuario = $this->input->post("idusuario");
		$data = array(
			'usuario' => $this->Usuarios_model->getUsuario($idusuario)
		);
		$this->load->view('admin/usuarios/view', $data);

	}

	public function delete($id){
		$data  = [
			'estado' => "0", 
		];
		$this->Usuarios_model->update($id, $data);
		echo 'administrador/usuarios';
	}
}