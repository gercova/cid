<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends MY_Controller {

	public $path_web_theme = 'themes/course/';

	public function index()
	{
		$path_web_theme = $this->path_web.$this->path_web_theme;
		/*--Cargando Css--*/
		$this->layout->css(
			array(
				base_url($path_web_theme.'styles/contact_styles.css'),
				base_url($path_web_theme.'styles/contact_responsive.css'),
				base_url($path_web_theme.'styles/elements_styles.css'),
				base_url($path_web_theme.'styles/elements_responsive.css'),
				base_url($path_web_theme.'styles/my_index.css'),
				base_url($path_web_theme.'styles/my_contacto.css')
			)
		);

		// Parametros para template
		$this->controller =  'Bienvenidos al  Centro en Tecnología de Información ';
		$this->metodo =  '';

		// Parametros para la vista
		$output['Web_seccion'] =  "Contacto";
		$output['fondo'] =  base_url($this->path_web.'img/fondos/biblioteca_modelo.jpg');

		$this->layout->view('contacto', $output ) ;
	}

}
