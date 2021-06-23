<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {

	public $path_web_theme = 'themes/course/';

	public function index()
	{	
		$path_web_theme = $this->path_web.$this->path_web_theme;

		/*--Cargando Css--*/
		$this->layout->css(
			array (
				base_url($path_web_theme.'styles/my_inicio.css'),				
				base_url($path_web_theme.'styles/main_styles.css'),
				base_url($path_web_theme.'styles/responsive.css'),
				base_url($path_web_theme.'styles/my_index.css') //mycss
			)
		);

		$this->layout->css_preload(
			array (				
				base_url($path_web_theme.'plugins/OwlCarousel2-2.2.1/owl.carousel.css'),
				base_url($path_web_theme.'plugins/OwlCarousel2-2.2.1/owl.theme.default.css'),
				base_url($path_web_theme.'plugins/OwlCarousel2-2.2.1/animate.css')
			)
		);

		// Parametros para la vista
		$output['sliders_web'] =  array(
			array('img' => base_url($this->path_web.'img/fondos/carrousel_3.webp'),
				'texto' => '<span>Centro en Tecnología de Información de la UNSM-T</span>' ),
			array('img' => base_url($this->path_web.'img/fondos/carrousel_1.webp'),
				'texto' => '<span>Capacítate y desarrolla tus Competencias en tecnología</span>')
		);
		$output['sliders_link_web'] =  array(
			array('img' => $path_web_theme.'images/earth-globe.svg',
				'texto' => 'Matricúlate','url' => base_url('web/inscripcion/') ),
			array('img' => $path_web_theme.'images/books.svg',
				'texto' => 'Cursos','url' =>  base_url('web/cursos/') ),
			array('img' => $path_web_theme.'images/mortarboard.svg',
				'texto' => 'Registrar pago','url' => base_url('web/pago/') )
		);

		//Get datos de servicios
		$this->load->model('web_data');
		$output['cti_servicios_web'] = $this->web_data->get_services();
		$output['events_web'] = $this->web_data->get_eventos();

		$output['upload_evento_path'] =  base_url("uploads/web_eventos/");
		$output['upload_servicio_path'] =  base_url("uploads/web_servicios/");

		$output['img_default'] =  base_url($this->path_web.'img/iconos/cti_logo_400_261.webp');
		$output['fondo_informe'] =  base_url($path_web_theme.'images/search_background.webp');

		$this->layout->view('index',$output);
	}

	public function buscar($codigo_curso = '')
	{	
		$path_web_theme = $this->path_web.$this->path_web_theme;

		/*--Cargando Css--*/
		$this->layout->css(
			array(
				base_url($path_web_theme.'styles/news_styles.css'),
				base_url($path_web_theme.'styles/news_responsive.css'),
				base_url($path_web_theme.'styles/my_index.css'),
			)
		);

		// Parametros para template
		$this->controller =  'Busqueda Web';
		$this->metodo =  '';

		// Parametros para la vista
		$output = array('title' => 'Principal' );
		$output['texto'] =  "Bienvenido";
		$output['fondo'] =  base_url($path_web_theme.'images/contact_background.jpg');

		$this->layout->view('buscar', $output );
	}

	public function blanco()
	{
		$path_web_theme = $this->path_web.$this->path_web_theme;

		/*--Cargando Css--*/
		$this->load->css($path_web_theme.'styles/news_styles.css');
		$this->load->css($path_web_theme.'styles/news_responsive.css');

		// Parametros para template
		$this->controller =  'Bienvenidos';
		$this->metodo =  '';

		// Parametros para la vista
		$output = array('title' => 'Principal' );
		$output['texto'] =  "Bienvenido";

		$this->load->view('web/blanco', $output ) ;
	}
}
