<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once './vendor/autoload.php';
class Certificados extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Certificados_model");
		$this->load->model("Docentes_model");
		$this->load->model("Aulas_model");
		$this->load->model("Cursos_model");
		$this->load->model("Grupos_model");
		$this->load->model("Aperturas_model");
		$this->load->model('View_model');
	}

	public function index(){
		$data  = [
			'permisos' 		=> $this->permisos, /* crear para permisos de modulos  */
			'Certificados' 	=> $this->Certificados_model->getCertificados(),
		];

		$this->View_model->render_view('admin/certificados/listjt', $data, 'content/c_certificados');
	}
	
	public function lista(){
		$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];

		if(isset($_POST['loquita'])){
			$buscar = (isset($_POST['loquita']) ? $_POST['loquita']: '' );
			$grilla = 'listexp';
	  	}else{    
		  	$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		  	$grilla = 'listo';
	  	}

		$libro 								= $this->Certificados_model->$grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] 			= 'OK';
		$jTableResult['Records'] 			= $libro[0];
		$jTableResult['TotalRecordCount'] 	= $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}


	public function add(){
		$data['alumnos'] = $this->Certificados_model->getAlumnos();
		$this->View_model->render_view('admin/certificados/add', $data, $content_data = null);
	}

	public function store(){
		$idusuario 		= $this->session->userdata("id");
		$idprematricula = $this->input->post("idprematriculal");
		$oculto 		= $this->input->post("oculto");
		$fecha_ini 		= $this->input->post("fecha_ini");
		$fecha_fin 		= $this->input->post("fecha_fin");
		$folio 			= $this->input->post("foliol");
		$correlativo 	= $this->input->post("correlativol");
		$fecha 			= $this->input->post("fechal");
		$img 			= $this->input->post("img");

		$id 		= $this->input->post("idcertificado");

		$data[''] 	= $this->session->userdata("id");
		$data[''] 	= $this->input->post("idprematriculal");
		$data[''] 	= $this->input->post("oculto");
		$data[''] 	= $this->input->post("fecha_ini");
		$data[''] 	= $this->input->post("fecha_fin");
		$data[''] 	= $this->input->post("foliol");
		$data[''] 	= $this->input->post("correlativol");
		$data[''] 	= $this->input->post("fechal");
		$data[''] 	= $this->input->post("img");
		
		$this->form_validation->set_rules("oculto", "Ingrese datos para Generar Certificados", "required");
		if ($this->form_validation->run() == TRUE) {
			if($this->save_certificado($idusuario,$idprematricula,$fecha_ini,$fecha_fin,$folio,$correlativo,$fecha,$img )) {
				redirect(base_url('matriculas/Certificados'));

			}else{
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url('matriculas/Certificados/add'));
			}
		}else{
			$this->add();
		}
	}

	protected function save_certificado($idusuario,$idprematricula,$fecha_ini,$fecha_fin,$folio,$correlativo,$fecha,$img){
		for ($i=0; $i < count($idprematricula); $i++) { 
			$id=$idprematricula[$i];
			$data  = [
				'prematricula_id' 	=> $idprematricula[$i],
				'fecha_ini' 		=> $fecha_ini[$i],
				'fecha_fin' 		=> $fecha_fin[$i],
				'folio' 			=> $folio[$i],
				'correlativo' 		=> $correlativo[$i],
				'fecha' 			=> $fecha[$i],
				'usuario_id' 		=> $idusuario,
				'img' 				=> $img[$i],
				'modalidad' 		=> null,
			];

			$this->Certificados_model->save($data);
			$this->Certificados_model->GuardarCert($id);
		}
		redirect(base_url('matriculas/Certificados'));
	}

	public function edit($id){
		$data['certificado'] = $this->Certificados_model->getEdit($id);
		$this->View_model->render_view('admin/certificados/edit', $data, $content_data = null);
	}

	public function update(){
		$idusuario = $this->session->userdata("id");
		$id= $this->input->post("idcertificado");
		$fecha_ini = $this->input->post("fecha_ini");
		$fecha_fin = $this->input->post("fecha_fin");
		$folio = $this->input->post("folio");
		$correlativo = $this->input->post("correlativo");
		$fecha = $this->input->post("fecha");
		$cara = $this->input->post("cara");
		$modalidad = $this->input->post("modalidad");
		$this->form_validation->set_rules("folio", "El Folio para generar las Certificados", "required");
		$this->form_validation->set_rules("correlativo", "El Correlativo para generar las Certificados", "required");
		$this->form_validation->set_rules("fecha", "La Fecha de Impresión para generar las Certificados", "required");
		
		if($this->form_validation->run() == TRUE){

			$data  = array(
				'fecha_ini' => $fecha_ini,
				'fecha_fin' => $fecha_fin,
				'folio' => $folio,
				'correlativo' => $correlativo,
				'fecha' => $fecha,
				'img' => $cara,
				'modalidad' => $modalidad,
				'usuario_mod' => $idusuario,
				'fecha_mod' => date('Y-m-d'),
			);

			if($this->Certificados_model->update($id,$data)){
				redirect(base_url('matriculas/Certificados'));
			}else{
				$this->session->set_flashdata('error', 'No se pudo Actualizar la informacion');
				redirect(base_url('matriculas/Certificados/edit/'. $id));
			}
		}else{
			$this->edit($id);
		}
	}

	public function delete($id,$pre){
		$data  = array(
			'estad' => "0",
		);
		$this->Certificados_model->update($id, $data);
		$this->Certificados_model->ActuaCert($pre);
		echo json_encode(['sucess' => true]);
	}

	public function entregar($id){	
		$idusuario = $this->session->userdata("id");
		$data  = array(
			'entrega' => "1",
			'usu_entrega' => $idusuario,
			'fecha_entre' => date('Y-m-d'),
		);
		$this->Certificados_model->update($id, $data);
		//$this->Certificados_model->ActuaCert($pre);
		echo json_encode(['sucess' => true]);
	}

	/// exportar en excel
	public function excel(){	 
		header('Content-Disposition: attachment; filename=certificados.xls');
		header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
	
		if(!isset($_GET['fechabuscar'])){
			$buscar = (isset($_POST['loquita']) ? $_POST['loquita']: '' );
			$grilla='Excel';
		}else{    
			$buscar = $_GET['fechabuscar'];
			$grilla='Excelbus';
		}
		$libro = $this->Certificados_model->$grilla($buscar);

		echo "<table>
			<thead>
				<tr>
					<th>#</th>
					<th>CODIGO</th>
					<th>DNI</th>
					<th>ESTUDIANTE</th>
					<th>TIPO</th>
					<th>CURSO</th>
					<th>PERIODO</th>
					<th>FOLIO</th>
					<th>CORRELATIVO</th>
					<th>FECHA DE IMPRESIÓN</th>
				</tr>
			</thead>
			<tbody>";
			$num=1;
			if(!empty($libro)) : 
				foreach ($libro as $libros) :
					echo "<tr>";
					echo "<td>". $num."</td>";
					echo "<td>". $libros->id."</td>";
					echo "<td>". $libros->num_documento."</td>";
					echo "<td>".utf8_decode($libros->estudiante)."</td>";
					echo "<td>". utf8_decode($libros->descripcion)."</td>";
					echo "<td>". utf8_decode($libros->curso)."</td>";
					echo "<td> DEL ".date('d/m/Y', strtotime($libros->fecha_ini))." AL ".date('d/m/Y', strtotime($libros->fecha_fin))."</td>";
					echo "<td>". $libros->folio."</td>";
					echo "<td>". $libros->correlativo."</td>";
					echo "<td>". $libros->fecha."</td>";
					echo "</tr>";
					$num=$num+1;
				endforeach;
			endif; 
			echo "</tbody>
			</table>
		";
		//return $varlo;
	}	

	public function view($id,$pre){
		$data  = array(
			'estudiante' => $this->Certificados_model->getEstudiante($id),
			'detalle' => $this->Certificados_model->getDetalle($pre),
			'horas' => $this->Certificados_model->getHoras($pre),
		
		); 
		//$this->load->view("admin/Certificados/view", $data);
		//exit(json_encode($data));
		//exit(var_dump($data['detalle']));
		$alumno = $data['estudiante']->alumno;
		$tipo = $data['estudiante']->tipocurso;
		
		if($tipo == "Examen de Suficiencia") {
			$glosa="EXAMEN DE SUFICIENCIA DE 10 HORAS, EQUIVALENTE A 80 HORAS DEL CURSO PRESENCIAL ";
		}else{
			$glosa="";
		}
		$curso = $data['estudiante']->curso;
		$ini= $data['estudiante']->fecha_ini;
		$inicio = date("d/m/Y", strtotime($ini));
		$f = $data['estudiante']->fecha_fin;
		$fin = date("d/m/Y", strtotime($f));
		$folio = $data['estudiante']->folio;
		$horita = $data['horas']->horas;
		$correlativo = $data['estudiante']->correlativo;
		$fecha = $data['estudiante']->fecha;
		setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
		$fechaimpresion = strtoupper(strftime("%d de %B de %Y", strtotime($fecha)));
		$cer = $data['estudiante']->img;
		$cers = $data['estudiante']->img."spd";
		$notas = $data['detalle'];
		/* formato papel membretado del cti*/
		$modalidad = $data['estudiante']->modalidad;
		if($modalidad != null){
			$concepto="En la modalidad de :";
		}else{
			$concepto="";
		};
		if($horita < 10) {
			$hora="0".$horita;
		} else{
			$hora=$horita;
		}
		
		$background = "
			<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
				<img src='./assets/img/$cer.jpg'
					style='width: 210mm; height: 297mm; margin: 0' />
			</div>
			
			<p style='z-index:1000; position: absolute;top:78mm; left:0; right: 0 ; font-size: xx-large; '>
				<p style='text-align:center'><b style='font-size:30px'>$alumno</b></p>
			</p>

			<p style='z-index:1000; position: absolute; top:99.8mm;left:118mm; right: 0 ;' >
				<i style='font-size:22px'> del  <b> $tipo</b> </i>
			</p>

			<p style='z-index:1000; position: absolute;top:103mm; left:0; right: 0 ; font-size: xx-large; '>
				<p style='text-align:center; line-height: 30px'><b style='font-size:30px'>$curso</b></p>
			</p>

			<p style='z-index:1000; position: absolute; top:126.8mm;left: 65mm; right: 0 ;' >
				<i style='font-size:20px'><b>$inicio</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:126.8mm;left: 118mm; right: 0 ;' >
				<i style='font-size:20px'><b>$fin</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:126.8mm;left: 223mm; right: 0 ;' >
				<i style='font-size:20px'><b>$hora</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:138.5mm;left:152mm; right: 0 ;' >
				<b style='font-size:13px'>$folio</b> 
			</p>

			<p style='z-index:1000; position: absolute; top:148.5mm;left:143mm; right: 0 ;' >
				<b style='font-size:13px'>$correlativo</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:138mm;left:200mm; right: 0 ;' >
			<i style='font-size:20px'>$concepto</i>
		</p>

		<p style='z-index:1000; position: absolute; top:145.5mm;left:200mm; right: 0 ;' >
			<i style='font-size:20px'><b>$modalidad</b></i>
		</p>
	
		";
		$calificacion = "<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
							<img src='./assets/img/$cers.jpg'
							style='width: 210mm; height: 297mm; margin: 0' />
						</div>";
		$primero=41; /* empeza en 41 normal con 15 de espacio*/
		$espacio=15;
		foreach($notas as $nota){
			$modulo = $nota->modulo;
			$nts = $nota->nota;
				if ($nts < 11) {
					$nt=" ";
				} else{
					$nt=$nts;
				}
				switch ($nt) {case 11: $letra= "ONCE";break;case 12: $letra= "DOCE";break;
				case 13: $letra= "TRECE";break;case 14: $letra= "CATORCE";break;case 15:$letra= "QUINCE";break;
				case 16:$letra= "DIECISÉIS";break;case 17:$letra= "DIECISIETE";	break;
				case 18:$letra= "DIECIOCHO";break;case 19:$letra= "DIECINUEVE"; break;
				case 20: $letra= "VEINTE"; break;default: $letra=" "; }
			$hor = $nota->hora;	
			if ($hor < 10) {
				$hora="0".$hor;
			} else{
				$hora=$hor;
			}	

			$calificacion .= "
				
				<div  style='z-index:1000; position: absolute; top:$primero.mm;left:22mm; right: 0 ; '>
					<table  style='font-size:20x'>
						<tr>
							<td  width='128mm' >
								<b>$modulo</b>
							</td >
							<td width='61mm'  >
							&nbsp;&nbsp;&nbsp;<b>$letra</b>
							</td>
							<td width='33mm' align='center' >
								<b>$nt</b>
							</td>
							<td width='35mm' align='center' >
								<b>$hora<b>
							</td>

						</tr>				
					</table>
				</div>
			";
			$primero=$primero+$espacio;
		}

		$calificacion .= "
			<p style='z-index:1000; position: absolute; top:162mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>$glosa</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:172mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>INSCRITO EN EL FOLIO: $folio</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:179mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>CON EL N°: $correlativo</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:186mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>DEL LIBRO DE CERTIFICADOS DEL CTI</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:172mm;left:185mm; right: 0 ;' >
				<b style='font-size:16px'>TARAPOTO, $fechaimpresion</b> 
			</p>
		";

		$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
		$mpdf->WriteHTML($background);
		$mpdf->AddPage();
		$mpdf->WriteHTML($calificacion);
		$mpdf->Output();
		//$this->load->view("admin/Certificados/view", $data);
	}

	public function viewotro($id,$pre){
		$data  = array(
			'estudiante' => $this->Certificados_model->getEstudiante($id),
			'detalle' => $this->Certificados_model->getDetalle($pre),
			'horas' => $this->Certificados_model->getHoras($pre),
		
		); 
		//$this->load->view("admin/Certificados/view", $data);
		//exit(json_encode($data));
		//exit(var_dump($data['detalle']));
		$alumno = $data['estudiante']->alumno;
		$tipo = $data['estudiante']->tipocurso;
			if ($tipo == "EXAMEN DE SUFICIENCIA") {
				$glosa="EXAMEN DE SUFICIENCIA DE 10 HORAS, EQUIVALENTE A 80 HORAS DEL CURSO PRESENCIAL ";
			} else{
				$glosa="";
			}
		$curso = $data['estudiante']->curso;
		$ini= $data['estudiante']->fecha_ini;
		$inicio = date("d/m/Y", strtotime($ini));
		$f = $data['estudiante']->fecha_fin;
		$fin = date("d/m/Y", strtotime($f));
		$folio = $data['estudiante']->folio;
		$hora = $data['horas']->horas;
		$correlativo = $data['estudiante']->correlativo;
		$fecha = $data['estudiante']->fecha;
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$fechaimpresion = strtoupper(strftime("%d de %B de %Y", strtotime($fecha)));
		$cer = $data['estudiante']->img;
		$cers = $data['estudiante']->img."spd";
		$modalidad = $data['estudiante']->modalidad;
		if($modalidad != null){
			$concepto="En la modalidad de :";
		}else{
			$concepto="";
		};
		$notas = $data['detalle'];
		/* formato papel membretado del cti*/
		
		$background = "
			<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
				<img src='./assets/img/$cer.jpg'
					style='width: 210mm; height: 297mm; margin: 0' />
			</div>
			
			<p style='z-index:1000; position: absolute;top:78mm; left:0; right: 0 ; font-size: xx-large; '>
				<p style='text-align:center'><b style='font-size:30px'>$alumno</b></p>
			</p>

			<p style='z-index:1000; position: absolute; top:99.8mm;left:120mm; right: 0 ;' >
				<i style='font-size:22px'> del  <b> $tipo</b> </i>
			</p>

			<p style='z-index:1000; position: absolute;top:103mm; left:0; right: 0 ; font-size: xx-large; '>
				<p style='text-align:center; line-height: 30px'><b style='font-size:30px'>$curso</b></p>
			</p>

			<p style='z-index:1000; position: absolute; top:126.8mm;left: 65mm; right: 0 ;' >
				<i style='font-size:20px'><b>$inicio</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:126.8mm;left: 118mm; right: 0 ;' >
				<i style='font-size:20px'><b>$fin</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:126.8mm;left: 223mm; right: 0 ;' >
				<i style='font-size:20px'><b>$hora</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:138.5mm;left:152mm; right: 0 ;' >
				<b style='font-size:13px'>$folio</b> 
			</p>

			<p style='z-index:1000; position: absolute; top:148.5mm;left:143mm; right: 0 ;' >
				<b style='font-size:13px'>$correlativo</b> 
			</p>

			<p style='z-index:1000; position: absolute; top:138mm;left:200mm; right: 0 ;' >
				<i style='font-size:20px'>$concepto</i>
			</p>

			<p style='z-index:1000; position: absolute; top:145.5mm;left:200mm; right: 0 ;' >
				<i style='font-size:20px'><b>$modalidad</b></i>
			</p>
	
		";
		$calificacion = "<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
							<img src='./assets/img/$cers.jpg'
							style='width: 210mm; height: 297mm; margin: 0' />
						</div>";
		$primero=41;
		$espacio=15;
		foreach($notas as $nota){
			$modulo = $nota->modulo;
			$nts = $nota->nota;
				if ($nts < 11) {
					$nt=" ";
				} else{
					$nt=$nts;
				}
				switch ($nt) {case 11: $letra= "ONCE";break;case 12: $letra= "DOCE";break;
				case 13: $letra= "TRECE";break;case 14: $letra= "CATORCE";break;case 15:$letra= "QUINCE";break;
				case 16:$letra= "DIECISÉIS";break;case 17:$letra= "DIECISIETE";	break;
				case 18:$letra= "DIECIOCHO";break;case 19:$letra= "DIECINUEVE"; break;
				case 20: $letra= "VEINTE"; break;default: $letra=" "; }
			$hor = $nota->hora;	
			if ($hor < 10) {
				$hora="0".$hor;
			} else{
				$hora=$hor;
			}	

			$calificacion .= "

			";
			$primero=$primero+$espacio;
		}

		$calificacion .= "
			<p style='z-index:1000; position: absolute; top:162mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>TARAPOTO, $fechaimpresion</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:162mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>$glosa</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:172mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>INSCRITO EN EL FOLIO: $folio</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:179mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>CON EL N°: $correlativo</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:186mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>DEL LIBRO DE CERTIFICADOS DEL CTI</b> 
			</p>
		";

		$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
		$mpdf->WriteHTML($background);
		$mpdf->AddPage();
		$mpdf->WriteHTML($calificacion);
		$mpdf->Output();
		//$this->load->view("admin/Certificados/view", $data);
	}

	public function fondo($id,$pre){
		$data  = array(
			'estudiante' => $this->Certificados_model->getEstudiante($id),
			'detalle' => $this->Certificados_model->getDetalle($pre),
			'horas' => $this->Certificados_model->getHoras($pre),
		
		); 
		//$this->load->view("admin/Certificados/view", $data);
		//exit(json_encode($data));
		//exit(var_dump($data['detalle']));
		$alumno = $data['estudiante']->alumno;
		$tipo = $data['estudiante']->tipocurso;
		if ($tipo == "EXAMEN DE SUFICIENCIA") {
			$glosa="EXAMEN DE SUFICIENCIA DE 10 HORAS, EQUIVALENTE A 80 HORAS DEL CURSO PRESENCIAL ";
		}else{
			$glosa="";
		}
		$curso = $data['estudiante']->curso;
		$ini= $data['estudiante']->fecha_ini;
		$inicio = date("d/m/Y", strtotime($ini));
		$f = $data['estudiante']->fecha_fin;
		$fin = date("d/m/Y", strtotime($f));
		$folio = $data['estudiante']->folio;
		$hora = $data['horas']->horas;
		$correlativo = $data['estudiante']->correlativo;
		$fecha = $data['estudiante']->fecha;
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$fechaimpresion = strtoupper(strftime("%d de %B de %Y", strtotime($fecha)));
		$cer = $data['estudiante']->img;
		$cers = $data['estudiante']->img."spd";
		$notas = $data['detalle'];
		
		/* formato con diseño digital segun puntos del papel pdf*/
		$background = "
			<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
				<img src='./assets/img/$cer.jpg'
					style='width: 210mm; height: 297mm; margin: 0' />
			</div>
			
			<p style='z-index:1000; position: absolute;top:78mm; left:0; right: 0 ; font-size: xx-large; '>
				<p style='text-align:center'><b style='font-size:30px'>$alumno</b></p>
			</p>

			<p style='z-index:1000; position: absolute; top:98.7mm;left:120.3mm; right: 0 ;' >
				<i style='font-size:22px'> del  <b> $tipo</b> </i>
			</p>

			<p style='z-index:1000; position: absolute;top:102mm; left:0; right: 0 ; font-size: xx-large; '>
				<p style='text-align:center; line-height: 30px'><b style='font-size:30px'>$curso</b></p>
			</p>

			<p style='z-index:1000; position: absolute; top:126.2mm;left: 65mm; right: 0 ;' >
				<i style='font-size:18px'><b>$inicio</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:126.2mm;left: 120mm; right: 0 ;' >
				<i style='font-size:18px'><b>$fin</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:126.2mm;left: 224mm; right: 0 ;' >
				<i style='font-size:18px'><b>$hora</b></i>
			</p>

			<p style='z-index:1000; position: absolute; top:137.2mm;left:155mm; right: 0 ;' >
				<b style='font-size:13px'>$folio</b> 
			</p>

			<p style='z-index:1000; position: absolute; top:147.2mm;left:146mm; right: 0 ;' >
				<b style='font-size:13px'>$correlativo</b> 
			</p>
	
		";
		$calificacion = "<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
							<img src='./assets/img/$cers.jpg'
							style='width: 210mm; height: 297mm; margin: 0' />
						</div>";
		$primero=40;
		$espacio=15;
		$promedio=0;

		foreach($notas as $nota){
			$modulo = $nota->modulo;
			$nts = $nota->nota;
				if ($nts < 11) {
					$nt=" ";
				} else{
					$nt=$nts;
				}
				switch ($nt) {case 11: $letra= "ONCE";break;case 12: $letra= "DOCE";break;
				case 13: $letra= "TRECE";break;case 14: $letra= "CATORCE";break;case 15:$letra= "QUINCE";break;
				case 16:$letra= "DIECISÉIS";break;case 17:$letra= "DIECISIETE";	break;
				case 18:$letra= "DIECIOCHO";break;case 19:$letra= "DIECINUEVE"; break;
				case 20: $letra= "VEINTE"; break;default: $letra=" "; }
			$hor = $nota->hora;	
			if ($hor < 10) {
				$hora="0".$hor;
			} else{
				$hora=$hor;
			}	

			$calificacion .= "
				
				<div  style='z-index:1000; position: absolute; top:$primero.mm;left:22mm; right: 0 ; '>
					<table  style='font-size:20px'>
						<tr>
							<td  width='128mm' >
								<b>$modulo</b>
							</td >
							<td width='61mm'  >
							&nbsp;&nbsp;&nbsp;<b>$letra</b>
							</td>
							<td width='33mm' align='center' >
								<b>$nt</b>
							</td>
							<td width='35mm' align='center' >
								<b>$hora<b>
							</td>

						</tr>				
					</table>
				</div>
			";
			$primero=$primero+$espacio;

		}

		$calificacion .= "
			<p style='z-index:1000; position: absolute; top:162mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>$glosa</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:172mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>INSCRITO EN EL FOLIO: $folio</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:179mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>CON EL N°: $correlativo</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:186mm;left:22mm; right: 0 ;' >
				<b style='font-size:16px'>DEL LIBRO DE Certificados DEL CTI</b> 
			</p>
			<p style='z-index:1000; position: absolute; top:172mm;left:185mm; right: 0 ;' >
				<b style='font-size:16px'>TARAPOTO, $fechaimpresion</b> 
			</p>
		";

		/* formato papel membretado del cti*/
		$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
		$mpdf->WriteHTML($background);
		$mpdf->AddPage();
		$mpdf->WriteHTML($calificacion);
		$mpdf->Output();
		//$this->load->view("admin/Certificados/view", $data);
	}

	public function ficha($id,$pre){
		$data  = array(
			'estudiante' => $this->Certificados_model->getEstudiante($id),
			'detalle' => $this->Certificados_model->getDetalle($pre),
			'horas' => $this->Certificados_model->getHoras($pre),
		
		); 
		//$this->load->view("admin/Certificados/view", $data);
		//exit(json_encode($data));
		//exit(var_dump($data['detalle']));
		$dni = $data['estudiante']->num_documento;
		$alumno = $data['estudiante']->alumno;
		$tipo = $data['estudiante']->tipocurso;
		if($tipo == "EXAMEN DE SUFICIENCIA"){
			$glosa="EXAMEN DE SUFICIENCIA DE 10 HORAS, EQUIVALENTE A 80 HORAS DEL CURSO PRESENCIAL ";
		}else{
			$glosa="";
		}
		$curso = $data['estudiante']->curso;
		$ini= $data['estudiante']->fecha_ini;
		$inicio = date("d/m/Y", strtotime($ini));
		$f = $data['estudiante']->fecha_fin;
		$fin = date("d/m/Y", strtotime($f));
		$folio = $data['estudiante']->folio;
		$hora = $data['horas']->horas;
		$correlativo = $data['estudiante']->correlativo;
		$fecha = $data['estudiante']->fecha;
		setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
		$fechaimpresion = strtoupper(strftime("%d de %B de %Y", strtotime($fecha)));
		$fecha_f = $data['estudiante']->fecha_entre;
		setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
		//date_default_timezone_set('Europe/Madrid');
		$fecha_ficha = strtoupper(strftime("%d de %B de %Y", strtotime($fecha_f )));
		/* formato con diseño digital segun puntos del papel pdf*/
		$background = "
			<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
				<img src='./assets/img/ficha.jpg'
					style='width: 210mm; height: 297mm; margin: 0' />
			</div>
			
			<p style='z-index:1000; position: absolute;top:75mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'>$dni</b></p>
			</p>
			<p style='z-index:1000; position: absolute;top:87mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'> $alumno</b></p>
			</p>

			<p style='z-index:1000; position: absolute;top:99mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'> $tipo</b></p>
			</p>

			<p style='z-index:1000; position: absolute;top:111mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'> $curso</b></p>
			</p>

			<p style='z-index:1000; position: absolute;top:123mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'>$inicio</b></p>
			</p>

			<p style='z-index:1000; position: absolute;top:135mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'>$fin</b></p>
			</p>

			<p style='z-index:1000; position: absolute;top:147mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'>$hora HORAS</b></p>
			</p>

			<p style='z-index:1000; position: absolute;top:159mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'>$folio</b> </p>
			</p>

			<p style='z-index:1000; position: absolute;top:171mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'>$correlativo</b></p>
			</p>

			<p style='z-index:1000; position: absolute;top:183mm; left:300; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:18px'>$fechaimpresion</b> </p>
			</p>

			<p style='z-index:1000; position: absolute;top:205mm; left:430; right: 0 ; font-size: xx-large; '>
				<p ><b style='font-size:16px'>TARAPOTO, $fecha_ficha</b> </p>
			</p>
	
		";
		/* formato papel membretado del cti*/
		
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($background);
		//$mpdf->AddPage();
		//$mpdf->WriteHTML($calificacion);
		$mpdf->Output();
		//$this->load->view("admin/Certificados/view", $data);
	}

	public function diplomas($id,$pre){
		$data  = array(
			'estudiante' => $this->Certificados_model->getEstudiante($id),
			'detalle' => $this->Certificados_model->getDetalle($pre),
			'horas' => $this->Certificados_model->getHoras($pre),
		
		);

		//$this->load->view("admin/Certificados/view", $data);
		//exit(json_encode($data));
		//exit(var_dump($data['detalle']));
		$alumno = $data['estudiante']->alumno;
		$tipo = $data['estudiante']->tipocurso;
		if($tipo == "EXAMEN DE SUFICIENCIA") {
			$glosa="EXAMEN DE SUFICIENCIA DE 10 HORAS, EQUIVALENTE A 80 HORAS DEL CURSO PRESENCIAL ";
		}else{
			$glosa="";
		}
		$curso = $data['estudiante']->curso;
		$ini= $data['estudiante']->fecha_ini;
		$inicio = date("d/m/Y", strtotime($ini));
		$f = $data['estudiante']->fecha_fin;
		$fin = date("d/m/Y", strtotime($f));
		$folio = $data['estudiante']->folio;
		$hora = $data['horas']->horas;
		$correlativo = $data['estudiante']->correlativo;
		$fecha = $data['estudiante']->fecha;
		setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
		$fechaimpresion = strtoupper(strftime("%d de %B de %Y", strtotime($fecha)));
		$cer = $data['estudiante']->img;
		$cers = $data['estudiante']->img."spd";
		$notas = $data['detalle'];
		/* formato papel membretado del cti*/
		$modalidad = $data['estudiante']->modalidad;
		if($modalidad != null){
			$concepto="En la modalidad de :";
		}else{
			$concepto="";
		};
		$background = "
			<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
				<img src='./assets/img/diploma.jpg'
					style='width: 210mm; height: 297mm; margin: 0' />
			</div>
			<p style='z-index:1000; position: absolute;top:103mm; left:200; right: 0 ; font-size: xx-large; border:1px'>
				<p style='text-align:center'><b style='font-size:25px'>$alumno</b></p>
			</p>	
		";
		$calificacion = "<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
							<img src='./assets/img/diplomaspd.jpg'
							style='width: 210mm; height: 297mm; margin: 0' />
						</div>";
		$primero=55;
		$espacio=17;
		$promedio=0;
		$cant=4;
		foreach($notas as $nota){
			$modulo = $nota->modulo;
			$nts = $nota->nota;
				if ($nts < 11) {
					$nt=" ";
				} else{
					$nt=$nts;
				}
				switch ($nt) {case 11: $letra= "ONCE";break;case 12: $letra= "DOCE";break;
				case 13: $letra= "TRECE";break;case 14: $letra= "CATORCE";break;case 15:$letra= "QUINCE";break;
				case 16:$letra= "DIECISÉIS";break;case 17:$letra= "DIECISIETE";	break;
				case 18:$letra= "DIECIOCHO";break;case 19:$letra= "DIECINUEVE"; break;
				case 20: $letra= "VEINTE"; break;default: $letra=" "; }
			$hor = $nota->hora;	
			if($hor < 10) {
				$hora="0".$hor;
			}else{
				$hora=$hor;
			}	
			$calificacion .= "
				<div  style='z-index:1000; position: absolute; top:$primero.mm;left:22mm; right: 0 ; '>
					<table  style='font-size:30px'>
						<tr>
							<td width='128mm'>
								<b></b>
							</td>
							<td width='61mm'>
							&nbsp;&nbsp;&nbsp;<b></b>
							</td>
							<td width='60mm' align='center' >
								<b>$nt</b>
							</td>
						</tr>				
					</table>
				</div>
			";

			$promedio = $promedio+ $nt;
			$primero=$primero+$espacio;
		}
		
		$promedio=round(($promedio/$cant),0);
		$calificacion .= "
			<div  style='z-index:1000; position: absolute; top:$primero.mm;left:22mm; right: 0 ; '>
				<table  style='font-size:30px'>
					<tr>
						<td  width='128mm' >
							<b></b>
						</td >
						<td width='61mm'  >
						<b> PROMEDIO :</b>
						</td>
						<td width='60mm' align='center' >
							<b>$promedio </b>
						</td>
					</tr>				
				</table>
			</div>
		";

		$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
		$mpdf->WriteHTML($background);
		$mpdf->AddPage();
		$mpdf->WriteHTML($calificacion);
		$mpdf->Output();
		//$this->load->view("admin/Certificados/view", $data);
	}
}