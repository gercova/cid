<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    //constructor, debe llamar al constructor de la clase parent
    public $sistema = 'CTI';
    public $pagina_web = 'Cti Web';
	public $version = '1.0.5';
	public $link = 'web/inicio';

    public $controller = '';
    public $metodo = '';
    public $menu = '';
    
    public $nombre_usuario = '';
    public $perfil_usuario = '';

    public $path_web = 'assets/web/';

    public $nombre_empresa = 'Centro en Tecnología de Información ';
    public $nombre_empresa_abreviado = 'CTI - UNSM';
    public $icono_pagina_web = 'assets/web/img/iconos/cti_logo_64_42.webp';
    public $correo_notificacion = 'cti@unsm.edu.pe';//'ctiunsm@unsm.edu.pe';
    public $correo_notificacion_oculta = 'colbersiho@gmail.com';//'ctiunsm@unsm.edu.pe';
    /*public $logo_empresa = 'assets/img/logo_empresa.jpg';
    public $razon_social = 'CENTRO EN TECNOLOGÍA DE INFORMACIÓN';
    public $ruc = '00000000000';
    public $direccion = 'Jr. Orellana 575 - Tarapoto';
	public $direccion_referencia = 'En las intalaciones del complejo universitario de la UNSM-T';
    public $telefono = '955 941 992';
	public $telefonos = '042 -480142, 955 941 992 , 944 929 637';
	public $correo = 'ctiunsm@gmail.com';
	public $correos = 'ctiunsm@gmail.com';
    public $rubro = 'Formación de profesionales humanistas y competitivos, con responsabilidad social y comprometidos con el desarrollo local, regional y nacional, mediante la generación de conocimientos, tecnologías e innovación, en el marco de una cultura de valores, en proceso de acreditación y de actualización permanente. ';
	public $informacion_pago = '';*/


    public $Web_personalizado_home = 0;
    public $grocery_basic_crud = '../grocery_crud/basic_crud';

    public function __construct()
    {
        parent::__construct();
		$this->load->helper('web');
		$this->load->model('Web_data');
        $this->load->library('Layout');

		$data_organizacion = $this->Web_data->get_organizacion();

		$this->direccion = $data_organizacion['direccion'];
		$this->direccion_referencia = $data_organizacion['direccion_referencia'];
		$this->telefono = $data_organizacion['telefono_principal'];
		$this->telefonos = $data_organizacion['telefonos'];
		$this->correo = $data_organizacion['correo_principal'];
		$this->correos = $data_organizacion['correos'];
		$this->informacion_pago = $data_organizacion['informacion_pago'];
    }   

    public function redireccionar($controlador,$ruta)
    { 
        redirect(base_url($controlador.$ruta));
    }

    public function upload_imagen($path, $imagen)
    {
        $this->load->library('upload');

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 20048;
        $config['max_width']            = 5024;
        $config['max_height']           = 5024;
        $result = array("img"=>"","error"=>"");

        if( empty($_FILES[$imagen]['name']) ){
            $result["error"] = "";

        }else if(file_exists($path)){
            $this->upload->initialize($config);
            if($this->upload->do_upload($imagen)){
                $file_info = $this->upload->data();
                $result["img"] = $file_info['file_name'];
            }else{
                $error = $this->upload->display_errors();
                $result["error"] = str_replace('<p>','',str_replace('</p>','', $error));
            }
        }else{
            $result["error"] = "Directorio path no encontrado.";
        }

        return $result;        
    }


    public function getDataDocumento($numero)
    {   //$numero = $this->input->post("documento");
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://aplicaciones007.jne.gob.pe/srop_publico/Consulta/api/AfiliadoApi/GetNombresCiudadano",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "CODDNI=$numero",
          CURLOPT_HTTPHEADER => array(
            "Requestverificationtoken: Dmfiv1Unnsv8I9EoXEzbyQExSD8Q1UY7viyyf_347vRCfO-1xGFvDddaxDAlvm0cZ8XgAKTaWclVFnnsGgoy4aLlBGB5m-E8rGw_ymEcCig1:eq4At-H2zqgXPrPnoiDGFZH0Fdx5a-1UiyVaR4nQlCvYZzAhzmvWxLwkUk6-yORYrBBxEnoG5sm-Hkiyc91so6-nHHxIeLee5p700KE47Cw1",
            "Content-Type: application/x-www-form-urlencoded",
            "Cookie: ASP.NET_SessionId=zjlc4c43wx03oqtdg45t05fn"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
        
    }

    public function enviar_correo($correo_destino, $titulo, $mensaje ){

        if (filter_var($correo_destino, FILTER_VALIDATE_EMAIL)) {

            $this->load->library('email');
            $config = array();
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'mail.ctiunsm.pe';
            $config['smtp_user'] = '_mainaccount@ctiunsm.pe';//'admin@ctiunsm.pe';
            $config['smtp_pass'] = 'tarapoto$678';
            $config['smtp_crypto']   = 'ssl';
            $config['smtp_port'] = 465;
            $config['mailtype'] = 'html';

            $this->email->initialize($config);
            $this->email->from('admin@ctiunsm.pe', 'Asistente CTI-UNSM');
            $this->email->to($correo_destino);
            
            $this->email->cc($this->correo_notificacion);
            $this->email->bcc($this->correo_notificacion_oculta);
            $this->email->subject($titulo);
            $this->email->message($mensaje);
            $this->email->send();

        }else{
            $correo_destino = "correo invalido";
        }
    }

}
