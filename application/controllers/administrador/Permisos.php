<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		 if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
        $this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model('Permisos_model');
		$this->load->model('Usuarios_model');
		$this->load->model('View_model');
	}

	public function index(){
		$data  = array(
			'permisos1' => $this->permisos, /* crear para permisos de modulos  */
			'permisos' => $this->Permisos_model->getPermisos(), 
		);

		$this->View_model->render_view('admin/permisos/list', $data, $content_data = null);
	}

	public function add(){
		$data  = [
			'roles' => $this->Usuarios_model->getRoles(), 
			'menus' => $this->Permisos_model->getMenus(), 
		];

		$this->View_model->render_view('admin/permisos/add', $data, $content_data = null);
	}

	public function store(){

		$idpermiso 			= $this->input->post("idpermiso");
		$data['menu_id'] 	= $this->input->post("menu");
		$data['rol_id'] 	= $this->input->post("rol");
		$data['read'] 		= $this->input->post("insert");
		$data['insert'] 	= $this->input->post("read");
		$data['update'] 	= $this->input->post("update");
		$data['delete'] 	= $this->input->post("delete");

		if(empty($idpermiso)){
			if($this->Permisos_model->save($data)){
				redirect(base_url('administrador/permisos'));
			}else{
				$this->session->set_flashdata('error', 'No se pudo guardar la informacion');
				redirect(base_url('administrador/permisos/add'));
			}
		}elseif(isset($idpermiso)){
			if($this->Permisos_model->update($idpermiso,$data)){
				redirect(base_url('administrador/permisos'));
	
			}else{
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url('administrador/permisos/edit/'.$idpermiso));
			}
		}
	}

	public function edit($id){
		$data  = [
			'roles' 	=> $this->Usuarios_model->getRoles(), 
			'menus' 	=> $this->Permisos_model->getMenus(), 
			'permiso' 	=> $this->Permisos_model->getPermiso($id)
		];

		$this->View_model->render_view('admin/permisos/edit', $data, $content_data = null);
	}

	public function delete($id){
		$this->Permisos_model->delete($id);
		redirect (base_url('administrador/permisos'));
	}
}