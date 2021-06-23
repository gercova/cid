<?php
/**
 * 
 */
class Backend_lib
{   
	private $CI;
	public function __construct()
	{
		$this->CI = & get_instance();
	}

	public function control(){
		if(!$this->CI->session->userdata("login")){
			redirect(base_url());
		}
		$url = $this->CI->uri->segment(1);
		if($url = $this->CI->uri->segment(2)){
			$url = $this->CI->uri->segment(1)."/".$this->CI->uri->segment(2);
		}

		$infomenu = $this->CI->Backend_model->getID($url);
		$permisos = $this->CI->Backend_model->getPermisos($infomenu->id,$this->CI->session->userdata("rol"));
		
		if($permisos->read ==0 ){
			redirect(base_url()."dashboard");
		}else{
		    $menu_show = $this->CI->Backend_model->showMenu($this->CI->session->userdata("rol"));
			$this->CI->session->set_userdata( array('showMenu' => $menu_show ));

			return $permisos;
		}
	}
}