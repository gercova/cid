<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends MY_Controller {

	public $path_web_theme = 'themes/course/';

	public function index($codigo_curso = 'none')
	{	
		$path_web_theme = $this->path_web.$this->path_web_theme;
		/*--Cargando Css--*/
		$this->layout->css(
			array (
				base_url($path_web_theme.'styles/courses_styles.css'),
				base_url($path_web_theme.'styles/courses_responsive.css'),
				base_url($path_web_theme.'styles/news_styles.css'),
				base_url($path_web_theme.'styles/news_responsive.css'),
				base_url($path_web_theme.'styles/my_index.css'),
				base_url($path_web_theme.'styles/my_cursos.css'),
			)
		);

		// Parametros para template
		$this->controller =  'Bienvenidos al  Centro en Tecnología de Información ';
		$this->metodo =  '';

		// Parametros para la vista
		$output['Web_seccion'] =  "Nuestros cursos";
		$output['fondo'] =  base_url($this->path_web.'img/fondos/grupo_computadoras.jpg');
		$output['cursos_lista'] = $this->Web_data->get_cursos();
		$output['upload_curso_path'] = base_url("uploads/web_cursos/");
		$output['img_default'] =  base_url($this->path_web.'img/iconos/cti_logo_400_261.png');
		$this->layout->view('cursos', $output ) ;
	}

	public function informacion($codigo_curso = 'none')
	{	
		$path_web_theme = $this->path_web.$this->path_web_theme;

		/*--Cargando Css--*/
		$this->layout->css(
			array (
				base_url($path_web_theme.'styles/elements_styles.css'),
				base_url($path_web_theme.'styles/elements_responsive.css'),
				base_url($path_web_theme.'styles/my_index.css'), //mycss
				base_url($path_web_theme.'styles/my_nosotros.css'),
				base_url('assets/template/font-awesome/css/font-awesome.min.css')			
			)
		);

		// Parametros para template
		$this->controller =  'Bienvenidos al  Centro en Tecnología de Información ';
		$this->metodo =  '';

		// Parametros para la vista
		$output['texto'] =  "Cursos";
		$output['Web_seccion'] =  "Cursos";
		$output['fondo'] =  base_url($this->path_web.'img/fondos/grupo_computadoras.jpg');

		$this->load->model('web_data');
		$output['curso_data'] = $curso_data = $this->web_data->get_curso_data($codigo_curso);


		$output['cursos_informacion'] = $this->web_data->get_cursos_informacion($codigo_curso);
		$output['cursos_informacion_det'] = $this->web_data->get_cursos_informacion_det($codigo_curso);
		$output['cursos_modulo'] = $this->web_data->get_cursos_modulo($codigo_curso);
		$output['cursos_modulo_det'] = $this->web_data->get_cursos_modulo_det($codigo_curso);
		$output['cursos_icono'] = $this->web_data->get_cursos_icono($codigo_curso);
		$output['cursos_icono_det'] = $this->web_data->get_cursos_icono_det($codigo_curso);

		$output['codigo_curso'] = $codigo_curso;


		if( empty($curso_data) ) {
			$home_content = "Curso no encontrado";
			$fondo= base_url('public/themes/course/images/courses_background.jpg');
			$found_curso = false;

		}else{
			$output['Web_seccion'] = $home_content = $curso_data[0]["nombre_curso"];
		    $upload_path = 'public/uploads/web_cursos/';

			$fondo= base_url($upload_path.$curso_data[0]["imagen_curso"].'');
			$found_curso = true;
		}

		//print_r($output);die();

		$this->layout->view('cursos_informacion', $output ) ;
	}
}
