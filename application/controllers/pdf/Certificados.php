<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once './vendor/autoload.php';

class Certificados extends CI_Controller
{
	public function __construct()
	{
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
		//$this->load->model("Certificados_model");
	}

	public function view($id,$pre)
	{
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
				$glosa="EXAMEN DE SUFICIENCIA DE 10 HORAS EQUIVALENTE A 80 HORAS DEL CURSO PRESENCIAL ";
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
		$cer = $data['estudiante']->cara;
		$cers = $data['estudiante']->espalda;
		$notas = $data['detalle'];
		$background = "
			<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
				<img src='./assets/img/$cer'
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
	
		";
		$calificacion = "<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
							<img src='./assets/img/$cers'
							style='width: 210mm; height: 297mm; margin: 0' />
						</div>";
		$primero=41;
		$espacio=15;
		foreach($notas as $nota){
			$modulo = $nota->modulo;
			$nts = $nota->nota;
				if ($nts < 14) {
					$nt=" ";
				} else{
					$nt=$nts;
				}
				switch ($nt) {case 14: $letra= "CATORCE";break;case 15:$letra= "QUINCE";break;
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
				<p style='z-index:1000; position: absolute; top:172mm;left:22mm; right: 0 ;' >
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


	public function certificado($id,$pre)
	{
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
				$glosa="EXAMEN DE SUFICIENCIA DE 10 HORAS EQUIVALENTE A 80 HORAS DEL CURSO PRESENCIAL ";
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
		$cer = $data['estudiante']->cara;
		$cers = $data['estudiante']->espalda;
		$notas = $data['detalle'];
		/* formato digital segun puntos del papel pdf*/
		$background = "
			<div style='position: absolute; left:0; right: 0; top: 0; bottom: 0;'>
				<img src='./assets/img/$cer'
					style='width: 210mm; height: 297mm; margin: 0' />
			</div>
			
			<p style='z-index:1000; position: absolute;top:78mm; left:0; right: 0 ; font-size: xx-large; '>
				<p style='text-align:center'><b style='font-size:30px'>$alumno</b></p>
			</p>

			<p style='z-index:1000; position: absolute; top:98.8mm;left:120.3mm; right: 0 ;' >
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
							<img src='./assets/img/$cers'
							style='width: 210mm; height: 297mm; margin: 0' />
						</div>";
		$primero=40;
		$espacio=15;
		foreach($notas as $nota){
			$modulo = $nota->modulo;
			$nts = $nota->nota;
				if ($nts < 14) {
					$nt=" ";
				} else{
					$nt=$nts;
				}
				switch ($nt) {case 14: $letra= "CATORCE";break;case 15:$letra= "QUINCE";break;
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
				<p style='z-index:1000; position: absolute; top:172mm;left:22mm; right: 0 ;' >
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

}
