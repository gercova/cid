<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripcion extends MY_Controller {

	private $controlador = "web/inscripcion/";
	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout('formulario_web');
		$this->controller = "Formulario de inscripción";
	}

	public function index($id_curso='')
	{
		$this->load->model("Web_inscripcion_model");
		$this->metodo = "Registro web";
		$data['controlador'] =$this->controlador;		
		
		$cssAdd = array( base_url("assets/template/select2/select2.min.css")//,
						//base_url("assets/css/checkbox.css")
				);
		$this->layout->css($cssAdd);

		$jsAdd = array( base_url("assets/template/jquery/jquery.min.js"),
						base_url("assets/template/select2/select2.min.js"),
						base_url("assets/js/inscripcion_v2.js"),
					base_url("assets/template/swalalert2.js")
				);
		$this->layout->js($jsAdd );
        
        $data['select'] =' ';
		$data['cursos'] = $this->Web_inscripcion_model->getCurso();	
		$data['carreras'] = $this->Web_inscripcion_model->getCarreras();
		$data['niveles'] = $this->Web_inscripcion_model->getNiveles();
		$data['sedes'] = $this->Web_inscripcion_model->getSedes();

		$this->layout->view('index',$data);
		$this->load->view('web/inscripcion/addSolicitudApertura',$data);
	}

	//Guardar data	
	public function guardar_inscripcion(){
		try {
		
		$data['controlador'] =$this->controlador;
		$this->load->model("Web_inscripcion_model");

		$usuario_id = $nuevo_usuario = 1;
		$curso_id = $this->input->post("curso_id");
		$apertura_id = $this->input->post("apertura_id");
		$nivel_id = $this->input->post("nivel_id");
		$data_result  = array( 'grupo' => 0, 'error' => 0 );

		//Validamos si el estudiante existe		
		$num_documento = $this->input->post("num_documento");
	    $dataEstExiste = $this->Web_inscripcion_model->validEstudiante($num_documento);

	    if( isset($dataEstExiste->id) ){
	    	//Validamos si el estudiante ya esta inscrito en la apertura
	    	$estudiante_id = $dataEstExiste->id;
	    	//$flag = $this->Web_inscripcion_model->getPrematriculaEstAper($apertura_id, $estudiante_id);
	    	$flag = $this->Web_inscripcion_model->getPrematriculaEstAperCurso($curso_id, $estudiante_id);
	    	if(isset($flag->id)){
	    		$data_result  = array( 'grupo' => 1, 'error' => 0 );
	    		echo json_encode($data_result);
	    		die();// se detiene 
	    	}
	    }

        $datos_curso=$this->Web_inscripcion_model->getCurso($curso_id);        
        $datos_nivel=$this->Web_inscripcion_model->getNiveles($nivel_id);

        $datos_curso=$datos_curso[0];        
        $datos_nivel=$datos_nivel[0];

		$costo_curso          = $datos_curso->costo;
		$descuento_porcentaje = $datos_nivel->descuento;
		$descuento_monto      = $costo_curso*$descuento_porcentaje;
		$monto_c              = $costo_curso-$descuento_monto;
		$fecha_registro       =  date("Y-m-d");   
		    
	    $nombre_estudiante = trim(strtoupper($this->input->post("nombre")));
	    $email_estudiante  = trim($this->input->post("email"));

	    //Validación de estudiante ya registrado en la bd
        if( isset($dataEstExiste->id)){
	        $estudiante_id = $dataEstExiste->id;
	        $nuevo_usuario = 0;
        }else{

        	$num_documento = trim($this->input->post("num_documento"));
         	$data  = array(
				'tipo_documento_id' => $this->input->post("tipo_documento_id"),
				'num_documento' => $num_documento,
				'nombre' => $nombre_estudiante,
				'sexo_id' => $this->input->post("sexo_id"),
				'fecha_nacimiento' => $this->input->post("fecha_nacimiento"),
				'direccion' => $this->input->post("direccion"),
				'celular'=> $this->input->post("telefono"),
				'email' => $email_estudiante,
				'estado' => 1,
				'fecha_registro' => date("Y-m-d"),
				'carrera_id' => $this->input->post("carrera_id")
			);       	

        	if ($this->Web_inscripcion_model->guardar_estudiante($data)){ 

				$dataEstExiste = $this->Web_inscripcion_model->validEstudiante($num_documento);
				$estudiante_id = $dataEstExiste->id;
			}
			else{
				$data_result = array( 'grupo' => 0, 'error' => 1,
									'msjError' => "Error al crear nuevo estudiante" );
	    		echo json_encode($data_result);
	    		die();// se detiene 
			}
        }
		
        $data  = array(
			'usuario_id' => $usuario_id,
			'estudiante_id' => $estudiante_id,
			'apertura_id' => $apertura_id,
			'nivel_id' => $nivel_id,
			'costo' => $costo_curso,
			'descuento' => $descuento_monto,
			'monto'=> $monto_c,
			'deuda'=> $monto_c,
			'fecha_registro' => $fecha_registro,
			'estado' => 1,
			'pagado' => 0,
			'descripcion' => 'Inscripción web',
			'matriculado' => 0
		);

		if ($this->Web_inscripcion_model->guardar_inscripcion($data)) {

			$id_inscripcion = $this->db->insert_id();  

		    $data  = array(
			    'prematricula_id' => $id_inscripcion,
			    'check_anterior' => $nuevo_usuario,
			    'ip_maquina' => getenv('REMOTE_ADDR'),
			    'fecha' => date("Y-m-d H:i:s"),
		     );  
		    $this->Web_inscripcion_model->guardar_log($data);

        	$data_result  = array( 'grupo' => 0, 'error' => 0);

            //enviar correo
            $this->send_email($id_inscripcion,$email_estudiante);


		} else{
			$data_result = array( 'grupo' => 0, 'error' => 1, 
							'msjError' => "Error al crear inscripción" );
    		echo json_encode($data_result);
    		die();// se detiene 
		}

		} catch (Exception $e) {
			$data_result = array( 'grupo' => 0, 'error' => 1, 
							'msjError' => "Error en php" );
    		echo json_encode($data_result);
    		die();// se detiene 
		}
		
	    echo json_encode($data_result);
	}

	public function guardar_solicitud_apertura(){

		$this->load->model("Web_inscripcion_model");
		$curso_id = $this->input->post("solicitud_curso_id");
		$nombre = $this->input->post("solicitud_nombre");
		$celular = $this->input->post("solicitud_celular");
		$correo = $this->input->post("solicitud_correo");
		$hora_tentativa = $this->input->post("solicitud_hora_tentativa");
		$mensaje = $this->input->post("solicitud_mensaje");
		$fecha_server = date("Y-m-d H:i:s");

        $dias_disp = array('lunes'=> 0,'martes'=> 0,'miercoles'=> 0,'jueves'=> 0,'viernes'=> 0,'sabado'=> 0, 'domingo'=> 0);

        foreach ($dias_disp as $key => $value) {
        	$aux = $this->input->post($key) ;
        	$dias_disp[$key] = isset($aux)? 1:0;
        }

		$data  = array(
			'curso_id'       => $curso_id,
			'nombre'         => $nombre,
			'celular'        => $celular,
			'correo'         => $correo,
			'lunes'          => $dias_disp['lunes'],
			'martes'         => $dias_disp['martes'],
			'miercoles'      => $dias_disp['miercoles'],
			'jueves'         => $dias_disp['jueves'],
			'viernes'        => $dias_disp['viernes'],
			'sabado'         => $dias_disp['sabado'],
			'domingo'        => $dias_disp['domingo'],
			'hora_tentativa' => $hora_tentativa,
			'mensaje'        => $mensaje,
			'fecha_server'   => $fecha_server
		);

		if ($this->Web_inscripcion_model->guardar_solicitud_apertura($data)) {
        	$this->session->set_flashdata("success","Se creo la SOLICITUD con ÉXITO.");

        	$insert_solicitud_id = $this->db->insert_id();

        	//enviar correo
            $this->send_email_solicitud($insert_solicitud_id,$correo);

		} else{
			$this->session->set_flashdata("error","ERROR no se pudo crear la solicitud.");			
		}
		redirect(base_url($this->controlador));
		//print_r(json_encode($array_response));
	}

	// Pedidos DATA
	public function get_datos_estudiante() {

        $this->load->model("Web_inscripcion_model");
        $tipo_doc = $this->input->post("tipo_doc");
        $num_doc =  $this->input->post('num_doc');
		$data = $this->Web_inscripcion_model->getEstudianteInscripcion($tipo_doc,$num_doc);

		if( is_null($data) or empty($data) ){                      
       		$data = $this->getDataDocumento($num_doc);
       	}else{
       		$data = json_encode($data);
       	} 

        echo $data;
    }

	public function getCursoAperturaTable($id_curso = 'none', $id_sede = "1")
	{
		$this->load->model("Web_inscripcion_model");

		$data['controlador'] =$this->controlador;

		$data['curso_aperturas'] = $this->Web_inscripcion_model->getCursoApertura($id_curso,$id_sede);
		$data['cursos'] = $this->Web_inscripcion_model->getCurso();
		$data['curso_id'] = $id_curso;
		$this->load->view('web/inscripcion/tableCursoApertura',$data);
	}

	public function send_email($inscripcion_id, $correo_notificacion)
	{	
		$this->load->model("Web_inscripcion_model");
		$data_msj = array( 
			'data_view' => $this->Web_inscripcion_model->getVer($inscripcion_id)
		);
        $CorreoConfirmInscripcion = $this->load->view('web/inscripcion/molde_email', $data_msj, true);        	

    	$this->enviar_correo($correo_notificacion, 
    						'Confirmación de inscripción web en CTI-UNSM',
    						$CorreoConfirmInscripcion
    					);
	}

	public function send_email_solicitud($solicitud_id, $correo_notificacion)
	{	
		$this->load->model("Web_solicitudes_model");
		$data_msj = array( 
			'data_view' => $this->Web_solicitudes_model->getVer($solicitud_id)
		);
        $CorreoConfirmSolicitud = $this->load->view('web/solicitud/molde_email', $data_msj, true);        	
    	$this->enviar_correo($correo_notificacion, 
        						'Confirmación de registro solicitud web en CTI-UNSM',
        						$CorreoConfirmSolicitud        						
        					);
	}


}
