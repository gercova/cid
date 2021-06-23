<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends MY_Controller {

	public $path_web_theme = 'themes/course/';

	public function index()
	{
		redirect(base_url('web/inicio'));
	}

	public function informacion($codigo_servicio = 'none')
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

		// Parametros para template
		$this->controller =  'Información del servicio';
		$this->metodo =  ' Detalle del servicio';

		// Parametros para la vista
		$data['examen-suficiencia'] = array(
			'home_content' => 'Examen de Suficiencia',
			'content' => array(
				array(
					'section_title' => 'Descripción',
					'section_text' => 'CTI - UNSM te facilita el examen de suficiencia, solo puede ser solicitado por los egresados de la UNSM y/o estudiantes que llevaron los cursos del CTI en periodos anterios.',
					'section_text_li' => array('Requisitos - Docuementación escaneada (Solicitud dirigida al coordinador, pago por derecho de examen, constancia de egresado o certificado de estudios y DNI digitalizado).',
							//'El costo del examen de suficiencia es equivalente al menos 20% del valor del módulo o programa.',
							'El examen es virtual y tiene una duración de 03 horas.',
							'La evaluación es previa coordinación con la Unidad Académica del CTI.',
					        'La certificación es equivalente a las horas académicas del curso presencial.',
					),

				)
			)
		);

		$data['capacitacion-empresas'] = array(
			'home_content' => 'Capacitación a Empresas',
			'content' => array(
				array(
					'section_title' => 'Descripción',
					'section_text' => 'En CTI - UNSM, acorde a nuestra misión “Capacitar en el uso de tecnología actual, promoviendo modernización educativa” desarrollamos cursos y programas dictados por docentes especialistas, diseñados a la medida de las necesidades en capacitación informática y de gestión de cada organización, orientados al logro de sus objetivos y metas. ',
					'section_text_li' => array()
				),
				array(
					'section_title' => 'Beneficios',
					'section_text' => '',
					'section_text_li' => array(
						'Descuentos corporativos.',
						'Entregará de certificado a cada participante por cada curso concluido y aprobado a nombre de la Universidad Nacional de San Martin.')
				),
				array(
					'section_title' => 'Contactanos',
					'section_text' => '',
					'section_text_li' => array(
						'correo : ctiunsm@gmail.com.',
						'Teléfonos : (042 -480142) (955 941 992) (944 929 637).')
				)
			)
		);

		$output =  $data[$codigo_servicio];
		$output['fondo'] = base_url($this->path_web.'img/fondos/grupo_computadoras.jpg');

		$this->layout->view('servicio_informacion', $output ) ;
	}
}
