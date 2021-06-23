<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pago extends MY_Controller {

	private $controlador = "web/pago/";
	private $upload_path = './uploads/web_pagos/';
	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout('formulario_web');
		$this->controller = "Registro de pago";
		$this->load->helper(array('download'));
	}

	public function index()
	{
		$this->metodo = "Registro web";
		
		$data['controlador'] =$this->controlador;

		$this->layout->css(array( base_url("assets/template/select2/select2.min.css")));

		$jsAdd = array( base_url("assets/template/jquery/jquery.min.js"),
						base_url("assets/template/select2/select2.min.js"),
						base_url("assets/js/pago.js"),
						base_url("assets/template/swalalert2.js")
					);
		$this->layout->js($jsAdd);

		$this->layout->view('index',$data);
	}

	public function guardar_pago(){

		
        $this->load->model("Web_pagos_model");

		$data['controlador'] =$this->controlador;
		$data_result  = array( 'error' => 0, 'msj_error' => "");
		$usuario_id = 1;

        $imagen = $this->upload_imagen($this->upload_path,"imagen_pago");

        if(!empty($imagen["error"])){
			$data_result  = array( 'error' => 1,'msj_error' => $imagen["error"]);
    		echo json_encode($data_result);
    		die();// se detiene 
		}

     	$dataPago  = array(
			'prematricula_id' => $this->input->post("prematricula_id"),
			'usuario_id' => $usuario_id,
			'fecha_registro' => date("Y-m-d H:i:s"),
			'descripcion' => $this->input->post("descripcion"),
			'monto' => $this->input->post("monto"),
			'codigo' => $this->input->post("codigo"),
			'fecha_pago'=> $this->input->post("fecha_pago"),
			'comentario'=> $this->input->post("comentario"),
			'estado' => '1'
	    );

        if(!empty($imagen["img"])){ $dataPago['imagen'] = $imagen["img"]; }

        if($this->Web_pagos_model->guardar_pago_web($dataPago) ){
        	//Id del pago web registrado
        	$insert_pago_id = $this->db->insert_id();            

            $estuidanteInfo = $this->Web_pagos_model->getInfoEstudiante($this->input->post("prematricula_id"));			
			$correo_pago = $estuidanteInfo->email;

			//enviar correo
            $this->send_email($insert_pago_id,$correo_pago);

            $data_result  = array('error' => 0, "msj_success" => "Registro de pago realizado con éxito." );

        }else{
            $data_result = array(
				    'error' => 1,
				    'msj_error' => 'Error, no se pudo cargar la información.' );
		}

      echo	json_encode($data_result);

	}

	// Pedidos DATA 
	public function get_datos_estudiante() {

        $this->load->model("Web_pagos_model");
        $tipo_doc = $this->input->post("tipo_doc");
        $num_doc =  $this->input->post('num_doc');
		$data = $this->Web_pagos_model->getEstudianteInscripcion($tipo_doc,$num_doc);

		if( is_null($data) or empty($data) ){
       		$data = array();
       	} 

       	echo json_encode($data);
    }

    public function getListPagoTable()
	{
		$this->load->model("Web_pagos_model");
		$id =  $this->input->post('id_estudiante');
		$data['controlador'] =$this->controlador;
		$data['list_pago'] = $this->Web_pagos_model->getListaPagos($id);
		$data['id_alumno'] = $id;

		$this->load->view('web/pago/TableListPago',$data);
	} 
	

	public function send_email($pago_id, $correo_notificacion)
	{	
		$this->load->model("Web_pagos_model");
		$data_msj  = array(
				'data_view' => $this->Web_pagos_model->getVer($pago_id),
				'upload_path'=> base_url("uploads/web_pagos/")
			);
		$CorreoConfirmPago = $this->load->view("web/pago/molde_email", $data_msj, true);
		$this->enviar_correo($correo_notificacion, 
        					'Confirmación de registro pago en CTI-UNSM',
        					$CorreoConfirmPago );
	}


}
