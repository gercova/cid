<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nosotros extends MY_Controller {

	public $path_web_theme = 'themes/course/';

	public function index()
	{	
		$path_web_theme = $this->path_web.$this->path_web_theme;

		/*--Cargando Css--*/
		$this->layout->css(
			array (
				base_url($path_web_theme.'styles/elements_styles.css'),
				base_url($path_web_theme.'styles/elements_responsive.css'),
				base_url($path_web_theme.'styles/my_index.css'), //mycss
				base_url($path_web_theme.'styles/my_nosotros.css')
			)
		);

		$this->load->model("Web_data");

		// Parametros para template
		$this->controller =  'Bienvenidos al  Centro en Tecnología de Información ';
		$this->metodo =  '';

		// Parametros para la vista
		$output['Web_seccion'] =  "Nosotros";

		$output['img_organigrama'] =  base_url($this->path_web.'img/organigrama_cti.png');		
		$output['fondo'] =  base_url($this->path_web.'img/fondos/libro_abierto.jpg');
		$output['data']  = $this->Web_data->get_organizacion();	

		$this->layout->view('nosotros', $output ) ;
	}

}
