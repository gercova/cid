<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos_informacion extends MY_Controller {



	public function index($codigo_curso = 'none')
	{
		/*--Cargando Css--*/
		$this->layout->css(
			array (
				base_url('public/themes/course/styles/courses_styles.css'),
				base_url('public/themes/course/styles/courses_responsive.css'),
				base_url('public/themes/course/styles/news_styles.css'),
				base_url('public/themes/course/styles/news_responsive.css'),
				base_url('public/themes/course/styles/my_index.css'),
				base_url('public/themes/course/styles/my_cursos.css'),
			)
		);

		// Parametros para template
		$this->controller =  'Bienvenidos al  Centro en Tecnología de Información ';
		$this->metodo =  '';

		// Parametros para la vista
		$output = array('title' => 'Principal' );
		$output['texto'] =  "Nosotros";
		$output['Web_seccion'] =  "Nosotros";
		$output['fondo'] =  base_url('public/themes/course/images/search_background.jpg');

		$this->load->model('web_data');
		$output['cursos_lista'] = $this->web_data->get_cursos($codigo_curso);

		$output['codigo_curso'] = $codigo_curso;

		$this->layout->view('cursos', $output ) ;
	}
}
